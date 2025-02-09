<?php

use App\Http\Route;

//Route::get('/migrate', 'HomeController@migrate');
//Route::get('/seeder', 'HomeController@seeder');

Route::post('/html/generate', 'HtmlController@generateHtml');
Route::post('/tripulante/create', 'TripulanteController@store');
Route::post('/tripulante-bilhete/create-random-numbers', 'TripulanteBilheteController@createRandomNumbers');
Route::post('/sorteio/create', 'SorteioController@store');
Route::post('/sorteio/generate-win-numbers', 'SorteioController@generateWinNumbers');
