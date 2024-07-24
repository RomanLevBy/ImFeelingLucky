#!/usr/bin/make
include .env

docker_bin := $(shell command -v docker 2> /dev/null)
docker_compose_bin := $(shell command -v docker-compose 2> /dev/null)

#Actions:
build:
	$(docker_compose_bin) -f docker-compose.yml build

up:
	$(docker_compose_bin) -f docker-compose.yml up --force-recreate -d --build
	make install-php
	$(docker_compose_bin) -f docker-compose.yml exec --user $(WWWUSER) -T "laravel.test" php artisan migrate --force

install-php: ## Install application dependencies
	$(docker_compose_bin) -f docker-compose.yml exec --user $(WWWUSER) -T "laravel.test" composer install

clean: ## Remove images from local registry
	-$(docker_compose_bin) -f docker-compose.yml down
	$(foreach image,$(all_images),$(docker_bin) rmi -f $(image);)
