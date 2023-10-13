<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\BookmarkController;

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

/* -------------------------
    User Authentication
--------------------------- */

Route::group(
    ['middleware' => ['UserAuth'], 'prefix' => 'auth'],
    function () {
        Route::post('/register', [UserController::class, 'register'])->name('User.Auth.Register');
        Route::post('/login', [UserController::class, 'login'])->name('User.Auth.Login');
        Route::post('/forget', [UserController::class, 'forget'])->name('User.Auth.Forget');
        Route::post('/reset', [UserController::class, 'reset'])->name('User.Auth.Reset');
    }
);

/* -------------------------
    User Details
--------------------------- */

Route::group(
    ['middleware' => ['UserAuthReq'], 'prefix' => 'profile'],
    function () {
        Route::get('/details', [UserController::class, 'profile_details'])->name('User.Profile.Details');
        Route::post('/update', [UserController::class, 'profile_update'])->name('User.Profile.update');
        Route::post('/password', [UserController::class, 'profile_password'])->name('User.Profile.Password');
        Route::get('/logout', [UserController::class, 'profile_logout'])->name('User.Profile.Logout');
        Route::post('/list', [UserController::class, 'userLogList'])->name('User.UserLog.List');
    }
);

/* -------------------------
    Media Controller
--------------------------- */

Route::prefix('media')->group( function () {
    Route::post('/upload', [MediaController::class, 'upload'])->name('User.Media.Upload');
});

/* -------------------------
    Bookmark Controller
--------------------------- */

Route::prefix('bookmark')->group( function () {
    Route::post('/list', [BookmarkController::class, 'list'])->name('User.Bookmark.List');
    Route::post('/create', [BookmarkController::class, 'create'])->name('User.Bookmark.Create');
    Route::post('/single', [BookmarkController::class, 'single'])->name('User.Bookmark.Single');
    Route::post('/update', [BookmarkController::class, 'update'])->name('User.Bookmark.Update');
    Route::post('/delete', [BookmarkController::class, 'delete'])->name('User.Bookmark.Delete');
});
