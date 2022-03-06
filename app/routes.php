<?php

$router = new Core\Router;

$router->add('/', ['controller' => 'home']);
$router->add('/some', ['controller' => 'home', 'action' => 'back']);

// $router->add("{controller}/{action}");
$router->start($_SERVER['REQUEST_URI']);
