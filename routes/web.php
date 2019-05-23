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

$router->group(['prefix' => 'api/personal'], function () use($router){
    $router->get('/list', 'Person\PersonController@findAll');
   $router->get('/clients', 'Client\ClientController@findAll');
   $router->post('/addClient', 'Client\ClientController@insert');
   $router->put('/client', 'Client\ClientController@update');
    $router->get('/employees', 'Employee\EmployeeController@findAll');
    $router->post('/addEmployee', 'Employee\EmployeeController@insert');
    $router->put('/employee', 'Employee\EmployeeController@update');
    $router->get('/gyms', 'Gym\GymController@findAll');
    $router->post('/addGym', 'Gym\GymController@insert');
    $router->put('/gym', 'Client\ClientController@update');
    $router->get('/users', 'User\UserController@findAll');
    $router->post('/addUser', 'User\UserController@insert');
    $router->put('/user', 'User\UserController@update');
});



