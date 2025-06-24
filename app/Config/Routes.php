<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->group('produk', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('kategori', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProductCategoryController::index');
    $routes->post('', 'ProductCategoryController::create');
    $routes->post('edit/(:any)', 'ProductCategoryController::edit/$1');
    $routes->get('delete/(:any)', 'ProductCategoryController::delete/$1');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);

$routes->get('get-location', 'Location::getKelurahan');
$routes->get('get-cost', 'TransaksiController::getCost');


$routes->post('buy', 'TransaksiController::buy');
$routes->get('api', 'ApiController::index');

$routes->get('keranjang', 'TransaksiController::index', ['filter' => 'auth']);
$routes->get('contact', 'ContactController::index', ['filter' => 'auth']);
$routes->post('contact', 'ContactController::create', ['filter' => 'auth']);
