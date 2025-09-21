<?php

/**
 * Enhanced Team Data Renderer
 * Renders team members with filtering and pagination
 */

function loadTeamData()
{
  $jsonFile = __DIR__ . '/team_data.json';
  if (!file_exists($jsonFile)) {
    return null;
  }

  $jsonContent = file_get_contents($jsonFile);
  return json_decode($jsonContent, true);
}

function renderMissionVisionSection($data)
{
  if (!$data || !isset($data['mission_vision'])) {
    return '';
  }

  $mv = $data['mission_vision'];

  ob_start();
?>
  <!-- Mission & Vision Section -->
  <section class="py-16 backdrop-blur-sm rounded-3xl border border-white/30 dark:border-gray-700/30 shadow-xl mission-card">
    <div class="max-w-7xl mx-auto px-10">
      <div class="text-center mb-20">
        <div class="inline-block p-2 rounded-2xl mb-6">
          <h2 class="text-5xl md:text-6xl font-display font-bold text-white px-6 py-2">
            About Verse'26
          </h2>
        </div>
        <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 max-w-4xl mx-auto leading-relaxed font-light">
          Empowering learners through interactive education and fostering a community of knowledge seekers
        </p>
      </div>

      <div class="grid lg:grid-cols-3 gap-8">
        <!-- Mission Card -->
        <div class="group relative overflow-hidden p-8 bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/40 dark:border-gray-700/50 hover:shadow-3xl transition-all duration-700 hover:-translate-y-3 hover:scale-[1.02]">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-cyan-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative z-10">
            <div class="w-20 h-20 bg-gradient-to-r <?= $mv['mission']['color'] ?> rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 shadow-lg">
              <span class="text-3xl"><?= $mv['mission']['icon'] ?></span>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300"><?= $mv['mission']['title'] ?></h3>
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
              <?= $mv['mission']['description'] ?>
            </p>
          </div>
        </div>

        <!-- Vision Card -->
        <div class="group relative overflow-hidden p-8 bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/40 dark:border-gray-700/50 hover:shadow-3xl transition-all duration-700 hover:-translate-y-3 hover:scale-[1.02]">
          <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-pink-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative z-10">
            <div class="w-20 h-20 bg-gradient-to-r <?= $mv['vision']['color'] ?> rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 shadow-lg">
              <span class="text-3xl"><?= $mv['vision']['icon'] ?></span>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-300"><?= $mv['vision']['title'] ?></h3>
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
              <?= $mv['vision']['description'] ?>
            </p>
          </div>
        </div>

        <!-- Values Card -->
        <div class="group relative overflow-hidden p-8 bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/40 dark:border-gray-700/50 hover:shadow-3xl transition-all duration-700 hover:-translate-y-3 hover:scale-[1.02]">
          <div class="absolute inset-0 bg-gradient-to-br from-green-500/10 to-emerald-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative z-10">
            <div class="w-20 h-20 bg-gradient-to-r <?= $mv['values']['color'] ?> rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 shadow-lg">
              <span class="text-3xl"><?= $mv['values']['icon'] ?></span>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-300"><?= $mv['values']['title'] ?></h3>
            <div class="space-y-4">
              <?php foreach ($mv['values']['items'] as $value): ?>
                <div class="flex items-start gap-4 p-3 rounded-xl hover:bg-white/50 dark:hover:bg-gray-700/50 transition-colors duration-300">
                  <div class="w-8 h-8 bg-gradient-to-r from-green-400 to-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0 mt-1 shadow-md">
                    <span class="text-sm"><?= $value['icon'] ?></span>
                  </div>
                  <div>
                    <h4 class="font-semibold text-gray-800 dark:text-white mb-1"><?= $value['title'] ?></h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300"><?= $value['description'] ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php
  return ob_get_clean();
}

