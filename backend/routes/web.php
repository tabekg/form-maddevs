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

$router->group([
    'namespace' => 'V1',
    'prefix' => 'api/v1'
], function() use ($router){
    $router->post('user/register', 'UserController@register');
    $router->post('user/login', 'UserController@login');
});

$router->group([
    'namespace' => 'V1',
    'prefix' => 'api/v1',
    'middleware' => ['auth']
], function() use ($router){
    $router->post('user/check', 'UserController@check');

    $resful = ['topic', 'post'];

    foreach($resful as $value){
    	$router->get($value, strtoupper(substr($value, 0, 1)) . substr($value, 1, strlen($value) - 1) . 'Controller@get');
	    $router->put($value, strtoupper(substr($value, 0, 1)) . substr($value, 1, strlen($value) - 1) . 'Controller@create');
	    $router->post($value, strtoupper(substr($value, 0, 1)) . substr($value, 1, strlen($value) - 1) . 'Controller@update');
	    $router->delete($value, strtoupper(substr($value, 0, 1)) . substr($value, 1, strlen($value) - 1) . 'Controller@delete');
    }
});