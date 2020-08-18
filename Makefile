phpcs:
	vendor/bin/phpcs --standard=PSR12 --extensions=php bin src tests *.php

phpunit:
	vendor/bin/phpunit --colors tests
