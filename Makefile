.PHONY: test install all

all: install test

install:
	./php composer.phar install

test:
	./php vendor/bin/phpunit
