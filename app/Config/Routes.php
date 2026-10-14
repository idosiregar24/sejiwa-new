<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Routes Untuk AuthController
$routes->get('/', 'UserController::dashboard');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::register');
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('verify', 'AuthController::verifyOtp');
$routes->post('verify', 'AuthController::verifyOtp');
$routes->get('verifyOtp', 'AuthController::verifyOtp');
$routes->post('verifyOtp', 'AuthController::verifyOtp');
$routes->get('logout', 'AuthController::logout');
$routes->post('logout', 'AuthController::logout');
$routes->get('resendVerification', 'AuthController::resendVerification');
$routes->post('resendVerification', 'AuthController::resendVerification');

//Routes Untuk UserController
$routes->get('dashboard', 'UserController::dashboard');
$routes->post('dashboard', 'UserController::dashboard');

$routes->get('about', 'UserController::about');
$routes->post('about', 'UserController::about');

$routes->get('artikel', 'UserController::artikel');
$routes->post('artikel', 'UserController::artikel');

$routes->get('user_management', 'UserController::index');
$routes->get('user/addForm', 'UserController::addForm');
$routes->post('/user/store', 'UserController::store');
$routes->get('/user/delete/(:num)', 'UserController::delete/$1');
$routes->get('user/editForm/(:num)', 'UserController::editForm/$1');
$routes->post('user/update/(:num)', 'UserController::update/$1');

//Routes Untuk AdminControllers
$routes->get('dashboard_admin', 'AdminController::dashboard_admin');
$routes->post('dashboard_admin', 'AdminController::dashboard_admin');
 
$routes->get('content-management', 'ContentController::index');
$routes->post('content-management', 'ContentController::index');

$routes->get('forum-management', 'forumController::index');
$routes->post('forum-management', 'forumController::index');

//Routes untuk ContentController
$routes->get('content/content_form', 'ContentController::create');
$routes->post('content/content_form', 'ContentController::create');
$routes->post('content/store', 'ContentController::store');

$routes->get('content/delete/(:num)', 'ContentController::delete/$1');
$routes->post('content/delete/(:num)', 'ContentController::delete/$1');

$routes->get('content/edit/(:num)', 'ContentController::edit/$1');
$routes->post('content/edit/(:num)', 'ContentController::edit/$1');

$routes->get('content/update/(:num)', 'ContentController::update/$1');
$routes->post('content/update/(:num)', 'ContentController::update/$1');

$routes->get('content/view/(:num)', 'ContentController::view/$1');
$routes->post('content/comment/(:num)', 'ContentController::comment/$1');
$routes->post('content/like/(:num)', 'ContentController::like/$1');
$routes->get('videos', 'ContentController::daftarVideos');


// Routes untuk ProfileController
$routes->get('profile', 'ProfileController::index');
$routes->get('profile/edit', 'ProfileController::edit');
$routes->post('profile/update', 'ProfileController::update');
$routes->post('profile/updatePhoto', 'ProfileController::updatePhoto');

//Routes Like dan Comment
$routes->get('content/like/(:num)', 'ContentController::like/$1');

//Routes Upload chunk
$routes->post('upload_chunk', 'Upload::upload_chunk');
$routes->get('content/like/(:num)', 'ContentController::like/$1');

