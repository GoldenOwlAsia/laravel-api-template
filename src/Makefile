# ------------- DOCKER  -----------------
up:
	docker-compose -p API up -d
down:
	docker-compose -p API down
# ------------- DOCKER CRONJOB -----------------
cron-up:
	docker-compose up -d cron
cron-stop:
	docker-compose stop cron
# ------------- COMPOSER  -----------------
composer:
	docker-compose run --rm composer $(filter-out $@,$(MAKECMDGOALS))
# ------------- ARTISAN  -----------------
artisan:
	docker-compose run --rm artisan $(filter-out $@,$(MAKECMDGOALS))
# ------------- NPM  -----------------
npm:
	docker-compose run --rm npm $(filter-out $@,$(MAKECMDGOALS))
# ------------- MIGRATION  -----------------
migrate-fresh-seed:
	docker-compose run --rm artisan migrate:fresh --seed
seed:
	docker-compose run --rm composer dump-autoload
	docker-compose run --rm artisan db:seed --class=$(filter-out $@,$(MAKECMDGOALS))

# ------------- NGINX  -----------------
nginx-test:
	docker-compose -p API exec site nginx -t
nginx-reload:
	docker-compose -p API exec site nginx -s reload
provision: up
	cp src/.env.local src/.env
	docker-compose run --rm composer install
	docker-compose run --rm npm install
	docker-compose run --rm artisan migrate:fresh --seed
dev: up mix-watch
%:
	@:
