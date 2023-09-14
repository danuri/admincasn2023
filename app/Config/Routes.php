<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('auth', 'Auth::index');
$routes->get('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('auth/callback', 'Auth::callback');

$routes->get('/', 'Home::index',['filter' => 'auth']);
$routes->get('formasi', 'Formasi::index',['filter' => 'auth']);

$routes->group("download", ["filter" => "auth"], function ($routes) {
    $routes->get('', 'Download::index');
});

$routes->group("upload", ["filter" => "auth"], function ($routes) {
    $routes->get('', 'Upload::index');
});

$routes->group("pengaturan", ["filter" => "auth"], function ($routes) {
    $routes->get('formasi', 'Pengaturan\Formasi::index');
    $routes->post('formasi/saveporsi', 'Pengaturan\Formasi::saveporsi');
});
