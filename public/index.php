<?php

if (PHP_VERSION < 8) {
    die('необходима php >= 8');
}
require_once dirname(__DIR__) . '/config/init.php';
require_once HELPERS . '/functions.php';
require_once CONFIG . '/routes.php';
new \wfm\App();

//var_dump(\wfm\App::$app->getProperties());
//\wfm\App::$app->setProperty('test', 'val-test');
//echo \wfm\App::$app->getProperty('site_name') . '  ';
//echo \wfm\App::$app->getProperty('test');
//throw new Exception('Какая то ошибка!', 404); //генерируем ошибку
//echo $test;
//echo 'Hello';

//debug(\wfm\Router::getRoutes());
