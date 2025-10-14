# 🛒 Gigatronic Shop

**Gigatronic Shop** is a full-stack PHP e-commerce web application built as part of a university project at Visoka škola strukovnih studija za informacione i komunikacione tehnologije.
The project demonstrates core e-commerce functionality with dynamic content loading, user authentication, and an advanced admin dashboard.

🔗 Live demo: https://gacho-dev.rs/gigatronic-shop

📄 Documentation and Database: <br/>
📘 Full Project Documentation (PDF) - https://github.com/MarkoG111/gigatronic_shop/blob/master/Dokument.pdf <br/>
🗄️ Database SQL File - https://github.com/MarkoG111/gigatronic_shop/blob/master/gigatronic_shop.sql

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)	
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)	
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)	
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple.svg?style=for-the-badge&logo=bootstrap)](https://getbootstrap.com/)
[![jQuery](https://img.shields.io/badge/jQuery-AJAX-blue.svg?style=for-the-badge&logo=jquery)](https://jquery.com/)
[![MVC](https://img.shields.io/badge/Architecture-MVC-success.svg?style=for-the-badge&logo=codeigniter)]()


👨‍💻 Admin login: <br/>
Email: admin@gmail.com <br/>
Password: Gacanovic121

## 🚀 Overview
This project emphasizes modular organization, secure database interaction via PDO, and client-server validation for better security and UX.

The project is a web shop for selling electronic components, featuring: <br/> 
- Dynamic product loading with AJAX and pagination 
- Shopping cart using LocalStorage
- User registration, login, and roles (user/admin)
- Admin dashboard with user, article, poll, order, and statistics management
- Contact form with email validation
- Real-time poll voting and results visualization


## ⚙️ Features
### 🏠 Public Area
- Home page with image slider and featured products
- Articles page dynamically loaded with AJAX
- Pagination, filtering, sorting, and search for articles
- Contact form with client and server validation

### 👤 User Area
- Registration & Login with session management
- Shopping cart implemented using LocalStorage
- Poll voting system (only one active poll per user)
- Email notifications for failed login attempts

### 🛠️ Admin Area
- Dashboard with system statistics (users, orders, products)
- User management (CRUD + export to Excel)
- Article management (CRUD with image upload via modal)
- Order management (status update, delete, details view)
- Poll management (create, activate, view results)
- Statistics on page visits in the last 24h


## 🌐 Pages Overview
| Page                 | Description                                                       |
| -------------------- | ----------------------------------------------------------------- |
| **Home**             | Displays image slider and featured products                       |
| **Articles**         | Dynamic product listing with pagination, search, sort, and filter |
| **Contact**          | Sends an email to admin with form validation                      |
| **Cart**             | Allows users to manage their orders via `LocalStorage`            |
| **Poll**             | Authenticated users can vote and see poll statistics              |
| **Admin Dashboard**  | Overview of system metrics                                        |
| **Admin Users**      | Manage users and export to Excel                                  |
| **Admin Articles**   | Manage articles (CRUD)                                            |
| **Admin Orders**     | Manage and update orders                                          |
| **Admin Poll**       | Create, activate, and analyze polls                               |
| **Admin Statistics** | Page visit statistics tracking                                    |


## 🧰 Technologies Used
| Category            | Tools / Libraries                              |
| ------------------- | ---------------------------------------------- |
| **Frontend**        | HTML, CSS, Bootstrap, JavaScript, jQuery, AJAX |
| **Backend**         | PHP (PDO, sessions, error logging)             |
| **Database**        | MySQL (phpMyAdmin)                             |
| **Data Exchange**   | JSON                                           |
| **Development**     | Visual Studio Code                             |
| **Version Control** | Git, GitHub                                    |


## 🧾 Database and Logging
- All data operations use PDO with prepared statements for safety.
- Error logs and page access logs are automatically written to text files:
  - ERRORS_FILE → records exceptions
  - LOG_ACCESS_FILE → records page visits with timestamp and IP

## ⚡ Installation
1. Clone the repository:
```bash
git clone https://github.com/YOUR_USERNAME/gigatronic_shop.git
```

2. Import the database from /database/gigatronic.sql
3. Configure database credentials in: config/config.php
4. Run a local server (e.g. XAMPP / WAMP)
5. Open in browser: http://localhost/Gigatronic_Shop/
