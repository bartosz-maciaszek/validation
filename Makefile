cs: lint
	./vendor/bin/phpcbf --standard=PSR2 src tests
	./vendor/bin/phpcs --standard=PSR2 --warning-severity=0 src tests

lint:
	find src/ tests/ -name "*.php" -exec php -l {} \;

test:
	./vendor/bin/phpunit

coveralls:
	./vendor/bin/coveralls -v

deps:
	composer install

coverage:
	./vendor/bin/phpunit --coverage-html=build/logs/coverage

clean:
	rm -rf coverage

.PHONY: cs lint test coveralls deps coverage clean
