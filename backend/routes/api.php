<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group([
    'prefix' => 'api/v1',
], function ($router) {
    $router->post('users', ['uses' => 'V1\UserController@store']);
    $router->delete('users/{id}', ['uses' => 'V1\UserController@destroy']);
});
