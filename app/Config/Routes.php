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
$routes->get('regulasi', 'Regulasi::index',['filter' => 'auth']);
$routes->get('pelamar', 'Pelamar::index',['filter' => 'auth']);
$routes->get('formasi', 'Formasi::index',['filter' => 'auth']);

$routes->group("api", function ($routes) {
    $routes->get('sanggah/(:any)/(:any)/(:num)', 'Api::sanggah/$1/$2/$3');
    $routes->get('whatsapp', 'Api::whatsapp');
});

$routes->group("siasn", function ($routes) {
    $routes->get('role', 'Siasn::role');
});

$routes->group("downloads", ["filter" => "auth"], function ($routes) {
    $routes->get('', 'Download::index');
    $routes->get('pelamar', 'Download::pelamar');
    $routes->get('sanggah', 'Download::sanggah');
    $routes->get('jadwalskd', 'Download::jadwalskd');
    $routes->get('jadwalsk', 'Download::jadwalsk');
    $routes->get('jadwalsksatker', 'Download::jadwalsksatker');
});

$routes->group("upload", ["filter" => "auth"], function ($routes) {
    $routes->get('', 'Upload::index');
    $routes->post('save', 'Upload::save');
});

$routes->group("pengaturan", ["filter" => "auth"], function ($routes) {
    $routes->get('formasi', 'Pengaturan\Formasi::index');
    $routes->post('formasi/saveporsi', 'Pengaturan\Formasi::saveporsi');
    $routes->post('formasi/final', 'Pengaturan\Formasi::final');
});

$routes->group("verifikasi", ["filter" => "auth"], function ($routes) {
    $routes->get('thk2', 'Verifikasi::thk2');
    $routes->post('thk2', 'Verifikasi::searchthk2');
    $routes->get('nonasn', 'Verifikasi::nonasn');
    $routes->post('nonasn', 'Verifikasi::searchnonasn');
});

$routes->group("sktt", ["filter" => "auth"], function ($routes) {
    $routes->get('lokasi', 'Sktt::lokasi');
    $routes->post('lokasi', 'Sktt::inserttilok');
    $routes->get('edit/(:any)', 'Sktt::edit/$1');
    $routes->post('edittilok', 'Sktt::edittilok');
    $routes->get('delete/(:any)', 'Sktt::deletetilok/$1');
});

$routes->group("admin", ["filter" => "admin"], function ($routes) {

  $routes->group("users", function ($routes) {
      $routes->get('', 'Admin\Users::index');
  });

  $routes->group("dokumen", function ($routes) {
      $routes->get('', 'Admin\Dokumen::index');
      $routes->get('unggahan/(:num)', 'Admin\Dokumen::unggahan/$1');
      $routes->get('deleteunggahan/(:num)', 'Admin\Dokumen::deleteunggahan/$1');
  });

  $routes->group("download", function ($routes) {
      $routes->get('', 'Admin\Download::index');
  });

  $routes->get('pelamar/(:any)', 'Admin\Pelamar::index/$1');

});
