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

//Route::get('/front/profile', function (){ return redirect()->route('lvs.front.any','user_profile'); });
//Route::get('/front/', [FrontController::class, 'index'])->where('any', '.*')->name('lvs.front');
//Route::get('/', function (){ return redirect()->route('lvs.front.any','home'); });
Route::get('/', [FrontController::class, 'index'])->where('any', '.*')->name('home');
Route::get('/{any}', [FrontController::class, 'index'])->where('any', '.*')->name('home.any');

/* --------------------------
    User Authentication Controller
------------------------ */

//Route::middleware('UserLoginCheck')->get('/front/auth/{any}', [FrontController::class, 'index'])->where('any', '.*')->name('lvs.front.auth');
//Route::middleware('UserLoginCheck')->get('/front/dashboard', [FrontController::class, 'index'])->name('lvs.front.dashboard');
//Route::middleware('UserLoginCheck')->get('/front/bookmark', [FrontController::class, 'index'])->name('lvs.front.bookmark');
//Route::middleware('UserLoginCheck')->get('/front/profile', [FrontController::class, 'index'])->name('lvs.front.profile');
