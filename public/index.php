<?php

require_once __DIR__.'/../vendor/autoload.php';

//use Framework\Router;
use Bramus\Router\Router;

// Create Router instance
$router = new Router();
$router->get('/tournament/matchs/{id}', '\App\Controller\MatchController@showMatchs'); 
$router->post('/tournament/matchs/{id}', '\App\Controller\MatchController@showMatchs'); 
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
$router->get('/tournaments', '\App\Controller\TournamentController@getTournaments');
$router->get('/tournament/{id}', '\App\Controller\TournamentController@getTournament');
$router->get('/myTournaments', '\App\Controller\TournamentController@getUserTournaments');
$router->get('/myTournaments/delete/{tournament.id}', '\App\Controller\TournamentController@deleteUserFromTournament');
$router->get('/myTournaments/delete/{tournament.id}', '\App\Controller\TournamentController@deleteUserFromTournament');
$router->get('/inscription/{tournament.id}', '\App\Controller\TournamentController@inscriptionTournament');
$router->get('/search/tournament', '\App\Controller\TournamentController@searchTournament'); 
$router->get('/inscription/{tournament.id}', '\App\Controller\TournamentController@inscriptionTournament');

// ----------------------------------------------------------

$router->get('/create-team/{id}', '\App\Controller\TeamController@createTeam'); 
$router->get('/teamInfo/{team.name}', '\App\Controller\TeamController@showMembersOfTeam'); 
$router->post('/bet/{team.name}', '\App\Controller\betController@bet'); 

$router->run();
