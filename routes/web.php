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

// Login
$router->post('auth/login', ['uses' => 'AuthController@authenticate']);

//Register new user
$router->post('auth/register', ['uses' => 'AuthController@addUser']);

// Prefix all endpoint with api
$router->group(['prefix' => 'api'], function () use ($router) {
    /**
     * Show a list of all books.
     */
    $router->get('books', ['uses' => 'BookController@showAllBooks']);

    /**
     * Show a specified book.
     */
    $router->get('books/{id}', ['uses' => 'BookController@showOneBook']);

    /**
     * Create a new book.
     */
    $router->post('books', ['middleware' => 'jwt.auth', 'uses' => 'BookController@create']);

    /**
     * Delete a specified book.
     */
    $router->delete('books/{id}', ['middleware' => 'jwt.auth', 'uses' => 'BookController@delete']);

    /**
     * Update a specified book.
     */
    $router->put('books/{id}', ['middleware' => 'jwt.auth', 'uses' => 'BookController@update']);

    /**
     * Rate a specified book.
     */
    $router->post('books/{id}/rate', ['middleware' => 'jwt.auth', 'uses' => 'BookController@rateABook']);

});

