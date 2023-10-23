<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\PostController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


/********************************
        frontend Routes
*********************************/
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [IndexController::class, 'index'])->name('home');





/********************************
        backend Routes
*********************************/
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


// for user
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/search',[UserController::class, 'search']);
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/storage', [UserController::class, 'storage'])->name('user.storage');
Route::get('/user/edit/{id}',[UserController::class, 'edit']);
Route::post('/user/update/{id}',[UserController::class, 'update']);
Route::post('/user/destroy',[UserController::class, 'destroy'])->name('user.destroy');


// for post
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post/storage', [PostController::class, 'storage'])->name('post.storage');




