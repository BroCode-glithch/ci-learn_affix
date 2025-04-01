<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Courses\CourseController;
use App\Controllers\About\AboutController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/courses', 'Courses\CourseController::index');

service('auth')->routes($routes);

$routes->get('course/(:num)', 'Courses\CourseController::show/$1');
$routes->get('courses/course-category/(:any)', 'Courses\CourseController::category/$1');
$routes->get('courses/categories', 'Courses\CourseController::categories');

$routes->get('/about', 'About\AboutController::index');
$routes->get('courses/all-categories', 'Courses\CourseController::allCategories');