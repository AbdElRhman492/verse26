<?php
// quiz.php
session_start();
require_once __DIR__ . '/../api/db.php';

$attempt_id = $_GET['attempt_id'] ?? null;
if (!$attempt_id || !isset($_SESSION['quiz'][$attempt_id])) {
  die("❌ الكويز غير موجود أو انتهى");
}

$questions = $_SESSION['quiz'][$attempt_id];
$totalQuestions = count($questions);

ob_start();
?>

<div class="max-w-4xl w-full mx-auto px-4">
  <!-- Quiz Header -->
  <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-3xl p-6 shadow-2xl border border-white/20 dark:border-gray-700/30 mb-6 card-animate">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
      <div>
        <h1 class="text-3xl font-display font-bold gradient-text mb-2">Quiz Time!</h1>
        <p class="text-gray-600 dark:text-gray-400">Answer all questions to complete the quiz</p>
      </div>
      <div class="text-right">
        <div class="text-2xl font-bold text-primary-600 dark:text-primary-400" id="timer">00:00</div>
        <div class="text-sm text-gray-600 dark:text-gray-400">Time Elapsed</div>
      </div>
    </div>

    <!-- Progress Bar -->
    <div class="mt-6">
      <div class="flex items-center justify-between mb-2">
        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Progress</span>
        <span class="text-sm font-medium text-gray-700 dark:text-gray-300" id="progressText">0 / <?php echo $totalQuestions; ?></span>
      </div>
      <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
        <div class="bg-gradient-to-r from-primary-500 to-primary-600 h-3 rounded-full transition-all duration-500" id="progressBar" style="width:0%"></div>
      </div>
    </div>
  </div>

  <!-- Quiz Form -->
  <form id="quizForm" class="space-y-8 bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/20 dark:border-gray-700/30 card-animate">
    <input type="hidden" name="attempt_id" value="<?php echo $attempt_id; ?>">

    <?php foreach ($questions as $index => $q): ?>
      <div class="question-card p-6 rounded-2xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-question="<?php echo $index + 1; ?>">
        <div class="flex items-start gap-4 mb-4">
          <!-- Question Number Circle -->
          <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
            <?php echo $index + 1; ?>
          </div>

          <div class="flex-1">
            <!-- Question Text -->
            <h3 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-white mb-3 leading-relaxed">
              <?php echo htmlspecialchars($q['question_text']); ?>
              <span class="text-sm text-primary-600 dark:text-primary-400 ml-2">[<?php echo $q['difficulty_level']; ?>]</span>
            </h3>

            <!-- Options -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
              <?php foreach (['A', 'B', 'C', 'D'] as $opt):
                $field = "option_" . strtolower($opt);
                if (!$q[$field]) continue; ?>
                <label class="option-label group flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-gray-600 cursor-pointer transition-all duration-300 hover:border-primary-500 hover:bg-primary-50 dark:hover:bg-primary-900">
                  <input type="radio" name="answers[<?php echo $q['id']; ?>]" value="<?php echo $opt; ?>" required class="sr-only option-radio" />

                  <!-- Custom Radio Circle -->
                  <div class="w-6 h-6 border-2 border-gray-300 dark:border-gray-500 rounded-full flex items-center justify-center transition-all duration-300 group-hover:border-primary-500">
                    <div class="w-3 h-3 bg-primary-500 rounded-full opacity-0 transition-opacity duration-300 radio-dot"></div>
                  </div>

                  <div class="flex-1 text-gray-800 dark:text-white font-medium">
                    <span class="mr-2 font-bold"><?php echo $opt; ?>.</span> <?php echo htmlspecialchars($q[$field]); ?>
                  </div>
                </label>
              <?php endforeach; ?>
            </div>

            <!-- Grade -->
            <div class="text-gray-700 dark:text-gray-300 font-medium text-sm">
              <span class="text-primary-600 dark:text-primary-400">Grade:</span> <?php echo htmlspecialchars($q['points']); ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <!-- Submit Button -->
    <div class="text-center pt-6">
      <button type="submit" id="submitBtn" class="px-8 py-4 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold text-lg rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-800 disabled:opacity-50 disabled:cursor-not-allowed">
        <span class="flex items-center justify-center gap-3">
          <span>Submit Quiz</span>
          <span class="text-xl">✅</span>
        </span>
      </button>
    </div>

    <!-- Message Display -->
    <div id="formMessage" class="mt-6 text-center"></div>
  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('quizForm');
    const submitBtn = document.getElementById('submitBtn');
    const messageDiv = document.getElementById('formMessage');
    const timerElement = document.getElementById('timer');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');

    const totalQuestions = <?php echo $totalQuestions; ?>;
    let startTime = Date.now();
    let timerInterval;

    function startTimer() {
      timerInterval = setInterval(() => {
        const elapsed = Date.now() - startTime;
        const minutes = Math.floor(elapsed / 60000);
        const seconds = Math.floor((elapsed % 60000) / 1000);
        timerElement.textContent = `${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')}`;
      }, 1000);
    }

    function updateProgress() {
      const answered = document.querySelectorAll('.option-radio:checked').length;
      const percent = (answered / totalQuestions) * 100;
      progressBar.style.width = `${percent}%`;
      progressText.textContent = `${answered} / ${totalQuestions}`;
      submitBtn.disabled = answered < totalQuestions;
    }

    document.querySelectorAll('.option-radio').forEach(radio => {
      radio.addEventListener('change', updateProgress);
    });

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (document.querySelectorAll('.option-radio:checked').length < totalQuestions) {
        messageDiv.textContent = `Please answer all ${totalQuestions} questions.`;
        messageDiv.className = "text-red-500 mt-4";
        return;
      }

      clearInterval(timerInterval);
      submitBtn.disabled = true;
      messageDiv.textContent = "Submitting your answers...";
      messageDiv.className = "text-blue-500 mt-4";

      try {
        const formData = new FormData(form);
        const res = await fetch("../api/submit.php", {
          method: "POST",
          body: formData
        });
        const data = await res.json();

        if (data.status === "ok") {
          messageDiv.textContent = "✅ Quiz submitted! Redirecting...";
          messageDiv.className = "text-green-500 mt-4";
          setTimeout(() => window.location.href = `result.php?attempt_id=${data.attempt_id}`, 1500);
        } else {
          messageDiv.textContent = data.message;
          messageDiv.className = "text-red-500 mt-4";
        }
      } catch (err) {
        messageDiv.textContent = "Network error occurred. Please try again.";
        messageDiv.className = "text-red-500 mt-4";
      } finally {
        submitBtn.disabled = false;
      }
    });

    startTimer();
    updateProgress();
  });
</script>

<style>
  .question-card:hover {
    transform: translateY(-2px);
  }

  .option-label .radio-dot {
    opacity: 0;
    transition: opacity 0.3s;
  }

  .option-radio:checked+div .radio-dot {
    opacity: 1;
  }
</style>

<?php
$content = ob_get_clean();
include 'layout.php';
?>