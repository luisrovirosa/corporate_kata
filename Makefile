.PHONY: test install all

all: install test

install:
	./php composer.phar install

test:
	./php vendor/bin/phpunit

fixer:
	docker-compose run --rm php vendor/bin/php-cs-fixer fix

phpstan:
	docker-compose run --rm php php -d memory_limit=1G vendor/bin/phpstan analyse -c .phpstan.neon --debug --level 8 src tests
