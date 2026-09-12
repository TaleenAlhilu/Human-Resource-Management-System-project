# HR Management System

A web based Human Resources Management System that supports employee administration, vacation requests, overtime requests, role based access, and an employee self service portal.

This project was developed using PHP, SQL, Microsoft SQL Server, JavaScript, jQuery, AJAX, HTML, CSS, and Bootstrap.

Note: Sensitive configuration and sample data such as database credentials, email service credentials, generated uploads, and the original database records have been excluded from this public repository.

## Features

### Administration Portal

* Add, edit, search, and remove employees
* Manage employee salaries and vacation balances
* Assign overtime eligibility
* Create and manage administrator accounts
* Support multiple access levels:

  * Super Admin
  * HR User
  * Viewer
* Configure vacation types and deduction rules
* Configure overtime types and hourly rates
* Review, approve, and reject employee requests

### Employee Portal

* Employee account login
* Initial temporary password workflow
* Password change functionality
* Submit vacation requests
* Submit overtime requests
* View previous requests and their statuses

## Technologies Used

* PHP
* Microsoft SQL Server
* SQL
* PDO
* JavaScript
* jQuery
* AJAX
* HTML5
* CSS3
* Bootstrap
* SweetAlert2
* PHPMailer

## Project Structure

```text
HRMS/
├── actions/          # Administrative request handlers
├── classes/          # Database models and business logic
├── employees-gate/   # Employee portal
├── images/           # Application images
├── includes/         # Shared page components
├── modals/           # Add and edit forms
├── PHPMailer/        # Email library
├── uploads/          # Runtime employee uploads
├── index.php         # Administrator login
└── login.php         # Administrator authentication
```

## Security and Configuration

Sensitive configuration is intentionally excluded from this public repository.

The following information must be configured locally before running the application:

* SQL Server address
* Database name
* Database username and password
* SMTP username and app password

## Running the Project Locally

1. Install PHP and Microsoft SQL Server.
2. Enable the PHP PDO SQL Server driver.
3. Place the project inside your local web server directory.
4. Create the required HRMS database tables.
5. Configure the database connection locally.
6. Configure SMTP settings if email functionality is required.
7. Open `index.php` through your local web server.

> The database contents and private configuration files are not included in this public repository.

## What I Learned

This project strengthened my experience with:

* Building a full stack application using PHP and SQL Server
* Organizing backend code using reusable classes
* Writing parameterized database queries with PDO
* Using AJAX to update pages without full reloads
* Implementing employee and administrator workflows
* Managing role based interface access
* Connecting frontend forms to backend request handlers
* Designing vacation and overtime approval workflows


