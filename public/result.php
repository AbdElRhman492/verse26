<?php
// result.php
require_once __DIR__ . '/../api/db.php';

$attempt_id = $_GET['attempt_id'] ?? null;
if (!$attempt_id) die("❌ attempt_id مفقود");

// Fetch attempt details
$stmt = $pdo->prepare("
  SELECT qa.*, s.name as student_name, s.phone as student_phone
  FROM quiz_attempts qa
  JOIN students s ON qa.student_id = s.id
  WHERE qa.id = ?
");
$stmt->execute([$attempt_id]);
$attempt = $stmt->fetch();
if (!$attempt) die("❌ المحاولة غير موجودة");

// Fetch answers with questions
$stmt = $pdo->prepare("
  SELECT q.*, qa.student_answer, qa.is_correct, c.name as category_name
  FROM quiz_answers qa
  JOIN questions q ON qa.question_id = q.id
  LEFT JOIN categories c ON q.category_id = c.id
  WHERE qa.attempt_id = ?
  ORDER BY qa.id
");
$stmt->execute([$attempt_id]);
$answers = $stmt->fetchAll();

$totalQuestions = count($answers);
$correctAnswers = $attempt['score'];
$percentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100) : 0;
$percentageCorrect = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100) : 0;
$percentageWrong = 100 - $percentageCorrect;

// Determine performance level
$performanceLevel = '';
$performanceColor = '';
$performanceIcon = '';
if ($percentage >= 90) {
  $performanceLevel = 'Excellent';
  $performanceColor = 'success';
  $performanceIcon = '🏆';
} elseif ($percentage >= 80) {
  $performanceLevel = 'Very Good';
  $performanceColor = 'success';
  $performanceIcon = '🎉';
} elseif ($percentage >= 70) {
  $performanceLevel = 'Good';
  $performanceColor = 'info';
  $performanceIcon = '👍';
} elseif ($percentage >= 60) {
  $performanceLevel = 'Fair';
  $performanceColor = 'warning';
  $performanceIcon = '📚';
} else {
  $performanceLevel = 'Needs Improvement';
  $performanceColor = 'error';
  $performanceIcon = '💪';
}

ob_start();
?>

