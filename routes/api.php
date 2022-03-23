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

// TODO:: 
// setup the middleware for authtication
Route::group(['prefix' => 'v1'], function () {
    Route::post(
        'link/create',
        'App\Http\Controllers\Api\Link\CreateController@index'
    )->name('api-v1-link-create');

    Route::get(
        'links/byUserId/{user_id}',
        'App\Http\Controllers\Api\Links\ByUserIdController@index'
    )->name('api-v1-links-by_user_id');
});
