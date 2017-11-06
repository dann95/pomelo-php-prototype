<?php

require_once '../vendor/autoload.php';

$configsDir = realpath('../configs/');
Pomelo\Config\Loader::load($configsDir);

$app = \Pomelo\ApplicationFactory::instance();

foreach (\Pomelo\Config\Config::get('application.routes.files') as $file) {
    require $file;
}

$app->handleHttpRequest();

return $app;