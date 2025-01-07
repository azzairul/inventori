<?php

use App\Http\Controllers\admin\PengajuanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\dashboardAdminController;
use App\Http\Controllers\DashboardStaffController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\CategoryDokumentasiController;
use App\Http\Controllers\PengembalianController;


Route::get('/', function () {
    return view('welcome');
});

//auth route
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

//dashboard route
Route::get('/admin-dashboard',[dashboardAdminController::class,"index"]);

//admin-users route
Route::get('/admin-dashboard/users',[UsersController::class,'index']);
Route::get('/admin-dashboard/master-karyawan',[EmployeeController::class,'index'])->name('employees.list');
Route::get('/admin-dashboard/master-karyawan/{id}', [EmployeeController::class, 'show'])->name('employees.show');
Route::get('/admin-dashboard/master-karyawan/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('/admin-dashboard/master-karyawan/{id}/update', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/admin-dashboard/master-karyawan/{id}/delete', [EmployeeController::class, 'destroy'])->name('employees.destroy');
Route::post('/admin-dashboard/users', [UsersController::class, 'store']);
Route::delete('/admin-dashboard/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
Route::put('/admin-dashboard/users/{user}', [UsersController::class, 'update'])->name('users.update');

//staff route
Route::get('/staff-dashboard',[DashboardStaffController::class,"index"]);
Route::get('/staff-dashboard/profile', [DashboardStaffController::class, 'profile']);
Route::get('/profile/edit', [DashboardStaffController::class, 'edit'])->name('edit.profile');
Route::post('/profile/update', [DashboardStaffController::class, 'update'])->name('update.profile');


    // Rute untuk menampilkan halaman profil staf
    Route::get('/staff/profile-UpdatePw', [StaffController::class, 'showProfile'])->name('staff.profile');

    // Rute untuk mengubah password
    Route::post('/staff/change-password', [StaffController::class, 'changePassword'])->name('staff.changePassword');

Route::get('admin-dashboard/category',[CategoryController::class, 'index'])->name('category.index');
Route::post('/admin-dashboard/category/store', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/admin-dashboard/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/admin-dashboard/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('admin-dashboard/items',[ItemsController::class,'index'])->name('item.index');
Route::post('/admin-dashboard/item/store', [ItemsController::class, 'store'])->name('item.store');
Route::put('/admin-dashboard/item/{id}/update', [ItemsController::class, 'update'])->name('item.update');
Route::delete('/admin-dashboard/item/{id}/delete', [ItemsController::class, 'destroy'])->name('item.destroy');

//staff peminjaman
Route::get('staff-dashboard/peminjaman',[PeminjamanController::class,'index'])->name('peminjaman.index');
Route::get('staff-dashboard/{id}/pinjaman',[PeminjamanController::class,'detail'])->name('peminjaman.detail');
Route::post('staff-dashboard/peminjaman/store',[PeminjamanController::class,'store'])->name('peminjaman.store');
Route::post('/peminjaman/submit', [PeminjamanController::class, 'submit'])->name('peminjaman.submit');
route::delete('/peminjaman{id}/delete', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');

//admin peminjaman
Route::post('/pengembalian/{id}', [PengajuanController::class, 'returnTransaction'])->name('pengembalian.return');
Route::get('admin-dashboard/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
Route::get('peminjaman-items/{id}', [PengajuanController::class, 'show'])->name('pengajuan.show');
Route::patch('peminjaman/acc/{id}', [PengajuanController::class, 'accTransaction']);
Route::patch('peminjaman/tolak/{id}', [PengajuanController::class, 'tolak']);
Route::delete('/peminjaman/{id}/delete', [PengajuanController::class, 'destroy'])->name('peminjaman.destroy');

//staff riwayat
Route::get('/riwayat/staff-peminjaman',[PeminjamanController::class,'showRiwayat'])->name('riwayat.staff');
Route::get('/api/peminjaman-items/{id}', [PeminjamanController::class, 'getPeminjamanItems']);

//KategoryDokumentasi
Route::get('admin-dashboard/kategori_dokumentasi', [CategoryDokumentasiController::class, 'index'])->name('kategori_dokumentasi.index');
Route::post('admin-dashboard/kategori_dokumentasi/store', [CategoryDokumentasiController::class, 'store'])->name('kategori_dokumentasi.store');
Route::put('admin-dashboard/kategori_dokumentasi/{id}', [CategoryDokumentasiController::class, 'update'])->name('kategori_dokumentasi.update');
Route::delete('admin-dashboard/kategori_dokumentasi/{id}', [CategoryDokumentasiController::class, 'destroy'])->name('kategori_dokumentasi.destroy');


// Admin Riwayat Peminjaman
Route::get('/riwayat/admin-peminjaman', [PengajuanController::class, 'showRiwayat'])->name('riwayat.admin');
Route::get('/staff-dashboard/{id}/pinjaman', [PengajuanController::class, 'detail'])->name('peminjaman.detail');
Route::delete('/admin-dashboard/item/{id}/delete', [ItemsController::class, 'destroy'])->name('item.destroy');

