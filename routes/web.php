<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('books', BookController::class);
    Route::resource('comments', CommentController::class);

    
    Route::post('/books/like-book/{id}', 'App\Http\Controllers\BookController@likeBook');
    Route::post('/books/favorite-book/{id}', 'App\Http\Controllers\BookController@favoriteBook');
    Route::post('/books/favorite-remove/{id}', 'App\Http\Controllers\BookController@favoriteRemove');
});

// Route::get('/user/create', [UserController::class, 'create'])->name('create');