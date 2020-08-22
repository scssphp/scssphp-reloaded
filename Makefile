phpcs:
	vendor/bin/phpcs -s --extensions=php bin src tests *.php

phpunit:
	vendor/bin/phpunit --colors tests
