<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/testdatabaseconnection', 'TestDatabaseConnection::index');


//  Group admin
// $routes->group('admin', function($routes){
//     $routes->get('users','Admin\Users::index');
// });

$routes->group('admin',function($routes){
    // $routes->get('/', 'Admin\Admin::index');
    $routes->get('users', 'Admin\Users::index');

});