-include .env
export

init-dev:
	cp .env-dist .env
	echo "APP_ENV=DEV" >> .env
	echo "COMPOSE_FILE=docker-compose.yml:docker-compose.dev.yml" >> .env

install:
	mkdir -p $(DATA_PATH)
	mkdir -p $(DATA_PATH)/opcache
	chmod -R 777 $(DATA_PATH)/opcache

	@docker-compose build --build-arg APP_ENV=${APP_ENV} data-export-php data-export-nginx data-export-ftp data-export-composer
	@docker-compose run data-export-composer
	@docker-compose run data-export-php php /web_root/dev/rules.php

rules:
	@docker-compose run data-export-php php /web_root/dev/rules.php

build:
	@docker-compose build --build-arg APP_ENV=${APP_ENV} data-export-nginx data-export-php data-export-ftp data-export-composer

up:
	@docker-compose  up -d --remove-orphans

down:
	@docker-compose down

update-composer:
	@docker-compose run data-export-composer

# Сборка и запуск докер проекта
build-up: build update-composer up

restart: down up