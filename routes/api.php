<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\BookController;

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


//Login
Route::controller(LoginController::class)->group(function(){
    Route::post('login', 'login');
});
//All books
Route::resource('books', BookController::class)->middleware("checkToken");

//popular books
Route::controller(BookController::class)->group(function(){
    Route::get('popular_books', 'popularBook')->middleware("checkToken");
});
