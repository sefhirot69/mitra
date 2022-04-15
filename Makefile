# VARIABLES
DOCKER_COMPOSE = docker-compose
CONTAINER      = container-mitra
EXEC           = docker exec -ti $(CONTAINER)
EXEC_PHP       = $(EXEC) php
SYMFONY        = $(EXEC_PHP) bin/console
COMPOSER       = $(EXEC) composer
CURRENT-DIR    := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

.DEFAULT_GOAL := deploy

deploy: build
	@echo "📦 Build done"

build: create_env_file recreate

deps: composer-install

update-deps: composer-update

test:
	$(EXEC_PHP) ./vendor/bin/phpunit
	@echo "Test Executed ✅"

#Linter
cs:
	$(EXEC_PHP) ./vendor/bin/php-cs-fixer fix --diff
	@echo "Coding Standar Fixer Executed ✅"

cs-prev:
	$(EXEC_PHP) ./vendor/bin/php-cs-fixer fix --dry-run --diff
	@echo "Coding Standar Fixer Executed ✅"

create_env_file:
	@if [ ! -f .env.local ]; then cp .env .env.local; fi


# Analysis Static Code
#audit:
#	@docker run --rm -it -v $(CURRENT-DIR):/data/project/ -p 8083:8080 jetbrains/qodana-license-audit --show-report
#
#static-analysis:
#	@docker run --rm -it -v $(CURRENT-DIR):/data/project/ -p 8083:8080 jetbrains/qodana-php:2021.3-eap --show-report

# 🐘 Composer
composer-install: ACTION=install

composer-update: ACTION=update $(module)

composer-require: ACTION=require $(module)

composer-dump: ACTION=dump-autoload

composer composer-install composer-update composer-require composer-dump: create_env_file
	$(COMPOSER) $(ACTION) \
			--ignore-platform-reqs \
			--no-ansi

# 🐳 Docker Compose
start:
	@echo "🚀 Deploy!!!"
	$(DOCKER_COMPOSE) up -d
stop:
	@echo "🛑 Stop container!!!"
	$(DOCKER_COMPOSE) stop
recreate:
	@echo "🔥 Recreate container!!!"
	$(DOCKER_COMPOSE) up -d --build --remove-orphans --force-recreate
	make deps
	make start
rebuild:
	@echo "🔥 Rebuild container!!!"
	$(DOCKER_COMPOSE) build --pull --force-rm --no-cache
	make deps
	make start

# 🦝 Apache
reload:
	$(EXEC) /bin/bash service apache2 restart || true

#clear cache
clear:
	$(SYMFONY) cache:clear

entity:
	$(SYMFONY) make:entity
migration:
	$(SYMFONY) make:migration
migrate:
	$(SYMFONY) doctrine:migrations:migrate
factory:
	$(SYMFONY) make:factory
factory-test:
	$(SYMFONY) make:factory --test
fixture:
	@$(SYMFONY) doctrine:fixtures:load --purge-with-truncate -q
import-database:
	$(SYMFONY) doctrine:mapping:import Mitra annotation --path="Mitra/Clients/Infrastructure/Doctrine/Entity"