<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group([
    'prefix' => 'api/v1',
], function ($router) {
    $router->get('users', ['uses' => 'V1\UserController@index']);
    $router->post('users', ['uses' => 'V1\UserController@store']);
    $router->get('users/{id}', ['uses' => 'V1\UserController@show']);
    $router->delete('users/{id}', ['uses' => 'V1\UserController@destroy']);
    $router->put('users/{id}/profile', ['uses' => 'V1\UserController@updateProfile']);

    $router->post('users/{id}/cars/attach', ['uses' => 'V1\UserCarController@attach']);
    $router->post('users/{id}/cars/detach', ['uses' => 'V1\UserCarController@detach']);

    $router->post('cars', ['uses' => 'V1\CarController@store']);
});
