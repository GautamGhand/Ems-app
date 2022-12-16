<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeAttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeLeaveController;
use App\Http\Controllers\EmployeeLeaveStatusController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordSetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStatusController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {

    if(Auth::check())
    {
        if(Auth::user()->is_employee)
        {
            return redirect()->route('employee');
        }
        return redirect()->route('users.index');
    }

    return redirect()->route('login');
});

Route::controller(LoginController::class)->group(function () {

    Route::get('/login', 'index')->name('login');

    Route::post('/login', 'login')->name('login');  
    
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(EmployeeAttendanceController::class)->group(function () {

    Route::get('/employees', 'index')->name('employee');

    Route::get('/employees/attendances', 'attendances')->name('employee.attendance.index');

    Route::post('/employees/attendance/{user}', 'store')->name('employee.attendance.store');
});

Route::controller(EmployeeLeaveController::class)->group(function () {

    Route::get('employees/leave/create', 'create')->name('employee.leave.create');

    Route::post('employees/leave/store', 'store')->name('employee.leave.store');

});

Route::controller(EmployeeLeaveStatusController::class)->group(function () {

    Route::get('/leaves', 'index')->name('employee.leave.index');

    Route::get('/employees/leave/approve/{leave}', 'approved')->name('employee.leave.approve');

    Route::get('/employees/leave/reject/{leave}', 'rejected')->name('employee.leave.reject');

});

Route::controller(UserController::class)->group(function()
{
    Route::get('/users', 'index')->name('users.index');

    Route::get('/users/create', 'create')->name('users.create');

    Route::post('/users/store', 'store')->name('users.store');

    Route::get('/users/{user:slug}/edit', 'edit')->name('users.edit');

    Route::post('/users/{user}/update', 'update')->name('users.update');

    Route::delete('/users/{user}delete', 'delete')->name('users.delete');
});

Route::post('users/{user}/active', [UserStatusController::class, 'status'])->name('users.active');


Route::get('/set-password/{user:slug}', [PasswordSetController::class, 'index'])->name('setpassword.index');

Route::post('/set-password/{user}', [PasswordSetController::class, 'setpassword'])->name('setpassword');

