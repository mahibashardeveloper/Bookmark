<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('UserLoginCheck')->get('user/auth/{any}', [UserController::class, 'index'])->where('any','.*')->name('lvs.user.auth');
Route::middleware('UserLoginCheck')->get('user/', [UserController::class, 'index'])->where('any','.*')->name('lvs.user');
Route::middleware('UserLoginCheck')->get('user/{any}', [UserController::class, 'index'])->where('any','.*')->name('lvs.user.any');
Route::middleware('UserLoginCheck')->get('', function (){ return redirect()->route('lvs.user.any','view'); });
