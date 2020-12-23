<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;


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


Route::get('/logout',[PostController::class, 'logout']);


Route::get('/', [PostController::class, 'index']);
Route::get('/post/search',[PostController::class, 'search']);
Route::get('/post/show/{id}', [PostController::class, 'show']);

Route::get('/profile/show/{username}',[ProfileController::class, 'show']);


/* Auth Route */
Route::group(['middleware' => ['auth']], function()
{
    Route::post('/post/store',[PostController::class, 'store']);
    Route::post('/post/edit',[PostController::class, 'edit']);
    Route::post('/post/delete',[PostController::class, 'delete']);


    Route::post('/comment/store',[CommentController::class, 'store']);
    Route::post('/comment/delete',[CommentController::class, 'delete']);

    
    Route::post('/profile/store',[ProfileController::class, 'store']);
});


Auth::routes();

