#!/bin/bash
include .env
SHELL := /bin/bash # Use bash syntax

export TZ=America/Sao_Paulo

export

.PHONY: help
.DEFAULT_GOAL := help

help:  ## Display this help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

##@ Docker
up: ## Start all project containers
	@echo -e "\n~~> Starting up containers for ${PROJECT_NAME}..."
	docker-compose up -d
	@echo -e "~> [OK] Access Application through url: http://localhost:${DOCKER_APP_PORT}"

in: ## Enter in app container
	@echo -e "\n~~> Entering in ${PROJECT_NAME}-app container..."
	@docker exec -it "${PROJECT_NAME}-app" bash

ps: ## List the project containers
	@echo -e "\n~~> Listing container..."
	@docker-compose ps

stop: ## Stop all project containers
	@echo -e "\n~~> Stopping application containers..."
	docker-compose stop
	@echo -e "~> [OK]"

clean: ## Stop and remove project's containers
	@echo -e "\n~~> Stopping and removing project's containers..."
	docker-compose down
	@echo -e "~> [OK]"

restart: ## Restart all project containers
	@echo -e "\n~~> Restarting application containers..."
	make clean
	make up

##@ Composer

install: ## Composer install dependencies
	@echo -e "~~> Installing composer dependencies..."
	@docker exec -it "${PROJECT_NAME}-app" composer install -o
	@echo -e "~~> [OK]\n"

require: ## Run the composer require. (e.g make require PACKAGE="vendor/package")
	@docker exec -it "${PROJECT_NAME}-app" php -d memory_limit=-1 /usr/local/bin/composer require "${PACKAGE}" -o

require-dev: ## Run the composer require to dev. (e.g make require-dev PACKAGE="vendor/package")
	@docker exec -it "${PROJECT_NAME}-app" php -d memory_limit=-1 /usr/local/bin/composer require "${PACKAGE}" --dev -o

dump: ## Run the composer dump
	@docker exec -it "${PROJECT_NAME}-app" composer dump-autoload -o

##@ Quality Tools
cs: ## Run Code Sniffer Tool
	@echo -e "~~> Running PHP Code Sniffer Tool..."
	@docker exec -it "${PROJECT_NAME}-app" composer run cs
	@echo -e "done!\n"

fixer: ## Run PHP Code Fixer Tool
	@echo -e "~~> Running PHP Code Fixer Tool..."
	@docker exec -it "${PROJECT_NAME}-app" composer run fixer
	@echo -e "done!\n"

##@ Database

db-in: # Enter in MongoDB Container
	@docker exec -it "${PROJECT_NAME}-mongodb" mongo -u "${MONGODB_USERNAME}" -p "${MONGODB_PASSWORD}"

db-backup: ## Backup database
	@docker exec "${PROJECT_NAME}-db" /usr/bin/mysqldump -u root -p"${DB_PASSWORD}" "${DB_DATABASE}" > backup.sql

db-restore: ## Restore database
	@cat backup.sql | docker exec -i "${PROJECT_NAME}-db" /usr/bin/mysql -u root -p"${DB_PASSWORD}" "${DB_DATABASE}"

##@ PHP Unit - Tests

test: ## Run the all suite test
	@docker exec -it "${PROJECT_NAME}-app" composer run test

test-filter: ## Run a single test by method name (e.g make test-single NAME=testYourTestName)
	@docker exec -it "${PROJECT_NAME}-app" composer run test-filter "${NAME}"

test-coverage: ## Run the all suite test and generate the Code Coverage
	@docker exec -it "${PROJECT_NAME}-app" composer run coverage

test-unit: ## Run the application unit tests only
	@docker exec -it "${PROJECT_NAME}-app" composer run test-unit
