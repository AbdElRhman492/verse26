<?php
// leaderboard.php
require_once __DIR__ . '/../api/db.php';

// Get leaderboard data with student information
$stmt = $pdo->prepare("
  SELECT 
    qa.id as attempt_id,
    qa.score,
    qa.duration,
    qa.created_at,
    s.name as student_name,
    s.phone as student_phone,
    COUNT(qa2.id) as total_questions,
    ROUND((qa.score / COUNT(qa2.id)) * 100, 1) as percentage
  FROM quiz_attempts qa
  JOIN students s ON qa.student_id = s.id
  LEFT JOIN quiz_answers qa2 ON qa.id = qa2.attempt_id
  GROUP BY qa.id, qa.score, qa.duration, qa.created_at, s.name, s.phone
  ORDER BY qa.score DESC, qa.duration ASC, qa.created_at ASC
  LIMIT 50
");
$stmt->execute();
$leaderboard = $stmt->fetchAll();

// Get statistics
$statsStmt = $pdo->query("
  SELECT 
    COUNT(DISTINCT qa.id) as total_attempts,
    COUNT(DISTINCT s.id) as total_students,
    AVG(qa.score) as avg_score,
    MAX(qa.score) as highest_score
  FROM quiz_attempts qa
  JOIN students s ON qa.student_id = s.id
");
$stats = $statsStmt->fetch();

ob_start();
?>

<div class="max-w-6xl w-full mx-auto">
  <!-- Header Section -->
  <div class="text-center mb-12">
    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-accent-400 to-accent-600 rounded-full mb-6 shadow-glow animate-bounce-gentle">
      <span class="text-4xl">🏆</span>
    </div>
    <h1 class="text-5xl font-display font-bold mb-4 gradient-text">
      Leaderboard
    </h1>
    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto leading-relaxed">
      See how you rank against other quiz takers! The leaderboard is updated in real-time.
    </p>
  </div>

  <!-- Statistics Cards -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/20 dark:border-gray-700/30 text-center card-animate">
      <div class="w-12 h-12 bg-gradient-to-r from-primary-400 to-primary-600 rounded-full flex items-center justify-center mx-auto mb-4">
        <span class="text-xl">👥</span>
      </div>
      <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2"><?php echo $stats['total_students']; ?></h3>
      <p class="text-gray-600 dark:text-gray-400">Total Students</p>
    </div>

    <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/20 dark:border-gray-700/30 text-center card-animate">
      <div class="w-12 h-12 bg-gradient-to-r from-secondary-400 to-secondary-600 rounded-full flex items-center justify-center mx-auto mb-4">
        <span class="text-xl">📊</span>
      </div>
      <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2"><?php echo $stats['total_attempts']; ?></h3>
      <p class="text-gray-600 dark:text-gray-400">Quiz Attempts</p>
    </div>

    <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/20 dark:border-gray-700/30 text-center card-animate">
      <div class="w-12 h-12 bg-gradient-to-r from-success-400 to-success-600 rounded-full flex items-center justify-center mx-auto mb-4">
        <span class="text-xl">⭐</span>
      </div>
      <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2"><?php echo round($stats['avg_score'], 1); ?></h3>
      <p class="text-gray-600 dark:text-gray-400">Average Score</p>
    </div>

    <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white/20 dark:border-gray-700/30 text-center card-animate">
      <div class="w-12 h-12 bg-gradient-to-r from-warning-400 to-warning-600 rounded-full flex items-center justify-center mx-auto mb-4">
        <span class="text-xl">🎯</span>
      </div>
      <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2"><?php echo $stats['highest_score']; ?></h3>
      <p class="text-gray-600 dark:text-gray-400">Highest Score</p>
    </div>
  </div>

  <!-- Leaderboard Table -->
  <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/20 dark:border-gray-700/30 card-animate">
    <div class="flex items-center justify-between mb-8">
      <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Top Performers</h2>
      <div class="flex gap-2">
        <button onclick="refreshLeaderboard()" class="px-4 py-2 bg-primary-100 dark:bg-primary-900 text-primary-800 dark:text-primary-200 rounded-lg text-sm font-medium hover:bg-primary-200 dark:hover:bg-primary-800 transition-colors">
          <span class="flex items-center gap-2">
            <span>🔄</span>
            <span>Refresh</span>
          </span>
        </button>
      </div>
    </div>

    <?php if (empty($leaderboard)): ?>
      <div class="text-center py-12">
        <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
          <span class="text-4xl">📝</span>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">No Quiz Attempts Yet</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Be the first to take a quiz and appear on the leaderboard!</p>
        <a href="index.php" class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-glow-lg">
          Start Your First Quiz
        </a>
      </div>
    <?php else: ?>
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="border-b-2 border-gray-200 dark:border-gray-700">
              <th class="text-left py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">Rank</th>
              <th class="text-left py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">Student</th>
              <th class="text-center py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">Score</th>
              <th class="text-center py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">Percentage</th>
              <th class="text-center py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">Date</th>
              <th class="text-center py-4 px-6 font-semibold text-gray-700 dark:text-gray-300">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($leaderboard as $index => $entry): ?>
              <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                <td class="py-4 px-6">
                  <div class="flex items-center gap-3">
                    <?php if ($index < 3): ?>
                      <div class="w-8 h-8 bg-gradient-to-r <?php
                                                            echo $index === 0 ? 'from-yellow-400 to-yellow-600' : ($index === 1 ? 'from-gray-300 to-gray-500' : 'from-orange-400 to-orange-600');
                                                            ?> rounded-full flex items-center justify-center text-white font-bold text-sm">
                        <?php echo $index + 1; ?>
                      </div>
                    <?php else: ?>
                      <div class="w-8 h-8 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-300 font-bold text-sm">
                        <?php echo $index + 1; ?>
                      </div>
                    <?php endif; ?>
                    <?php if ($index < 3): ?>
                      <span class="text-lg">
                        <?php echo $index === 0 ? '🥇' : ($index === 1 ? '🥈' : '🥉'); ?>
                      </span>
                    <?php endif; ?>
                  </div>
                </td>
                <td class="py-4 px-6">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-primary-400 to-primary-600 rounded-full flex items-center justify-center text-white font-bold">
                      <?php echo strtoupper(substr($entry['student_name'], 0, 1)); ?>
                    </div>
                    <div>
                      <div class="font-semibold text-gray-800 dark:text-white"><?php echo htmlspecialchars($entry['student_name']); ?></div>
                      <div class="text-sm text-gray-600 dark:text-gray-400"><?php echo htmlspecialchars($entry['student_phone']); ?></div>
                    </div>
                  </div>
                </td>
                <td class="py-4 px-6 text-center">
                  <div class="flex items-center justify-center gap-2">
                    <span class="text-xl font-bold text-gray-800 dark:text-white"><?php echo $entry['score']; ?></span>
                    <span class="text-gray-600 dark:text-gray-400">/ <?php echo $entry['total_questions']; ?></span>
                  </div>
                </td>
                <td class="py-4 px-6 text-center">
                  <div class="flex items-center justify-center gap-2">
                    <span class="text-lg font-bold <?php
                                                    echo $entry['percentage'] >= 90 ? 'text-success-600 dark:text-success-400' : ($entry['percentage'] >= 70 ? 'text-info-600 dark:text-info-400' : ($entry['percentage'] >= 50 ? 'text-warning-600 dark:text-warning-400' : 'text-error-600 dark:text-error-400'));
                                                    ?>">
                      <?php echo $entry['percentage']; ?>%
                    </span>
                  </div>
                </td>
                <td class="py-4 px-6 text-center">
                  <div class="text-sm text-gray-600 dark:text-gray-400">
                    <?php echo date('M j, Y', strtotime($entry['created_at'])); ?>
                  </div>
                  <div class="text-xs text-gray-500 dark:text-gray-500">
                    <?php echo date('g:i A', strtotime($entry['created_at'])); ?>
                  </div>
                </td>
                <td class="py-4 px-6 text-center">
                  <a href="result.php?attempt_id=<?php echo $entry['attempt_id']; ?>" class="px-3 py-1 bg-primary-100 dark:bg-primary-900 text-primary-800 dark:text-primary-200 rounded-lg text-sm font-medium hover:bg-primary-200 dark:hover:bg-primary-800 transition-colors">
                    View Details
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>

  <!-- Call to Action -->
  <div class="text-center mt-12">
    <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/20 dark:border-gray-700/30 card-animate">
      <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Ready to Compete?</h3>
      <p class="text-gray-600 dark:text-gray-400 mb-6 max-w-2xl mx-auto">
        Take a quiz and see how you rank against other students. Challenge yourself with different categories and improve your knowledge!
      </p>
      <a href="index.php" class="px-8 py-4 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold text-lg rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-glow-lg">
        <span class="flex items-center justify-center gap-3">
          <span>Start New Quiz</span>
          <span class="text-xl">🚀</span>
        </span>
      </a>
    </div>
  </div>
</div>

<script>
  function refreshLeaderboard() {
    location.reload();
  }

  // Add animations on load
  document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach((row, index) => {
      row.style.opacity = '0';
      row.style.transform = 'translateX(-20px)';

      setTimeout(() => {
        row.style.transition = 'all 0.5s ease-out';
        row.style.opacity = '1';
        row.style.transform = 'translateX(0)';
      }, index * 50);
    });
  });
</script>

<?php
$content = ob_get_clean();
include 'layout.php';
