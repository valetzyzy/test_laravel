<?php

use Illuminate\Http\Request;

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

Route::apiResource('client', 'Api\ClientController')
    ->except('create', 'edit');

Route::apiResource('project', 'Api\ProjectController')
    ->except('create', 'edit');

