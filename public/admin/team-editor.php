<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Team Editor - Verse'26</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.544.0/dist/umd/lucide.min.js"></script>
  <style>
    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    .member-card {
      transition: all 0.3s ease;
    }

    .member-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
  <!-- Header -->
  <div class="bg-white shadow-lg border-b">
    <div class="container mx-auto px-6 py-4">
      <div class="flex justify-between items-center">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
            <i data-lucide="users" class="w-6 h-6 text-white"></i>
          </div>
          <h1 class="text-2xl font-bold text-gray-800">Team Data Editor</h1>
        </div>
        <div class="flex space-x-3">
          <button onclick="exportData()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center space-x-2">
            <i data-lucide="download" class="w-4 h-4"></i>
            <span>Export JSON</span>
          </button>
          <button onclick="importData()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
            <i data-lucide="upload" class="w-4 h-4"></i>
            <span>Import JSON</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="container mx-auto px-6 py-8">
    <!-- Success/Error Messages -->
    <div id="message-area"></div>

    <!-- Tabs -->
    <div class="bg-white rounded-xl shadow-lg mb-8">
      <div class="border-b border-gray-200">
        <nav class="flex space-x-8 px-6" id="tab-nav">
          <button class="tab-button active py-4 px-2 border-b-2 border-blue-500 font-medium text-blue-600" data-tab="team">
            <i data-lucide="users" class="w-4 h-4 inline mr-2"></i>
            Team Members
          </button>
          <button class="tab-button py-4 px-2 border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700" data-tab="mission">
            <i data-lucide="target" class="w-4 h-4 inline mr-2"></i>
            Mission & Vision
          </button>
          <button class="tab-button py-4 px-2 border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700" data-tab="features">
            <i data-lucide="settings" class="w-4 h-4 inline mr-2"></i>
            Features
          </button>
          <button class="tab-button py-4 px-2 border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700" data-tab="raw">
            <i data-lucide="code" class="w-4 h-4 inline mr-2"></i>
            Raw JSON
          </button>
        </nav>
      </div>

      <!-- Team Members Tab -->
      <div id="team-tab" class="tab-content active p-6">
        <div class="mb-6">
          <h2 class="text-xl font-semibold mb-4">Team Categories</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="categories-grid">
            <!-- Categories will be populated here -->
          </div>
        </div>
      </div>

      <!-- Mission & Vision Tab -->
      <div id="mission-tab" class="tab-content p-6">
        <div class="space-y-6">
          <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-3 flex items-center">
              <i data-lucide="target" class="w-5 h-5 mr-2"></i>
              Mission Statement
            </h3>
            <textarea id="mission-text" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Enter mission statement..."></textarea>
          </div>
          <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-3 flex items-center">
              <i data-lucide="star" class="w-5 h-5 mr-2"></i>
              Vision Statement
            </h3>
            <textarea id="vision-text" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Enter vision statement..."></textarea>
          </div>
          <div class="bg-gradient-to-r from-green-50 to-teal-50 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-3 flex items-center">
              <i data-lucide="gem" class="w-5 h-5 mr-2"></i>
              Core Values
            </h3>
            <div id="values-list" class="space-y-3">
              <!-- Values will be populated here -->
            </div>
            <button onclick="addValue()" class="mt-3 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
              <i data-lucide="plus" class="w-4 h-4 inline mr-1"></i>
              Add Value
            </button>
          </div>
        </div>
      </div>

      <!-- Features Tab -->
      <div id="features-tab" class="tab-content p-6">
        <div class="mb-4">
          <h3 class="text-lg font-semibold mb-3">Platform Features</h3>
          <div class="grid gap-4 mb-4">
            <input id="features-title" type="text" placeholder="Features section title" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <textarea id="features-subtitle" placeholder="Features section subtitle" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" rows="2"></textarea>
          </div>
        </div>
        <div id="features-list" class="space-y-4">
          <!-- Features will be populated here -->
        </div>
        <button onclick="addFeature()" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
          <i data-lucide="plus" class="w-4 h-4 inline mr-1"></i>
          Add Feature
        </button>
      </div>

      <!-- Raw JSON Tab -->
      <div id="raw-tab" class="tab-content p-6">
        <div class="mb-4 flex space-x-3">
          <button onclick="formatJson()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
            <i data-lucide="align-left" class="w-4 h-4 inline mr-1"></i>
            Format
          </button>
          <button onclick="validateJson()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
            <i data-lucide="check-circle" class="w-4 h-4 inline mr-1"></i>
            Validate
          </button>
          <button onclick="loadFromJson()" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
            <i data-lucide="refresh-cw" class="w-4 h-4 inline mr-1"></i>
            Load from JSON
          </button>
        </div>
        <textarea id="raw-json" class="w-full h-96 p-4 border border-gray-300 rounded-lg font-mono text-sm focus:ring-2 focus:ring-blue-500" placeholder="Raw JSON data will appear here..."></textarea>
      </div>
    </div>

    <!-- Save Button -->
    <div class="text-center">
      <button onclick="saveAllData()" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition-colors text-lg font-semibold shadow-lg">
        <i data-lucide="save" class="w-5 h-5 inline mr-2"></i>
        Save All Changes
      </button>
    </div>
  </div>

  <!-- Modals -->
  <div id="member-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 w-full max-w-md max-h-[90vh] overflow-y-auto">
      <div class="flex justify-between items-center mb-4">
        <h3 id="modal-title" class="text-lg font-semibold">Add Team Member</h3>
        <button onclick="closeMemberModal()" class="text-gray-400 hover:text-gray-600">
          <i data-lucide="x" class="w-6 h-6"></i>
        </button>
      </div>
      <form id="member-form" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
          <input id="member-name" type="text" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
          <input id="member-position" type="text" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Avatar (Single Letter)</label>
          <input id="member-avatar" type="text" maxlength="1" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
          <textarea id="member-bio" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" rows="3" required></textarea>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input id="member-email" type="email" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
          <input id="member-linkedin" type="url" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="https://linkedin.com/in/username">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Twitter URL</label>
          <input id="member-twitter" type="url" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="https://twitter.com/username">
        </div>
        <div class="flex space-x-3 pt-4">
          <button type="submit" class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
            Save Member
          </button>
          <button type="button" onclick="closeMemberModal()" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- File Input for Import -->
  <input type="file" id="import-file" accept=".json" style="display: none;" onchange="handleFileImport(event)">

  <script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Sample data structure
    let teamData = {};

    async function loadTeamData() {
      try {
        const response = await fetch("./../../config/team_data.json");
        teamData = await response.json();
        console.log("Team data loaded:", teamData);

        // Initialize interface *after* data is ready
        renderCategories();
        loadMissionVision();
        loadFeatures();
        updateRawJson();
      } catch (error) {
        console.error("Error loading JSON:", error);

        // fallback: initialize sample data if fetch fails
        initializeSampleData();
        renderCategories();
        loadMissionVision();
        loadFeatures();
        updateRawJson();
      }
    }

    // Call loader on DOM ready
    document.addEventListener("DOMContentLoaded", () => {
      loadTeamData();
    });

    let currentCategory = null;
    let editingMemberIndex = null;

    // Tab switching
    document.querySelectorAll('.tab-button').forEach(button => {
      button.addEventListener('click', function() {
        const tabId = this.getAttribute('data-tab');
        switchTab(tabId);
      });
    });

    function switchTab(tabId) {
      // Update buttons
      document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('active', 'text-blue-600', 'border-blue-500');
        btn.classList.add('text-gray-500', 'border-transparent');
      });

      document.querySelector(`[data-tab="${tabId}"]`).classList.remove('text-gray-500', 'border-transparent');
      document.querySelector(`[data-tab="${tabId}"]`).classList.add('active', 'text-blue-600', 'border-blue-500');

      // Update content
      document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
      });

      document.getElementById(`${tabId}-tab`).classList.add('active');

      // Load data based on tab
      if (tabId === 'team') renderCategories();
      else if (tabId === 'mission') loadMissionVision();
      else if (tabId === 'features') loadFeatures();
      else if (tabId === 'raw') updateRawJson();
    }

    function renderCategories() {
      const grid = document.getElementById('categories-grid');
      grid.innerHTML = '';

      Object.entries(teamData.team_categories).forEach(([key, category]) => {
        const categoryCard = document.createElement('div');
        categoryCard.className = 'bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow';
        categoryCard.innerHTML = `
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-2">
                            <span class="text-2xl">${category.icon}</span>
                            <h3 class="font-semibold text-gray-800">${category.title}</h3>
                        </div>
                        <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                            ${category.members.length} members
                        </span>
                    </div>
                    
                    <div class="space-y-2 mb-4 max-h-32 overflow-y-auto">
                        ${category.members.map((member, index) => `
                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-gradient-to-r ${category.color} rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                        ${member.avatar}
                                    </div>
                                    <div>
                                        <div class="font-medium text-sm">${member.name}</div>
                                        <div class="text-xs text-gray-500">${member.position}</div>
                                    </div>
                                </div>
                                <div class="flex space-x-1">
                                    <button onclick="editMember('${key}', ${index})" class="text-blue-600 hover:text-blue-800">
                                        <i data-lucide="edit-2" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="deleteMember('${key}', ${index})" class="text-red-600 hover:text-red-800">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                    
                    <button onclick="addMember('${key}')" class="w-full bg-gradient-to-r ${category.color} text-white py-2 px-3 rounded-lg hover:opacity-90 transition-opacity text-sm font-medium">
                        <i data-lucide="plus" class="w-4 h-4 inline mr-1"></i>
                        Add Member
                    </button>
                `;
        grid.appendChild(categoryCard);
      });

      lucide.createIcons();
    }

    function addMember(categoryKey) {
      currentCategory = categoryKey;
      editingMemberIndex = null;
      document.getElementById('modal-title').textContent = `Add Member to ${teamData.team_categories[categoryKey].title}`;
      clearMemberForm();
      document.getElementById('member-modal').classList.remove('hidden');
    }

    function editMember(categoryKey, memberIndex) {
      currentCategory = categoryKey;
      editingMemberIndex = memberIndex;
      const member = teamData.team_categories[categoryKey].members[memberIndex];

      document.getElementById('modal-title').textContent = `Edit ${member.name}`;
      document.getElementById('member-name').value = member.name;
      document.getElementById('member-position').value = member.position;
      document.getElementById('member-avatar').value = member.avatar;
      document.getElementById('member-bio').value = member.bio;
      document.getElementById('member-email').value = member.social.email;
      document.getElementById('member-linkedin').value = member.social.linkedin || '';
      document.getElementById('member-twitter').value = member.social.twitter || '';

      document.getElementById('member-modal').classList.remove('hidden');
    }

    function deleteMember(categoryKey, memberIndex) {
      if (confirm('Are you sure you want to delete this member?')) {
        teamData.team_categories[categoryKey].members.splice(memberIndex, 1);
        renderCategories();
        showMessage('Member deleted successfully!', 'success');
      }
    }

    function clearMemberForm() {
      document.getElementById('member-form').reset();
    }

    function closeMemberModal() {
      document.getElementById('member-modal').classList.add('hidden');
    }

    // Member form submission
    document.getElementById('member-form').addEventListener('submit', function(e) {
      e.preventDefault();

      const memberData = {
        name: document.getElementById('member-name').value,
        position: document.getElementById('member-position').value,
        avatar: document.getElementById('member-avatar').value,
        bio: document.getElementById('member-bio').value,
        social: {
          email: document.getElementById('member-email').value,
          linkedin: document.getElementById('member-linkedin').value || '#',
          twitter: document.getElementById('member-twitter').value || '#'
        }
      };

      if (editingMemberIndex !== null) {
        teamData.team_categories[currentCategory].members[editingMemberIndex] = memberData;
        showMessage('Member updated successfully!', 'success');
      } else {
        teamData.team_categories[currentCategory].members.push(memberData);
        showMessage('Member added successfully!', 'success');
      }

      closeMemberModal();
      renderCategories();
    });

    function loadMissionVision() {
      document.getElementById('mission-text').value = teamData.mission_vision.mission.description;
      document.getElementById('vision-text').value = teamData.mission_vision.vision.description;
      renderValues();
    }

    function renderValues() {
      const valuesList = document.getElementById('values-list');
      valuesList.innerHTML = '';

      teamData.mission_vision.values.items.forEach((value, index) => {
        const valueDiv = document.createElement('div');
        valueDiv.className = 'bg-white p-4 border border-gray-200 rounded-lg';
        valueDiv.innerHTML = `
                    <div class="flex justify-between items-start mb-2">
                        <input type="text" value="${value.title}" class="font-medium text-gray-800 bg-transparent border-none p-0 flex-1" 
                               onchange="updateValue(${index}, 'title', this.value)">
                        <button onclick="deleteValue(${index})" class="text-red-600 hover:text-red-800 ml-2">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <textarea class="w-full text-sm text-gray-600 bg-transparent border-none p-0 resize-none" rows="2"
                              onchange="updateValue(${index}, 'description', this.value)">${value.description}</textarea>
                    <div class="mt-2">
                        <input type="text" value="${value.icon}" maxlength="2" class="w-8 text-center bg-gray-100 rounded" 
                               onchange="updateValue(${index}, 'icon', this.value)" placeholder="🎯">
                    </div>
                `;
        valuesList.appendChild(valueDiv);
      });

      lucide.createIcons();
    }

    function addValue() {
      teamData.mission_vision.values.items.push({
        title: 'New Value',
        description: 'Description of the new value',
        icon: '🌟'
      });
      renderValues();
    }

    function updateValue(index, field, value) {
      teamData.mission_vision.values.items[index][field] = value;
    }

    function deleteValue(index) {
      if (confirm('Are you sure you want to delete this value?')) {
        teamData.mission_vision.values.items.splice(index, 1);
        renderValues();
      }
    }

    function loadFeatures() {
      document.getElementById('features-title').value = teamData.features.title;
      document.getElementById('features-subtitle').value = teamData.features.subtitle;
      renderFeatures();
    }

    function renderFeatures() {
      const featuresList = document.getElementById('features-list');
      featuresList.innerHTML = '';

      teamData.features.items.forEach((feature, index) => {
        const featureDiv = document.createElement('div');
        featureDiv.className = 'bg-white p-4 border border-gray-200 rounded-lg';
        featureDiv.innerHTML = `
                    <div class="grid gap-3">
                        <div class="flex justify-between items-center">
                            <input type="text" value="${feature.title}" class="font-medium text-gray-800 bg-transparent border-b border-gray-300 p-2 flex-1" 
                                   onchange="updateFeature(${index}, 'title', this.value)" placeholder="Feature Title">
                            <button onclick="deleteFeature(${index})" class="text-red-600 hover:text-red-800 ml-2">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <textarea class="w-full text-sm text-gray-600 border border-gray-300 rounded p-2 resize-none" rows="2"
                                  onchange="updateFeature(${index}, 'description', this.value)" placeholder="Feature description">${feature.description}</textarea>
                        <div class="flex space-x-3">
                            <input type="text" value="${feature.icon}" maxlength="2" class="w-12 text-center bg-gray-100 rounded p-2" 
                                   onchange="updateFeature(${index}, 'icon', this.value)" placeholder="🎯">
                            <input type="text" value="${feature.color}" class="flex-1 bg-gray-100 rounded p-2 text-sm font-mono" 
                                   onchange="updateFeature(${index}, 'color', this.value)" placeholder="from-blue-400 to-blue-600">
                        </div>
                    </div>
                `;
        featuresList.appendChild(featureDiv);
      });

      lucide.createIcons();
    }

    function addFeature() {
      teamData.features.items.push({
        title: 'New Feature',
        description: 'Description of the new feature',
        icon: '⭐',
        color: 'from-gray-400 to-gray-600'
      });
      renderFeatures();
    }

    function updateFeature(index, field, value) {
      teamData.features.items[index][field] = value;
    }

    function deleteFeature(index) {
      if (confirm('Are you sure you want to delete this feature?')) {
        teamData.features.items.splice(index, 1);
        renderFeatures();
      }
    }

    // Update mission/vision from text areas
    document.getElementById('mission-text').addEventListener('change', function() {
      teamData.mission_vision.mission.description = this.value;
    });

    document.getElementById('vision-text').addEventListener('change', function() {
      teamData.mission_vision.vision.description = this.value;
    });

    document.getElementById('features-title').addEventListener('change', function() {
      teamData.features.title = this.value;
    });

    document.getElementById('features-subtitle').addEventListener('change', function() {
      teamData.features.subtitle = this.value;
    });

    // Raw JSON functions
    function updateRawJson() {
      document.getElementById('raw-json').value = JSON.stringify(teamData, null, 2);
    }

    function formatJson() {
      try {
        const data = JSON.parse(document.getElementById('raw-json').value);
        document.getElementById('raw-json').value = JSON.stringify(data, null, 2);
        showMessage('JSON formatted successfully!', 'success');
      } catch (e) {
        showMessage('Invalid JSON: ' + e.message, 'error');
      }
    }

    function validateJson() {
      try {
        JSON.parse(document.getElementById('raw-json').value);
        showMessage('JSON is valid!', 'success');
      } catch (e) {
        showMessage('Invalid JSON: ' + e.message, 'error');
      }
    }

    function loadFromJson() {
      try {
        teamData = JSON.parse(document.getElementById('raw-json').value);
        renderCategories();
        loadMissionVision();
        loadFeatures();
        showMessage('Data loaded from JSON successfully!', 'success');
      } catch (e) {
        showMessage('Invalid JSON: ' + e.message, 'error');
      }
    }

    // Import/Export functions
    function exportData() {
      const dataStr = JSON.stringify(teamData, null, 2);
      const dataBlob = new Blob([dataStr], {
        type: 'application/json'
      });
      const url = URL.createObjectURL(dataBlob);
      const link = document.createElement('a');
      link.href = url;
      link.download = 'team_data.json';
      link.click();
      URL.revokeObjectURL(url);
      showMessage('Data exported successfully!', 'success');
    }

    function importData() {
      document.getElementById('import-file').click();
    }

    function handleFileImport(event) {
      const file = event.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = function(e) {
        try {
          teamData = JSON.parse(e.target.result);
          renderCategories();
          loadMissionVision();
          loadFeatures();
          updateRawJson();
          showMessage('Data imported successfully!', 'success');
        } catch (error) {
          showMessage('Error importing file: ' + error.message, 'error');
        }
      };
      reader.readAsText(file);
    }

    function saveAllData() {
      // This would typically send data to server
      // For demo purposes, we'll just show a success message
      updateRawJson();
      showMessage('All changes saved successfully! (In a real implementation, this would save to your server)', 'success');
      console.log('Data to save:', teamData);
    }

    function showMessage(message, type) {
      const messageArea = document.getElementById('message-area');
      const messageClass = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';

      messageArea.innerHTML = `
                <div class="${messageClass} px-4 py-3 rounded mb-6 border">
                    ${message}
                </div>
            `;

      // Auto-hide after 5 seconds
      setTimeout(() => {
        messageArea.innerHTML = '';
      }, 5000);
    }

    // Quick snippets for common actions
    function addPresetMembers() {
      const presets = {
        president: {
          name: "John Doe",
          position: "President",
          avatar: "J",
          bio: "Visionary leader passionate about transforming education through technology. Leads the strategic direction and innovation initiatives.",
          social: {
            linkedin: "#",
            twitter: "#",
            email: "john@verse26.com"
          }
        },
        vicePresident: {
          name: "Jane Smith",
          position: "Vice President",
          avatar: "J",
          bio: "Strategic leader with expertise in educational technology and community building. Oversees platform development and user experience.",
          social: {
            linkedin: "#",
            twitter: "#",
            email: "jane@verse26.com"
          }
        },
        boardMember: {
          name: "Alex Johnson",
          position: "Board Member",
          avatar: "A",
          bio: "Creative strategist focused on user experience and platform innovation. Drives design excellence and user engagement.",
          social: {
            linkedin: "#",
            twitter: "#",
            email: "alex@verse26.com"
          }
        },
        departmentHead: {
          name: "Sarah Wilson",
          position: "Head of Technology",
          avatar: "S",
          bio: "Technical leader overseeing platform architecture, security, and performance optimization for seamless user experience.",
          social: {
            linkedin: "#",
            twitter: "#",
            email: "sarah@verse26.com"
          }
        },
        instructor: {
          name: "Mike Brown",
          position: "Senior Instructor",
          avatar: "M",
          bio: "Experienced educator specializing in interactive learning methodologies and student engagement strategies.",
          social: {
            linkedin: "#",
            twitter: "#",
            email: "mike@verse26.com"
          }
        }
      };

      return presets;
    }

    // Initialize with sample data
    function initializeSampleData() {
      const sampleData = {
        "team_categories": {
          "presidents": {
            "title": "Presidents",
            "icon": "👑",
            "color": "from-purple-400 to-purple-600",
            "members": [{
              "name": "Ahmed Hassan",
              "position": "President",
              "avatar": "A",
              "bio": "Visionary leader passionate about transforming education through technology. Leads the strategic direction and innovation initiatives.",
              "social": {
                "linkedin": "#",
                "twitter": "#",
                "email": "ahmed@verse26.com"
              }
            }]
          },
          "high_board": {
            "title": "High Board",
            "icon": "🏛️",
            "color": "from-blue-400 to-blue-600",
            "members": [{
              "name": "Sarah Mohamed",
              "position": "Vice President",
              "avatar": "S",
              "bio": "Strategic leader with expertise in educational technology and community building. Oversees platform development and user experience.",
              "social": {
                "linkedin": "#",
                "twitter": "#",
                "email": "sarah@verse26.com"
              }
            }]
          },
          "board": {
            "title": "Board Members",
            "icon": "👥",
            "color": "from-green-400 to-green-600",
            "members": []
          },
          "heads": {
            "title": "Department Heads",
            "icon": "🎯",
            "color": "from-orange-400 to-orange-600",
            "members": []
          },
          "vice_heads": {
            "title": "Vice Heads",
            "icon": "🔧",
            "color": "from-teal-400 to-teal-600",
            "members": []
          },
          "instructors": {
            "title": "Instructors",
            "icon": "📚",
            "color": "from-indigo-400 to-indigo-600",
            "members": []
          }
        },
        "mission_vision": {
          "mission": {
            "title": "Our Mission",
            "icon": "🎯",
            "description": "To democratize education by creating an engaging, accessible, and interactive learning platform that empowers learners of all ages to discover, explore, and master knowledge through gamified experiences.",
            "color": "from-blue-500 to-purple-600"
          },
          "vision": {
            "title": "Our Vision",
            "icon": "🌟",
            "description": "To become the world's leading educational platform where learning is not just effective but truly enjoyable, fostering a global community of curious minds and lifelong learners.",
            "color": "from-purple-500 to-pink-600"
          },
          "values": {
            "title": "Our Core Values",
            "icon": "💎",
            "items": [{
                "title": "Excellence in Education",
                "description": "Delivering the highest quality educational content and experiences",
                "icon": "🏆"
              },
              {
                "title": "Innovation & Creativity",
                "description": "Continuously evolving our platform with cutting-edge technology",
                "icon": "💡"
              }
            ],
            "color": "from-green-500 to-teal-600"
          }
        },
        "features": {
          "title": "Platform Features",
          "subtitle": "Discover the powerful features that make Verse'26 Quiz the ultimate learning experience",
          "items": [{
              "title": "Smart Categories",
              "description": "Choose from 8 diverse categories including Science, History, Literature, and more. Each category is carefully curated to provide comprehensive learning.",
              "icon": "🎯",
              "color": "from-blue-400 to-blue-600"
            },
            {
              "title": "Live Leaderboard",
              "description": "Compete with fellow learners in real-time. Track your progress, climb the rankings, and celebrate your achievements with the community.",
              "icon": "🏆",
              "color": "from-yellow-400 to-orange-600"
            }
          ]
        }
      };

      teamData = sampleData;
    }

    // Load sample data if no existing data
    if (!teamData.team_categories.presidents.members.length) {
      initializeSampleData();
    }

    // Initialize the interface
    document.addEventListener('DOMContentLoaded', function() {
      renderCategories();
      loadMissionVision();
      loadFeatures();
      updateRawJson();
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
      // Ctrl+S to save
      if (e.ctrlKey && e.key === 's') {
        e.preventDefault();
        saveAllData();
      }

      // Ctrl+E to export
      if (e.ctrlKey && e.key === 'e') {
        e.preventDefault();
        exportData();
      }

      // Escape to close modal
      if (e.key === 'Escape') {
        closeMemberModal();
      }
    });

    // Add helpful tooltips and guides
    function showQuickTips() {
      const tips = [
        "💡 Use Ctrl+S to quickly save your changes",
        "📤 Use Ctrl+E to export your data",
        "🎨 Gradient colors should follow the format: 'from-color-400 to-color-600'",
        "👤 Avatar should be a single letter representing the person's name",
        "📝 Keep member bios between 100-200 characters for best display",
        "🔗 Social links can be '#' as placeholders if not available"
      ];

      alert(tips.join('\n\n'));
    }

    // Add quick tips button to header
    window.addEventListener('load', function() {
      const header = document.querySelector('.container.mx-auto.px-6.py-4 .flex.space-x-3');
      if (header) {
        const tipsButton = document.createElement('button');
        tipsButton.onclick = showQuickTips;
        tipsButton.className = 'bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors flex items-center space-x-2';
        tipsButton.innerHTML = '<i data-lucide="help-circle" class="w-4 h-4"></i><span>Tips</span>';
        header.appendChild(tipsButton);
        lucide.createIcons();
      }
    });
  </script>
</body>

</html>