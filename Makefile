phpcs:
	vendor/bin/phpcs --extensions=php bin src tests *.php

phpunit:
	vendor/bin/phpunit --colors tests
