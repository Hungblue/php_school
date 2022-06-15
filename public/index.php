<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
// error_reporting(E_ALL);
// set_error_handler('Core\Error::errorHandler');
// set_exception_handler('Core\Error::exceptionHandler');


/**
 * Sessions
 */
session_start();


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('login', ['controller' => 'Login', 'action' => 'new']);
$router->add('logout', ['controller' => 'Login', 'action' => 'destroy']);
$router->add('password/reset/{token:[\da-f]+}', ['controller' => 'Password', 'action' => 'reset']);
$router->add('signup/activate/{token:[\da-f]+}', ['controller' => 'Signup', 'action' => 'activate']);

$router->add('admin/dashboard', ['controller' => 'Admin\Home', 'action' => 'index']);
$router->add('admin/statistical', ['controller' => 'Admin\Statistical', 'action' => 'index']);

//Category
$router->add('admin/category', ['controller' => 'Admin\CategoryController', 'action' => 'index']);
$router->add('admin/add-category', ['controller' => 'Admin\CategoryController', 'action' => 'add']);
$router->add('admin/insert-category', ['controller' => 'Admin\CategoryController', 'action' => 'insert']);
$router->add('admin/edit-category/{id:\d+}', ['controller' => 'Admin\CategoryController', 'action' => 'edit']);
// $router->add('admin/update-category/{id}', ['controller' => 'Admin\CategoryController', 'action' => 'update']);
$router->add('admin/delete-category/{id:\d+}', ['controller' => 'Admin\CategoryController', 'action' => 'delete']);

//Product
$router->add('admin/product', ['controller' => 'Admin\ProductController', 'action' => 'index']);
$router->add('admin/add-product', ['controller' => 'Admin\ProductController', 'action' => 'add']);
$router->add('admin/insert-product', ['controller' => 'Admin\ProductController', 'action' => 'insert']);
$router->add('admin/edit-product', ['controller' => 'Admin\ProductController', 'action' => 'edit']);
$router->add('admin/update-product/{id}', ['controller' => 'Admin\ProductController', 'action' => 'update']);
$router->add('admin/delete-product/{id}', ['controller' => 'Admin\ProductController', 'action' => 'delete']);

//User
$router->add('admin/user', ['controller' => 'Admin\UserController', 'action' => 'index']);
$router->add('admin/view-user/{id}', ['controller' => 'Admin\UserController', 'action' => 'view']);

//Order
$router->add('admin/order', ['controller' => 'Admin\OrderController', 'action' => 'index']);
$router->add('admin/view-order', ['controller' => 'Admin\OrderController', 'action' => 'view']);
$router->add('admin/update-order', ['controller' => 'Admin\OrderController', 'action' => 'update']);
$router->add('admin/history-order', ['controller' => 'Admin\OrderController', 'action' => 'history']);

/***************************Frontend */

$router->add('home', ['controller' => 'Frontend\HomeController', 'action' => 'index']);



$router->add('{controller}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);