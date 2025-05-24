SHELL := /bin/bash
S := ./vendor/bin/sail

# 🏗 Инициализация
init: sail-up composer-install migrate

# 🚀 Контейнеры
sail-up:
	$(S) up -d

sail-down:
	$(S) down

sail-restart:
	$(S) down && $(S) up -d

sail-build:
	$(S) build --no-cache

# 📦 Composer
composer-install:
	$(S) composer install

composer-update:
	$(S) composer update

composer:
	$(S) composer $(name)

# 🎯 Laravel Artisan
laravel:
	$(S) artisan $(name)

migrate:
	$(S) artisan migrate

migrate-fresh:
	$(S) artisan migrate:fresh

seed:
	$(S) artisan db:seed

test:
	$(S) artisan test

# ✅ Code quality
project-cs-check:
	$(S) exec laravel.test php ./vendor/bin/php-cs-fixer fix -vvv --dry-run --config=.php-cs-fixer.php --allow-risky=yes --show-progress=dots

project-cs-fix:
	$(S) exec laravel.test php ./vendor/bin/php-cs-fixer fix -vvv --config=.php-cs-fixer.php --allow-risky=yes --show-progress=dots

project-analyze:
	$(S) exec laravel.test php ./vendor/bin/phpstan analyse --configuration=phpstan.neon.dist --memory-limit=1G

project-test:
	$(S) exec laravel.test php ./vendor/bin/phpunit

check: project-cs-check project-analyze
fix: project-cs-fix project-analyze

# 🔁 Кэш
cache-clear:
	$(S) artisan config:clear && \
	$(S) artisan cache:clear && \
	$(S) artisan route:clear && \
	$(S) artisan view:clear
