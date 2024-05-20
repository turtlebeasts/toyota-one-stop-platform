<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ShowroomController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Middleware\NoCache;
use App\Http\Middleware\UserAuthenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/admin-login', [LoginController::class, 'admin'])->name('admin.login');
Route::post('/user-login', [LoginController::class, 'user'])->name('user.login');

Route::get('/register', [LoginController::class, 'register_view']);
Route::post('/user-register', [LoginController::class, 'register'])->name('user.register');


Route::group(['middleware' => [AdminAuthenticate::class, NoCache::class]], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/employee', [EmployeeController::class, 'index'])->name('admin.employee');
        Route::post('/employee-store', [EmployeeController::class, 'store'])->name('admin.employee.store');
        Route::put('/employee-edit/{user}', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
        Route::delete('/employee-delete/{user}', [EmployeeController::class, 'destroy'])->name('admin.employee.destroy');

        Route::get('/showroom', [ShowroomController::class, 'index'])->name('admin.car');
        Route::post('/showroom', [ShowroomController::class, 'store'])->name('admin.car.store');
        Route::put('/showroom/{id}', [ShowroomController::class, 'update'])->name('admin.car.update');
        Route::put('/showroom/stock/{car}', [ShowroomController::class, 'stock'])->name('admin.car.stock');
        Route::delete('/showroom/{id}', [ShowroomController::class, 'destroy'])->name('admin.car.destroy');

        Route::get('/part', [PartController::class, 'index'])->name('admin.part');
        Route::post('/part', [PartController::class, 'store'])->name('admin.part.store');
        Route::put('/part/{id}', [PartController::class, 'update'])->name('admin.part.update');
        Route::delete('/part/{id}', [PartController::class, 'destroy'])->name('admin.part.destroy');
        Route::put('/part/stock/{part}', [PartController::class, 'stock'])->name('admin.part.stock');
    });
});
Route::group(['middleware' => [UserAuthenticate::class, NoCache::class]], function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'dashboard'])->name('user.dashboard');
    });
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
