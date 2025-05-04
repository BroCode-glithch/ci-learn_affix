<?php

use Blog\BlogController;
use Admin\AdminAuthController;
use Newsletter\NewsletterController;
use CodeIgniter\Router\RouteCollection;

use App\Controllers\About\AboutController;
use App\Controllers\Admin\AdminController;
use App\Controllers\Payment\CoursePayment;
use App\Controllers\Courses\CourseController;
use App\Controllers\Admin\BlogAdminController;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

// $routes->get('/courses', 'Courses\CourseController::index');

// service('auth')->routes($routes);

// $routes->get('course/(:num)', 'Courses\CourseController::show/$1');
// $routes->get('courses/course-category/(:any)', 'Courses\CourseController::category/$1');
// $routes->get('courses/categories', 'Courses\CourseController::categories');

// $routes->get('/about', 'About\AboutController::index');
// $routes->get('courses/all-categories', 'Courses\CourseController::allCategories');

// $routes->get('course/(:num)', 'Payment\CoursePayment::course/$1');
// $routes->post('payment/coursepayment/pay', 'Payment\CoursePayment::pay');
// $routes->get('payment/coursepayment/callback', 'Payment\CoursePayment::callback');


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
service('auth')->routes($routes);

$routes->get('fetch-thumbnail', 'Courses\CourseThumbnail::fetch');
$routes->get('update-thumbnail', 'Courses\CourseThumbnail::updateThumbnail');
$routes->get('/courses', 'Courses\CourseController::index');
$routes->get('course/(:num)', 'Courses\CourseController::show/$1'); // ✅ Show course details
$routes->get('courses/course-category/(:any)', 'Courses\CourseController::category/$1');
$routes->get('courses/all-categories', 'Courses\CourseController::allCategories');

$routes->get('/about', 'About\AboutController::index');

// ✅ NEW: Checkout Route (before payment)
$routes->get('checkout', 'Payment\CoursePayment::checkout'); 

// ✅ Payment Routes
$routes->get('course/(:num)', 'Payment\CoursePayment::course/$1');
$routes->post('payment/process', 'Payment\CoursePayment::processPayment'); // ✅ Add this
$routes->post('payment/coursepayment/pay', 'Payment\CoursePayment::pay');
$routes->get('payment/coursepayment/callback', 'Payment\CoursePayment::callback');
// Route to handle Paystack integration
$routes->post('/payment/paystack', 'Payment\CoursePayment::paystack');
// For PayPal (if needed)
$routes->get('/payment/paypal', 'Payment\CoursePayment::paypal');
$routes->get('payment/callback', 'Payment\CoursePayment::callback');

$routes->get('/blog', 'Blog\BlogController::index');
$routes->get('/blog/(:segment)', 'BlogController::detail/$1');

// Newsletter Route:
$routes->post('subscribe', 'Newsletter\NewsletterController::subscribe');

$routes->get('unlock/(:num)', 'Courses\CourseController::unlock/$1');
 



// Admin
// $routes->get('/admin/login', 'Admin\AdminController::loginShow');
// $routes->get('/admin/register', 'Admin\AdminController::registerShow');
// $routes->get('/admin/dashboard', 'Admin\AdminController::index');
// $routes->get('/admin/users/', 'Admin\AdminController::user');
// $routes->get('/admin/settings/', 'Admin\AdminController::settings');

// Admin login & register routes
$routes->get('admin/login', 'Admin\AdminAuthController::login');
$routes->post('admin/login', 'Admin\AdminAuthController::loginPost');
$routes->get('admin/register', 'Admin\AdminAuthController::register');
$routes->post('admin/register', 'Admin\AdminAuthController::registerPost');
$routes->get('admin/logout', 'Admin\AdminAuthController::logout');

$routes->group('admin', ['filter' => 'adminAuth'], function($routes) {

    // Admin dashboard
    $routes->get('dashboard', 'Admin\AdminController::index');
    
    // Blog routes
    $routes->get('blog', 'Admin\BlogAdminController::index');
    $routes->get('blog/create', 'Admin\BlogAdminController::create');
    $routes->post('blog/store', 'Admin\BlogAdminController::store');
    $routes->get('blog/edit/(:num)', 'Admin\BlogAdminController::edit/$1');
    $routes->post('blog/update/(:num)', 'Admin\BlogAdminController::update/$1');
    $routes->get('blog/delete/(:num)', 'Admin\BlogAdminController::delete/$1');
    
    // Blog category routes (inside admin group)
    $routes->get('blog/category', 'Admin\BlogCategoryController::index');
    $routes->get('blog/category/create', 'Admin\BlogCategoryController::create');
    $routes->post('blog/category/store', 'Admin\BlogCategoryController::store');
    $routes->get('blog/category/edit/(:num)', 'Admin\BlogCategoryController::edit/$1');
    $routes->get('blog/category/delete/(:num)', 'Admin\BlogCategoryController::delete/$1');

    // Admin Blog Tag Routes
    $routes->get('blog/tag', 'Admin\BlogTagController::index');
    $routes->get('blog/tag/create', 'Admin\BlogTagController::create');
    $routes->post('blog/tag/store', 'Admin\BlogTagController::store');
    $routes->get('blog/tag/edit/(:num)', 'Admin\BlogTagController::edit/$1');
    $routes->get('blog/tag/delete/(:num)', 'Admin\BlogTagController::delete/$1');
});


$routes->get('user/profile', 'User\UserController::profile');
$routes->match(['GET', 'POST'], 'user/edit', 'User\UserController::editProfile');
