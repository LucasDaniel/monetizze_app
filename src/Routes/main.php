<?php

use App\Http\Route;

/*
Como chamar as rotas

Route::get('/', 'TesteController@index');
Route::post('/', 'TesteController@index');
Route::put('/', 'TesteController@index');
Route::delete('/', 'TesteController@index');
*/

//Route::get('/migrate', 'HomeController@migrate');
//Route::get('/seeder', 'HomeController@seeder');

Route::get('/', 'HomeController@index');
Route::post('/tripulante/create', 'TripulanteController@store');
Route::post('/tripulante-bilhete/create', 'TripulanteBilheteController@store');
Route::post('/tripulante-bilhete/create-random-numbers', 'TripulanteBilheteController@createRandomNumbers');
Route::post('/sorteio/create', 'SorteioController@store');
