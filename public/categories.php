<?php
// categories.php
require_once __DIR__ . '/../api/db.php';

$attempt_id = $_GET['attempt_id'] ?? null;
if (!$attempt_id) {
  die("❌ attempt_id مفقود");
}

// جلب الكاتيجوريز من DB
$stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
$categories = $stmt->fetchAll();

// If no categories exist, create some sample ones
if (empty($categories)) {
  $sampleCategories = [
    'General Knowledge',
    'Science & Technology',
    'History',
    'Geography',
    'Sports',
    'Literature',
    'Mathematics',
    'Art & Culture'
  ];

  foreach ($sampleCategories as $catName) {
    $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->execute([$catName]);
  }

  // Fetch again after inserting
  $stmt = $pdo->query("SELECT id, name FROM categories ORDER BY name");
  $categories = $stmt->fetchAll();
}

ob_start();
?>

<div class="max-w-4xl w-full mx-auto">
  <!-- Header Section -->
  <div class="text-center mb-12">
    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-accent-400 to-accent-600 rounded-full mb-6 shadow-glow animate-bounce-gentle">
      <span class="text-3xl">🎯</span>
    </div>
    <h1 class="text-4xl font-display font-bold mb-4 gradient-text">
      Choose Your Categories
    </h1>
    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto leading-relaxed">
      Select the topics you'd like to be quizzed on. You can choose multiple categories
      to create a diverse and challenging quiz experience.
    </p>
  </div>

  <!-- Categories Selection -->
  <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/20 dark:border-gray-700/30 card-animate">
    <div class="text-center mb-8">
      <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Available Categories</h2>
      <p class="text-gray-600 dark:text-gray-400">Select at least one category to continue</p>
    </div>

    <form id="categoriesForm" class="space-y-8">
      <input type="hidden" name="attempt_id" value="<?php echo $attempt_id; ?>">

      <!-- Categories Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($categories as $index => $cat): ?>
          <div class="category-card group">
            <label class="flex items-center gap-4 p-4 rounded-2xl border-2 border-gray-200 dark:border-gray-600 cursor-pointer transition-all duration-300 hover:border-primary-400 hover:shadow-lg hover:scale-[1.02] bg-white dark:bg-gray-700">
              <div class="relative">
                <input
                  type="checkbox"
                  name="categories[]"
                  value="<?php echo $cat['id']; ?>"
                  class="sr-only category-checkbox" />
                <div class="w-6 h-6 border-2 border-gray-300 dark:border-gray-500 rounded-lg flex items-center justify-center transition-all duration-300 checkbox-display">
                  <svg class="w-4 h-4 text-white opacity-0 transition-opacity duration-300 check-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
              </div>
              <div class="flex-1">
                <div class="flex items-center gap-3">
                  <span class="text-2xl"><?php echo $cat['icon'] ?></span>
                  <span class="font-semibold text-gray-800 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors duration-300">
                    <?php echo htmlspecialchars($cat['name']); ?>
                  </span>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                  <?php echo htmlspecialchars($cat['description']); ?>
                </p>
              </div>
            </label>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Selection Summary -->
      <div class="bg-gray-50 dark:bg-gray-700/50 rounded-2xl p-6">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="font-semibold text-gray-800 dark:text-white mb-1">Selected Categories</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400" id="selectionCount">0 categories selected</p>
          </div>
          <div class="flex flex-wrap gap-2" id="selectedCategories">
            <!-- Selected categories will appear here -->
          </div>
        </div>
      </div>

      <!-- Submit Button -->
      <button
        type="submit"
        class="w-full py-4 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold text-lg rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-glow-lg focus:outline-none focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-800 disabled:opacity-50 disabled:cursor-not-allowed"
        id="submitBtn"
        disabled>
        <span class="flex items-center justify-center gap-3">
          <span>Start Quiz</span>
          <span class="text-xl">🚀</span>
        </span>
      </button>
    </form>

    <!-- Message Display -->
    <div id="formMessage" class="mt-6"></div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('categoriesForm');
    const submitBtn = document.getElementById('submitBtn');
    const messageDiv = document.getElementById('formMessage');
    const selectionCount = document.getElementById('selectionCount');
    const selectedCategories = document.getElementById('selectedCategories');

    const checkboxes = document.querySelectorAll('.category-checkbox');
    const checkboxDisplays = document.querySelectorAll('.checkbox-display');
    const checkIcons = document.querySelectorAll('.check-icon');

    // Update selection count and visual feedback
    function updateSelection() {
      const checkedBoxes = document.querySelectorAll('.category-checkbox:checked');
      const count = checkedBoxes.length;

      selectionCount.textContent = `${count} categor${count === 1 ? 'y' : 'ies'} selected`;
      submitBtn.disabled = count === 0;

      // Update selected categories display
      selectedCategories.innerHTML = '';
      checkedBoxes.forEach(checkbox => {
        const label = checkbox.closest('label');
        const categoryName = label.querySelector('span:last-child').textContent;
        const badge = document.createElement('span');
        badge.className = 'px-3 py-1 bg-primary-100 dark:bg-primary-900 text-primary-800 dark:text-primary-200 rounded-full text-sm font-medium';
        badge.textContent = categoryName;
        selectedCategories.appendChild(badge);
      });

      // Update checkbox visual states
      checkboxes.forEach((checkbox, index) => {
        const display = checkboxDisplays[index];
        const icon = checkIcons[index];

        if (checkbox.checked) {
          display.classList.add('bg-primary-500', 'border-primary-500');
          display.classList.remove('border-gray-300', 'dark:border-gray-500');
          icon.classList.remove('opacity-0');
        } else {
          display.classList.remove('bg-primary-500', 'border-primary-500');
          display.classList.add('border-gray-300', 'dark:border-gray-500');
          icon.classList.add('opacity-0');
        }
      });
    }

    // Add event listeners to checkboxes
    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', updateSelection);
    });

    // Form submission
    form.addEventListener('submit', async function(e) {
      e.preventDefault();

      const checkedBoxes = document.querySelectorAll('.category-checkbox:checked');
      if (checkedBoxes.length === 0) {
        FormHandler.showMessage('formMessage', 'Please select at least one category to continue.', 'error');
        return;
      }

      // Disable submit button and show loading
      submitBtn.disabled = true;
      LoadingManager.show(messageDiv, 'Preparing your quiz...');

      try {
        const formData = new FormData(this);

        const response = await fetch("../api/questions.php", {
          method: "POST",
          body: formData
        });

        const data = await response.json();

        if (data.status === "ok") {
          FormHandler.showMessage('formMessage', 'Quiz prepared successfully! Starting...', 'success');

          setTimeout(() => {
            window.location.href = "quiz.php?attempt_id=" + data.attempt_id;
          }, 1500);
        } else {
          FormHandler.showMessage('formMessage', data.message, 'error');
        }
      } catch (error) {
        FormHandler.showMessage('formMessage', 'Network error occurred. Please try again.', 'error');
      } finally {
        submitBtn.disabled = false;
      }
    });

    // Initialize selection count
    updateSelection();
  });
</script>

<style>
  .category-card label:hover .checkbox-display {
    border-color: rgb(34, 197, 94);
  }

  .category-card input:checked+.checkbox-display {
    background-color: rgb(34, 197, 94);
    border-color: rgb(34, 197, 94);
  }

  .category-card input:checked+.checkbox-display .check-icon {
    opacity: 1;
  }
</style>

<?php
$content = ob_get_clean();
include 'layout.php';
