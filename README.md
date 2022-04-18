
# Work With Us


## Set up
1. Clone the project

    git clone git@github.com:julialeu/work-with-us.git
2. Enter to the project
   cd work-with-us
3. Create .env file
   cp .env.example .env
4. Run docker
    docker-compose up --build
5. composer install
    docker-compose exec wwu_app composer install
6. Generate app key
    docker-compose exec wwu_app php artisan key:generate
