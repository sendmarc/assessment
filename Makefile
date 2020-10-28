.PHONY: build-fresh build-site mysql artisan-migrate composer-update npm-install npm-watch composer-command artisan-command  npm-command 

help:
	@echo 	"usage: make <target>"
	@echo 	"Targets:"
	@echo 	"	build-fresh \n\t -> Fresh initial build \n"
	@echo 	"	build-site \n\t -> build site docker containers \n"
	@echo 	"	mysql \n\t -> Setup mysql volumes \n"
	@echo 	"	artisan-migrate \n\t -> Setup db migrations \n"
	@echo 	"	composer-update \n\t -> Setup compposer \n"
	@echo 	"	npm-install \n\t -> Setup npm packages \n"
	@echo 	"	npm-watch \n\t -> Run npm dev watch \n"
	@echo 	"	composer-command \n\t -> Run command in composer container \n"
	@echo 	"	artisan-command \n\t -> Run command in artisan container \n"
	@echo 	"	npm-command \n\t -> Run command in npm container \n"

build-fresh: build-site mysql composer-update artisan-migrate

build-site:
	@echo "\n###################################"
	@echo "---Setting the scene up for you!---"
	docker-compose up -d --build site

mysql:
	@echo "\n###################################"
	@echo "---Setting up mysql volumes---"
	sudo chmod +r ./mysql/*.pem

artisan-migrate:
	@echo "\n###################################"
	@echo "---Running migrations and seeds!---"
	docker-compose run --rm artisan migrate:refresh --seed

composer-update:
	@echo "\n###################################"
	@echo "---Setting up composer!---"
	docker-compose run --rm composer update

npm-install: 
	@echo "\n###################################"
	@echo "---Setting up npm packeges!---"
	docker-compose run --rm npm install

npm-watch:
	docker-compose run --rm npm run watch

composer-command:
	docker-compose run --rm composer

artisan-command:
	docker-compose run --rm artisan

npm-command:
	docker-compose run --rm npm
