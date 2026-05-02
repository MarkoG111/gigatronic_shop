# 🛒 Gigatronic Shop

> Full-stack PHP e-commerce web application built as a university project at **Visoka škola strukovnih studija za informacione i komunikacione tehnologije**.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-4.3-purple.svg?style=for-the-badge&logo=bootstrap)](https://getbootstrap.com/)
[![jQuery](https://img.shields.io/badge/jQuery-AJAX-blue.svg?style=for-the-badge&logo=jquery)](https://jquery.com/)
[![MVC](https://img.shields.io/badge/Architecture-MVC-success.svg?style=for-the-badge&logo=codeigniter)]()

🔗 **Live demo:** https://gigatronic-shop.infinityfree.me/

📘 **Documentation (PDF):** [Dokument.pdf](https://github.com/MarkoG111/gigatronic_shop/blob/master/Dokument.pdf)

🗄️ **Database:** [gigatronic_shop.sql](https://github.com/MarkoG111/gigatronic_shop/blob/master/gigatronic_shop.sql)

---

## 📚 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
  - [Public Area](#-public-area)
  - [User Area](#-user-area)
  - [Admin Area](#-admin-area)
- [Pages Overview](#-pages-overview)
- [Technologies Used](#-technologies-used)
- [Database & Logging](#-database--logging)
- [Project Structure](#-project-structure)
- [Installation](#-installation)
- [Demo Credentials](#-demo-credentials)

---

## 🚀 Overview

Gigatronic Shop is a web shop for selling electronic components. The project emphasizes modular MVC-style organization, secure database interaction via PDO with prepared statements, and both client-side and server-side validation for improved security and UX.

Key highlights:
- Dynamic product loading with AJAX and pagination
- Shopping cart persisted via `localStorage`
- Role-based access control (guest / user / admin)
- Admin dashboard with full CRUD management
- Contact form with PHPMailer email integration
- Real-time poll voting with results visualization
- Page traffic statistics tracked over the last 24 hours

---

## ⚙️ Features

### 🏠 Public Area

- Home page with Bootstrap image carousel and featured products
- Articles page dynamically loaded via AJAX
- Pagination, category filtering, price sorting, and live search
- Contact form with client-side and server-side validation

### 👤 User Area

- Registration and login with PHP session management
- Shopping cart built on `localStorage` with quantity editing
- Poll voting system - one vote per user per active poll
- Email notification sent to the user on failed login attempts

### 🛠️ Admin Area

- Dashboard with an overview of users, articles, orders, and logged-in users
- **User management** - full CRUD + export to Excel (PhpSpreadsheet)
- **Article management** - full CRUD with image upload and automatic resizing
- **Order management** - status updates, deletion, detailed order view
- **Poll management** - create polls with multiple answers, activate a poll, view results
- **Statistics** - pie chart of page visits in the last 24 hours (Chart.js)

---

## 🌐 Pages Overview

| Page | Access | Description |
|---|---|---|
| **Home** | Everyone | Image slider and featured products |
| **Articles** | Everyone | AJAX product listing with pagination, search, sort, and filter |
| **Contact** | Everyone | Contact form that sends email to admin via PHPMailer |
| **Cart** | Logged-in users | Manage cart items and place orders via `localStorage` |
| **Poll** | Logged-in users | Vote on the active poll and view live results |
| **Admin Dashboard** | Admin only | System overview - user count, article count, order count |
| **Admin Users** | Admin only | CRUD user management + Excel export |
| **Admin Articles** | Admin only | CRUD article management with image upload |
| **Admin Orders** | Admin only | View, update status, and delete orders |
| **Admin Poll** | Admin only | Create, activate, and analyze poll results |
| **Admin Statistics** | Admin only | Pie chart of page visits in the last 24 hours |

---

## 🧰 Technologies Used

| Category | Tools & Libraries |
|---|---|
| **Frontend** | HTML, CSS, Bootstrap 4, JavaScript (ES6), jQuery, AJAX |
| **Backend** | PHP 8.2, PDO, Sessions, Error logging |
| **Database** | MySQL (via phpMyAdmin) |
| **Email** | PHPMailer 6.9 |
| **Spreadsheet** | PhpSpreadsheet 1.29 |
| **Charts** | Chart.js |
| **Data Exchange** | JSON |
| **Dev Tools** | Visual Studio Code, XAMPP |
| **Version Control** | Git, GitHub |

---

## 🧾 Database & Logging

All database operations use **PDO with prepared statements** to prevent SQL injection.

The application automatically writes logs to plain text files:

| File | Purpose |
|---|---|
| `data/errors.txt` | Records PHP and PDO exceptions with timestamps |
| `data/login.txt` | Tracks currently logged-in users |
| `data/log_access.txt` | Records page visits with URL, timestamp, and IP address |

### Database Schema (key tables)

- `user` - stores user accounts with roles
- `role` - `admin` or `user`
- `article` - products with category, price, and image paths
- `category` - Equipment, Phones, Computers
- `customer_order` - order header with status (`not processed`, `in preparation`, `sent`, `delivered`)
- `order_items` - line items linking orders to articles
- `poll` / `answer` / `voting` - poll system with vote tracking
- `menu` / `menu_group` - dynamic navigation based on user role

---

## 📁 Project Structure

```
gigatronic_shop/
├── assets/
│   ├── css/            # Custom stylesheets
│   ├── img/            # Product images and UI assets
│   ├── js/             # JavaScript modules (cart, login, admin, etc.)
│   └── vendor/         # PHPMailer
├── config/
│   ├── config.php      # Constants and .env reader
│   ├── connection.php  # PDO connection, executeQuery, recordErrors
│   └── .env            # DB credentials (not committed)
├── data/               # Log files (errors, access, login)
├── models/
│   ├── articles/       # Article CRUD, search, pagination, filter
│   ├── orders/         # Order insert, update, delete, details
│   ├── polls/          # Poll insert, activate, vote, results
│   ├── users/          # User CRUD, login, register, export
│   ├── functions.php   # Shared functions (menu, categories, statistics)
│   ├── login.php       # Login handler + PHPMailer alert
│   ├── logout.php      # Session destroy + login log cleanup
│   └── register.php    # Registration handler
├── views/
│   ├── fixed/          # head.php, header.php, footer.php, modals.php
│   └── pages/          # Page views (home, articles, cart, poll, admin/*)
├── composer.json
└── index.php           # Front controller with routing and access control
```

---

## ⚡ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/MarkoG111/gigatronic_shop.git
   ```

2. **Import the database**
   Open phpMyAdmin and import `gigatronic_shop.sql` from the project root.

3. **Configure environment**
   Edit `config/.env` with your database credentials:
   ```
   DBNAME=gigatronic_shop
   SERVER=localhost
   USERNAME=root
   PASSWORD=
   ```

4. **Install dependencies**
   ```bash
   composer install
   ```

5. **Start a local server**
   Use XAMPP, WAMP, or any PHP-compatible local server. Place the project in the `htdocs` (or `www`) directory.

6. **Open in browser**
   ```
   http://localhost/gigatronic_shop/
   ```

---

## 🔐 Demo Credentials

| Role | Email | Password |
|---|---|---|
| **Admin** | admin@gmail.com | Gacanovic121 |
| **User** | sofija@gmail.com | *(see SQL dump)* |

> ⚠️ Passwords are stored as **MD5 hashes**. For production use, replace with a modern hashing algorithm such as `password_hash()` / `password_verify()`.

---

*Built with ❤️ as a university project - [Marko Gačanović](https://www.linkedin.com/in/marko-ga%C4%8Danovi%C4%87-4a133016a/)*
