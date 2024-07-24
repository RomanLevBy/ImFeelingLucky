#!/usr/bin/make
include .env

#Actions:
build:
	$(docker_compose_bin) -f docker-compose.yml build

up:
	$(docker_compose_bin) -f docker-compose.yml up -d --build

clean: ## Remove images from local registry
	-$(docker_compose_bin) -f docker-compose.yml down
	$(foreach image,$(all_images),$(docker_bin) rmi -f $(image);)