function renderFeaturesSection($data)
{
  if (!$data || !isset($data['features'])) {
    return '';
  }

  $features = $data['features'];

  ob_start();
?>
  <!-- Features Showcase Section -->
  <section class="mt-16 py-16 backdrop-blur-sm rounded-3xl border border-white/30 dark:border-gray-700/30 shadow-xl">
    <div class="relative z-10 max-w-7xl mx-auto px-10">
      <div class="text-center mb-20">
        <div class="inline-block p-2 rounded-2xl mb-6">
          <h2 class="text-5xl md:text-6xl font-display font-bold text-white px-6 py-2">
            <?= $features['title'] ?>
          </h2>
        </div>
        <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 max-w-4xl mx-auto leading-relaxed font-light">
          <?= $features['subtitle'] ?>
        </p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($features['items'] as $index => $feature): ?>
          <div class="group relative overflow-hidden p-8 bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-3xl shadow-xl border border-white/40 dark:border-gray-700/50 hover:shadow-3xl transition-all duration-700 hover:-translate-y-3 hover:scale-[1.02]" style="animation: fadeInUp 0.6s ease-out <?= $index * 0.1 ?>s both;">
            <div class="absolute inset-0 bg-gradient-to-br opacity-0 group-hover:opacity-100 transition-opacity duration-500" style="background: linear-gradient(135deg, <?= str_replace(['from-', 'to-'], ['', ''], $feature['color']) ?>/10);"></div>
            <div class="relative z-10">
              <div class="w-20 h-20 bg-gradient-to-r <?= $feature['color'] ?> rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-lg">
                <span class="text-3xl"><?= $feature['icon'] ?></span>
              </div>
              <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300"><?= $feature['title'] ?></h3>
              <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
                <?= $feature['description'] ?>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <style>
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
<?php
  return ob_get_clean();
}

