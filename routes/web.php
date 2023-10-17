<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* --------------------------
    Front Controller
------------------------ */

Route::get('/', [FrontController::class, 'index'])->where('any', '.*')->name('home');
Route::get('/{any}', [FrontController::class, 'index'])->where('any', '.*')->name('home.any');
