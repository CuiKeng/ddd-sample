<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
    'namespace' => 'App\CargoBC\Http\Controller'
], function ($router) {
    $router->post('cargo/create', 'CargoController@create');
    $router->get('cargo/{uuid}', 'CargoController@get');
});