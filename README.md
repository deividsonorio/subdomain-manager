## Subdomain Manager

Follow the instructions below to setting up the project.

### Prerequisites

- Download and Install [Docker](https://docs.docker.com/engine/install/)

## Run App With GNU Make (UNIX Based OS: MacOS, Linux)

- `make run-smd-setup` : Build docker and start all containers with Laravel setup
- `make run-smd-setup-db` : Build docker and start all containers with Laravel setup, database migrations and seeder
- `make run-smd` : Start all docker containers
- `make kill-smd` : Kill all docker containers
- `make enter-nginx` : Enter docker Nginx container
- `make enter-php` : Enter docker PHP container
- `make enter-mysql` : Enter docker MySQL container
- `make flush-db` : Run PHP migrate fresh command
- `make flush-db-with-seeding` : Run php migrate fresh command with seeding

## Run App Manually

- Create the .env file in the src folder for Laravel environment from .env.example
- Run command ```docker-compose build```
- Run command ```docker-compose up -d```
- Run command ```composer install``` inside PHP container on docker
- Run command ```docker exec -it php /bin/sh``` on your terminal
- Run command ```chmod -R 777 storage``` on your terminal after went into PHP container on docker
- If app:key still empty on .env run ```php artisan key:generate``` on your terminal after went into php container on docker
- To run artisan command like migrate, etc. go to php container using ```docker exec -it php /bin/sh```
- Go to http://localhost:8777 or any port you set to open Laravel

**Note: if you got a permission error when running docker, try running it as an admin or use sudo in linux**