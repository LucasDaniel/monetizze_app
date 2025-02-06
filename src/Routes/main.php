<?php

use App\Http\Route;

/*
Como chamar as rotas

Route::get('/', 'TesteController@index');
Route::post('/', 'TesteController@index');
Route::put('/', 'TesteController@index');
Route::delete('/', 'TesteController@index');
*/

Route::get('/database', 'HomeController@database');

Route::get('/', 'HomeController@index');
Route::post('/tripulante/create', 'TripulanteController@store');
