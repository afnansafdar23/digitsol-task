# Document Management System

A robust Laravel-based document management solution designed for efficient document handling and workflow management.

## Overview

This system provides a comprehensive platform for managing documents with features like version control, status management, and secure user authentication. Built with Laravel 10.x, it offers a modern and responsive interface for both desktop and mobile users.

## Key Features

- **Advanced Document Management**
  - Document creation and versioning
  - Draft and publication workflow
  - Real-time status tracking
  - Secure document deletion
  - Detailed document viewing

- **User Authentication & Security**
  - Role-based access control
  - Secure login system
  - Session management
  - Password protection

- **Interface & Design**
  - Responsive layout
  - Dark/Light theme toggle
  - System theme integration
  - Mobile-first approach
  - Intuitive navigation

## Technical Requirements

- PHP >= 8.0
- Laravel 10.x
- MySQL 5.7+ or MariaDB 10.3+
- Composer 2.x
- Node.js 14+ & NPM 6+

## Quick Start Guide

### 1. System Setup

```bash
# Clone Repository
git clone https://github.com/afnansafdar23/digitsol-task.git
cd digitsol-task

# Install Dependencies
composer install

## Database Configuration

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

## run migration command

php artisan migrate --seed

##  Start the development server

php artisan serve

## Default Admin Credentials
Email: admin@gmail.com
Password: admin


## Security Measures
- CSRF protection enabled
- Secure session handling
- Authentication required for all operations
- Protected routes and middleware implementation
