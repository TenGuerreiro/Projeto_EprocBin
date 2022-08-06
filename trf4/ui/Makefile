build-prod-remove-dev-deps: build-dev build-prod js-remove-dev-deps
build-dev: build-pre php-build-dev js-build-dev build-pos
build-prod: build-pre php-build-prod js-build-prod


php-build-prod:
	composer install
	composer install --optimize-autoloader --no-interaction --no-dev --no-ansi --no-progress --no-scripts -d lib
	composer install --optimize-autoloader --no-interaction --no-dev --no-ansi --no-progress --no-scripts -d showcase
	composer run update-php-assets -d showcase

build-pre:
	@if [ ! -e showcase/.env ]; then \
    	echo "Criando showcase/.env..."; \
    	cp showcase/.env.example showcase/.env ; \
    	echo ".env ok"; \
	fi;


build-pos:
	php showcase/artisan key:generate

verify: lint phpcpd

js-build-dev:
	npm install
	(cd showcase && npm install)
	(cd showcase && npm run dev)

js-build-prod:
	(cd showcase && npm install)
	(cd showcase && npm run prod)

php-build-dev:
	phive install --trust-gpg-keys 31C7E470E2138192,4AA394086372C20A
	composer install
	composer install -d lib
	composer install -d showcase
	composer run update-php-assets -d showcase

phpcpd:
	 php tools/phpcpd --fuzzy lib/src --min-tokens 20 -vvv

lint:
	php showcase/vendor/overtrue/phplint/bin/phplint

lint-local:
	find lib/src tests showcase -type f -name '*.php' -print0 | xargs -0 -n1 -P4 php -l -n | (! grep -v "No syntax errors detected"

js-remove-dev-deps:
	rm -R showcase/node_modules/

js-watch:
	(cd showcase && npm run watch)

test:
	php vendor/bin/phpunit \
		--testsuite Unit \
		--coverage-text \
		--colors=never

test-functional:
	php showcase/artisan dusk

test-with-coverage:
	php vendor/bin/phpunit \
		--prepend "tests/xdebug-filter.php" \
		-c phpunit.xml \
		--testsuite Unit \
		--coverage-text \
		--coverage-html "tests/_reports/coverage" \
		--colors=never
