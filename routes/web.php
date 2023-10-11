<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::middleware('AdminLoginCheck')->get('/admin/auth/{any}', [AdminController::class, 'index'])->where('any','.*')->name('lvs.admin.auth');
Route::middleware('AdminLoginCheck')->get('/admin/', [AdminController::class, 'index'])->where('any','.*')->name('lvs.admin');
Route::middleware('AdminLoginCheck')->get('/admin/{any}', [AdminController::class, 'index'])->where('any','.*')->name('lvs.admin.any');
Route::middleware('AdminLoginCheck')->get('/admin', function (){ return redirect()->route('lvs.admin.any','dashboard'); });
