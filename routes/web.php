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

// api/
$router->group(['prefix' => 'api', 'middleware' => 'cors'], function ($router) {
    // api/examples
    $router->group(['prefix' => 'examples'], function ($router) {
        $router->get('/', 'ExampleController@index');
        $router->post('/', ['middleware' => 'validateExample', 'uses' => 'ExampleController@store']);

        // api/examples/{example}
        $router->group(['prefix' => '{example}', 'middleware' => 'findExample'], function ($router) {
            $router->get('/', 'ExampleController@show');
            $router->patch('/', ['middleware' => 'validateExample', 'uses' => 'ExampleController@update']);
            $router->delete('/', 'ExampleController@destroy');

            // api/examples/{example}/children
            $router->group(['prefix' => 'children'], function ($router) {
                $router->get('/', 'ExampleChildrenController@index');
                $router->post('/', ['middleware' => 'validateExampleChildren', 'uses' => 'ExampleChildrenController@store']);

                // api/examples/{example}/children/{child}
                $router->group(['prefix' => '{child}', 'middleware' => 'findExampleChildren'], function ($router) {
                    $router->get('/', 'ExampleChildrenController@show');
                    $router->patch('/', ['middleware' => 'validateExampleChildren', 'uses' => 'ExampleChildrenController@update']);
                    $router->delete('/', 'ExampleChildrenController@destroy');
                });
            });
        });


        // api/examples/search
        $router->group(['prefix' => 'search'], function ($router) {
            // api/examples/search/{keyword}
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
