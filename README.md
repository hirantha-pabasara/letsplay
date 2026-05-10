# LetsPlay

LetsPlay is a PHP + MySQL based web application for a gaming e-commerce experience. It includes user account management, product browsing, cart handling, profile management, and online payment flow integration.

## Table of Contents

- [Project Overview](#project-overview)
- [Key Features](#key-features)
- [Technology Stack](#technology-stack)
- [Project Structure](#project-structure)
- [Prerequisites](#prerequisites)
- [Setup Instructions](#setup-instructions)
- [Configuration](#configuration)
- [How to Run](#how-to-run)
- [Main User Flows](#main-user-flows)
- [Important Notes](#important-notes)
- [Known Limitations](#known-limitations)
- [Troubleshooting](#troubleshooting)
- [Future Improvements](#future-improvements)

## Project Overview

This project provides a game store front-end and back-end with:

- Homepage with game categories and product cards
- User registration and login
- Password reset via email verification
- Product detail and checkout preparation
- Cart and invoice flow
- User profile update features

The application is built in a mostly page-based PHP architecture with JavaScript (AJAX/XHR) for interactive actions.

## Key Features

- **User Authentication**
  - Sign up (`join.php` + `signUpProcess.php`)
  - Sign in (`signInProcess.php`)
  - Sign out (`signoutProcess.php`)
- **Password Recovery**
  - Verification code email sender (`forgotPasswordProcess.php`)
  - Password reset handler (`resetPassword.php`)
- **Storefront & Products**
  - Homepage sections and product rendering (`home.php`)
  - Single product view (`singleProductView.php`)
- **Cart & Orders**
  - Add to cart process (`addtoCartProcess.php`)
  - Cart page (`cart.php`)
  - Buy now process (`buyNowProcess.php`)
  - Invoice save and render (`saveInvoice.php`, `invoice.php`)
- **User Profile**
  - Profile view and updates (`userProfile.php`, `updateProcess.php`)

## Technology Stack

- **Backend:** PHP (procedural + utility class pattern)
- **Database:** MySQL (via `mysqli`)
- **Frontend:** HTML, CSS, JavaScript
- **UI Framework:** Bootstrap
- **Email:** PHPMailer
- **Payments:** PayHere JavaScript SDK integration

## Project Structure

```text
letsplay/
├── home.php
├── header.php
├── join.php
├── userProfile.php
├── cart.php
├── singleProductView.php
├── invoice.php
├── connection.php
├── signUpProcess.php
├── signInProcess.php
├── signoutProcess.php
├── forgotPasswordProcess.php
├── resetPassword.php
├── addtoCartProcess.php
├── buyNowProcess.php
├── saveInvoice.php
├── updateProcess.php
├── js/
│   └── script.js
├── css/
│   ├── style.css
│   └── bootstrap*.css
├── resource/
│   ├── home/
│   ├── game/
│   ├── carousel/
│   └── tournament/
└── PHPMailer-related files
```

## Prerequisites

Before running locally, ensure you have:

- PHP 7.4+ (or compatible PHP 8.x environment)
- MySQL Server
- A local web server (Apache/Nginx, or XAMPP/Laragon/WAMP)
- Internet access for CDN assets and payment SDK where needed

## Setup Instructions

1. **Clone the repository**
2. **Place it in your web root** (example: `htdocs/letsplay`)
3. **Create a MySQL database** named:
   - `letsplay`
4. **Import your schema/data** (SQL dump is not included in this repository)
5. **Update database connection settings** in `connection.php` if needed
6. **Configure email sender credentials** in `forgotPasswordProcess.php`
7. **Open the app** in your browser:
   - `http://localhost/letsplay/home.php`

## Configuration

### 1) Database Configuration

In `connection.php`, update:

- Host
- Username
- Password
- Database name
- Port

### 2) Email Configuration (Password Reset)

In `forgotPasswordProcess.php`, update:

- SMTP host/port/security
- Sender email and app password
- Sender display name

> Use environment variables or a secure secrets manager for production deployments.

### 3) Payment Configuration

PayHere configuration appears in `js/script.js` inside `payNow()`.

Update:

- `merchant_id`
- Return and cancel URLs
- Notify URL
- Sandbox/production mode

## How to Run

- Start Apache/Nginx and MySQL
- Ensure database and configuration are ready
- Navigate to:
  - `home.php` (landing page)
  - `join.php` (auth page)

## Main User Flows

1. **User registers** and signs in
2. **User browses games** on the home page
3. **User opens product details** and initiates payment/cart actions
4. **User can update profile** and address information
5. **User can reset password** using email verification code

## Important Notes

- The repository currently stores connection and SMTP values directly in source files.
- The application logic is tightly coupled to database table names and existing schema.
- Several static assets and UI text sections are hardcoded for demo-like presentation.

## Known Limitations

- No database schema SQL file is included.
- No dependency manager files (Composer/NPM) are included.
- No automated test suite or CI configuration is present in the repository.
- Some scripts contain implementation issues that may require bug-fixing before production use.

## Troubleshooting

- **Database connection error**
  - Verify credentials and DB server status in `connection.php`
- **Password reset email not sent**
  - Verify SMTP credentials and provider security settings
- **Payment popup issues**
  - Verify PayHere configuration and browser console errors
- **Missing images/styles**
  - Ensure project is served from the expected base path

## Future Improvements

- Move secrets to environment variables
- Add DB schema migrations or SQL dump
- Add server-side validation hardening and prepared statements
- Add automated tests and CI workflows
- Modularize codebase (routing, services, reusable components)

