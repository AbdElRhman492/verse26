# Verse'26 Quiz Platform 🎯

A modern, interactive quiz platform built with PHP, MySQL, and Tailwind CSS. Features a beautiful light/dark theme, real-time progress tracking, and comprehensive leaderboard system.

## ✨ Features

### 🎨 Modern UI/UX

- **Light/Dark Theme Toggle** - Seamless theme switching with localStorage persistence
- **Responsive Design** - Works perfectly on desktop, tablet, and mobile devices
- **Glass Morphism Effects** - Modern backdrop blur and transparency effects
- **Smooth Animations** - CSS transitions and keyframe animations throughout
- **Custom Color Palette** - Carefully crafted color scheme with semantic naming

### 🧠 Quiz System

- **User Registration** - Simple name and phone number registration
- **Category Selection** - Choose from multiple quiz categories
- **Random Question Fetching** - Questions are randomly selected from chosen categories
- **Real-time Progress Tracking** - Visual progress bar and question counter
- **Timer Functionality** - Track time spent on each quiz
- **Auto-save Progress** - Prevents data loss during quiz sessions

### 📊 Results & Analytics

- **Detailed Results Page** - Comprehensive performance analysis
- **Question Review** - See correct/incorrect answers with explanations
- **Performance Levels** - Dynamic performance categorization (Excellent, Good, Fair, etc.)
- **Filter Options** - View only correct or incorrect answers
- **Score Breakdown** - Percentage, correct answers, and improvement areas

### 🏆 Leaderboard System

- **Real-time Rankings** - Live leaderboard with top performers
- **Statistics Dashboard** - Total students, attempts, average scores
- **Performance Metrics** - Score percentages and completion times
- **Individual Profiles** - View detailed results for each attempt

### 🗄️ Enhanced Database

- **Optimized Schema** - Improved database structure with proper indexing
- **Sample Data** - Pre-loaded categories and questions
- **Data Integrity** - Foreign key constraints and data validation
- **Performance Optimized** - Efficient queries and database design

## 🚀 Quick Start

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Composer (for dependencies)

### Installation

1. **Clone the repository**

   ```bash
   git clone <repository-url>
   cd verse26
   ```

2. **Install dependencies**

   ```bash
   composer install
   npm install
   ```

3. **Database Setup**

   - Create a MySQL database
   - Import the schema: `mysql -u username -p database_name < schema.sql`
   - Update database credentials in `.env` file

4. **Environment Configuration**

   ```bash
   cp .env.example .env
   # Edit .env with your database credentials
   ```

5. **Build Assets**

   ```bash
   npm run build
   ```

6. **Start Development Server**
   ```bash
   php -S localhost:8000
   ```

## 📁 Project Structure

```
verse26/
├── api/                    # Backend API endpoints
│   ├── db.php             # Database connection
│   ├── student.php        # Student registration
│   ├── questions.php      # Question fetching
│   ├── submit.php         # Quiz submission
│   └── answer.php         # Answer handling
├── public/                 # Frontend pages
│   ├── assets/            # Static assets
│   │   ├── css/          # Stylesheets
│   │   ├── js/           # JavaScript files
│   │   └── images/       # Images and icons
│   ├── index.php         # Home/Registration page
│   ├── categories.php    # Category selection
│   ├── quiz.php          # Quiz interface
│   ├── result.php        # Results display
│   ├── leaderboard.php   # Leaderboard
│   └── layout.php        # Main layout template
├── config/                # Configuration files
├── src/                   # Source files
├── schema.sql            # Database schema
├── tailwind.config.js    # Tailwind configuration
├── composer.json         # PHP dependencies
└── package.json          # Node.js dependencies
```

## 🎨 Customization

### Colors

The color palette is defined in `tailwind.config.js`:

```javascript
colors: {
  primary: { /* Green shades */ },
  accent: { /* Yellow shades */ },
  secondary: { /* Blue shades */ },
  success: { /* Success states */ },
  error: { /* Error states */ },
  warning: { /* Warning states */ },
  info: { /* Info states */ }
}
```

### Themes

The theme system uses CSS custom properties and Tailwind's dark mode:

```css
/* Light theme */
body {
  background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #bae6fd 100%);
}

/* Dark theme */
.dark body {
  background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
}
```

### Adding Questions

Questions can be added directly to the database or through the admin interface:

```sql
INSERT INTO questions (question_text, option_a, option_b, option_c, option_d, correct_option, explanation, difficulty_level, category_id)
VALUES ('Your question?', 'Option A', 'Option B', 'Option C', 'Option D', 'A', 'Explanation', 'medium', 1);
```

## 🔧 API Endpoints

### Student Registration

- **POST** `/api/student.php`
- **Body**: `name`, `phone`
- **Response**: `{status: 'ok', student_id: int, attempt_id: int}`

### Category Selection

- **POST** `/api/questions.php`
- **Body**: `attempt_id`, `categories[]`
- **Response**: `{status: 'ok', attempt_id: int}`

### Quiz Submission

- **POST** `/api/submit.php`
- **Body**: `attempt_id`, `answers[]`
- **Response**: `{status: 'ok', attempt_id: int}`

## 🎯 Features in Detail

### Theme System

- **Automatic Detection**: Detects system preference on first visit
- **Manual Toggle**: Users can switch themes anytime
- **Persistence**: Theme choice is saved in localStorage
- **Smooth Transitions**: All theme changes are animated

### Quiz Engine

- **Random Selection**: Questions are randomly selected from chosen categories
- **Progress Tracking**: Real-time progress updates
- **Timer Integration**: Tracks time spent on quiz
- **Auto-save**: Prevents data loss during sessions

### Results Analysis

- **Performance Metrics**: Detailed scoring and analysis
- **Visual Feedback**: Color-coded performance indicators
- **Question Review**: Detailed explanation for each question
- **Improvement Suggestions**: Areas for improvement highlighted

## 🛠️ Development

### Adding New Features

1. Create new API endpoint in `api/` directory
2. Add corresponding frontend page in `public/` directory
3. Update navigation in `layout.php`
4. Add database changes to `schema.sql`

### Styling Guidelines

- Use Tailwind CSS utility classes
- Follow the established color palette
- Maintain consistent spacing and typography
- Ensure responsive design principles
- Test both light and dark themes

### Database Best Practices

- Use prepared statements for all queries
- Implement proper error handling
- Add appropriate indexes for performance
- Use foreign key constraints for data integrity

## 📱 Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🙏 Acknowledgments

- Tailwind CSS for the utility-first CSS framework
- PHP for the backend logic
- MySQL for data persistence
- Modern web standards for accessibility and performance

---

**Made with ❤️ for learning and education**
