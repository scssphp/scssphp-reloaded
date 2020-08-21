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

Aside from file and class naming conventions, the source code structures should
be similar to facilitate ongoing maintenance. To aid in porting, a subset of the
Dart SDK and packages also exists to emulate the platform.

However, there may be deviations from the above guidelines to address issues
with performance, error handling, or testability.

Before you send a pull request, we recommend you run the following steps:

* `make phpcs` will run the code sniffer for PSR-12

* `make phpunit` will run unit tests and sass-spec compatibility tests

### Synchronizing

ScssPhp2 does not support the asynchronous mode of operation (at this time).

### File Headers

All source files in the project must start with an appropriate file header.

For files ported from `dart-sass`:
```php
<?php

/**
 * @copyright 2020 Google Inc.
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Sass;
```

For files ported from `dart-lang`:
```php
<?php

/**
 * @copyright 2014 Dart project authors
 * @license https://opensource.org/licenses/BSD-3-Clause BSD
 */

namespace DartLang;
```

For `scssphp` specific support files:
```php
<?php

/**
 * @copyright 2020 Anthon Pang
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace ScssPhp;
```
