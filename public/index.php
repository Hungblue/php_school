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
$router->add('admin/delete-category/{id:\d+}', ['controller' => 'Admin\CategoryController', 'action' => 'delete']);

//Product
$router->add('admin/product', ['controller' => 'Admin\ProductController', 'action' => 'index']);
$router->add('admin/add-product', ['controller' => 'Admin\ProductController', 'action' => 'add']);
$router->add('admin/edit-product/{id:\d+}', ['controller' => 'Admin\ProductController', 'action' => 'edit']);
$router->add('admin/delete-product/{id:\d+}', ['controller' => 'Admin\ProductController', 'action' => 'delete']);

//User
$router->add('admin/user', ['controller' => 'Admin\UserController', 'action' => 'index']);
$router->add('admin/view-user/{id:\d+}', ['controller' => 'Admin\UserController', 'action' => 'view']);

//Order
$router->add('admin/order', ['controller' => 'Admin\OrderController', 'action' => 'index']);
$router->add('admin/view-order', ['controller' => 'Admin\OrderController', 'action' => 'view']);
$router->add('admin/update-order', ['controller' => 'Admin\OrderController', 'action' => 'update']);
$router->add('admin/history-order', ['controller' => 'Admin\OrderController', 'action' => 'history']);

/***************************Frontend */

$router->add('home', ['controller' => 'Frontend\HomeController', 'action' => 'index']);
//$router->add('view-category/{slug}', ['controller' => 'Frontend\HomeController', 'action' => 'index']);
$router->add('product/{id:\d+}', ['controller' => 'Frontend\HomeController', 'action' => 'viewProduct']);
$router->add('add-rating', ['controller' => 'Frontend\ReviewProductController', 'action' => 'insert']);

$router->add('add-comment/{id:\d+}', ['controller' => 'Frontend\CommentProductController', 'action' => 'add']);
$router->add('add-comment', ['controller' => 'Frontend\CommentProductController', 'action' => 'insert']);
$router->add('edit-comment/{id:\d+}', ['controller' => 'Frontend\CommentProductController', 'action' => 'edit']);
$router->add('update-comment', ['controller' => 'Frontend\CommentProductController', 'action' => 'update']);


$router->add('cart', ['controller' => 'Frontend\CartController', 'action' => 'view']);

$router->add('checkout', ['controller' => 'Frontend\CheckoutController', 'action' => 'index']);
//$router->add('cart', ['controller' => 'Frontend\CartController', 'action' => 'view']);

//   Route::get('checkout', [CheckoutController::class, 'index']);
//   Route::post('place-order', [CheckoutController::class, 'placeOrder']);

//   Route::get('cart', [CartController::class, 'viewcart']);
//   Route::get('checkout', [CheckoutController::class, 'index']);
//   Route::post('place-order', [CheckoutController::class, 'placeOrder']);

//   Route::post('add-to-cart', [CartController::class, 'addProduct']);
//   Route::post('delete-cart-item', [CartController::class, 'deleteProduct']);
//   Route::post('update-cart', [CartController::class, 'updateCart']);

//laravel routes
// Route::get('/', [FrontendController::class, 'index']);
// Route::get('/home', [FrontendController::class, 'index']);
// Route::get('/view-category/{slug}', [FrontendController::class, 'viewcategory']);
// Route::get('/category/{category_slug}/{product_slug}', [FrontendController::class, 'viewproduct']);
// Route::get('/search', [FrontendController::class, 'search']);
// Route::get('/search_category', [FrontendController::class, 'search_category']);

// Route::get('/contact', [ContactController::class, 'index']);


// Auth::routes();

//   Route::get('/load-cart-data', [CartController::class, 'cartcount']);
//   Route::get('/load-wishlist-data', [WishListController::class, 'wishlistcount']);


//   Route::post('add-to-cart', [CartController::class, 'addProduct']);
//   Route::post('delete-cart-item', [CartController::class, 'deleteProduct']);
//   Route::post('update-cart', [CartController::class, 'updateCart']);

//   Route::post('add-to-wishlist', [WishListController::class, 'add']);
//   Route::post('delete-wishlist-item', [WishListController::class, 'deleteitem']);


// Route::middleware(['auth'])->group(function () {
//   Route::get('cart', [CartController::class, 'viewcart']);
//   Route::get('checkout', [CheckoutController::class, 'index']);
//   Route::post('place-order', [CheckoutController::class, 'placeOrder']);

//   Route::get('my-orders', [UserController::class, 'index']);
//   Route::get('view-order/{id}', [UserController::class, 'view']);
//   Route::get('profile', [UserController::class, 'profile']);
//   Route::put('update-profile', [UserController::class, 'update']);

//   Route::get('wishlist', [WishListController::class, 'index']);
//   Route::get('add-to-wishlist', [WishListController::class, 'add']);

//   Route::post('add-rating', [RatingController::class, 'add']);

//   Route::get('add-review/{product_slug}/userreview', [ReviewController::class, 'add']);
//   Route::post('add-review', [ReviewController::class, 'create']);
//   Route::get('edit-review/{product_slug}/userreview', [ReviewController::class, 'edit']);
//   Route::put('update-review', [ReviewController::class, 'update']);

//   Route::post('proceed-to-pay', [CheckoutController::class, 'razorpaycheck']);
//   Route::post('payment/vnpay', [CheckoutController::class, 'create_payment']);
//   Route::post('payment/vnpay_payment', [CheckoutController::class, 'vnpay_payment']);
//   Route::get('vnpay/save_order/{order_id}', [CheckoutController::class, 'save_order']);
//   Route::get('vnpay/return', [CheckoutController::class, 'vnpay_return']);


//   Route::get('send-mail', [MailController::class, 'sendEmail']);
//   Route::post('info-send-mail', [MailController::class, 'info_mail']);



$router->add('{controller}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);