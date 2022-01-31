<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//CRUD de divisiones
Route::get('/divisions', 'divisionController@get_divisions_list');
Route::post('/divisions', 'divisionController@save_division');
Route::put('/divisions', 'divisionController@update_division');
Route::delete('/divisions', 'divisionController@delete_division');
//Consultar division
Route::get('/division/{id}', 'divisionController@get_division');
Route::get('/subdivisions/{id}', 'divisionController@get_subdivisions');


