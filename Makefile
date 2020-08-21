phpcs:
	vendor/bin/phpcs --standard=phpcs.xml.dist --extensions=php bin src tests *.php

phpunit:
	vendor/bin/phpunit --colors tests
