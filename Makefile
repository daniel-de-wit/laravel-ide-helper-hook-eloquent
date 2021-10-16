build:
	@docker-compose build --pull --no-cache

setup:
	@docker-compose run --rm app sh -c "composer install"

.PHONY: app
app:
	@docker-compose run --rm app sh

analyze:
	@docker-compose run --rm analyze

style:
	@docker-compose run --rm style fix --dry-run --diff .

test:
	@docker-compose run --rm app sh -c "php ./vendor/bin/phpunit"
