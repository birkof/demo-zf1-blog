<?php

// Define path to application directory
defined('APP_PATH')
|| define('APP_PATH', realpath(dirname(__FILE__) . '/../app'));

// Define application environment
defined('APP_ENV')
|| define('APP_ENV', (getenv('APP_ENV') ? getenv('APP_ENV') : 'production'));

/** Composer autoloader */
if (!file_exists(realpath(APP_PATH . '/../vendor/autoload.php'))) {
    exit('<h1>CRITICAL ERROR!</h1><p>Please run <strong style="color: lightseagreen"><em>composer install</em></strong> to install all the application dependencies.</p>');
}
require realpath(APP_PATH . '/../vendor/autoload.php');

/** Zend_Application */
if (stripos(get_include_path(), 'zendframework') === false) {
    exit('<h1>CRITICAL ERROR!</h1><h3>Zend Framework is not installed or not installed properly!</h3><p>Please run command <strong style="color: lightseagreen"><em>composer install</em></strong> to install it.</p>');
}
require 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APP_ENV,
    APP_PATH . '/configs/application.ini'
);

// Let's cross the fingers :-D
$application->bootstrap()
    ->run();
