// Theme Management
class ThemeManager {
  constructor() {
    this.themeIcon = document.getElementById("themeIcon");
    this.toggleBtn = document.getElementById("modeToggle");
    this.init();
  }

  init() {
    // Load saved theme or default to light
    const savedTheme = localStorage.getItem('theme') || 'light';
    this.setTheme(savedTheme);

    // Add click event listener
    if (this.toggleBtn) {
      this.toggleBtn.addEventListener("click", () => this.toggleTheme());
    }
  }

  setTheme(theme) {
    const html = document.documentElement;
    const isDark = theme === 'dark';

    html.classList.toggle('dark', isDark);
    html.classList.toggle('light', !isDark);

    if (this.themeIcon) {
      this.themeIcon.textContent = isDark ? '☀️' : '🌙';
    }

    // Save to localStorage
    localStorage.setItem('theme', theme);

    // Update meta theme-color for mobile browsers
    this.updateMetaThemeColor(isDark);
  }

  toggleTheme() {
    const currentTheme = localStorage.getItem('theme') || 'light';
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    this.setTheme(newTheme);

    // Add animation effect
    this.toggleBtn.style.transform = 'scale(0.95)';
    setTimeout(() => {
      this.toggleBtn.style.transform = 'scale(1)';
    }, 150);
  }

  updateMetaThemeColor(isDark) {
    let metaThemeColor = document.querySelector('meta[name="theme-color"]');
    if (!metaThemeColor) {
      metaThemeColor = document.createElement('meta');
      metaThemeColor.name = 'theme-color';
      document.head.appendChild(metaThemeColor);
    }
    metaThemeColor.content = isDark ? '#0f172a' : '#f0f9ff';
  }
}

// Initialize theme manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  new ThemeManager();
});

// Utility functions for form handling
class FormHandler {
  static async submitForm(formElement, endpoint, successCallback, errorCallback) {
    const formData = new FormData(formElement);

    try {
      const response = await fetch(endpoint, {
        method: 'POST',
        body: formData
      });

      const data = await response.json();

      if (data.status === 'ok') {
        if (successCallback) successCallback(data);
      } else {
        if (errorCallback) errorCallback(data.message);
      }
    } catch (error) {
      if (errorCallback) errorCallback('Network error occurred. Please try again.');
    }
  }

  static showMessage(elementId, message, type = 'error') {
    const messageElement = document.getElementById(elementId);
    if (messageElement) {
      const colorClass = type === 'error' ? 'text-error-500' : 'text-success-500';
      const icon = type === 'error' ? '⚠️' : '✅';

      messageElement.innerHTML = `
        <div class="flex items-center justify-center gap-2 p-3 rounded-xl bg-${type === 'error' ? 'error' : 'success'}-50 dark:bg-${type === 'error' ? 'error' : 'success'}-900/20 border border-${type === 'error' ? 'error' : 'success'}-200 dark:border-${type === 'error' ? 'error' : 'success'}-800">
          <span class="text-lg">${icon}</span>
          <p class="${colorClass} font-medium">${message}</p>
        </div>
      `;

      // Auto-hide after 5 seconds
      setTimeout(() => {
        messageElement.innerHTML = '';
      }, 5000);
    }
  }
}

// Animation utilities
class AnimationUtils {
  static fadeIn(element, duration = 500) {
    element.style.opacity = '0';
    element.style.transition = `opacity ${duration}ms ease-in-out`;

    setTimeout(() => {
      element.style.opacity = '1';
    }, 10);
  }

  static slideUp(element, duration = 500) {
    element.style.transform = 'translateY(20px)';
    element.style.opacity = '0';
    element.style.transition = `all ${duration}ms ease-out`;

    setTimeout(() => {
      element.style.transform = 'translateY(0)';
      element.style.opacity = '1';
    }, 10);
  }

  static pulse(element, duration = 1000) {
    element.style.animation = `pulse ${duration}ms ease-in-out`;

    setTimeout(() => {
      element.style.animation = '';
    }, duration);
  }
}

// Loading state management
class LoadingManager {
  static show(element, text = 'Loading...') {
    element.innerHTML = `
      <div class="flex items-center justify-center gap-3 p-4">
        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-primary-500"></div>
        <span class="text-gray-600 dark:text-gray-400 font-medium">${text}</span>
      </div>
    `;
  }

  static hide(element) {
    element.innerHTML = '';
  }
}