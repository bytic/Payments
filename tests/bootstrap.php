<?php

define('PROJECT_BASE_PATH', __DIR__ . '/..');
define('TEST_BASE_PATH', __DIR__);
define('TEST_FIXTURE_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'fixtures');


if (file_exists(__DIR__.DIRECTORY_SEPARATOR.'.env')) {
    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();
}


require dirname(__DIR__) . '/vendor/autoload.php';