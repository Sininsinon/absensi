<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Intern\HomeController;
use App\Http\Controllers\Intern\ProfileController;
use App\Http\Controllers\Intern\RiwayatController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\DevisiController;
use App\Http\Controllers\Admin\AttendanceSettingController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\RefershController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Halaman Login
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login-proses', [AuthController::class, 'login_proses']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode'])->name('password.email');
Route::post('/verify-code', [ForgotPasswordController::class, 'verifyCode'])->name('password.verify');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

// Rute yang Hanya Bisa Diakses Setelah Login
Route::middleware('auth')->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
    // admin user
    Route::get('/admin/user', [UserController::class, 'index']);
    Route::get('/admin/profile', [UserController::class, 'profile']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::get('/user/{id}/edit', [UserController::class, 'edit']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::get('/user/{id}', [UserController::class, 'destroy']);

    Route::get('/admin/profile/{id}', [ProfileController::class, 'edit']);
    Route::put('/admin/profile/{id}', [ProfileController::class, 'update']);

    // kategori 
    Route::get('/admin/kategori', [KategoriController::class, 'index']);
    Route::post('/kategori/store', [KategoriController::class, 'store']);
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);
    Route::put('/kategori/{id}', [KategoriController::class, 'update']);
    Route::get('/kategori/{id}', [KategoriController::class, 'destroy']);

    // Devisi 
    Route::get('/admin/devisi', [DevisiController::class, 'index']);
    Route::post('/devisi/store', [DevisiController::class, 'store']);
    Route::get('/devisi/{id}/edit', [DevisiController::class, 'edit']);
    Route::put('/devisi/{id}', [DevisiController::class, 'update']);
    Route::get('/devisi/{id}', [DevisiController::class, 'destroy']);
    
    Route::get('/admin/settings', [AttendanceSettingController::class, 'index'])->name('attendance-settings.index');
    Route::put('/settings/attendance', [AttendanceSettingController::class, 'update'])->name('attendance-settings.update');

    // Monitoring
    Route::get('/admin/monitoring', [MonitoringController::class, 'index'])->name('admin.monitoring');
    Route::get('/admin/monitoring/{user_id}', [MonitoringController::class, 'show'])->name('admin.monitoring.show');
    Route::post('/admin/monitoring/{user_id}/check-in', [MonitoringController::class, 'checkIn'])->name('admin.monitoring.checkin');
    Route::post('/admin/monitoring/{user_id}/check-out', [MonitoringController::class, 'checkOut'])->name('admin.monitoring.checkout');
    Route::delete('/admin/monitoring/cancel/checkin/{id}', [MonitoringController::class, 'cancelCheckIn'])->name('admin.monitoring.cancel.checkin');
    Route::delete('/admin/monitoring/cancel/checkout/{id}', [MonitoringController::class, 'cancelCheckOut'])->name('admin.monitoring.cancel.checkout');
    Route::post('/admin/monitoring/allow-cancel', [MonitoringController::class, 'allowCancelAttendance'])->name('admin.monitoring.allow.cancel');
    Route::post('/admin/monitoring/cancel-today', [MonitoringController::class, 'cancelTodayAttendance'])->name('admin.monitoring.cancel.today');





    // User Magang (Intern)

    Route::get('/attendance/status', [RefershController::class, 'checkStatus'])->name('attendance.status');

    Route::post('/attendance/check-in', [HomeController::class, 'checkIn'])->name('attendance.check-in');
    Route::post('/attendance/check-out', [HomeController::class, 'checkOut'])->name('attendance.check-out');
    
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('attendance.history');
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('/info-profile', [ProfileController::class, 'infoProfile']);
    Route::get('/change-pw', [ProfileController::class, 'Changepw']);
    Route::post('/change-password', [ProfileController::class, 'updatePw'])->name('password.update');
    Route::get('/edit-profile', [ProfileController::class, 'editProfile'])->name('edit-profile');
    Route::put('/update-profile', [ProfileController::class, 'updateprofile'])->name('update-profile');


    // print
    Route::get('/print-pdf', [RiwayatController::class, 'generatePDF'])->name('attendance.pdf');



    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
