<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchingController;
use App\Http\Controllers\TpsApiController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->name('logout');
    Route::post('refresh', 'refresh');
});

Route::controller(SearchingController::class)->group(function () {
    Route::post('search', 'master_search');
    Route::post('pencarian', 'search_banyak');
});

Route::controller(TpsApiController::class)->group(function () {
    Route::post('th-inbound', 'th_inbound');
    Route::post('th-aircarft', 'th_aircarft');
    Route::post('th-breakdown', 'th_breakdown');
    Route::post('th-storage', 'th_storage');
    Route::post('th-clearance', 'th_clearance');
    Route::post('th-pod', 'th_pod');
});