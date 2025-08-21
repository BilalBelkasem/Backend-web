# 🎮 FF14 Community Website

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC.svg)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

## 📖 About

This is a Laravel-based community website for Final Fantasy XIV players. The project provides a comprehensive portal with user management, news system, FAQ management, and contact functionality. Built using Laravel 11 with modern web technologies.

## 🚀 Features

### 🔐 User Authentication
- **Login/Register System** - Secure user authentication
- **Password Reset** - Email-based password recovery
- **Remember Me** - Persistent login sessions
- **Admin/User Roles** - Role-based access control

### 👤 User Management
- **Public Profile Pages** - Accessible to all visitors
- **Profile Editing** - Users can update their information
- **Admin User Management** - Promote/demote users, create new accounts
- **Profile Fields** - Username, birthday, profile photo, about me

### 📰 News System
- **News Article Management** - Create, edit, delete news items
- **Image Upload Support** - Store images on server
- **Publication Control** - Draft/publish functionality
- **Public Access** - All visitors can view news
- **Comments** - Authenticated users can comment on news; owners/admins can remove

### ❓ FAQ System
- **Categorized Q&A** - Organized by topics
- **Admin Management** - Add/edit/delete categories and items
- **Public Access** - All visitors can browse FAQ

### 📧 Contact System
- **Contact Form** - Public contact form
- **Admin Notifications** - Email alerts for new messages
- **Message Storage** - Database storage of contact messages
- **Admin Panel & Replies** - Admins can view messages and send email replies

### 💬 Social Features
- **Profile Wall Posts** - Users can post on someone else’s public profile
- **Private Messages (DMs)** - Users can send private messages with an inbox

## 🛠️ Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/ff14-website.git
cd ff14-website
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install NPM Dependencies
```bash
npm install
```

### 4. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Database Configuration
Configure your database in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ff14_website
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Run Migrations and Seed Database
```bash
php artisan migrate:fresh --seed
```

If you are upgrading an existing database, run:
```bash
php artisan migrate
```

### 7. Link Storage
```bash
php artisan storage:link
```

### 8. Start Development Servers
```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start Vite for assets
npm run dev
```

## 🎯 Default Admin Account

After running the seeder, you'll have access to an admin account:
- **Email:** `admin@ff14-website.com`
- **Password:** `admin123`

**⚠️ Important:** Change the default password after first login!

To receive contact form reply emails, ensure your mail credentials are set in `.env` (see Environment Variables below). Admin notification emails default to `admin@ff14-website.com`.

## 🏗️ Project Structure

```
ff14-website/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/UserController.php    # Admin user management
│   │   ├── Admin/ContactMessageController.php # Admin contact inbox & replies
│   │   ├── NewsController.php          # News CRUD operations
│   │   ├── FaqController.php          # FAQ management
│   │   ├── ContactController.php      # Contact form handling
│   │   ├── ProfileController.php      # User profile management
│   │   ├── CommentController.php      # News comments
│   │   ├── ProfilePostController.php  # Profile wall posts
│   │   └── PrivateMessageController.php # Private messages
│   ├── Models/
│   │   ├── User.php                   # User model with admin support
│   │   ├── News.php                   # News articles
│   │   ├── FaqCategory.php           # FAQ categories
│   │   ├── FaqItem.php               # FAQ questions/answers
│   │   ├── ContactMessage.php        # Contact form messages
│   │   ├── Comment.php               # News comments
│   │   ├── ProfilePost.php           # Profile wall posts
│   │   └── PrivateMessage.php        # Private messages
│   ├── Http/Middleware/
│   │   └── AdminMiddleware.php        # Admin access control
│   └── Mail/
│       ├── ContactFormMail.php       # Contact form emails
│       └── ContactFormReplyMail.php  # Admin reply emails
├── resources/views/
│   ├── admin/users/                   # Admin user management views
│   ├── admin/contact/                 # Admin contact inbox views
│   ├── news/                          # News views
│   ├── faq/                           # FAQ views
│   ├── contact/                       # Contact form views
│   ├── profile/                       # Profile views
│   ├── messages/                      # Inbox view
│   └── emails/                        # Mail templates
└── routes/
    └── web.php                        # All application routes
```

## 🧭 Feature Usage Guide

- **News Comments**: Open a news item (`/news/{id}`) while logged in to post or delete your own comments. Admins can delete any comment.
- **Admin Contact Inbox**: Go to `Admin → 📬 Contactberichten` or `/admin/contact` to list, view, and reply to contact messages. Replies are emailed to the sender and stored with the message.
- **Profile Wall Posts**: Visit a user’s public profile (`/profile/{username}`) and post on their wall. Post owners, profile owners, and admins can remove posts.
- **Private Messages**: Send a DM from a user’s public profile; view received messages in your Inbox (`/messages`). Mark messages as read from the inbox.

## 🎨 Technologies Used

- **[Laravel 11](https://laravel.com)** - PHP web framework
- **[Tailwind CSS](https://tailwindcss.com)** - Utility-first CSS framework
- **[Alpine.js](https://alpinejs.dev)** - Lightweight JavaScript framework
- **[MySQL/SQLite](https://www.mysql.com/)** - Database systems
- **[Laravel Breeze](https://laravel.com/docs/breeze)** - Authentication scaffolding

## 🔒 Security Features

- **CSRF Protection** - Cross-site request forgery prevention
- **Admin Middleware** - Role-based access control
- **File Upload Validation** - Secure image uploads
- **Input Validation** - Comprehensive form validation
- **SQL Injection Protection** - Eloquent ORM security

## 📱 Responsive Design

The website is fully responsive and works on:
- Desktop computers
- Tablets
- Mobile phones
- All modern browsers

## 🚀 Deployment

### Production Requirements
- PHP 8.1 or higher
- MySQL 5.7+ or PostgreSQL
- Composer
- Node.js & NPM

### Environment Variables
Make sure to set these in production:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

**Made with ❤️ for the FF14 Community**
    
