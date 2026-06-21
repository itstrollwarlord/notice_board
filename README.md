# Notice Board Management System.

A responsive **Notice Board Management System** developed using **PHP, HTML, CSS, JavaScript, and MySQL**. The application provides an easy way to create, manage, edit, and delete notices through a secure admin dashboard with role-based access control.

This project was built to strengthen my understanding of full-stack web development using core web technologies without relying on frameworks.

## Features

* User authentication (Login System)
* Admin Dashboard
* Role-based access control (Admin/User)
* Create new notices
* Edit existing notices
* Delete notices
* Display all notices
* Notice categories
* Responsive user interface
* Search-friendly card layout
* Secure session management
* MySQL database integration

## Technologies Used

### Frontend

* HTML5
* CSS3
* JavaScript

### Backend

* PHP

### Database

* MySQL

### Development Tools

* XAMPP
* phpMyAdmin
* Git
* GitHub

# Project Structure

NoticeBoard/
│
├── admin_dashboard.php
├── login.php
├── logout.php
├── add_notice.php
├── edit_notice.php
├── delete_notice.php
├── db.php
├── header.php
├── navbar.php
├── footer.php
├── css/
├── js/
├── images/
└── database/

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/itstrollwarlord/notice_board.git
```

### 2. Move the project

Copy the project folder into your **htdocs** directory.

Example:

```
C:\xampp\htdocs\NoticeBoard
```

### 3. Start XAMPP

Start:

* Apache
* MySQL

### 4. Import the Database

* Open phpMyAdmin.
* Create a new database.
* Import the provided SQL file.

### 5. Configure Database Connection

Open:

```
db.php
```

Update your database credentials if necessary.

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "notice_board";
```

### 6. Run the Project

Open your browser and visit:

```
http://localhost/NoticeBoard
```

---

## Main Functionalities

* User Login
* Session Management
* Admin Authorization
* Notice Management (CRUD)
* Category Management
* Responsive Dashboard
* Secure Database Connectivity

---

## Learning Outcomes

Through this project, I learned:

* PHP Programming
* MySQL Database Integration
* CRUD Operations
* Session Handling
* Authentication & Authorization
* Responsive Web Design
* HTML & CSS Layout Design
* JavaScript Basics
* Database Relationships
* Git & GitHub Version Control

---

## Security Features

* Session-based authentication
* Admin-only access to dashboard
* Protected pages
* Output escaping using `htmlspecialchars()`
* Confirmation prompts before deleting records

---

## Future Improvements

* Image attachments for notices
* File upload support
* Search and filtering
* Pagination
* Rich text editor
* Email notifications
* User profile management
* Dark/Light mode
* Notice expiration dates
* Dashboard analytics

---

## Author

**Muhammad Abdullah Ali**

BS Computer Science Student

### Currently Learning

* PHP
* MySQL
* C#
* ASP.NET Core
* Android Development
* Flutter

GitHub:
https://github.com/itstrollwarlord

##  License

This project is created for educational and portfolio purposes.

⭐ If you like this project, consider giving it a star on GitHub!
