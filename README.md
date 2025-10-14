🛒 Gigatronic Shop

Gigatronic Shop is a full-stack PHP e-commerce web application built as part of a university project at Visoka škola strukovnih studija za informacione i komunikacione tehnologije.
The project demonstrates core e-commerce functionality with dynamic content loading, user authentication, and an advanced admin dashboard.

🔗 Live demo: https://gacodev.gigatronicshop.com

👨‍💻 Admin login:

Email: admin@gmail.com
Password: Gacanovic121

🚀 Overview
The project is a web shop for selling electronic components, featuring:
Dynamic product loading with AJAX and pagination
Shopping cart using LocalStorage
User registration, login, and roles (user/admin)
Admin dashboard with user, article, poll, order, and statistics management
Contact form with email validation
Real-time poll voting and results visualization
This project emphasizes modular organization, secure database interaction via PDO, and client-server validation for better security and UX.

⚙️ Features
🏠 Public Area
Home page with image slider and featured products
Articles page dynamically loaded with AJAX
Pagination, filtering, sorting, and search for articles
Contact form with client and server validation

👤 User Area
Registration & Login with session management
Shopping cart implemented using LocalStorage
Poll voting system (only one active poll per user)
Email notifications for failed login attempts

🛠️ Admin Area
Dashboard with system statistics (users, orders, products)
User management (CRUD + export to Excel)
Article management (CRUD with image upload via modal)
Order management (status update, delete, details view)
Poll management (create, activate, view results)
Statistics on page visits in the last 24h


🌐 Pages Overview
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


🧰 Technologies Used
| Category            | Tools / Libraries                              |
| ------------------- | ---------------------------------------------- |
| **Frontend**        | HTML, CSS, Bootstrap, JavaScript, jQuery, AJAX |
| **Backend**         | PHP (PDO, sessions, error logging)             |
| **Database**        | MySQL (phpMyAdmin)                             |
| **Data Exchange**   | JSON                                           |
| **Development**     | Visual Studio Code                             |
| **Version Control** | Git, GitHub                                    |


🧾 Database and Logging
All data operations use PDO with prepared statements for safety.
Error logs and page access logs are automatically written to text files:
ERRORS_FILE → records exceptions
LOG_ACCESS_FILE → records page visits with timestamp and IP

⚡ Installation
Clone the repository:
git clone https://github.com/YOUR_USERNAME/Gigatronic_Shop.git
Import the database from /database/gigatronic.sql
Configure database credentials in:
config/config.php
Run a local server (e.g. XAMPP / WAMP)
Open in browser:
http://localhost/Gigatronic_Shop/
