<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Modules\V1\Http\Controllers\BookController;
use Modules\V1\Http\Controllers\AuthController;
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
], function () {
    Route::post('/login', 'AuthController@login');
    Route::get('/protected-endpoint', 'AuthController@protectedEndpoint');
});

Route::group([
    'middlewares' => ['jwt.auth'],
    'prefix' => 'v1'
], function () {

    Route::get('/book', 'BookController@listBooks');
    Route::get('/book/{id}', 'BookController@listBook');
    Route::post('/book', 'BookController@createBook');
    Route::put('/book/{id}', 'BookController@updateBook');
    Route::delete('/book/{id}', 'BookController@deleteBook');
    //Route For User login
    Route::post('/create', 'UserController@createUser');
    Route::get('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::get('/user', 'UserController@getUser');
});
