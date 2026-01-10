# Restaurant E-Commerce System - Setup Guide

## Prerequisites
- XAMPP or WAMP installed (with PHP, MySQL, Apache)
- Composer installed
- Git installed

## Setup Instructions

### 1. Clone the project
```bash
git clone https://github.com/SuetYee03/TPL-website.git
cd TPL-website
```

### 2. Install dependencies
```bash
composer install
```

### 3. Setup environment file
```bash
copy .env.example .env
php artisan key:generate
```

### 4. Configure database in .env file
Open `.env` file and update these lines:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rms2
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Import database (IMPORTANT!)
**Option A: Using phpMyAdmin (Easiest)**
1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Create a new database named `rms2`
3. Click on the `rms2` database
4. Go to "Import" tab
5. Choose the `rms2.sql` file from the project folder
6. Click "Go" to import

**Option B: Using command line**
```bash
# Create database
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS rms2;"

# Import SQL file
mysql -u root -p rms2 < rms2.sql
```
(Press Enter when asked for password if you don't have one)

### 6. Clear cache
```bash
php artisan optimize:clear
```

### 7. Run the application
```bash
php artisan serve
```
Then open http://localhost:8000 in your browser

## Troubleshooting

### Error: "Column not found: 1054 Unknown column 'phone'"
This means you ran migrations instead of importing the SQL file. To fix:
1. Drop the `rms2` database in phpMyAdmin
2. Create a new `rms2` database
3. Import `rms2.sql` as shown in step 5 above
4. Clear cache: `php artisan optimize:clear`

### Products or images not showing
Make sure you imported the complete `rms2.sql` file which includes all product data and banner images.

### Port already in use
If port 8000 is already in use, run: `php artisan serve --port=9000`
