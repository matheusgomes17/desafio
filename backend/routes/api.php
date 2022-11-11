<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group([
    'prefix' => 'api/v1',
], function ($router) {
    $router->get('users', ['uses' => 'V1\Users\UserController@index']);
    $router->post('users', ['uses' => 'V1\Users\UserController@store']);
    $router->put('users/{id}', ['uses' => 'V1\Users\UserController@update']);
    $router->get('users/{id}', ['uses' => 'V1\Users\UserController@show']);
    $router->delete('users/{id}', ['uses' => 'V1\Users\UserController@destroy']);

    $router->post('users/{id}/cars/attach', ['uses' => 'V1\Users\UserCarController@attach']);
    $router->post('users/{id}/cars/detach', ['uses' => 'V1\Users\UserCarController@detach']);

    $router->get('cars/all', ['uses' => 'V1\Cars\CarController@all']);
    $router->get('cars', ['uses' => 'V1\Cars\CarController@index']);
    $router->post('cars', ['uses' => 'V1\Cars\CarController@store']);
    $router->put('cars/{id}', ['uses' => 'V1\Cars\CarController@update']);
    $router->get('cars/{id}', ['uses' => 'V1\Cars\CarController@show']);
    $router->delete('cars/{id}', ['uses' => 'V1\Cars\CarController@destroy']);
});
