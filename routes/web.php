<?php

$router = \Pomelo\ApplicationFactory::instance()->router();

$router->get('/', function (){
    return "Olá mundo!";
});

$router->get('/teytey/:id/hehe', function (){
   return "Hua hua";
});