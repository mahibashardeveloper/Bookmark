<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(
    ['middleware' => ['AdminAuth'], 'prefix' => 'auth'],
    function () {
        Route::post('/register', [AdminController::class, 'register'])->name('Admin.Auth.Register');
        Route::post('/login', [AdminController::class, 'login'])->name('Admin.Auth.Login');
        Route::post('/forget', [AdminController::class, 'forget'])->name('Admin.Auth.Forget');
        Route::post('/reset', [AdminController::class, 'reset'])->name('Admin.Auth.Reset');
    }
);

Route::group(
    ['middleware' => ['AdminAuthReq'], 'prefix' => 'profile'],
    function () {
        Route::get('/details', [AdminController::class, 'profile_details'])->name('Admin.Profile.Details');
        Route::get('/update', [AdminController::class, 'profile_update'])->name('Admin.Profile.update');
        Route::get('/password', [AdminController::class, 'profile_password'])->name('Admin.Profile.Password');
        Route::get('/logout', [AdminController::class, 'profile_logout'])->name('Admin.Profile.Logout');
    }
);
