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

4. Run database migration and seed

docker compose exec server bash -lc "php artisan migrate"
docker compose exec server bash -lc "php artisan db:seed"

5. Clear cache

docker compose exec server bash -lc "php artisan optimize:clear"

6. Useful commands
Stop containers
docker compose down

Rebuild containers
docker compose up -d --build


Enter server container
docker compose exec server bash