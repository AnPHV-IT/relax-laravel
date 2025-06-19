# RelaxViet E-commerce Platform

RelaxViet is a Laravel-based e-commerce web application for outdoor and camping products, developed for CÔNG TY TNHH THƯ GIÃN VIỆT. The platform supports product browsing, cart management, order processing, blog/news, showroom locations, and a full-featured admin dashboard.

## Table of Contents
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Setup](#setup)
- [Usage](#usage)
- [Database Schema](#database-schema)
- [License](#license)

## Features
### User
- Browse products by category
- Product detail pages with images, descriptions, and color options
- Add to cart, update, and remove items
- Place orders and view order history
- User authentication (sign up, sign in)
- Contact form for customer inquiries
- Blog/news section
- Showroom locator with map

### Admin
- Dashboard with revenue statistics
- Product management (CRUD, color/image management)
- Category management
- Order management (confirm/cancel orders)
- User management
- Contact management
- Discount code management
- System settings

## Tech Stack
- **Backend:** Laravel 11 (PHP ^8.2)
- **Frontend:** Blade templates, Bootstrap 5, Vite, Axios
- **Database:** MySQL (or compatible, see `.env`)
- **Other:** Cloudinary (image storage), JWT (authentication), UUID, PHPUnit (testing)

## Setup
1. **Clone the repository:**
   ```bash
   git clone <repo-url>
   cd Web-RelaxViet-Laravel-PHP
   ```
2. **Install PHP dependencies:**
   ```bash
   composer install
   ```
3. **Install JS dependencies:**
   ```bash
   npm install
   ```
4. **Copy and configure environment:**
   ```bash
   cp .env.example .env
   # Edit .env for DB, mail, Cloudinary, etc.
   ```
5. **Generate app key:**
   ```bash
   php artisan key:generate
   ```
6. **Run migrations:**
   ```bash
   php artisan migrate
   ```
7. **Build frontend assets:**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```
8. **Start the server:**
   ```bash
   php artisan serve
   ```

## Usage
- Visit `http://localhost:8000` for the user site.
- Admin dashboard: `http://localhost:8000/admin` (requires admin login).
- Main routes:
  - `/products` — Product listing
  - `/products/{id}` — Product details
  - `/cart` — Shopping cart
  - `/orders` — User orders
  - `/contact` — Contact form
  - `/blog` — Blog/news
  - `/showroom` — Showroom locator

## Database Schema (Main Tables)
- **users**: id, name, email, role (user/admin), password, address, timestamps
- **products**: id, name, description, price, category, image, quantity, public_id, timestamps
- **categories**: id, name, timestamps
- **colors**: id, productId, name, imageUrl, public_id, timestamps
- **orders**: id, productId, colorId, userId, categoryId, amount, status, timestamps
- **carts**: id, productId, colorId, categoryId, userId, amount, timestamps
- **discounts**: id, timestamps
- **posts**: id, title, content, timestamps
- **stores**: id, name, location
- **contacts**: id, name, company, address, phone, email, message, timestamps

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🙋‍♂️ Support

This project is developed and maintained by a single developer.  
For support or inquiries, please contact me at: **phanhuynhvanan@gmail.com**
