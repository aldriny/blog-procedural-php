# Blog Project

## Overview

This project is a simple blog application that allows users to create, edit, and delete posts. It also includes user authentication and localization support for multiple languages.

## Features

- User Authentication
  - Login
  - Registration
- CRUD Operations for Blog Posts
  - Create a new post
  - Edit an existing post
  - Delete a post
  - View all posts
- Localization
  - Multi-language support
  - RTL (Right-To-Left) support for languages like Arabic
- Responsive Design
  - Built with Bootstrap for a responsive and mobile-friendly layout

## Technologies Used

- PHP
- MySQL
- Composer (Dependency Management)
- Dotenv (Environment Variables)
- Bootstrap (Frontend Framework)

## Getting Started

### Prerequisites

- PHP 7.4 or higher
- MySQL
- Composer

### Installation

1. **Clone the repository**:
    ```sh
    git clone https://github.com/aldriny/blog-procedural-php.git
    cd blog-procedural-php
    ```

2. **Install dependencies**:
    ```sh
    composer install
    ```

3. **Set up the database**:

4. **Configure environment variables**:

    ```
    - Edit the `.env` file with your database information:
    ```plaintext
    DB_SERVER_NAME=localhost
    DB_USER_NAME=root
    DB_PASSWORD=
    DB_NAME=blog
    ```

5. **Run the application**:
    - Make sure your local server (e.g., XAMPP) is running.
    - Navigate to `http://localhost/blog-procedural-php` in your web browser.
