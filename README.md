# Restaurant E-Commerce System - Setup Guide

Choose the setup method that matches your environment:
- **Method A**: Docker Setup (Recommended for deployment)
- **Method B**: Local Setup (XAMPP/WAMP for Windows development)

---

## Method A: Docker Setup

### Prerequisites
- Docker and Docker Compose installed
- Git installed

### Setup Steps

#### 1. Clone the project
```bash
git clone https://github.com/SuetYee03/TPL-website.git
cd TPL-website
```

#### 2. Start Docker containers
```bash
docker compose up -d --build
docker compose ps
```

#### 3. Install dependencies and setup environment
```bash
docker compose exec server bash -lc "composer install"
docker compose exec server bash -lc "cp .env.example .env"
docker compose exec server bash -lc "php artisan key:generate"
```

#### 4. Import database (IMPORTANT: Do NOT use migrations!)
```bash
# Copy SQL file into the database container
docker cp rms2.sql $(docker compose ps -q db):/tmp/rms2.sql

# Create database and import
docker compose exec db mysql -u root -prootpassword -e "CREATE DATABASE IF NOT EXISTS rms2;"
docker compose exec db mysql -u root -prootpassword rms2 -e "source /tmp/rms2.sql"
```
**Note**: Replace `rootpassword` with the actual password from your `docker-compose.yml`

#### 5. Clear cache
```bash
docker compose exec server bash -lc "php artisan optimize:clear"
```

#### 6. Access the application
Open http://localhost:8000 (or the port specified in your docker-compose.yml)

### Docker Useful Commands
```bash
# Stop containers
docker compose down

# Rebuild containers
docker compose up -d --build

# Enter server container
docker compose exec server bash

# View logs
docker compose logs -f
```

---

## Method B: Local Setup (XAMPP/WAMP)

### Prerequisites
- XAMPP or WAMP installed (with PHP, MySQL, Apache)
- Composer installed
- Git installed

### Setup Steps

#### 1. Clone the project
```bash
git clone https://github.com/SuetYee03/TPL-website.git
cd TPL-website
```

#### 2. Install dependencies
```bash
composer install
```

#### 3. Setup environment file
```bash
copy .env.example .env
php artisan key:generate
```

#### 4. Configure database in .env file
Open `.env` file and update these lines:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rms2
DB_USERNAME=root
DB_PASSWORD=
```

#### 5. Import database (IMPORTANT!)
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

#### 6. Clear cache
```bash
php artisan optimize:clear
```

#### 7. Run the application
```bash
php artisan serve
```
Then open http://localhost:8000 in your browser

---

## Troubleshooting (Both Methods)

### Error: "Column not found: 1054 Unknown column 'phone'"
This means you ran migrations instead of importing the SQL file. To fix:

**For Docker:**
```bash
docker compose exec db mysql -u root -prootpassword -e "DROP DATABASE IF EXISTS rms2; CREATE DATABASE rms2;"
docker compose exec db mysql -u root -prootpassword rms2 -e "source /tmp/rms2.sql"
docker compose exec server bash -lc "php artisan optimize:clear"
```

**For Local:**
1. Drop the `rms2` database in phpMyAdmin
2. Create a new `rms2` database
3. Import `rms2.sql` as shown in step 5 above
4. Clear cache: `php artisan optimize:clear`

### Products or images not showing
Make sure you imported the complete `rms2.sql` file which includes all product data and banner images.

### Port already in use
**For Local:** Run `php artisan serve --port=9000`
**For Docker:** Change the port mapping in `docker-compose.yml`