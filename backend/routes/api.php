<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group([
    'prefix' => 'api/v1',
], function ($router) {
    $router->get('users', ['uses' => 'V1\UserController@index']);
    $router->post('users', ['uses' => 'V1\UserController@store']);
    $router->put('users/{id}', ['uses' => 'V1\UserController@update']);
    $router->get('users/{id}', ['uses' => 'V1\UserController@show']);
    $router->delete('users/{id}', ['uses' => 'V1\UserController@destroy']);

    $router->post('users/{id}/cars/attach', ['uses' => 'V1\UserCarController@attach']);
    $router->post('users/{id}/cars/detach', ['uses' => 'V1\UserCarController@detach']);

    $router->get('cars', ['uses' => 'V1\CarController@index']);
    $router->post('cars', ['uses' => 'V1\CarController@store']);
    $router->put('cars/{id}', ['uses' => 'V1\CarController@update']);
    $router->get('cars/{id}', ['uses' => 'V1\CarController@show']);
    $router->delete('cars/{id}', ['uses' => 'V1\CarController@destroy']);
});
