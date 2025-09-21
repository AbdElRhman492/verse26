# Team Management System

## Overview

The Verse'26 Quiz platform now features a modern, JSON-based team management system that allows easy editing of team members, mission/vision content, and platform features.

## Features

### 🎯 Modern UI Design

- **Glassmorphism Effects**: Beautiful backdrop blur and transparency effects
- **Enhanced Animations**: Smooth hover effects and transitions
- **Responsive Design**: Works perfectly on all device sizes
- **Dark Mode Support**: Automatic dark/light theme switching

### 👥 Team Categories

The system organizes team members into hierarchical categories:

1. **Presidents** 👑

   - Top leadership position
   - Purple gradient theme
   - Typically 1 member

2. **High Board** 🏛️

   - Senior executives and strategic leaders
   - Blue gradient theme
   - 2-3 members

3. **Board Members** 👥

   - Strategic advisors and decision makers
   - Green gradient theme
   - 2-4 members

4. **Department Heads** 🎯

   - Leaders of specific departments
   - Orange gradient theme
   - 3-5 members

5. **Vice Heads** 🔧

   - Assistant department heads
   - Teal gradient theme
   - 2-3 members

6. **Instructors** 📚
   - Teaching and content staff
   - Indigo gradient theme
   - 3-6 members

## File Structure

```
config/
├── team_data.json          # Main data file (JSON format)
└── team_renderer.php       # PHP functions to render data

public/
├── index.php              # Main homepage (updated)
├── admin/
│   └── team-editor.php    # Admin interface for editing
└── output.css             # Enhanced styles
```

## How to Edit Team Data

### Method 1: Admin Interface (Recommended)

1. Navigate to `/public/admin/team-editor.php`
2. Login with password: `admin123`
3. Edit the JSON data in the code editor
4. Click "Save Changes"

### Method 2: Direct File Editing

1. Open `/config/team_data.json`
2. Edit the JSON structure directly
3. Ensure valid JSON syntax

## JSON Structure

### Team Members

```json
{
  "name": "John Doe",
  "position": "CEO",
  "avatar": "J",
  "bio": "Brief description...",
  "social": {
    "linkedin": "https://linkedin.com/in/johndoe",
    "twitter": "https://twitter.com/johndoe",
    "email": "john@verse26.com"
  }
}
```

### Mission & Vision

```json
{
  "mission": {
    "title": "Our Mission",
    "icon": "🎯",
    "description": "Mission statement...",
    "color": "from-blue-500 to-purple-600"
  }
}
```

### Features

```json
{
  "title": "Feature Name",
  "description": "Feature description...",
  "icon": "🎯",
  "color": "from-blue-400 to-blue-600"
}
```

## Color Themes

Each category uses specific gradient colors:

- **Purple**: `from-purple-400 to-purple-600`
- **Blue**: `from-blue-400 to-blue-600`
- **Green**: `from-green-400 to-green-600`
- **Orange**: `from-orange-400 to-orange-600`
- **Teal**: `from-teal-400 to-teal-600`
- **Indigo**: `from-indigo-400 to-indigo-600`

## Adding New Team Members

1. Open the admin interface or JSON file
2. Navigate to the appropriate category
3. Add a new member object:

```json
{
  "name": "New Member",
  "position": "Position Title",
  "avatar": "N",
  "bio": "Member biography...",
  "social": {
    "linkedin": "#",
    "twitter": "#",
    "email": "member@verse26.com"
  }
}
```

## Customization

### Changing Colors

Update the `color` field in the JSON to use different Tailwind CSS gradients.

### Adding Social Links

Modify the `social` object to include additional platforms or remove unused ones.

### Modifying Layout

Edit the `team_renderer.php` file to change how the data is displayed.

## Security Notes

- Change the admin password in `team-editor.php`
- Implement proper authentication for production
- Validate JSON input to prevent errors
- Consider adding CSRF protection

## Browser Support

- Modern browsers with CSS Grid support
- Backdrop-filter support for glassmorphism effects
- JavaScript enabled for admin interface

## Troubleshooting

### JSON Errors

- Use the "Validate JSON" button in the admin interface
- Check for missing commas or brackets
- Ensure all strings are properly quoted

### Display Issues

- Clear browser cache
- Check CSS file is loading correctly
- Verify PHP includes are working

### Performance

- Optimize images for team avatars
- Consider lazy loading for large teams
- Monitor JSON file size

## Future Enhancements

- [ ] Image upload for team avatars
- [ ] Drag-and-drop team member ordering
- [ ] Bulk import/export functionality
- [ ] Advanced role permissions
- [ ] Team member profiles with detailed information
- [ ] Integration with external APIs (LinkedIn, etc.)

---

**Need Help?** Check the admin interface for validation tools and formatting options.
