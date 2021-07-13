<?php

use App\Http\Controllers\StatController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//группа для внешнего API
Route::middleware('api')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::resource('stats', StatController::class);
    });
});