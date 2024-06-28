<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/comic/search', 'Home::search');
$routes->get('/comic/detail/(:segment)', 'Home::detail/$1');
$routes->get('/comic/add', 'Home::add');
$routes->post('/comic/create', 'Home::create');
$routes->post('/comic/update/(:num)', 'Home::update/$1');
$routes->post('/comic/delete/(:segment)', 'Home::delete/$1');
$routes->get('/comic/edit/(:segment)', 'Home::edit/$1');
