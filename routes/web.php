<?php

use App\Http\Controllers\{
    IndexController,
    EpisodeController,
    PageController,
    ProfileController,
    Admin\IndexController as AdminIndexController,
    Admin\PageController as AdminPageController,
    Admin\UserController as AdminUserController,
    Admin\EpisodeController as AdminEpisodeController,
};
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/episodes', [EpisodeController::class, 'index'])->name('episodes');
Route::get('/page/{slug}', PageController::class)->name('page');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [IndexController::class, 'redirect'])->name('dashboard');
    Route::put('/user/profile/bio', [ProfileController::class, 'update'])->name('update.profile');

    /*Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/index', [AdminIndexController::class, 'index'])->name('index');

        Route::prefix('/users')->name('users.')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/{user}', [AdminUserController::class, 'show'])->name('edit');
            Route::put('/{user}', [AdminUserController::class, 'update']);
            Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('/pages')->name('pages.')->group(function () {
            Route::get('/', [AdminPageController::class, 'index'])->name('index');
            Route::post('/', [AdminPageController::class, 'store'])->name('create');
            Route::get('/{page}', [AdminPageController::class, 'show'])->name('show');
            Route::put('/{page}', [AdminPageController::class, 'update'])->name('update');
            Route::delete('/{page}', [AdminPageController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('/episodes')->name('episodes.')->group(function () {
            Route::get('/', [AdminEpisodeController::class, 'index'])->name('index');
            Route::post('/', [AdminEpisodeController::class, 'store'])->name('create');
            Route::get('/{episode}', [AdminEpisodeController::class, 'show'])->name('show');
            Route::put('/{episode}', [AdminEpisodeController::class, 'update'])->name('update');
            Route::delete('/{episode}', [AdminEpisodeController::class, 'destroy'])->name('destroy');
        });
    });*/

});
