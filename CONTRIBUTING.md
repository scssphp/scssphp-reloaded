Want to contribute? Great! First, read this page.

## Before You Contribute

As a derivative of `dart-sass`, you must sign the [Google Individual Contributor
License Agreement][cla] (CLA).

[cla]: https://cla.developers.google.com/about/google-individual

## Development Dependencies

1. PHP 5.6 or above

2. In this repository, run `composer install`. This will install all of the
   `vendor/` dependencies.

## Writing Code

ScssPhp2 follows the PHP Standards [PSR-1 Basic Coding Standard][psr1], [PSR-4 Autoloading Standard][psr4], [PSR-12 Extended Coding Style Guide][psr12],
and draft [PSR-19 PHPDoc tags][psr19].

[psr1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[psr4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-meta.md
[psr12]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-12-extended-coding-style-guide.md
[psr19]: https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md

To facilitate maintenance, the source code structures are similar. In addition,
we use a small compatibility library to emulate a subset of various Dart platform
packages. Lastly, there may be deviations for performance, error handling,
testability, or self-imposed constraints (such as object calisthenics, SOLID,
Clean Code, etc).

Before you send a pull request, we recommend you run the following steps:

* `make phpcs` will run the code sniffer for PSR-12

* `make phpunit` will run unit tests and sass-spec compatibility tests

### Synchronizing

ScssPhp2 does not support the asynchronous mode of operation (at this time).

### File Headers

All source files in the project must start with one of the following headers:

```php
<?php
/**
 * @copyright 2020 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 */
namespace Sass;
```

or
```php
<?php
/**
 * @copyright 2020 Anthon Pang
 * @license https://opensource.org/licenses/MIT MIT
 */
namespace ScssPhp;
```
