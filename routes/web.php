<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\backend\DashboardController;

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








