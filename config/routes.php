<?php

use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;


Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true,
    ]));

    $routes->prefix('login', function ($routes) {
        $routes->applyMiddleware('csrf');
    });

    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);

    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

   
    $routes->fallbacks(DashedRoute::class);
});



