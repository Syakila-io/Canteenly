Development quickstart for Canteenly (Windows / XAMPP)

This file helps you get a local development environment up and running quickly.

Prerequisites
- PHP 8.2+
- Composer
- Node.js + npm
- MySQL (XAMPP or other)
- Git (optional)

1) Clone & dependencies
- If you haven't cloned the repo yet, clone it into your local webroot (e.g. `c:\xampp\htdocs\`)

2) Create .env
- Copy `.env.example` to `.env` (if not present):

  Copy-Item .env.example .env

- Open `.env` and set the database values. Example for XAMPP default:

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=canteenly
  DB_USERNAME=root
  DB_PASSWORD=

3) Create the database
- Using PowerShell + MySQL client (XAMPP):

  # if mysql is on PATH
  mysql -u root -e "CREATE DATABASE IF NOT EXISTS canteenly CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

- Or use phpMyAdmin (http://localhost/phpmyadmin) and create database `canteenly`.

4) Install PHP & JS dependencies

  composer install
  npm install

5) Migrate & seed
- Run migrations and seeders (this will create tables and optionally sample data):

  php artisan key:generate
  php artisan migrate --seed

- If you get errors, check `.env` DB settings and make sure MySQL service is running.

6) Build assets and run dev server

  npm run dev
  php artisan serve

- Visit http://127.0.0.1:8000 to open the site.

7) Quick manual tests
- Landing page should be at `/` and have links to login/register.
- Login: `/login` — if you don't have users, register via `/register` or run seeder.
- Admin: to test admin UI, set `role` field of a user to `admin` in DB (users table), then login.

Notes & tips
- If you use XAMPP and want to use the Apache vhost, place the project in `c:\xampp\htdocs\canteenly` and open via `http://localhost/canteenly/public/` (or configure vhost).
- For real-time notifications, consider setting up Laravel Echo + Pusher or Laravel WebSockets (not included by default).
- If you want me to create seed data for admin and demo users, tell me and I can add a simple seeder.

Contact
- If any command fails, copy the error output and I will help troubleshoot.
