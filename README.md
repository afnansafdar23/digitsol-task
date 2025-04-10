# Document Management System

A Laravel-based document management system that allows users to create, edit, publish, and manage documents.

## Features

- User Authentication
- Document Management
  - Create new documents
  - Edit draft documents
  - Publish documents
  - View document details
  - Delete documents
- Status Management
  - Draft status for editable documents
  - Published status for finalized documents
- Theme Customization
  - Light mode
  - Dark mode
  - System preference mode
- Responsive Design
  - Desktop and mobile-friendly interface
  - Mobile navigation support

## Requirements

- PHP >= 8.0
- Laravel 9.x
- MySQL/MariaDB
- Composer
- Node.js & NPM

## Installation

1. Clone the repository:
```bash
git clone <https://github.com/afnansafdar23/digitsol-task.git>
cd digitsol-task
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