run-smd-setup:
	cp ./src/.env.example ./src/.env
	docker compose build
	docker compose up -d
	docker exec php /bin/sh -c "composer install && chmod -R 777 storage && php artisan key:generate && php artisan storage:link"

run-smd-setup-db:
	cp ./src/.env.example ./src/.env
	docker compose build
	docker compose up -d
	docker exec php /bin/sh -c "composer install && chmod -R 777 storage && php artisan storage:link && php artisan key:generate && php artisan migrate:fresh --seed"

run-smd:
	docker compose up -d

kill-smd:
	docker compose down

enter-nginx:
	docker exec -it nginx /bin/sh

enter-php:
	docker exec -it php /bin/sh

enter-mysql:
	docker exec -it mysql /bin/sh

flush-db:
	docker exec php /bin/sh -c "php artisan migrate:fresh"

flush-db-with-seeding:
	docker exec php /bin/sh -c "php artisan migrate:fresh --seed"