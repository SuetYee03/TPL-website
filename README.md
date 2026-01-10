1. Clone the project and open in VS Code
git clone https://github.com/SuetYee03/TPL-website.git
cd TPL-website
code .

2. Start Docker containers

docker compose up -d --build
docker compose ps

3. Install dependencies and setup environment

docker compose exec server bash -lc "composer install"
docker compose exec server bash -lc "cp .env.example .env"
docker compose exec server bash -lc "php artisan key:generate"

4. Import database (IMPORTANT: Use this method, NOT migrations!)

First, create the database:
docker compose exec db mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS rms2;"

Then import the SQL file:
docker compose exec -T db mysql -u root -p rms2 < rms2.sql

Note: The password is defined in your docker-compose.yml file

5. Clear cache

docker compose exec server bash -lc "php artisan optimize:clear"

6. Useful commands
Stop containers
docker compose down

Rebuild containers
docker compose up -d --build


Enter server container
docker compose exec server bash

## Troubleshooting

### Error: "Column not found: 1054 Unknown column 'phone'"
This means you ran migrations instead of importing the SQL file. To fix:
1. Drop the database and recreate it
2. Import rms2.sql as shown in step 4 above
3. Clear cache: `docker compose exec server bash -lc "php artisan optimize:clear"`

### Products or images not showing
Make sure you imported the complete rms2.sql file which includes all product data and banner images.