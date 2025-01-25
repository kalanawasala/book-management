<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// create route for book via contoller
Route::get('/book',[BookController::class,'index'])->name('book.index');
// create route for bookRegister via contoller
Route::get('/book/register',[BookController::class,'register'])->name('book.register');
// create route for book  data retrive via contoller
Route::post('/book',[BookController::class,'store'])->name('book.store');

Route::get('/book/{book}/edit',[BookController::class,'edit'])->name('book.edit');