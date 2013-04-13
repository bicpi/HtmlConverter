<?php

/**
 * This is bootstrap for phpUnit unit tests,
 * use README.md for more details
 */

if (!class_exists('PHPUnit_Framework_TestCase') ||
    version_compare(PHPUnit_Runner_Version::id(), '3.5') < 0
) {
    die('PHPUnit framework is required, at least 3.5 version');
}
$baseDir = dirname(__DIR__);

$loader = require __DIR__.'/../vendor/autoload.php';
