<?php
// index_enhanced.php - Enhanced home page with GSAP and Anime.js animations
ob_start();

// Include team data renderer
require_once __DIR__ . '/../config/team_renderer.php';

// Load team data
$teamData = loadTeamData();
?>

<!-- Hero Section with Animated Background -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
  <!-- Animated Background Elements -->
  <div class="absolute inset-0 overflow-hidden">
    <!-- Floating Shapes -->
    <div class="floating-shapes">
      <div class="shape shape-1 absolute w-32 h-32 bg-gradient-to-r from-primary-400/20 to-primary-600/20 rounded-full blur-xl"></div>
      <div class="shape shape-2 absolute w-24 h-24 bg-gradient-to-r from-accent-400/20 to-accent-600/20 rounded-full blur-lg"></div>
      <div class="shape shape-3 absolute w-40 h-40 bg-gradient-to-r from-secondary-400/20 to-secondary-600/20 rounded-full blur-2xl"></div>
      <div class="shape shape-4 absolute w-16 h-16 bg-gradient-to-r from-primary-500/30 to-accent-500/30 rounded-full blur-md"></div>
      <div class="shape shape-5 absolute w-28 h-28 bg-gradient-to-r from-accent-500/25 to-secondary-500/25 rounded-full blur-lg"></div>
    </div>

    <!-- Grid Pattern -->
    <div class="absolute inset-0 opacity-5">
      <div class="grid-pattern w-full h-full" style="background-image: radial-gradient(circle, currentColor 1px, transparent 1px); background-size: 50px 50px;"></div>
    </div>
  </div>

  <div class="relative z-10 max-w-6xl mx-auto px-6 text-center">
    <!-- Main Hero Content -->
    <div class="hero-content">
      <div class="hero-icon mb-8">
        <div class="w-24 h-24 bg-gradient-to-r from-primary-400 to-primary-600 rounded-full flex items-center justify-center mx-auto shadow-glow">
          <img src="assets/images/verse_logo.jpg" alt="Verse'26" class="h-20 w-20 rounded-full border-3 border-primary-400 shadow-lg hover:rotate-12 transition-all duration-300 hover:shadow-glow">
        </div>
      </div>

      <h1 class="hero-title text-6xl md:text-7xl font-display font-bold mb-6">
        <span class="gradient-text">Verse'26 Quiz</span>
      </h1>

      <p class="hero-subtitle text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">
        Transform your learning journey with our interactive quiz platform.
        Challenge yourself, compete with peers, and unlock your potential!
      </p>

      <!-- Animated Stats -->
      <div class="hero-stats grid grid-cols-3 gap-8 max-w-2xl mx-auto mb-12">
        <div class="stat-item text-center">
          <div class="stat-number text-3xl font-bold text-primary-600 dark:text-primary-400" data-target="1000">0</div>
          <div class="stat-label text-sm text-gray-600 dark:text-gray-400">Questions</div>
        </div>
        <div class="stat-item text-center">
          <div class="stat-number text-3xl font-bold text-accent-600 dark:text-accent-400" data-target="500">0</div>
          <div class="stat-label text-sm text-gray-600 dark:text-gray-400">Students</div>
        </div>
        <div class="stat-item text-center">
          <div class="stat-number text-3xl font-bold text-secondary-600 dark:text-secondary-400" data-target="8">0</div>
          <div class="stat-label text-sm text-gray-600 dark:text-gray-400">Categories</div>
        </div>
      </div>

      <!-- CTA Button -->
      <div class="hero-cta">
        <button id="startQuizBtn" class="cta-button px-12 py-4 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold text-xl rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-glow-lg focus:outline-none focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-800">
          <span class="flex items-center gap-2">
            <span>Start Your Journey</span>
            <span class="rocket-icon">🚀</span>
          </span>
        </button>
      </div>
    </div>
  </div>

  <!-- Scroll Indicator -->
  <div class="scroll-indicator absolute bottom-8 left-1/2 transform -translate-x-1/2">
    <div class="w-6 h-10 border-2 border-gray-400 dark:border-gray-600 rounded-full flex justify-center">
      <div class="w-1 h-3 bg-gray-400 dark:bg-gray-600 rounded-full mt-2 animate-bounce"></div>
    </div>
  </div>
