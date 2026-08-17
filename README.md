# College Club Management System with Event & Task Management

A full-featured, secure, and lightweight **College Club Management System** built using **procedural PHP**, **MySQL**, **HTML5**, **CSS3**, and **Vanilla JavaScript**.

This system is specifically tailored for **BCA 4th Semester Tribhuvan University (TU), Nepal** final/term projects. It covers complete club management, student membership enforcement, lead responsibilities, event coordination, task management, manual attendance marking, feedback/rating collection, and system-wide admin control.

---

## 📌 Project Overview

The application simplifies and automates college club operations through three distinct roles:
1. **Student**: Registers an account, views clubs, joins **only one active club at a time** (enforced server-side), registers for events, tracks assigned tasks, marks tasks as completed, and submits post-event feedback.
2. **Club Head**: Promoted and assigned by Admin to lead a specific club. Creates and manages events, assigns lead responsibilities (Logistics Lead, Graphics Lead, Tech Lead, etc.) to club members, creates and delegates event-driven tasks, marks attendance, posts announcements, and reviews member feedback.
3. **Admin**: Department/College administration account with overarching system privileges. Manages clubs, promotes registered students to Club Head status, reviews system-wide memberships, events, tasks, attendance, and feedback logs.

---

## 🛠️ Technology Stack

* **Frontend**: HTML5, CSS3 (Vanilla), Vanilla JavaScript
* **Backend**: PHP Procedural Programming (PHP 7.4+ / PHP 8.x)
* **Database**: MySQL / MariaDB
* **Server Environment**: XAMPP (Apache + MySQL)
* **Version Control**: Git & GitHub

> **Constraint Compliance**: No external frameworks or libraries are used (No Laravel, Bootstrap, Tailwind, React, Vue, jQuery, Composer, or ORM).

---

## 📁 Directory Structure

```text
college-club-management/
│
├── index.php                 # Application Landing Page
├── login.php                 # User Authentication Login (To be implemented)
├── register.php              # Student Registration (Role escalation protected)
├── logout.php                # Session Destruction & Logout
│
├── config/
│   └── database.php          # MySQLi Procedural Connection Config
│
├── includes/
│   ├── auth.php              # Role Authentication & Session Helpers
│   ├── functions.php         # Input Sanitization, Flash Messages, 1-Club Rule Helper
│   ├── csrf.php              # Session-based CSRF Token Protection
│   ├── header.php            # Global Page Header
│   ├── footer.php            # Global Page Footer
│   └── navbar.php            # Role-aware Navigation Bar
│
├── student/                  # Student & Member Module Pages
│   ├── dashboard.php
│   ├── clubs.php
│   ├── join-club.php
│   ├── my-club.php
│   ├── events.php
│   ├── register-event.php
│   ├── tasks.php
│   ├── task.php
│   └── feedback.php
│
├── club-head/                # Club Head Management Panel
│   ├── dashboard.php
│   ├── club.php
│   ├── members.php
│   ├── responsibilities.php
│   ├── events.php
│   ├── create-event.php
│   ├── edit-event.php
│   ├── attendance.php
│   ├── tasks.php
│   ├── create-task.php
│   └── edit-task.php
│
├── admin/                    # System Administration Module
│   ├── dashboard.php
│   ├── users.php
│   ├── clubs.php
│   ├── create-club.php
│   ├── assign-head.php
│   ├── responsibilities.php
│   ├── events.php
│   └── tasks.php
│
├── assets/
│   ├── css/
│   │   └── style.css         # Modern, Clean CSS
│   └── js/
│       └── script.js         # Client-side Interactive Helpers
│
├── database/
│   └── database.sql          # Importable MySQL Database Dump
│
└── README.md                 # Project Documentation & Viva Guide
```

---

## 💻 XAMPP Setup & Installation

1. **Clone / Place Project in XAMPP `htdocs`**:
   Copy or clone this repository directly into your XAMPP `htdocs` directory:
   ```text
   C:\xampp\htdocs\college-club-management\
   ```

2. **Start Apache & MySQL**:
   Open **XAMPP Control Panel** and start both **Apache** and **MySQL** services.

3. **Import Database in phpMyAdmin**:
   * Open your browser and go to `http://localhost/phpmyadmin/`.
   * Create a new database named `college_club_db` (or simply import `database/database.sql` directly as it contains `CREATE DATABASE IF NOT EXISTS`).
   * Select `database/database.sql` from the file input and click **Import**.

4. **Access the System**:
   Open browser and navigate to:
   ```text
   http://localhost/college-club-management/
   ```

---

## 🔑 Default Credentials

### Admin Account
* **Email**: `admin@college.edu.np`
* **Password**: `admin123`
* **Role**: `admin`

---

## 🔒 Key Security Implementation & Defense Points (For Viva)

1. **Role Privilege Escalation Protection**:
   * Public registration (`register.php`) hardcodes `role = 'student'` and `status = 'active'`.
   * Users cannot submit `role=admin` or `role=club_head` in POST payloads to gain admin rights.
2. **One Active Club per Student Enforcement**:
   * Verified on the **server side** before processing any join request using `getStudentActiveClub($conn, $userId)`.
3. **Insecure Direct Object Reference (IDOR) & Ownership Verification**:
   * **Task Ownership**: Members can only update tasks where `assigned_to == $_SESSION['user_id']`.
   * **Club Ownership**: Club Heads can only manage events, members, and tasks associated with their assigned `club_id`.
4. **SQL Injection Defense**:
   * All database queries dealing with user input use **MySQLi Prepared Statements** (`mysqli_prepare`, `mysqli_stmt_bind_param`).
5. **Cross-Site Scripting (XSS) Prevention**:
   * User input render outputs are wrapped in `htmlspecialchars($data, ENT_QUOTES, 'UTF-8')` via the `e()` helper function.
6. **Cross-Site Request Forgery (CSRF) Defense**:
   * State-changing POST forms require a valid token generated via `generateCsrfToken()` and checked via `verifyCsrfToken()`.
7. **Password Security**:
   * Passwords hashed using standard `password_hash($pass, PASSWORD_BCRYPT)` and validated using `password_verify()`.

---

## 🎓 BCA Viva Q&A Quick Reference

* **Q: Why procedural PHP instead of Object-Oriented or Frameworks?**
  * *A:* Procedural PHP provides a clear, transparent view of how HTTP POST/GET requests, MySQL database connections, sessions, and procedural logic interact without black-box framework abstractions, ideal for demonstrating core computer science fundamentals.
* **Q: How is the 1-club restriction enforced?**
  * *A:* Through server-side validation against the `memberships` table searching for `user_id = X AND status = 'active'` before performing `INSERT INTO memberships`.
* **Q: How are member responsibilities different from authentication roles?**
  * *A:* Authentication roles (`student`, `club_head`, `admin`) control system-wide page access. Responsibilities (`Graphics Lead`, `Logistics Lead`, etc.) are organizational designations inside a specific club saved in the `memberships` table.
