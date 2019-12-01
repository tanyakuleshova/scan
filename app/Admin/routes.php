<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('scan-codes', ScanController::class);
    $router->resource('products', ProductsController::class);
    $router->get('/makescan', 'ScanningController@index');
    $router->post('/makescan', 'ScanningController@makescan')->name('makescan');
    $router->post('/new-scancode', 'ScanningController@storescan');
    $router->get('/select2-autocomplete-ajax', 'AjaxSearchController@dataAjax');
});