</section>

<!-- Mission Vision Section -->
<div class="mission-vision-wrapper">
  <?= renderMissionVisionSection($teamData) ?>
</div>

<!-- Features Section -->
<div class="features-wrapper">
  <?= renderFeaturesSection($teamData) ?>
</div>

<!-- Team Section -->
<div class="team-wrapper">
  <?= renderTeamSection($teamData) ?>
</div>

<!-- Registration Form Section -->
<section class="mt-16 py-16 backdrop-blur-sm rounded-3xl border border-white/30 dark:border-gray-700/30 shadow-xl registration-section">

  <div class="relative z-10 max-w-4xl mx-auto px-10">
    <div class="registration-header text-center mb-12">
      <h2 class="section-title text-4xl md:text-5xl font-display font-bold mb-6">
        <span class="gradient-text">Ready to Start?</span>
      </h2>
      <p class="section-subtitle text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
        Join thousands of learners who are already transforming their knowledge with Verse'26 Quiz
      </p>
    </div>

    <!-- Registration Form -->
    <div class="registration-form bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/30 dark:border-gray-700/40">
      <form id="studentForm" class="space-y-6">
        <div class="form-fields grid md:grid-cols-2 gap-6">
          <!-- Name Input -->
          <div class="input-group space-y-2">
            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
              Full Name
            </label>
            <div class="input-wrapper relative">
              <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <span class="text-gray-400 text-lg">👤</span>
              </div>
              <input
                type="text"
                id="name"
                name="name"
                placeholder="Enter your full name"
                required
                class="form-input w-full pl-12 pr-4 py-4 bg-white dark:bg-gray-700 outline-none border-2 border-gray-200 dark:border-gray-600 rounded-xl text-gray-800 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:border-primary-500 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-800 transition-all duration-300 shadow-sm hover:shadow-md" />
            </div>
          </div>

          <!-- Phone Input -->
          <div class="input-group space-y-2">
            <label for="phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
              Phone Number
            </label>
            <div class="input-wrapper relative">
              <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <span class="text-gray-400 text-lg">📱</span>
              </div>
              <input
                type="tel"
                id="phone"
                name="phone"
                placeholder="Enter your phone number"
                required
                class="form-input w-full pl-12 pr-4 py-4 bg-white dark:bg-gray-700 outline-none border-2 border-gray-200 dark:border-gray-600 rounded-xl text-gray-800 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:border-primary-500 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-800 transition-all duration-300 shadow-sm hover:shadow-md" />
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="form-submit text-center pt-4">
          <button
            type="submit"
            id="submitBtn"
            class="submit-button px-12 py-4 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold text-xl rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-glow-lg focus:outline-none focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-800 disabled:opacity-50 disabled:cursor-not-allowed">
            <span class="flex items-center justify-center gap-2">
              <span>Start Your Learning Journey</span>
              <span class="rocket-icon">🚀</span>
            </span>
          </button>
        </div>
      </form>

      <!-- Message Display -->
      <div id="formMessage" class="form-message mt-6"></div>
    </div>
  </div>
</section>

