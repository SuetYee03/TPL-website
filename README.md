# Restaurant E-Commerce System - Setup Guide

## Prerequisites
- XAMPP/WAMP (for local) OR Docker (for deployment)
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
copy .env.example .env      # Windows
# OR
cp .env.example .env        # Linux/Mac
```

### 4. Generate application key
```bash
php artisan key:generate
```

### 5. Configure database
Open `.env` file and update database settings:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rms2
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Create database and run migrations
**Using phpMyAdmin:**
1. Open http://localhost/phpmyadmin
2. Create a new database named `rms2`
3. Run migrations: `php artisan migrate`
4. Seed database: `php artisan db:seed`

**Using command line:**
```bash
# Create database
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS rms2;"

# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

### 7. Clear cache
```bash
php artisan optimize:clear
```

### 8. Run the application
```bash
php artisan serve
```
Then open http://localhost:8000 in your browser

## Docker Setup (Alternative)

If using Docker:
```bash
docker compose up -d --build
docker compose exec server bash -lc "composer install"
docker compose exec server bash -lc "cp .env.example .env"
docker compose exec server bash -lc "php artisan key:generate"
docker compose exec server bash -lc "php artisan migrate"
docker compose exec server bash -lc "php artisan db:seed"
```

## Troubleshooting

### Products or images not showing
Run the database seeder:
```bash
php artisan db:seed
```

### Port already in use
```bash
php artisan serve --port=9000
```

### Clear all cache
```bash
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
```