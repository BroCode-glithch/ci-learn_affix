<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Courses\CourseController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/courses', 'Courses\CourseController::index');

service('auth')->routes($routes);

$routes->get('course/(:num)', 'Courses\CourseController::show/$1');
