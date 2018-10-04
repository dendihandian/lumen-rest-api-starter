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

$router->group(['prefix' => 'api', 'middleware' => 'cors'], function ($router) {
    $router->group(['prefix' => 'examples'], function ($router) {
        $router->get('/', 'ExampleController@index');
        $router->post('/', ['middleware' => 'validateExample', 'uses' => 'ExampleController@store']);
        $router->group(['prefix' => '/{example}'], function ($router) {
            $router->get('/', ['middleware' => 'findExample', 'uses' => 'ExampleController@show']);
            $router->patch('/', ['middleware' => ['validateExample', 'findExample'], 'uses' => 'ExampleController@update']);
            $router->delete('/', ['middleware' => 'findExample', 'uses' => 'ExampleController@destroy']);
        });
        $router->group(['prefix' => 'search'], function ($router) {
            $router->get('/{keyword}', 'ExampleController@search');
        });
    });

    $router->group(['prefix' => 'auth'], function ($router) {
        $router->post('register', 'AuthController@register');
        $router->post('login', 'AuthController@login');
        $router->get('me', ['middleware' => 'jwt.auth', 'uses' => 'AuthController@authenticatedUser']);
        $router->post('logout', ['middleware' => 'jwt.auth', 'uses' => 'AuthController@logout']);
    });
});