<!-- Enhanced Styles for Animations -->
<style>
  /* Floating Shapes Initial Positions */
  .shape-1 {
    top: 10%;
    left: 10%;
  }

  .shape-2 {
    top: 20%;
    right: 15%;
  }

  .shape-3 {
    bottom: 30%;
    left: 5%;
  }

  .shape-4 {
    top: 50%;
    right: 10%;
  }

  .shape-5 {
    bottom: 20%;
    right: 25%;
  }

  /* Initial Animation States */
  .hero-content>* {
    opacity: 0;
    transform: translateY(50px);
  }

  .section-title,
  .section-subtitle {
    opacity: 0;
    transform: translateY(50px);
  }

  .stat-item {
    opacity: 0;
    transform: translateY(30px) scale(0.8);
  }

  .input-group,
  .form-submit {
    opacity: 0;
    transform: translateY(30px);
  }

  .registration-form {
    opacity: 0;
    transform: translateY(50px) scale(0.95);
  }

  /* Card initial states will be handled by the enhanced team renderer */

  /* Glow effects */
  .shadow-glow {
    box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
  }

  .shadow-glow-lg {
    box-shadow: 0 0 30px rgba(59, 130, 246, 0.4);
  }

  /* Rocket animation */
  @keyframes rocketFloat {

    0%,
    100% {
      transform: translateY(0) rotate(0deg);
    }

    25% {
      transform: translateY(-3px) rotate(2deg);
    }

    50% {
      transform: translateY(0) rotate(0deg);
    }

    75% {
      transform: translateY(-2px) rotate(-1deg);
    }
  }

  .rocket-icon {
    display: inline-block;
    animation: rocketFloat 2s ease-in-out infinite;
  }
</style>

