<?php
// index.php
ob_start();
?>

<div class="max-w-2xl w-full mx-auto">
  <!-- Hero Section -->
  <div class="text-center mb-12">
    <h1 class="text-5xl font-display font-bold mb-4 gradient-text">
      Welcome to Verse'26 Quiz
    </h1>
    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-lg mx-auto leading-relaxed">
      Test your knowledge, challenge yourself, and climb the leaderboard!
      Choose your categories and start your learning journey.
    </p>
  </div>

  <!-- Registration Form -->
  <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/20 dark:border-gray-700/30 card-animate">
    <div class="text-center mb-8">
      <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Join the Challenge</h2>
      <p class="text-gray-600 dark:text-gray-400">Enter your details to begin</p>
    </div>

    <form id="studentForm" class="space-y-6">
      <!-- Name Input -->
      <div class="space-y-2">
        <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
          Full Name
        </label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <span class="text-gray-400 text-lg">👤</span>
          </div>
          <input
            type="text"
            id="name"
            name="name"
            placeholder="Enter your full name"
            required
            class="w-full pl-12 pr-4 py-4 bg-white dark:bg-gray-700 border-2 outline-none border-gray-200 dark:border-gray-600 rounded-xl text-gray-800 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:border-primary-500 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-800 transition-all duration-300 shadow-sm hover:shadow-md" />
        </div>
      </div>

      <!-- Phone Input -->
      <div class="space-y-2">
        <label for="phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
          Phone Number
        </label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <span class="text-gray-400 text-lg">📱</span>
          </div>
          <input
            type="tel"
            id="phone"
            name="phone"
            placeholder="Enter your phone number"
            required
            class="w-full pl-12 pr-4 py-4 bg-white dark:bg-gray-700 border-2 outline-none border-gray-200 dark:border-gray-600 rounded-xl text-gray-800 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:border-primary-500 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-800 transition-all duration-300 shadow-sm hover:shadow-md" />
        </div>
      </div>

      <!-- Submit Button -->
      <button
        type="submit"
        class="w-full py-4 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold text-lg rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-glow-lg focus:outline-none focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-800 disabled:opacity-50 disabled:cursor-not-allowed"
        id="submitBtn">
        <span class="flex items-center justify-center gap-3">
          <span>Start Your Journey</span>
          <span class="text-xl">🚀</span>
        </span>
      </button>
    </form>

    <!-- Message Display -->
    <div id="formMessage" class="mt-6"></div>
  </div>

  <!-- Features Section -->
  <div class="mt-12 grid md:grid-cols-3 gap-6">
    <div class="text-center p-6 bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-2xl border border-white/20 dark:border-gray-700/30">
      <div class="w-12 h-12 bg-gradient-to-r from-accent-400 to-accent-500 rounded-full flex items-center justify-center mx-auto mb-4">
        <span class="text-xl">🎯</span>
      </div>
      <h3 class="font-bold text-gray-800 dark:text-white mb-2">Multiple Categories</h3>
      <p class="text-sm text-gray-600 dark:text-gray-400">Choose from various topics and test your knowledge</p>
    </div>

    <div class="text-center p-6 bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-2xl border border-white/20 dark:border-gray-700/30">
      <div class="w-12 h-12 bg-gradient-to-r from-secondary-400 to-secondary-500 rounded-full flex items-center justify-center mx-auto mb-4">
        <span class="text-xl">🏆</span>
      </div>
      <h3 class="font-bold text-gray-800 dark:text-white mb-2">Leaderboard</h3>
      <p class="text-sm text-gray-600 dark:text-gray-400">Compete with others and climb the rankings</p>
    </div>

    <div class="text-center p-6 bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-2xl border border-white/20 dark:border-gray-700/30">
      <div class="w-12 h-12 bg-gradient-to-r from-info-400 to-info-500 rounded-full flex items-center justify-center mx-auto mb-4">
        <span class="text-xl">📊</span>
      </div>
      <h3 class="font-bold text-gray-800 dark:text-white mb-2">Detailed Results</h3>
      <p class="text-sm text-gray-600 dark:text-gray-400">Get comprehensive feedback on your performance</p>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('studentForm');
    const submitBtn = document.getElementById('submitBtn');
    const messageDiv = document.getElementById('formMessage');

    form.addEventListener('submit', async function(e) {
      e.preventDefault();

      // Disable submit button and show loading
      submitBtn.disabled = true;
      LoadingManager.show(messageDiv, 'Creating your account...');

      try {
        const formData = new FormData(this);

        const response = await fetch("../api/student.php", {
          method: "POST",
          body: formData
        });

        const data = await response.json();

        if (data.status === "ok") {
          // Show success message briefly before redirecting
          FormHandler.showMessage('formMessage', 'Account created successfully! Redirecting...', 'success');

          setTimeout(() => {
            window.location.href = "categories.php?attempt_id=" + data.attempt_id;
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

    // Add input validation and styling
    // const inputs = form.querySelectorAll('input');
    // inputs.forEach(input => {
    //   input.addEventListener('focus', function() {
    //     this.parentElement.classList.add('ring-4', 'ring-primary-200', 'dark:ring-primary-800');
    //   });

    //   input.addEventListener('blur', function() {
    //     this.parentElement.classList.remove('ring-4', 'ring-primary-200', 'dark:ring-primary-800');
    //   });
    // });
  });
</script>

<?php
$content = ob_get_clean();
include 'layout.php';
