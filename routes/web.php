<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\User\Auth\AuthController::class, 'index'])
    ->name('user');
Route::get('/login', [\App\Http\Controllers\User\Auth\AuthController::class, 'login'])
    ->name('user.login');
Route::post('/register', [\App\Http\Controllers\User\Auth\AuthController::class, 'register'])
    ->name('user.register');
Route::post('/login', [\App\Http\Controllers\User\Auth\AuthController::class, 'logging']);

Route::group(['middleware' => 'user'], function () {
    Route::get('/logout', [\App\Http\Controllers\User\Auth\AuthController::class, 'logout'])
        ->name('user.logout');
    Route::get('/home', [\App\Http\Controllers\User\HomeController::class, 'index'])
        ->name('user.hostel.list');
    Route::get('/hostel/{hostel}', [\App\Http\Controllers\User\HostelController::class, 'show'])
        ->name('user.hostel.show');

    Route::get('/hostel/{hostel}/room/{room}', [\App\Http\Controllers\User\RoomController::class, 'show'])
        ->name('user.hostel.room.show');
    Route::post('/reserve/room/{room}', [\App\Http\Controllers\User\RoomController::class, 'reservation'])
        ->name('user.hostel.reserve.room');
});

Route::get('/head-office', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'login'])
    ->name('admin');
Route::post('/admin/login', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'logging'])
    ->name('admin.login');



Route::group(['prefix' => 'head-office', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('/hostel', \App\Http\Controllers\Admin\HostelController::class, ['as' => 'admin']);

    Route::get('{hostel}/room/create', [\App\Http\Controllers\Admin\RoomController::class, 'create'])
        ->name('admin.room.create');
    Route::post('{hostel}/room/store', [\App\Http\Controllers\Admin\RoomController::class, 'store'])
        ->name('admin.room.store');
    Route::get('{hostel}/room/{room}/edit', [\App\Http\Controllers\Admin\RoomController::class, 'edit'])
        ->name('admin.room.edit');
    Route::patch('{hostel}/room/{room}/update', [\App\Http\Controllers\Admin\RoomController::class, 'update'])
        ->name('admin.room.update');
    Route::delete('{hostel}/room/{room}/delete', [\App\Http\Controllers\Admin\RoomController::class, 'destroy'])
        ->name('admin.room.destroy');
});
