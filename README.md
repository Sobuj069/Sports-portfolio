# Sports Portfolio - Nick Ho Motorsports Clone & Dynamic Admin Panel

A high-performance clone of [Nick Ho Motorsports](https://nickho-motorsports.nl/) built with **Laravel 11/12/13, Three.js WebGL 3D, GSAP animations, Lenis smooth scroll, and an Admin Management Panel**.

---

## 🏎️ Features

- **100% Authentic Visuals & Experience**: WebGL 3D shader car curve, smooth radial circular track gallery, high-speed physics and animations.
- **Dynamic Admin Panel**: Manage every section dynamically without writing code:
  - **Hero & Profile**: Name, subtitle, driver statistics (podiums, circuits raced, odometer stats, countdown date/time).
  - **Race Calendar**: Add, edit, remove race weekends, format dates, championship tags.
  - **Sponsors Wall**: Upload PNG/SVG logos, website redirect links, display sorting.
  - **Press & Media**: Media articles, publication date, thumbnails, external news links.
  - **Radial Gallery**: Upload race track photography and manage circular gallery items.
  - **About & Philosophy**: Edit lead quote text and custom yellow highlighted phrases.
  - **Contact Inquiries**: Review incoming contact inquiries sent from visitors.
  - **Site Settings & SEO**: Manage phone, email, Instagram, LinkedIn, and meta tags.

---

## 🛠️ Setup Instructions

### 1. Requirements
- PHP 8.2 or 8.3+
- Composer
- Node.js & NPM
- SQLite or MySQL

### 2. Installation
```bash
# Clone the repository
git clone https://github.com/Sobuj069/Sports-portfolio.git
cd Sports-portfolio

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Run migrations and seed data
touch database/database.sqlite
php artisan migrate --seed

# Start the application
php artisan serve
```

---

## 🔑 Default Admin Credentials

- **Admin URL:** `/admin` (or `/admin/login`)
- **Email:** `admin@nickho-motorsports.nl`
- **Password:** `password`

---

## 📄 License
Open-source under the [MIT license](LICENSE).
