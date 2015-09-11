cs: lint
	./vendor/bin/phpcbf --standard=PSR2 src tests
	./vendor/bin/phpcs --standard=PSR2 --warning-severity=0 src tests

lint:
	find src/ tests/ -name "*.php" -exec php -l {} \;

test:
	./vendor/bin/phpunit

coverage:
	./vendor/bin/phpunit --coverage-html=coverage

clean:
	rm -rf coverage
