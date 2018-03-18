<?php
include __DIR__ . '/../vendor/autoload.php'; // composer autoload

if (!defined('HHVM_VERSION')) {
    $kernel = \AspectMock\Kernel::getInstance();
    $kernel->init([
        'debug' => true,
        'cacheDir' => __DIR__ . '/../.cache',
        'includePaths' => [__DIR__ . '/../src']
    ]);
}
