#!/usr/bin/make
include .env

#Actions:
build:
	$(docker_compose_bin) -f docker-compose.yml build

up:
	$(docker_compose_bin) -f docker-compose.yml up --force-recreate -d --build
	$(docker_compose_bin) -f docker-compose.yml exec --user $(WWWUSER) -T "laravel.test" php artisan migrate --force

clean: ## Remove images from local registry
	-$(docker_compose_bin) -f docker-compose.yml down
	$(foreach image,$(all_images),$(docker_bin) rmi -f $(image);)
