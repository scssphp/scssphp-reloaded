<?php

if (version_compare(PHP_VERSION, '5.6') < 0) {
    throw new \Exception('scssphp2 requires PHP 5.6 or above');
}

if (! class_exists('Sass\Version', false)) {
    include_once __DIR__ . '/src/Sass/Version.php';
    include_once __DIR__ . '/src/ScssPhp/Path/Path.php';
    include_once __DIR__ . '/src/Sass/Syntax.php';
}
