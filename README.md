# Blogorithm

A traditional server-rendered blog management system built with PHP, MySQL,
HTML, CSS, and vanilla JavaScript. It includes user authentication, post
management, and an administrator dashboard for managing users and content.

## Features

- User registration, sign-in, sign-out, and password changes
- Password hashing and verification with PHP's password API
- Create, edit, view, and delete blog posts
- User and administrator roles
- Admin dashboards for users and posts
- MySQL schema and sample content
- Session-based authentication

## Requirements

- PHP 8.x recommended
- MySQL or MariaDB
- Apache through XAMPP, Laragon, or a similar local stack

## Local setup with XAMPP

1. Clone the project into XAMPP's `htdocs` directory:

   ```powershell
   cd C:\xampp\htdocs
   git clone https://github.com/YSFWRLD/Blogorithm.git blogorithm
   ```

2. Start Apache and MySQL from the XAMPP control panel.
3. Open `http://localhost/phpmyadmin`.
4. Create a database named `blogorithm`.
5. Import `blogorithm.sql` into that database.
6. Confirm the local database settings in `includes/dbconnect.php`.
7. Open `http://localhost/blogorithm`.

The included SQL file contains sample posts and sample users with password
hashes. Treat them as demonstration data and create new accounts for your own
local environment.

## Roles

| Role | Capabilities |
| --- | --- |
| User | Register, sign in, change password, and manage blog posts |
| Admin | Manage users and posts through the admin dashboard |

## Project structure

```text
css/                  stylesheets
images/               post and interface images
includes/             database connection and shared layout
js/                   browser-side JavaScript
blogorithm.sql         schema and sample data
index.php              public post listing
post.php               individual post page
dashboard.php          user dashboard
admin_dashboard.php    administration area
```

## Security notes

This is an educational project, not a production-ready CMS. Before deploying it
publicly:

- Move database credentials out of source code and into environment variables.
- Replace string-built SQL with prepared statements throughout the application.
- Add CSRF protection to state-changing forms.
- Validate uploaded files and generated image paths.
- Add authorization checks to every administrative action.
- Remove demonstration users and content from the database import.
- Configure secure session cookies and production error handling.

## Current limitations

- No automated tests
- No pagination or post search
- Local database configuration is hard-coded for XAMPP defaults
- The interface was designed as a learning project rather than a reusable theme

No software license is currently included. Add one before granting others
permission to reuse or redistribute the project.
