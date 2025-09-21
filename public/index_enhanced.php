<!DOCTYPE html>
<html lang="en" class="light">

<head>
  <meta charset="UTF-8">
  <title>Verse'26 Quiz - Interactive Learning Platform</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Verse'26 Quiz - Test your knowledge with our interactive quiz platform">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Animation Libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

  <style>
    :root {
      --primary-50: #f0fdf4;
      --primary-100: #dcfce7;
      --primary-200: #bbf7d0;
      --primary-300: #86efac;
      --primary-400: #4ade80;
      --primary-500: #22c55e;
      --primary-600: #16a34a;
      --primary-700: #15803d;
      --primary-800: #166534;
      --primary-900: #14532d;

      --accent-400: #f59e0b;
      --accent-500: #d97706;
      --accent-600: #b45309;

      --secondary-400: #8b5cf6;
      --secondary-500: #7c3aed;
      --secondary-600: #6d28d9;

      --info-400: #06b6d4;
      --info-500: #0891b2;
      --info-600: #0e7490;

      --success-400: #10b981;
      --success-500: #059669;
      --success-600: #047857;

      --warning-400: #f59e0b;
      --warning-500: #d97706;
      --warning-600: #b45309;
    }

    * {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #334155 50%, #475569 75%, #64748b 100%);
      background-size: 400% 400%;
      animation: gradientShift 15s ease infinite;
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
    }

    @keyframes gradientShift {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    .font-display {
      font-family: 'Poppins', sans-serif;
    }

    /* Interactive Background Particles */
    .particles-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 1;
      overflow: hidden;
    }

    .particle {
      position: absolute;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(34, 197, 94, 0.3), transparent);
      animation: floatParticle 8s ease-in-out infinite;
    }

    .particle::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 2px;
      height: 2px;
      background: rgba(255, 255, 255, 0.8);
      border-radius: 50%;
      transform: translate(-50%, -50%);
      animation: twinkle 2s ease-in-out infinite alternate;
    }

    @keyframes floatParticle {

      0%,
      100% {
        transform: translateY(0px) translateX(0px) rotate(0deg);
        opacity: 0.3;
      }

      25% {
        transform: translateY(-30px) translateX(20px) rotate(90deg);
        opacity: 0.8;
      }

      50% {
        transform: translateY(-60px) translateX(-10px) rotate(180deg);
        opacity: 1;
      }

      75% {
        transform: translateY(-30px) translateX(-30px) rotate(270deg);
        opacity: 0.6;
      }
    }

    @keyframes twinkle {
      0% {
        opacity: 0.3;
        transform: translate(-50%, -50%) scale(0.5);
      }

      100% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
      }
    }

    /* Glassmorphism Effects */
    .glass-effect {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    /* Gradient Text */
    .gradient-text {
      background: linear-gradient(135deg, #4ade80, #22c55e, #16a34a);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      background-size: 200% 200%;
      animation: gradientMove 3s ease-in-out infinite;
    }

    @keyframes gradientMove {

      0%,
      100% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }
    }

    /* Glowing Effects */
    .shadow-glow {
      box-shadow: 0 0 30px rgba(34, 197, 94, 0.4);
    }

    .shadow-glow-lg {
      box-shadow: 0 0 50px rgba(34, 197, 94, 0.6);
    }

    /* Hover Animations */
    .hover-float:hover {
      transform: translateY(-10px);
    }

    .hover-glow:hover {
      box-shadow: 0 20px 40px rgba(34, 197, 94, 0.3);
    }

    /* Initial Animation States */
    .animate-on-scroll {
      opacity: 0;
      transform: translateY(50px);
    }

    .stat-counter {
      opacity: 0;
      transform: scale(0.5);
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
    }

    ::-webkit-scrollbar-thumb {
      background: linear-gradient(180deg, var(--primary-400), var(--primary-600));
      border-radius: 4px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .particles-container {
        display: none;
      }
    }

    /* Button Ripple Effect */
    .btn-ripple {
      position: relative;
      overflow: hidden;
    }

    .btn-ripple::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.3);
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
    }

    .btn-ripple:hover::before {
      width: 300px;
      height: 300px;
    }
  </style>
