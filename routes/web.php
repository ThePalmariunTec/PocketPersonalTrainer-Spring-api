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

$router->group(['prefix' => 'api/pocketPersonalTrainer'],
    function () use($router){

        $router->get('/list', 'Person\PersonController@findAll');
        $router->get('client/all', 'Client\ClientController@findAll');
        $router->get('client/client/', 'Client\ClientController@findById');
        $router->post('client/add', 'Client\ClientController@insert');
        $router->put('client/update/', 'Client\ClientController@update');
        $router->delete('client/delete', 'Client\ClientController@Delete');
        $router->get('gym/all', 'Gym\GymController@findAll');
        $router->post('gym/add', 'Gym\GymController@insert');
        $router->put('gym/gym', 'Client\ClientController@update');
        $router->get('train/all','Train\TrainController@findAll');
        $router->get('train/exercise/','Train\TrainController@findById');
        $router->post('train/add','Train\TrainController@insert');
        $router->put('train/update/','Train\TrainController@update');
        $router->delete('train/delete/','Train\TrainController@delete');
        $router->get('user/all', 'User\UserController@findAll');
        $router->post('user/add', 'User\UserController@insert');
        $router->put('user/user', 'User\UserController@update');
        $router->post('/login', 'User\LoginController@login');
});



