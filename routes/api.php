<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FishController;
use App\Http\Controllers\Api\AquariumController;

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

//Login route, that will return a token that can then be used on authenticated/protected routes.
Route::post('/get-token', [AuthController::class, 'getToken']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/fish', [FishController::class, 'index']);
Route::get('/aquariums', [AquariumController::class, 'index']);

Route::get('/fish-by-aquarium/{aquariumid}', [FishController::class, 'findByAquarium']); //Multiple options here I just do not like the default

//Required Protected route/s
Route::middleware('auth:sanctum')->group(function(){
    Route::post('/fish', [FishController::class, 'create']);
    Route::patch('/fish/{fish}', [FishController::class, 'update']); //Using route model binding :) set Accept "application/json" to get the response in json.
});