<?php

require_once __DIR__.'/../vendor/autoload.php';

//use Framework\Router;
use Bramus\Router\Router;

// Create Router instance
$router = new Router();



$router->get('/account/login', '\App\Controller\UserController@showLogin');
$router->post('/account/login', '\App\Controller\UserController@showLogin');
$router->get('/account/registration', '\App\Controller\UserController@showRegistration');
$router->post('/account/registration', '\App\Controller\UserController@showRegistration');
$router->get('/account/disconnect', '\App\Controller\UserController@disconnectEvent');
$router->get('/account/disconnect', '\App\Controller\UserController@disconnectEvent');
$router->get('/admin/homepage', '\App\Controller\TournamentController@getTournaments');

$router->get('/admin/homepage/edit/{id}', '\App\Controller\TournamentController@editTournament');
$router->post('/admin/homepage/edit/{id}', '\App\Controller\TournamentController@editTournament');

$router->post('/admin/homepage', '\App\Controller\TournamentController@getTournaments');
$router->get('/admin/homepage/delete/{id}', '\App\Controller\TournamentController@deleteTournament');
$router->get('/admin/homepage/create', '\App\Controller\TournamentController@createTournament');
$router->post('/admin/homepage/create', '\App\Controller\TournamentController@createTournament');

// $router->get('/test/{url}', '\App\Controller\UserController@testEvent');


$router->run();
