<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('auth/login', 'Auth::login');
$routes->post('auth/attempt', 'Auth::attemptLogin');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('admin/dashboard', 'Admin::index');

$routes->get('admin/portfolio', 'Admin::portfolioIndex');
$routes->get('admin/portfolio/create', 'Admin::portfolioCreate');
$routes->post('admin/portfolio/store', 'Admin::portfolioStore');
$routes->get('admin/portfolio/edit/(:num)', 'Admin::portfolioEdit/$1');
$routes->post('admin/portfolio/update/(:num)', 'Admin::portfolioUpdate/$1');
$routes->get('admin/portfolio/toggle/(:num)', 'Admin::portfolioToggle/$1');
$routes->get('admin/portfolio/delete/(:num)', 'Admin::portfolioDelete/$1');
$routes->get('admin/settings', 'Admin::settingsIndex');
$routes->post('admin/settings/update', 'Admin::settingsUpdate');
