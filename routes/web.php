<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardAdminController;
use App\Http\Controllers\DashboardStaffController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//auth route
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

//dashboard route
Route::get('/admin-dashboard',[dashboardAdminController::class,"index"]);

//admin-users route
Route::get('/admin-dashboard/users',[UsersController::class,"index"]);
Route::post('/admin-dashboard/users', [UsersController::class, 'store']);
Route::delete('/admin-dashboard/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
Route::put('/admin-dashboard/users/{user}', [UsersController::class, 'update'])->name('users.update');

//staff route
Route::get('/staff-dashboard',[DashboardStaffController::class,"index"]);
Route::get('/staff-dashboard/profile', [DashboardStaffController::class, 'profile']);
Route::get('/profile/edit', [DashboardStaffController::class, 'edit'])->name('edit.profile');
Route::post('/profile/update', [DashboardStaffController::class, 'update'])->name('update.profile');



