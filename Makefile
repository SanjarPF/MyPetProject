SHELL := /bin/bash
S := ./vendor/bin/sail

init: sail-up composer-install migrate

sail-up:
	$(S) up -d
sail-down:
	$(S) down
sail-restart:
	$(S) down && $(S) up -d
sail-build:
	$(S) build --no-cache
composer-install:
	$(S) composer install
composer-update:
	$(S) composer update
composer:
	$(S) composer $(name)

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

project-cs-check:
	$(S) exec laravel.test php ./vendor/bin/php-cs-fixer fix -vvv --dry-run --config=.php-cs-fixer.php --allow-risky=yes --show-progress=dots
project-cs-fix:
	$(S) exec laravel.test php ./vendor/bin/php-cs-fixer fix -vvv --config=.php-cs-fixer.php --allow-risky=yes --show-progress=dots
project-analyze:
	$(S) exec laravel.test php ./vendor/bin/phpstan analyse --configuration=phpstan.neon.dist --memory-limit=1G
project-test:
	$(S) exec laravel.test php ./vendor/bin/phpunit

reset:
	$(S) artisan migrate:fresh --seed
horizon:
	$(S) artisan horizon
rabbitmq:
	$(S) artisan queue:work rabbitmq
dispatch-welcome:
	$(S) artisan tinker --execute="dispatch(new \App\Ship\Jobs\SendWelcomeEmailJob(\App\Models\User::first()));"
token:
	$(S) artisan tinker --execute="echo \App\Models\User::first()->createToken('demo')->plainTextToken;"


check: project-cs-check project-analyze
fix: project-cs-fix project-analyze

cache-clear:
	$(S) artisan config:clear && \
	$(S) artisan cache:clear && \
	$(S) artisan route:clear && \
	$(S) artisan view:clear