function renderTeamSection($data)
{
  if (!$data || !isset($data['team_categories'])) {
    return '';
  }

  $categories = $data['team_categories'];

  ob_start();
?>
  <!-- Enhanced Team Section with Filtering -->
  <section class="mt-16 py-16 backdrop-blur-sm rounded-3xl border border-white/30 dark:border-gray-700/30 shadow-xl relative overflow-hidden">

    <div class="relative z-10 max-w-7xl mx-auto px-10">
      <div class="text-center mb-16">
        <div class="inline-block p-2 rounded-2xl mb-6">
          <h2 class="text-5xl md:text-6xl font-display font-bold text-white px-6 py-2">
            Meet Our Team
          </h2>
        </div>
        <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 max-w-4xl mx-auto leading-relaxed font-light mb-12">
          The passionate individuals behind Verse'26 Quiz, dedicated to creating the best learning experience
        </p>

        <!-- Enhanced Filter Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-12" id="teamFilters">
          <button class="filter-btn active px-8 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 border-2 border-transparent" data-filter="all">
            <span class="flex items-center gap-2">
              <span class="text-lg">👥</span>
              <span>All Team</span>
            </span>
          </button>
          <?php foreach ($categories as $categoryKey => $category): ?>
            <button class="filter-btn px-8 py-4 bg-white/90 dark:bg-gray-800/90 backdrop-blur-xl text-gray-700 dark:text-gray-300 font-semibold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 border-2 border-white/40 dark:border-gray-700/40 hover:border-blue-300 dark:hover:border-blue-500" data-filter="<?= $categoryKey ?>">
              <span class="flex items-center gap-2">
                <span class="text-lg"><?= $category['icon'] ?></span>
                <span><?= $category['title'] ?></span>
              </span>
            </button>
          <?php endforeach; ?>
        </div>

        <!-- Team Statistics -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
          <?php
          $totalMembers = 0;
          foreach ($categories as $category) {
            $totalMembers += count($category['members']);
          }
          ?>
          <div class="stat-card p-6 bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-lg border border-white/40 dark:border-gray-700/40">
            <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2"><?= $totalMembers ?></div>
            <div class="text-sm font-semibold text-gray-600 dark:text-gray-300">Team Members</div>
          </div>
          <div class="stat-card p-6 bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-lg border border-white/40 dark:border-gray-700/40">
            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-2"><?= count($categories) ?></div>
            <div class="text-sm font-semibold text-gray-600 dark:text-gray-300">Departments</div>
          </div>
          <div class="stat-card p-6 bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-lg border border-white/40 dark:border-gray-700/40">
            <div class="text-3xl font-bold text-green-600 dark:text-green-400 mb-2">24/7</div>
            <div class="text-sm font-semibold text-gray-600 dark:text-gray-300">Support</div>
          </div>
          <div class="stat-card p-6 bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-lg border border-white/40 dark:border-gray-700/40">
            <div class="text-3xl font-bold text-orange-600 dark:text-orange-400 mb-2">100%</div>
            <div class="text-sm font-semibold text-gray-600 dark:text-gray-300">Dedicated</div>
          </div>
        </div>
      </div>

      <!-- Team Members Grid -->
      <div id="teamGrid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 transition-all duration-500">
        <?php
        $memberIndex = 0;
        foreach ($categories as $categoryKey => $category):
          foreach ($category['members'] as $member):
            $memberIndex++;
        ?>
            <div class="team-member-card member-card group relative overflow-hidden p-8 bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-3xl shadow-xl border border-white/40 dark:border-gray-700/50 hover:shadow-3xl transition-all duration-700 hover:-translate-y-3 hover:scale-[1.02] text-center <?= $memberIndex > 6 ? 'hidden' : '' ?>"
              data-category="<?= $categoryKey ?>"
              data-index="<?= $memberIndex ?>"
              style="animation: fadeInScale 0.6s ease-out <?= ($memberIndex - 1) * 0.1 ?>s both;">

              <!-- Gradient Background -->
              <div class="absolute inset-0 bg-gradient-to-br opacity-0 group-hover:opacity-100 transition-opacity duration-500" style="background: linear-gradient(135deg, <?= str_replace(['from-', 'to-'], ['', ''], $category['color']) ?>/10);"></div>

              <div class="relative z-10">
                <!-- Enhanced Avatar -->
                <div class="relative mx-auto mb-6">
                  <div class="team-avatar w-24 h-24 bg-gradient-to-r <?= $category['color'] ?> rounded-3xl flex items-center justify-center mx-auto group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-xl">
                    <span class="text-3xl text-white font-bold"><?= $member['avatar'] ?></span>
                  </div>
                  <!-- Status Indicator -->
                  <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-4 border-white dark:border-gray-800 shadow-lg animate-pulse"></div>
                </div>

                <!-- Member Info -->
                <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300"><?= $member['name'] ?></h4>

                <!-- Department Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r <?= $category['color'] ?> rounded-full mb-4 shadow-md">
                  <span class="text-sm"><?= $category['icon'] ?></span>
                  <span class="text-sm font-semibold text-white"><?= $member['position'] ?></span>
                </div>

                <!-- Bio -->
                <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed mb-6 line-clamp-3">
                  <?= $member['bio'] ?>
                </p>

                <!-- Enhanced Social Links -->
                <div class="flex justify-center gap-3">
                  <?php if (isset($member['social']['linkedin']) && $member['social']['linkedin'] !== '#'): ?>
                    <a href="<?= $member['social']['linkedin'] ?>" class="social-link w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center hover:scale-110 hover:rotate-12 transition-all duration-300 shadow-lg hover:shadow-xl">
                      <span class="text-white text-sm font-bold">in</span>
                    </a>
                  <?php endif; ?>
                  <?php if (isset($member['social']['twitter']) && $member['social']['twitter'] !== '#'): ?>
                    <a href="<?= $member['social']['twitter'] ?>" class="social-link w-10 h-10 bg-gradient-to-r from-sky-400 to-sky-500 rounded-xl flex items-center justify-center hover:scale-110 hover:rotate-12 transition-all duration-300 shadow-lg hover:shadow-xl">
                      <span class="text-white text-sm">🐦</span>
                    </a>
                  <?php endif; ?>
                  <?php if (isset($member['social']['email']) && $member['social']['email'] !== '#'): ?>
                    <a href="mailto:<?= $member['social']['email'] ?>" class="social-link w-10 h-10 bg-gradient-to-r from-gray-500 to-gray-600 rounded-xl flex items-center justify-center hover:scale-110 hover:rotate-12 transition-all duration-300 shadow-lg hover:shadow-xl">
                      <span class="text-white text-sm">✉</span>
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
        <?php
          endforeach;
        endforeach;
        ?>
      </div>

      <!-- Show More/Less Button -->
      <?php if ($memberIndex > 6): ?>
        <div class="text-center mt-16">
          <button id="showMoreBtn" class="show-more-btn px-10 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 hover:-translate-y-1">
            <span class="flex items-center gap-3">
              <span>Show More Team Members</span>
              <span class="text-xl transform transition-transform duration-300" id="showMoreIcon">↓</span>
            </span>
          </button>
        </div>
      <?php endif; ?>

      <!-- No Results Message -->
      <div id="noResults" class="hidden text-center py-16">
        <div class="w-32 h-32 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
          <span class="text-4xl text-gray-400">🔍</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-600 dark:text-gray-300 mb-4">No team members found</h3>
        <p class="text-gray-500 dark:text-gray-400">Try selecting a different department filter</p>
      </div>
    </div>
  </section>

  <style>
    @keyframes fadeInScale {
      from {
        opacity: 0;
        transform: translateY(20px) scale(0.95);
      }

      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    .line-clamp-3 {
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .filter-btn.active {
      background: linear-gradient(135deg, #3b82f6, #6366f1);
      color: white;
      border-color: #3b82f6;
      transform: scale(1.05);
    }

    .member-card {
      transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .social-link:hover {
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .stat-card:hover {
      transform: translateY(-5px) scale(1.05);
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const filterButtons = document.querySelectorAll('.filter-btn');
      const teamCards = document.querySelectorAll('.member-card');
      const showMoreBtn = document.getElementById('showMoreBtn');
      const showMoreIcon = document.getElementById('showMoreIcon');
      const noResults = document.getElementById('noResults');
      let isShowingAll = false;
      let currentFilter = 'all';

      // Filter functionality
      filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
          const filter = btn.dataset.filter;
          currentFilter = filter;

          // Update active button
          filterButtons.forEach(b => b.classList.remove('active'));
          btn.classList.add('active');

          // Reset show more state
          isShowingAll = false;
          if (showMoreBtn) {
            showMoreBtn.innerHTML = '<span class="flex items-center gap-3"><span>Show More Team Members</span><span class="text-xl transform transition-transform duration-300">↓</span></span>';
          }

          filterAndDisplay();
        });
      });

      // Show more functionality
      if (showMoreBtn) {
        showMoreBtn.addEventListener('click', () => {
          isShowingAll = !isShowingAll;

          if (isShowingAll) {
            showMoreBtn.innerHTML = '<span class="flex items-center gap-3"><span>Show Less</span><span class="text-xl transform transition-transform duration-300 rotate-180">↓</span></span>';
          } else {
            showMoreBtn.innerHTML = '<span class="flex items-center gap-3"><span>Show More Team Members</span><span class="text-xl transform transition-transform duration-300">↓</span></span>';
          }

          filterAndDisplay();
        });
      }

      function filterAndDisplay() {
        let visibleCount = 0;
        let hasVisibleCards = false;

        teamCards.forEach((card, index) => {
          const cardCategory = card.dataset.category;
          const shouldShow = currentFilter === 'all' || cardCategory === currentFilter;

          if (shouldShow) {
            hasVisibleCards = true;
            if (isShowingAll || visibleCount < 6) {
              card.classList.remove('hidden');
              card.style.animationDelay = (visibleCount * 0.1) + 's';
              visibleCount++;
            } else {
              card.classList.add('hidden');
            }
          } else {
            card.classList.add('hidden');
          }
        });

        // Show/hide no results message
        if (hasVisibleCards) {
          noResults.classList.add('hidden');
        } else {
          noResults.classList.remove('hidden');
        }

        // Show/hide show more button based on filter
        if (showMoreBtn) {
          const filteredCards = Array.from(teamCards).filter(card =>
            currentFilter === 'all' || card.dataset.category === currentFilter
          );

          if (filteredCards.length > 6) {
            showMoreBtn.classList.remove('hidden');
          } else {
            showMoreBtn.classList.add('hidden');
          }
        }
      }

      // Initialize
      filterAndDisplay();
    });
  </script>
<?php
  return ob_get_clean();
}
?>