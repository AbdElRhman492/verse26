<?php
// layout.php
?>
<!DOCTYPE html>
<html lang="en" class="light">

<head>
  <meta charset="UTF-8">
  <title>Verse'26 Quiz - Interactive Learning Platform</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Verse'26 Quiz - Test your knowledge with our interactive quiz platform">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
  <link rel="stylesheet" href="../public/output.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Animation Libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
  <style>
    body {
      background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #bae6fd 100%);
      min-height: 100vh;
      transition: all 0.3s ease;
    }

    .dark body {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
    }

    .card-animate {
      animation: slideUp 0.8s ease-out;
    }

    .floating-shapes {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
    }

    .shape {
      position: absolute;
      border-radius: 50%;
      background: linear-gradient(45deg, rgba(34, 197, 94, 0.1), rgba(59, 130, 246, 0.1));
      animation: float 6s ease-in-out infinite;
    }

    .shape-1 {
      width: 80px;
      height: 80px;
      top: 20%;
      left: 10%;
      animation-delay: 0s;
    }

    .shape-2 {
      width: 120px;
      height: 120px;
      top: 60%;
      left: 80%;
      animation-delay: 2s;
    }

    .shape-3 {
      width: 60px;
      height: 60px;
      top: 80%;
      left: 20%;
      animation-delay: 4s;
    }

    .shape-4 {
      width: 100px;
      height: 100px;
      top: 10%;
      left: 70%;
      animation-delay: 1s;
    }

    .shape-5 {
      width: 90px;
      height: 90px;
      top: 40%;
      left: 5%;
      animation-delay: 3s;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0px) rotate(0deg);
      }

      50% {
        transform: translateY(-20px) rotate(180deg);
      }
    }

    /* Scroll Indicator */
    .scroll-indicator {
      animation: bounce 2s infinite;
    }

    @keyframes bounce {

      0%,
      20%,
      50%,
      80%,
      100% {
        transform: translateY(0) translateX(-50%);
      }

      40% {
        transform: translateY(-10px) translateX(-50%);
      }

      60% {
        transform: translateY(-5px) translateX(-50%);
      }
    }

    .floating-particles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 1;
    }

    .particle {
      position: absolute;
      background: rgba(34, 197, 94, 0.1);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }

    .particle:nth-child(1) {
      top: 20%;
      left: 10%;
      width: 4px;
      height: 4px;
      animation-delay: 0s;
    }

    .particle:nth-child(2) {
      top: 60%;
      left: 20%;
      width: 6px;
      height: 6px;
      animation-delay: 2s;
    }

    .particle:nth-child(3) {
      top: 30%;
      left: 80%;
      width: 3px;
      height: 3px;
      animation-delay: 4s;
    }

    .particle:nth-child(4) {
      top: 70%;
      left: 70%;
      width: 5px;
      height: 5px;
      animation-delay: 1s;
    }

    .particle:nth-child(5) {
      top: 10%;
      left: 60%;
      width: 4px;
      height: 4px;
      animation-delay: 3s;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .glass-effect {
      backdrop-filter: blur(16px);
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .dark .glass-effect {
      background: rgba(0, 0, 0, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .gradient-text {
      background: linear-gradient(135deg, #22c55e, #16a34a, #15803d);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .dark .gradient-text {
      background: linear-gradient(135deg, #4ade80, #22c55e, #16a34a);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .theme-toggle {
      position: relative;
      overflow: hidden;
    }

    .theme-toggle::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s;
    }

    .theme-toggle:hover::before {
      left: 100%;
    }
  </style>
</head>

<body class="transition-all duration-500 ease-in-out">
  <!-- Floating Particles -->
  <div class="floating-particles">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
  </div>

  <!-- Animated Background Elements -->
  <div class="fixed inset-0">
    <div class="floating-shapes">
      <div class="shape shape-1"></div>
      <div class="shape shape-2"></div>
      <div class="shape shape-3"></div>
      <div class="shape shape-4"></div>
      <div class="shape shape-5"></div>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="relative z-[9999] flex justify-between items-center p-4 glass-effect rounded-b-3xl shadow-xl sticky top-0">
    <div class="flex items-center gap-4">
      <div class="relative">
        <img src="assets/images/verse_logo.jpg" alt="Verse'26" class="h-14 w-14 rounded-full border-3 border-primary-400 shadow-lg hover:rotate-12 transition-all duration-300 hover:shadow-glow">
        <div class="absolute -top-1 -right-1 w-4 h-4 bg-accent-400 rounded-full animate-pulse"></div>
      </div>
      <div>
        <h1 class="font-display font-bold text-2xl gradient-text">Verse'26</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Interactive Quiz Platform</p>
      </div>
    </div>

    <div class="flex items-center gap-4">
      <!-- Navigation Links -->
      <div class="hidden md:flex items-center gap-4">
        <a href="index.php" class="px-4 py-2 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-primary-100 dark:hover:bg-primary-900 transition-all duration-300 font-medium">
          Home
        </a>
        <a href="leaderboard.php" class="px-4 py-2 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-primary-100 dark:hover:bg-primary-900 transition-all duration-300 font-medium">
          Leaderboard
        </a>
      </div>

      <!-- Theme Toggle -->
      <!-- <button id="modeToggle" class="theme-toggle px-4 py-2 rounded-xl bg-gradient-to-r from-accent-400 to-accent-500 text-white font-bold transition-all duration-300 hover:scale-105 hover:shadow-lg relative overflow-hidden">
        <span id="themeIcon" class="text-lg">🌙</span>
      </button> -->
    </div>
  </nav>

  <!-- Page Content -->
  <main class="relative z-10 p-6 flex justify-center items-center min-h-[85vh]">
    <div class="w-full max-w-6xl">
      <?php echo $content ?? ''; ?>
    </div>
  </main>

  <!-- Footer -->
  <footer class="relative z-10 text-center py-6 text-gray-600 dark:text-gray-400">
    <p class="font-medium">© 2025 Verse'26 Quiz Platform. Made with ❤️ for learning.</p>
  </footer>

  <script src="assets/js/app.js"></script>
</body>

</html>