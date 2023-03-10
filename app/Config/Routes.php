<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('DashboardController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Route without login
$routes->get('/login', 'LoginController::index', ['filter' => 'userGuard']);
$routes->get('/register', 'RegisterController::index', ['filter' => 'userGuard']);

// Route with login
$routes->get('/', 'DashboardController::index', ['filter' => 'authGuard']);
$routes->get('/pay-electricity', 'PayElectricityController::index', ['filter' => 'customerGuard']);

// Route with login admin
$routes->get('/manage-admin', 'AdminController::manageAdmin', ['filter' => 'adminGuard']);
$routes->get('/manage-customer', 'CustomerController::index', ['filter' => 'adminGuard']);
$routes->get('/verification-and-validation', 'VerifValidationController::index', ['filter' => 'adminGuard']);
$routes->get('/verification-and-validation/(:any)', 'VerifValidationController::viewVerif/$1', ['filter' => 'adminGuard']);
$routes->get('/generate-report', 'GenerateReportController::index', ['filter' => 'adminGuard']);
$routes->get('/user-non-active', 'CustomerController::notActiveUser', ['filter' => 'adminGuard']);

// stytem route
// global
$routes->post('/login', 'LoginController::login');
$routes->post('/logout', 'LoginController::logout');
$routes->post('/register', 'RegisterController::addCustomer');

// admin
$routes->post('/', 'DashboardController::genUses');
$routes->post('/manage-admin', 'AdminController::addAdmin');
$routes->post('/manage-customer', 'RegisterController::addCustomer');
$routes->post('/update-customer/(:any)', 'CustomerController::updateCustomer/$1');
$routes->post('/update-status-payment/(:any)', 'VerifValidationController::updatePayment/$1');
$routes->post('/reject-status-payment/(:any)', 'VerifValidationController::rejectPayment/$1');
$routes->post('/generate-report', 'GenerateReportController::pdf');
$routes->post('/delete-customer/(:any)', 'CustomerController::delete/$1');
$routes->post('/activate-customer/(:any)', 'CustomerController::activate/$1');

// customer
$routes->post('/pay-electricity', 'PayElectricityController::pay');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
