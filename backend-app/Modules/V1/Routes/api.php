<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Modules\V1\Http\Controllers\BookController;
use Modules\V1\Http\Requests\Book\UpdateBookRequest;

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

Route::middleware('auth:api')->get('/v1', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'v1'
], function ($router) {

    Route::get('/book', 'BookController@listBooks')->middleware("cors");
    Route::get('/book/{id}', 'BookController@listBook')->middleware("cors");
    Route::post('/book', 'BookController@createBook')->middleware("cors");
    Route::put('/book/{id}', 'BookController@updateBook')->middleware("cors");;
    Route::delete('/book/{id}', 'BookController@deleteBook')->middleware("cors");;
});