<div class="max-w-5xl w-full mx-auto px-4">
  <!-- Header -->
  <div class="text-center mb-12">
    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-<?php echo $performanceColor; ?>-400 to-<?php echo $performanceColor; ?>-600 rounded-full mb-6 shadow-glow animate-bounce-gentle">
      <span class="text-4xl"><?php echo $performanceIcon; ?></span>
    </div>
    <h1 class="text-5xl font-display font-bold mb-4 gradient-text">Quiz Complete!</h1>
    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto leading-relaxed">
      Congratulations on completing the quiz! Here's your detailed performance analysis.
    </p>
  </div>

  <!-- Score Summary -->
  <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/20 dark:border-gray-700/30 mb-8 card-animate">
    <div class="grid md:grid-cols-3 gap-8">
      <!-- Overall Score -->
      <div class="text-center">
        <div class="w-20 h-20 bg-gradient-to-r from-primary-400 to-primary-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-glow">
          <span class="text-2xl font-bold text-white"><?php echo $percentage; ?>%</span>
        </div>
        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Overall Score</h3>
        <p class="text-gray-600 dark:text-gray-400"><?php echo $performanceLevel; ?></p>
      </div>

      <!-- Correct Answers -->
      <div class="text-center">
        <div class="w-20 h-20 bg-gradient-to-r from-success-400 to-success-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-glow">
          <span class="text-2xl font-bold text-white"><?php echo $correctAnswers; ?></span>
        </div>
        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Correct Answers</h3>
        <p class="text-gray-600 dark:text-gray-400">Out of <?php echo $totalQuestions; ?> questions</p>
      </div>

      <!-- Incorrect Answers -->
      <div class="text-center">
        <div class="w-20 h-20 bg-gradient-to-r from-error-400 to-error-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-glow">
          <span class="text-2xl font-bold text-white"><?php echo $totalQuestions - $correctAnswers; ?></span>
        </div>
        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Incorrect Answers</h3>
        <p class="text-gray-600 dark:text-gray-400">Areas to improve</p>
      </div>
    </div>

    <!-- Progress Bar -->
    <div class="mt-8">
      <div class="flex items-center justify-between mb-2">
        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
          Performance
        </span>
        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
          <?php echo $percentageCorrect; ?>% / <?php echo $percentageWrong; ?>%
        </span>
      </div>

      <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 flex overflow-hidden">
        <!-- Success / Correct -->
        <div class="h-4 bg-green-500 transition-all duration-1000" style="width: <?php echo $percentageCorrect; ?>%"></div>

        <!-- Wrong / Incorrect -->
        <div class="h-4 bg-red-500 transition-all duration-1000" style="width: <?php echo $percentageWrong; ?>%"></div>
      </div>
    </div>
  </div>

  <!-- Detailed Question Review -->
  <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/20 dark:border-gray-700/30 card-animate">
    <div class="flex items-center justify-between mb-8 flex-col sm:flex-row gap-4">
      <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Question Review</h2>
      <div class="flex gap-2 flex-wrap">
        <button onclick="filterQuestions(true)" class="btn-filter bg-success-100 dark:bg-success-900 text-success-800 dark:text-success-200">Show Correct Only</button>
        <button onclick="filterQuestions(false)" class="btn-filter bg-error-100 dark:bg-error-900 text-error-800 dark:text-error-200">Show Incorrect Only</button>
        <button onclick="filterQuestions('all')" class="btn-filter bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">Show All</button>
      </div>
    </div>

    <div class="space-y-6">
      <?php foreach ($answers as $index => $ans): ?>
        <div class="question-result p-6 rounded-2xl border-2 <?php echo $ans['is_correct'] ? 'border-success-200 dark:border-success-800 bg-success-50 dark:bg-success-900/20' : 'border-error-200 dark:border-error-800 bg-error-50 dark:bg-error-900/20'; ?> transition-all duration-300" data-correct="<?php echo $ans['is_correct'] ? 'true' : 'false'; ?>">
          <div class="flex items-start gap-4 mb-4">
            <div class="flex-shrink-0 w-10 h-10 <?php echo $ans['is_correct'] ? 'bg-success-500' : 'bg-error-500'; ?> rounded-full flex items-center justify-center text-white font-bold text-lg">
              <?php echo $index + 1; ?>
            </div>
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-3 flex-wrap">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                  <?php echo htmlspecialchars($ans['question_text']); ?>
                </h3>
                <span class="<?php echo $ans['is_correct'] ? 'bg-success-100 dark:bg-success-900 text-success-800 dark:text-success-200' : 'bg-error-100 dark:bg-error-900 text-error-800 dark:text-error-200'; ?> px-3 py-1 rounded-full text-sm font-medium">
                  <?php echo $ans['is_correct'] ? '✅ Correct' : '❌ Incorrect'; ?>
                </span>
                <span class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-3 py-1 rounded-full text-sm font-medium">
                  <?php echo $ans['difficulty_level']; ?>
                </span>
              </div>

              <div class="space-y-2">
                <?php foreach (['A', 'B', 'C', 'D'] as $opt):
                  if (empty($ans['option_' . strtolower($opt)])) continue;
                  $isCorrectOption = $opt === $ans['correct_option'];
                  $isStudentChoice = $opt === $ans['student_answer'];
                ?>
                  <div class="flex items-center gap-3 p-3 rounded-xl <?php
                                                                      if ($isCorrectOption) echo 'bg-success-100 dark:bg-success-900/30 border border-success-200 dark:border-success-800';
                                                                      elseif ($isStudentChoice && !$isCorrectOption) echo 'bg-error-100 dark:bg-error-900/30 border border-error-200 dark:border-error-800';
                                                                      else echo 'bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600';
                                                                      ?>">
                    <span class="w-8 h-8 <?php
                                          if ($isCorrectOption) echo 'bg-success-500 text-white';
                                          elseif ($isStudentChoice && !$isCorrectOption) echo 'bg-error-500 text-white';
                                          else echo 'bg-gray-300 dark:bg-gray-600 text-gray-600 dark:text-gray-300';
                                          ?> rounded-full flex items-center justify-center font-bold text-sm"><?php echo $opt; ?></span>
                    <span class="text-gray-800 dark:text-white font-medium flex-1"><?php echo htmlspecialchars($ans['option_' . strtolower($opt)]); ?></span>
                    <?php if ($isCorrectOption) echo '<span class="text-success-600 dark:text-success-400 text-lg">✓</span>'; ?>
                    <?php if ($isStudentChoice && !$isCorrectOption) echo '<span class="text-error-600 dark:text-error-400 text-lg">✗</span>'; ?>
                  </div>
                <?php endforeach; ?>
                <div class="text-gray-700 dark:text-gray-300 font-medium text-sm mt-2">
                  <span class="text-primary-600 dark:text-primary-400">Category:</span> <?php echo htmlspecialchars($ans['category_name'] ?? 'Uncategorized'); ?>
                </div>
                <div class="text-gray-700 dark:text-gray-300 font-medium text-sm">
                  <span class="text-primary-600 dark:text-primary-400">Grade:</span> <?php echo $ans['points']; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="text-center mt-8">
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="index.php" class="btn-main">Take Another Quiz 🔄</a>
      <a href="leaderboard.php" class="btn-main">View Leaderboard 🏆</a>
    </div>
  </div>
</div>

<script>
  function filterQuestions(showCorrect) {
    document.querySelectorAll('.question-result').forEach(q => {
      if (showCorrect === 'all') q.style.display = 'block';
      else q.dataset.correct === (showCorrect ? 'true' : 'false') ? q.style.display = 'block' : q.style.display = 'none';
    });
  }

  // Animate question cards on load
  document.addEventListener('DOMContentLoaded', function() {
    const questions = document.querySelectorAll('.question-result');
    questions.forEach((q, i) => {
      q.style.opacity = '0';
      q.style.transform = 'translateY(20px)';
      setTimeout(() => {
        q.style.transition = 'all 0.5s ease-out';
        q.style.opacity = '1';
        q.style.transform = 'translateY(0)';
      }, i * 100);
    });
  });
</script>

<style>
  .btn-filter {
    padding: 0.5rem 1rem;
    /* equivalent to Tailwind px-4 py-2 */
    border-radius: 0.5rem;
    /* rounded-lg */
    font-size: 0.875rem;
    /* text-sm */
    font-weight: 500;
    /* font-medium */
    transition: all 0.2s;
  }

  .btn-filter:hover {
    filter: brightness(1.05);
  }

  .btn-main {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    font-weight: bold;
    color: white;
    border-radius: 1rem;
    background: linear-gradient(to right, #3b82f6, #2563eb);
    transition: all 0.3s;
    transform: scale(1);
  }

  .btn-main:hover {
    transform: scale(1.02);
    box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
  }

  .shadow-glow {
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  }
</style>

<?php
$content = ob_get_clean();
include 'layout.php';
?>