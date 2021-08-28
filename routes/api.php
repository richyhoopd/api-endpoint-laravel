<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------

|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/paquetes', [PackageController::class, 'index']);
Route::get('/paquetes/{id}', [PackageController::class, 'show']);
Route::get('/paquetes/search/{name}', [PackageController::class, 'search']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/paquetes', [PackageController::class, 'store']);
    Route::put('/paquetes/{id}', [PackageController::class, 'update']);
    Route::delete('/paquetes/{id}', [PackageController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});