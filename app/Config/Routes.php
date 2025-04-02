<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Courses\CourseController;
use App\Controllers\About\AboutController;

use App\Controllers\Payment\CoursePayment;

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