<!-- Load GSAP and ScrollTrigger -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Register GSAP ScrollTrigger plugin
    gsap.registerPlugin(ScrollTrigger);

    // ============= HERO SECTION ANIMATIONS =============

    // Create master timeline for hero section
    const heroTimeline = gsap.timeline({
      delay: 0.5,
      onComplete: () => {
        // Start floating shapes animation after hero loads
        startFloatingAnimation();
      }
    });

    // Hero content animation sequence
    heroTimeline
      .to('.hero-icon', {
        duration: 1,
        opacity: 1,
        y: 0,
        scale: 1,
        ease: 'back.out(1.7)',
        onComplete: () => {
          // Add continuous gentle floating to the icon
          gsap.to('.hero-icon', {
            y: -10,
            duration: 2,
            repeat: -1,
            yoyo: true,
            ease: 'power1.inOut'
          });
        }
      })
      .to('.hero-title', {
        duration: 1,
        opacity: 1,
        y: 0,
        ease: 'power3.out'
      }, '-=0.6')
      .to('.hero-subtitle', {
        duration: 1,
        opacity: 1,
        y: 0,
        ease: 'power3.out'
      }, '-=0.7')
      .to('.stat-item', {
        duration: 0.8,
        opacity: 1,
        y: 0,
        scale: 1,
        stagger: 0.2,
        ease: 'back.out(1.7)'
      }, '-=0.5')
      .to('.hero-cta', {
        duration: 1,
        opacity: 1,
        y: 0,
        scale: 1,
        ease: 'back.out(1.7)'
      }, '-=0.3');

    // ============= COUNTER ANIMATIONS =============

    function animateCounters() {
      document.querySelectorAll('.stat-number').forEach(counter => {
        const target = parseInt(counter.dataset.target);
        const suffix = counter.textContent.replace(/[0-9]/g, '');

        gsap.fromTo(counter, {
          innerHTML: 0
        }, {
          innerHTML: target,
          duration: 2,
          ease: 'power2.out',
          delay: 1.8,
          snap: {
            innerHTML: 1
          },
          onUpdate: function() {
            counter.textContent = Math.ceil(counter.innerHTML) + suffix;
          }
        });
      });
    }

    animateCounters();

    // ============= FLOATING SHAPES ANIMATION =============

    function startFloatingAnimation() {
      // Animate each shape with different patterns
      gsap.set('.shape', {
        opacity: 0.6
      });

      anime({
        targets: '.shape-1',
        translateY: [0, -30, 0],
        translateX: [0, 20, 0],
        rotate: [0, 180, 360],
        duration: 15000,
        easing: 'easeInOutSine',
        loop: true
      });

      anime({
        targets: '.shape-2',
        translateY: [0, 25, 0],
        translateX: [0, -15, 0],
        rotate: [0, -90, -180],
        duration: 12000,
        easing: 'easeInOutQuad',
        loop: true
      });

      anime({
        targets: '.shape-3',
        translateY: [0, -20, 0],
        translateX: [0, 30, 0],
        scale: [1, 1.1, 1],
        duration: 18000,
        easing: 'easeInOutSine',
        loop: true
      });

      anime({
        targets: '.shape-4',
        translateY: [0, 35, 0],
        translateX: [0, -25, 0],
        rotate: [0, 270, 540],
        duration: 10000,
        easing: 'easeInOutCubic',
        loop: true
      });

      anime({
        targets: '.shape-5',
        translateY: [0, -15, 0],
        translateX: [0, 10, 0],
        scale: [1, 0.9, 1],
        rotate: [0, -45, 0],
        duration: 14000,
        easing: 'easeInOutSine',
        loop: true
      });
    }

    // ============= SCROLL-TRIGGERED ANIMATIONS =============

    // Section titles and subtitles
    gsap.utils.toArray('.section-title').forEach(title => {
      gsap.fromTo(title, {
        opacity: 0,
        y: 50
      }, {
        opacity: 1,
        y: 0,
        duration: 1,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: title,
          start: 'top 80%',
          end: 'bottom 20%',
          toggleActions: 'play none none reverse'
        }
      });
    });

    gsap.utils.toArray('.section-subtitle').forEach(subtitle => {
      gsap.fromTo(subtitle, {
        opacity: 0,
        y: 30
      }, {
        opacity: 1,
        y: 0,
        duration: 0.8,
        ease: 'power2.out',
        delay: 0.2,
        scrollTrigger: {
          trigger: subtitle,
          start: 'top 85%',
          end: 'bottom 15%',
          toggleActions: 'play none none reverse'
        }
      });
    });

    // ============= REGISTRATION FORM ANIMATIONS =============

    // Registration section
    gsap.fromTo('.registration-form', {
      opacity: 0,
      y: 50,
      scale: 0.95
    }, {
      opacity: 1,
      y: 0,
      scale: 1,
      duration: 1,
      ease: 'back.out(1.7)',
      scrollTrigger: {
        trigger: '.registration-section',
        start: 'top 75%',
        end: 'bottom 25%',
        toggleActions: 'play none none reverse'
      }
    });

    // Form fields animation
    gsap.fromTo('.input-group', {
      opacity: 0,
      y: 30
    }, {
      opacity: 1,
      y: 0,
      duration: 0.6,
      stagger: 0.1,
      ease: 'power2.out',
      scrollTrigger: {
        trigger: '.form-fields',
        start: 'top 80%',
        end: 'bottom 20%',
        toggleActions: 'play none none reverse'
      }
    });

    gsap.fromTo('.form-submit', {
      opacity: 0,
      y: 20,
      scale: 0.9
    }, {
      opacity: 1,
      y: 0,
      scale: 1,
      duration: 0.8,
      ease: 'back.out(1.7)',
      delay: 0.3,
      scrollTrigger: {
        trigger: '.form-submit',
        start: 'top 85%',
        end: 'bottom 15%',
        toggleActions: 'play none none reverse'
      }
    });

    // ============= INTERACTIVE ANIMATIONS =============

    // Button hover effects
    document.querySelectorAll('.cta-button, .submit-button').forEach(button => {
      button.addEventListener('mouseenter', () => {
        gsap.to(button, {
          scale: 1.05,
          duration: 0.3,
          ease: 'back.out(1.7)'
        });

        gsap.to(button.querySelector('.rocket-icon'), {
          rotation: 15,
          y: -3,
          duration: 0.3,
          ease: 'back.out(2)'
        });
      });

      button.addEventListener('mouseleave', () => {
        gsap.to(button, {
          scale: 1,
          duration: 0.3,
          ease: 'back.out(1.7)'
        });

        gsap.to(button.querySelector('.rocket-icon'), {
          rotation: 0,
          y: 0,
          duration: 0.3,
          ease: 'back.out(2)'
        });
      });
    });

    // Input focus animations
    document.querySelectorAll('.form-input').forEach(input => {
      const wrapper = input.closest('.input-wrapper');

      input.addEventListener('focus', () => {
        gsap.to(wrapper, {
          scale: 1.02,
          duration: 0.3,
          ease: 'power2.out'
        });
      });

      input.addEventListener('blur', () => {
        gsap.to(wrapper, {
          scale: 1,
          duration: 0.3,
          ease: 'power2.out'
        });
      });
    });

    // ============= FORM HANDLING =============

    const form = document.getElementById('studentForm');
    const submitBtn = document.getElementById('submitBtn');
    const messageDiv = document.getElementById('formMessage');
    const startQuizBtn = document.getElementById('startQuizBtn');

    // Scroll to registration form when start button is clicked
    startQuizBtn.addEventListener('click', function() {
      // Animate to start page instead of scrolling
      gsap.to(window, {
        duration: 0.5,
        scrollTo: 0,
        ease: 'power2.inOut',
        onComplete: () => {
          window.location.href = "start.php";
        }
      });
    });

    // Form submission with enhanced animations
    form.addEventListener('submit', async function(e) {
      e.preventDefault();

      // Disable submit button and show loading animation
      submitBtn.disabled = true;

      // Loading animation
      gsap.to(submitBtn, {
        scale: 0.95,
        duration: 0.1,
        yoyo: true,
        repeat: 1,
        ease: 'power2.inOut'
      });

      // Show loading message
      showMessage('Creating your account...', 'loading');

      try {
        const formData = new FormData(this);

        const response = await fetch("../api/student.php", {
          method: "POST",
          body: formData
        });

        const data = await response.json();

        if (data.status === "ok") {
          // Success animation
          gsap.timeline()
            .to('.registration-form', {
              scale: 1.05,
              duration: 0.3,
              ease: 'back.out(2)'
            })
            .to('.registration-form', {
              scale: 1,
              duration: 0.3,
              ease: 'back.out(2)'
            });

          showMessage('Account created successfully! Redirecting...', 'success');

          setTimeout(() => {
            // Smooth transition to categories page
            gsap.to('body', {
              opacity: 0,
              duration: 0.5,
              ease: 'power2.inOut',
              onComplete: () => {
                window.location.href = "categories.php?attempt_id=" + data.attempt_id;
              }
            });
          }, 1500);
        } else {
          showMessage(data.message, 'error');
        }
      } catch (error) {
        showMessage('Network error occurred. Please try again.', 'error');
      } finally {
        submitBtn.disabled = false;
      }
    });

    // Enhanced message display function
    function showMessage(message, type) {
      const messageClasses = {
        success: 'bg-green-100 border border-green-300 text-green-700 dark:bg-green-900/50 dark:border-green-600 dark:text-green-300',
        error: 'bg-red-100 border border-red-300 text-red-700 dark:bg-red-900/50 dark:border-red-600 dark:text-red-300',
        loading: 'bg-blue-100 border border-blue-300 text-blue-700 dark:bg-blue-900/50 dark:border-blue-600 dark:text-blue-300'
      };

      const icons = {
        success: '✅',
        error: '❌',
        loading: '⏳'
      };

      messageDiv.innerHTML = `
      <div class="message-content p-4 rounded-xl ${messageClasses[type]} backdrop-blur-sm">
        <div class="flex items-center gap-3">
          <span class="text-xl">${icons[type]}</span>
          <span class="font-medium">${message}</span>
        </div>
      </div>
    `;

      // Animate message appearance
      gsap.fromTo('.message-content', {
        opacity: 0,
        y: 20,
        scale: 0.9
      }, {
        opacity: 1,
        y: 0,
        scale: 1,
        duration: 0.5,
        ease: 'back.out(1.7)'
      });
    }

    // ============= PERFORMANCE OPTIMIZATIONS =============

    // Throttle scroll events for better performance
    let ticking = false;

    function updateAnimations() {
      // Update any scroll-based animations here
      ticking = false;
    }

    window.addEventListener('scroll', () => {
      if (!ticking) {
        requestAnimationFrame(updateAnimations);
        ticking = true;
      }
    });

    // Preload images for smooth experience
    const imagesToPreload = [
      'assets/images/verse_logo.jpg'
    ];

    imagesToPreload.forEach(src => {
      const img = new Image();
      img.src = src;
    });
  });
</script>

<?php
$content = ob_get_clean();
include 'layout.php';
?>