</head>

<body>
  <!-- Interactive Background Particles -->
  <div class="particles-container" id="particlesContainer"></div>

  <!-- Navbar -->
  <nav class="relative z-50 flex justify-between items-center p-6 glass-effect sticky top-0">
    <div class="flex items-center gap-4">
      <div class="relative group">
        <div class="w-16 h-16 bg-gradient-to-r from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center shadow-glow group-hover:shadow-glow-lg transition-all duration-300">
          <span class="text-2xl">🎯</span>
        </div>
        <div class="absolute -top-2 -right-2 w-6 h-6 bg-accent-400 rounded-full animate-ping"></div>
      </div>
      <div>
        <h1 class="font-display font-bold text-3xl gradient-text">Verse'26</h1>
        <p class="text-sm text-gray-300 font-medium">Interactive Learning Platform</p>
      </div>
    </div>

    <div class="flex items-center gap-6">
      <div class="hidden md:flex items-center gap-4">
        <a href="#home" class="nav-link px-4 py-2 rounded-xl text-white hover:bg-white hover:bg-opacity-10 transition-all duration-300 font-medium">
          Home
        </a>
        <a href="#features" class="nav-link px-4 py-2 rounded-xl text-white hover:bg-white hover:bg-opacity-10 transition-all duration-300 font-medium">
          Features
        </a>
        <a href="#team" class="nav-link px-4 py-2 rounded-xl text-white hover:bg-white hover:bg-opacity-10 transition-all duration-300 font-medium">
          Team
        </a>
      </div>

      <button id="menuToggle" class="md:hidden p-2 rounded-xl glass-effect">
        <div class="space-y-1">
          <div class="w-6 h-0.5 bg-white"></div>
          <div class="w-6 h-0.5 bg-white"></div>
          <div class="w-6 h-0.5 bg-white"></div>
        </div>
      </button>
    </div>
  </nav>

  <!-- Hero Section -->
  <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
      <!-- Animated Hero Content -->
      <div class="hero-content space-y-8">
        <div class="hero-icon mb-12">
          <div class="w-32 h-32 bg-gradient-to-r from-primary-400 to-primary-600 rounded-3xl flex items-center justify-center mx-auto shadow-glow hover:shadow-glow-lg transition-all duration-500 hover:rotate-12">
            <span class="text-6xl">🚀</span>
          </div>
        </div>

        <h1 class="hero-title text-7xl md:text-8xl font-display font-bold mb-8">
          <span class="gradient-text">Verse'26 Quiz</span>
        </h1>

        <p class="hero-subtitle text-2xl md:text-3xl text-gray-200 mb-12 max-w-4xl mx-auto leading-relaxed">
          Transform your learning journey with our <span class="text-primary-400 font-semibold">interactive quiz platform</span>.
          Challenge yourself, compete with peers, and unlock your potential!
        </p>

        <!-- Animated Statistics -->
        <div class="hero-stats grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto mb-16">
          <div class="stat-item glass-card p-6 rounded-2xl hover-float transition-all duration-300">
            <div class="stat-number text-4xl font-bold text-primary-400 mb-2" data-target="1000">0</div>
            <div class="stat-label text-gray-300 font-medium">Questions</div>
          </div>
          <div class="stat-item glass-card p-6 rounded-2xl hover-float transition-all duration-300">
            <div class="stat-number text-4xl font-bold text-accent-400 mb-2" data-target="500">0</div>
            <div class="stat-label text-gray-300 font-medium">Students</div>
          </div>
          <div class="stat-item glass-card p-6 rounded-2xl hover-float transition-all duration-300">
            <div class="stat-number text-4xl font-bold text-secondary-400 mb-2" data-target="8">0</div>
            <div class="stat-label text-gray-300 font-medium">Categories</div>
          </div>
          <div class="stat-item glass-card p-6 rounded-2xl hover-float transition-all duration-300">
            <div class="stat-number text-4xl font-bold text-info-400 mb-2" data-target="99">0</div>
            <div class="stat-label text-gray-300 font-medium">Success Rate</div>
          </div>
        </div>

        <!-- CTA Buttons -->
        <div class="hero-cta space-y-6 md:space-y-0 md:space-x-6 md:flex md:justify-center">
          <button id="startQuizBtn" class="btn-ripple px-12 py-4 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold text-xl rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-glow-lg">
            Start Your Journey 🚀
          </button>
          <button class="btn-ripple px-12 py-4 bg-transparent border-2 border-primary-400 text-primary-400 font-bold text-xl rounded-2xl transition-all duration-300 hover:bg-primary-400 hover:text-white">
            Learn More 📚
          </button>
        </div>
      </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 scroll-indicator">
      <div class="w-8 h-14 border-2 border-primary-400 rounded-full flex justify-center animate-pulse">
        <div class="w-2 h-4 bg-primary-400 rounded-full mt-3 animate-bounce"></div>
      </div>
    </div>
  </section>

  <!-- Mission Section -->
  <section class="py-24 relative">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-20">
        <h2 class="section-title text-5xl md:text-6xl font-display font-bold mb-8">
          <span class="gradient-text">Our Mission</span>
        </h2>
        <p class="section-subtitle text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
          Empowering learners through interactive education and fostering a community of knowledge seekers
        </p>
      </div>

      <div class="grid md:grid-cols-2 gap-16 items-center">
        <div class="mission-content space-y-8">
          <div class="glass-card p-10 rounded-3xl hover-glow transition-all duration-500">
            <div class="flex items-center gap-6 mb-8">
              <div class="w-20 h-20 bg-gradient-to-r from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center">
                <span class="text-3xl">🎯</span>
              </div>
              <h3 class="text-3xl font-bold text-white">Our Vision</h3>
            </div>
            <p class="text-gray-300 text-lg leading-relaxed">
              To create the most engaging and effective learning platform that makes education accessible,
              interactive, and fun for everyone. We believe that learning should be an adventure, not a chore.
            </p>
          </div>
        </div>

        <div class="values-content space-y-8">
          <div class="glass-card p-10 rounded-3xl hover-glow transition-all duration-500">
            <div class="flex items-center gap-6 mb-8">
              <div class="w-20 h-20 bg-gradient-to-r from-secondary-400 to-secondary-600 rounded-2xl flex items-center justify-center">
                <span class="text-3xl">🌟</span>
              </div>
              <h3 class="text-3xl font-bold text-white">Our Values</h3>
            </div>
            <div class="space-y-6">
              <div class="flex items-center gap-4 group">
                <div class="w-4 h-4 bg-primary-500 rounded-full group-hover:scale-150 transition-all duration-300"></div>
                <span class="text-gray-300 text-lg">Excellence in Education</span>
              </div>
              <div class="flex items-center gap-4 group">
                <div class="w-4 h-4 bg-primary-500 rounded-full group-hover:scale-150 transition-all duration-300"></div>
                <span class="text-gray-300 text-lg">Innovation & Creativity</span>
              </div>
              <div class="flex items-center gap-4 group">
                <div class="w-4 h-4 bg-primary-500 rounded-full group-hover:scale-150 transition-all duration-300"></div>
                <span class="text-gray-300 text-lg">Community Building</span>
              </div>
              <div class="flex items-center gap-4 group">
                <div class="w-4 h-4 bg-primary-500 rounded-full group-hover:scale-150 transition-all duration-300"></div>
                <span class="text-gray-300 text-lg">Continuous Learning</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="py-24 relative">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-20">
        <h2 class="section-title text-5xl md:text-6xl font-display font-bold mb-8">
          <span class="gradient-text">Platform Features</span>
        </h2>
        <p class="section-subtitle text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
          Discover the powerful features that make Verse'26 Quiz the ultimate learning experience
        </p>
      </div>

      <div class="features-grid grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Feature Cards -->
        <div class="feature-card glass-card p-8 rounded-3xl hover-glow hover-float transition-all duration-500 group">
          <div class="w-20 h-20 bg-gradient-to-r from-primary-400 to-primary-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">
            <span class="text-3xl">🎯</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-4">Smart Categories</h3>
          <p class="text-gray-300 text-lg leading-relaxed">
            Choose from 8 diverse categories including Science, History, Literature, and more.
            Each category is carefully curated to provide comprehensive learning.
          </p>
        </div>

        <div class="feature-card glass-card p-8 rounded-3xl hover-glow hover-float transition-all duration-500 group">
          <div class="w-20 h-20 bg-gradient-to-r from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">
            <span class="text-3xl">🏆</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-4">Live Leaderboard</h3>
          <p class="text-gray-300 text-lg leading-relaxed">
            Compete with fellow learners in real-time. Track your progress,
            climb the rankings, and celebrate your achievements with the community.
          </p>
        </div>

        <div class="feature-card glass-card p-8 rounded-3xl hover-glow hover-float transition-all duration-500 group">
          <div class="w-20 h-20 bg-gradient-to-r from-secondary-400 to-secondary-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">
            <span class="text-3xl">📊</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-4">Detailed Analytics</h3>
          <p class="text-gray-300 text-lg leading-relaxed">
            Get comprehensive insights into your performance. Identify strengths,
            track improvement areas, and optimize your learning strategy.
          </p>
        </div>

        <div class="feature-card glass-card p-8 rounded-3xl hover-glow hover-float transition-all duration-500 group">
          <div class="w-20 h-20 bg-gradient-to-r from-info-400 to-info-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">
            <span class="text-3xl">⚡</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-4">Real-time Progress</h3>
          <p class="text-gray-300 text-lg leading-relaxed">
            Track your quiz progress in real-time with visual indicators,
            timers, and instant feedback to keep you motivated.
          </p>
        </div>

        <div class="feature-card glass-card p-8 rounded-3xl hover-glow hover-float transition-all duration-500 group">
          <div class="w-20 h-20 bg-gradient-to-r from-success-400 to-success-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">
            <span class="text-3xl">🎨</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-4">Beautiful Design</h3>
          <p class="text-gray-300 text-lg leading-relaxed">
            Enjoy a stunning, responsive interface with interactive animations,
            smooth transitions, and intuitive navigation.
          </p>
        </div>

        <div class="feature-card glass-card p-8 rounded-3xl hover-glow hover-float transition-all duration-500 group">
          <div class="w-20 h-20 bg-gradient-to-r from-warning-400 to-warning-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300">
            <span class="text-3xl">🔒</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-4">Secure & Reliable</h3>
          <p class="text-gray-300 text-lg leading-relaxed">
            Your data is protected with enterprise-grade security.
            Enjoy a reliable platform that's always available when you need it.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Team Section -->
  <section id="team" class="py-24 relative">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-20">
        <h2 class="section-title text-5xl md:text-6xl font-display font-bold mb-8">
          <span class="gradient-text">Meet Our Team</span>
        </h2>
        <p class="section-subtitle text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
          The passionate individuals behind Verse'26 Quiz, dedicated to creating the best learning experience
        </p>
      </div>

      <div class="team-grid grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Team Members -->
        <div class="team-card glass-card p-8 rounded-3xl hover-glow hover-float transition-all duration-500 text-center group">
          <div class="w-28 h-28 bg-gradient-to-r from-primary-400 to-primary-600 rounded-full flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-all duration-300">
            <span class="text-4xl text-white font-bold">A</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-3">Ahmed Hassan</h3>
          <p class="text-primary-400 font-semibold mb-6 text-lg">Founder & CEO</p>
          <p class="text-gray-300 leading-relaxed">
            Visionary leader passionate about transforming education through technology.
            Leads the strategic direction and innovation initiatives.
          </p>
        </div>

        <div class="team-card glass-card p-8 rounded-3xl hover-glow hover-float transition-all duration-500 text-center group">
          <div class="w-28 h-28 bg-gradient-to-r from-accent-400 to-accent-600 rounded-full flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-all duration-300">
            <span class="text-4xl text-white font-bold">S</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-3">Sarah Mohamed</h3>
          <p class="text-accent-400 font-semibold mb-6 text-lg">Lead Developer</p>
          <p class="text-gray-300 leading-relaxed">
            Full-stack developer with expertise in modern web technologies.
            Crafts beautiful, performant, and user-friendly experiences.
          </p>
        </div>

        <div class="team-card glass-card p-8 rounded-3xl hover-glow hover-float transition-all duration-500 text-center group">
          <div class="w-28 h-28 bg-gradient-to-r from-secondary-400 to-secondary-600 rounded-full flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-all duration-300">
            <span class="text-4xl text-white font-bold">M</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-3">Mohamed Ali</h3>
          <p class="text-secondary-400 font-semibold mb-6 text-lg">Content Manager</p>
          <p class="text-gray-300 leading-relaxed">
            Educational content specialist ensuring high-quality questions and
            comprehensive learning materials across all categories.
          </p>
        </div>

        <div class="team-card glass-card p-8 rounded-3xl hover-glow hover-float transition-all duration-500 text-center group">
          <div class="w-28 h-28 bg-gradient-to-r from-info-400 to-info-600 rounded-full flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-all duration-300">
            <span class="text-4xl text-white font-bold">F</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-3">Fatma Ibrahim</h3>
          <p class="text-info-400 font-semibold mb-6 text-lg">UX Designer</p>
          <p class="text-gray-300 leading-relaxed">
            Creative designer focused on creating intuitive and engaging user experiences
            that make learning enjoyable and accessible.
          </p>
        </div>

        <div class="team-card glass-card p-8 rounded-3xl hover-glow hover-float transition-all duration-500 text-center group">
          <div class="w-28 h-28 bg-gradient-to-r from-success-400 to-success-600 rounded-full flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-all duration-300">
            <span class="text-4xl text-white font-bold">O</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-3">Omar Khalil</h3>
          <p class="text-success-400 font-semibold mb-6 text-lg">Data Analyst</p>
          <p class="text-gray-300 leading-relaxed">
            Analytics expert who transforms user data into actionable insights,
            helping improve the platform and learning outcomes.
          </p>
        </div>

        <div class="team-card glass-card p-8 rounded-3xl hover-glow hover-float transition-all duration-500 text-center group">
          <div class="w-28 h-28 bg-gradient-to-r from-warning-400 to-warning-600 rounded-full flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-all duration-300">
            <span class="text-4xl text-white font-bold">L</span>
          </div>
          <h3 class="text-2xl font-bold text-white mb-3">Layla Ahmed</h3>
          <p class="text-warning-400 font-semibold mb-6 text-lg">Community Manager</p>
          <p class="text-gray-300 leading-relaxed">
            Builds and nurtures our learning community, ensuring every user feels
            supported and motivated in their educational journey.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Registration Section -->
  <section class="py-24 relative">
    <div class="max-w-5xl mx-auto px-6">
      <div class="text-center mb-16">
        <h2 class="section-title text-5xl md:text-6xl font-display font-bold mb-8">
          <span class="gradient-text">Ready to Start?</span>
        </h2>
        <p class="section-subtitle text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
          Join thousands of learners who are already transforming their knowledge with Verse'26 Quiz
        </p>
      </div>

      <div class="registration-form glass-card p-12 rounded-3xl hover-glow transition-all duration-500">
        <form id="studentForm" class="space-y-8">
          <div class="grid md:grid-cols-2 gap-8">
            <!-- Name Input -->
            <div class="space-y-3">
              <label for="name" class="block text-lg font-semibold text-white">
                Full Name
              </label>
              <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                  <span class="text-primary-400 text-2xl">👤</span>
                </div>
                <input
                  type="text"
                  id="name"
                  name="name"
                  placeholder="Enter your full name"
                  required
                  class="w-full pl-16 pr-6 py-4 bg-white bg-opacity-5 backdrop-blur-sm border-2 border-white border-opacity-20 rounded-2xl text-white placeholder-gray-400 focus:border-primary-400 focus:bg-opacity-10 transition-all duration-300 text-lg hover:bg-opacity-8" />
              </div>
            </div>

            <!-- Phone Input -->
            <div class="space-y-3">
              <label for="phone" class="block text-lg font-semibold text-white">
                Phone Number
              </label>
              <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                  <span class="text-primary-400 text-2xl">📱</span>
                </div>
                <input
                  type="tel"
                  id="phone"
                  name="phone"
                  placeholder="Enter your phone number"
                  required
                  class="w-full pl-16 pr-6 py-4 bg-white bg-opacity-5 backdrop-blur-sm border-2 border-white border-opacity-20 rounded-2xl text-white placeholder-gray-400 focus:border-primary-400 focus:bg-opacity-10 transition-all duration-300 text-lg hover:bg-opacity-8" />
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="text-center pt-8">
            <button
              type="submit"
              id="submitBtn"
              class="btn-ripple px-16 py-5 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-bold text-2xl rounded-3xl transition-all duration-300 transform hover:scale-105 hover:shadow-glow-lg focus:outline-none focus:ring-4 focus:ring-primary-400 focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed">
              Start Your Learning Journey 🚀
            </button>
          </div>
        </form>

        <!-- Message Display -->
        <div id="formMessage" class="mt-8 text-center"></div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="relative z-10 py-12 text-center">
    <div class="max-w-7xl mx-auto px-6">
      <div class="glass-card p-8 rounded-3xl">
        <p class="text-2xl text-gray-300 font-medium mb-4">
          © 2025 Verse'26 Quiz Platform
        </p>
        <p class="text-lg text-gray-400">
          Made with ❤️ for learning and growth
        </p>
        <div class="flex justify-center gap-6 mt-6">
          <span class="text-3xl hover:scale-125 transition-transform duration-300 cursor-pointer">🎯</span>
          <span class="text-3xl hover:scale-125 transition-transform duration-300 cursor-pointer">🚀</span>
          <span class="text-3xl hover:scale-125 transition-transform duration-300 cursor-pointer">✨</span>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // Initialize GSAP ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);

    // Create interactive particles
    function createParticles() {
      const container = document.getElementById('particlesContainer');
      const particleCount = 50;

      for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';

        // Random positioning and sizing
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = Math.random() * 100 + '%';
        particle.style.width = (Math.random() * 8 + 4) + 'px';
        particle.style.height = particle.style.width;
        particle.style.animationDelay = Math.random() * 8 + 's';
        particle.style.animationDuration = (Math.random() * 6 + 4) + 's';

        container.appendChild(particle);
      }
    }

    // Counter animation
    function animateCounters() {
      const counters = document.querySelectorAll('.stat-number');

      counters.forEach(counter => {
        const target = parseInt(counter.dataset.target);
        const duration = 2000; // 2 seconds
        const startTime = Date.now();

        function updateCounter() {
          const currentTime = Date.now();
          const progress = Math.min((currentTime - startTime) / duration, 1);
          const currentValue = Math.floor(progress * target);

          counter.textContent = currentValue + (counter.dataset.target === '99' ? '%' : '+');

          if (progress < 1) {
            requestAnimationFrame(updateCounter);
          }
        }

        updateCounter();
      });
    }

    // Hero section animations
    function initHeroAnimations() {
      const heroTl = gsap.timeline();

      heroTl
        .from('.hero-icon', {
          duration: 1.2,
          scale: 0,
          rotation: 180,
          ease: 'elastic.out(1, 0.5)',
        })
        .from('.hero-title', {
          duration: 1,
          y: 50,
          opacity: 0,
          ease: 'power3.out'
        }, '-=0.5')
        .from('.hero-subtitle', {
          duration: 1,
          y: 30,
          opacity: 0,
          ease: 'power3.out'
        }, '-=0.3')
        .from('.stat-item', {
          duration: 0.8,
          scale: 0,
          opacity: 0,
          stagger: 0.1,
          ease: 'back.out(1.7)',
          onComplete: animateCounters
        }, '-=0.2')
        .from('.hero-cta button', {
          duration: 0.6,
          y: 30,
          opacity: 0,
          stagger: 0.2,
          ease: 'power2.out'
        }, '-=0.3');
    }

    // Scroll animations
    function initScrollAnimations() {
      // Section titles and subtitles
      gsap.utils.toArray('.section-title, .section-subtitle').forEach(element => {
        gsap.fromTo(element, {
          opacity: 0,
          y: 50
        }, {
          opacity: 1,
          y: 0,
          duration: 1,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: element,
            start: 'top 85%',
            end: 'bottom 15%',
            toggleActions: 'play none none reverse'
          }
        });
      });

      // Feature cards with stagger
      gsap.fromTo('.feature-card', {
        opacity: 0,
        y: 60,
        scale: 0.8
      }, {
        opacity: 1,
        y: 0,
        scale: 1,
        duration: 0.8,
        stagger: 0.15,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: '.features-grid',
          start: 'top 80%',
          end: 'bottom 20%',
          toggleActions: 'play none none reverse'
        }
      });

      // Team cards with different animation
      gsap.fromTo('.team-card', {
        opacity: 0,
        x: -50,
        rotation: -5
      }, {
        opacity: 1,
        x: 0,
        rotation: 0,
        duration: 0.8,
        stagger: 0.1,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: '.team-grid',
          start: 'top 80%',
          end: 'bottom 20%',
          toggleActions: 'play none none reverse'
        }
      });

      // Mission and vision cards
      gsap.fromTo('.mission-content, .values-content', {
        opacity: 0,
        x: -100
      }, {
        opacity: 1,
        x: 0,
        duration: 1.2,
        stagger: 0.3,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: '.mission-content',
          start: 'top 80%',
          end: 'bottom 20%',
          toggleActions: 'play none none reverse'
        }
      });

      // Registration form
      gsap.fromTo('.registration-form', {
        opacity: 0,
        y: 50,
        scale: 0.9
      }, {
        opacity: 1,
        y: 0,
        scale: 1,
        duration: 1,
        ease: 'power3.out',
        scrollTrigger: {
          trigger: '.registration-form',
          start: 'top 85%',
          end: 'bottom 15%',
          toggleActions: 'play none none reverse'
        }
      });
    }

    // Anime.js animations for enhanced effects
    function initAnimeAnimations() {
      // Floating animation for feature icons
      anime({
        targets: '.feature-card .w-20',
        translateY: [0, -10, 0],
        rotate: [0, 5, -5, 0],
        duration: 4000,
        easing: 'easeInOutSine',
        loop: true,
        delay: anime.stagger(200)
      });

      // Team avatars pulse
      anime({
        targets: '.team-card .w-28',
        scale: [1, 1.1, 1],
        duration: 3000,
        easing: 'easeInOutQuad',
        loop: true,
        delay: anime.stagger(500)
      });

      // Navbar logo rotation on hover
      const navLogo = document.querySelector('nav .w-16');
      navLogo.addEventListener('mouseenter', () => {
        anime({
          targets: navLogo,
          rotate: '1turn',
          duration: 600,
          easing: 'easeInOutExpo'
        });
      });
    }

    // Form handling
    function initFormHandling() {
      const form = document.getElementById('studentForm');
      const submitBtn = document.getElementById('submitBtn');
      const messageDiv = document.getElementById('formMessage');

      // Smooth scroll to registration when start button is clicked
      document.getElementById('startQuizBtn').addEventListener('click', () => {
        document.querySelector('.registration-form').scrollIntoView({
          behavior: 'smooth',
          block: 'center'
        });
      });

      // Form submission
      form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Disable button and show loading animation
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Creating Account... ⏳';

        // Animate button
        anime({
          targets: submitBtn,
          scale: [1, 0.95, 1],
          duration: 200,
          easing: 'easeInOutQuad'
        });

        try {
          // Simulate API call (replace with actual endpoint)
          await new Promise(resolve => setTimeout(resolve, 2000));

          // Success animation
          anime({
            targets: '.registration-form',
            scale: [1, 1.05, 1],
            duration: 600,
            easing: 'easeInOutQuad'
          });

          messageDiv.innerHTML = `
            <div class="glass-card p-6 rounded-2xl border-2 border-primary-400">
              <p class="text-primary-400 text-xl font-semibold">✅ Account created successfully!</p>
              <p class="text-gray-300 mt-2">Redirecting to quiz categories...</p>
            </div>
          `;

          setTimeout(() => {
            // Replace with actual redirect
            window.location.href = 'categories.php';
          }, 1500);

        } catch (error) {
          messageDiv.innerHTML = `
            <div class="glass-card p-6 rounded-2xl border-2 border-red-400">
              <p class="text-red-400 text-xl font-semibold">❌ Error occurred</p>
              <p class="text-gray-300 mt-2">Please try again later.</p>
            </div>
          `;
        } finally {
          submitBtn.disabled = false;
          submitBtn.innerHTML = 'Start Your Learning Journey 🚀';
        }
      });

      // Input animations
      const inputs = form.querySelectorAll('input');
      inputs.forEach(input => {
        input.addEventListener('focus', () => {
          anime({
            targets: input,
            scale: 1.02,
            duration: 200,
            easing: 'easeOutQuad'
          });
        });

        input.addEventListener('blur', () => {
          anime({
            targets: input,
            scale: 1,
            duration: 200,
            easing: 'easeOutQuad'
          });
        });
      });
    }

    // Smooth navigation
    function initSmoothNavigation() {
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            target.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          }
        });
      });
    }

    // Mobile menu toggle
    function initMobileMenu() {
      const menuToggle = document.getElementById('menuToggle');
      const navLinks = document.querySelector('nav .hidden.md\\:flex');

      if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => {
          navLinks.classList.toggle('hidden');
          navLinks.classList.toggle('flex');
          navLinks.classList.toggle('flex-col');
          navLinks.classList.toggle('absolute');
          navLinks.classList.toggle('top-full');
          navLinks.classList.toggle('left-0');
          navLinks.classList.toggle('w-full');
          navLinks.classList.toggle('glass-effect');
          navLinks.classList.toggle('p-4');
          navLinks.classList.toggle('rounded-b-2xl');
        });
      }
    }

    // Mouse parallax effect
    function initMouseParallax() {
      document.addEventListener('mousemove', (e) => {
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;

        // Move particles slightly based on mouse position
        gsap.to('.particle', {
          duration: 2,
          x: (mouseX - 0.5) * 20,
          y: (mouseY - 0.5) * 20,
          stagger: 0.05,
          ease: 'power2.out'
        });

        // Subtle background movement
        gsap.to('body', {
          duration: 1,
          backgroundPosition: `${mouseX * 10}% ${mouseY * 10}%`,
          ease: 'power2.out'
        });
      });
    }

    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
      createParticles();
      initHeroAnimations();
      initScrollAnimations();
      initAnimeAnimations();
      initFormHandling();
      initSmoothNavigation();
      initMobileMenu();
      initMouseParallax();

      // Add loading complete animation
      gsap.to('body', {
        duration: 1,
        opacity: 1,
        ease: 'power2.out'
      });
    });

    // Performance optimization: Reduce animations on mobile
    if (window.innerWidth < 768) {
      document.querySelector('.particles-container').style.display = 'none';
    }
  </script>
</body>

</html>