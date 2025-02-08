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
Route::get('/teste', 'TripulanteController@teste');
Route::post('/tripulante/create', 'TripulanteController@store');
