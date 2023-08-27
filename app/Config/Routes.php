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
$routes->setDefaultController('Login');
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
$routes->get('/', 'Home::index');

$routes->get('registration', 'Registration::index');
$routes->post('registration/store', 'Registration::store');

$routes->get('email-verification', 'EmailVerification::verifyEmailRegistration');
$routes->get('email-verification/resend', 'EmailVerification::viewResendEmailVerification');
$routes->post('email-verification/resend', 'EmailVerification::resendEmailVerification');

$routes->get('login', 'Login::index');
$routes->post('login/authenticate', 'Login::authenticate');

$routes->post('logout', 'Logout::index');

$routes->get('forgot-password', 'ForgotPassword::index');
$routes->post('forgot-password/reset-password', 'ForgotPassword::resetPassword');
$routes->get('reset-password', 'EmailVerification::VerifyEmailForgotPassword');

$routes->get('change-password', 'ChangePassword::index');
$routes->post('change-password/update-forgot-password', 'ChangePassword::updateForgotPassword');

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
