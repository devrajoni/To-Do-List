<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;


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



//** Authentication Routes **//
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.store');
Route::post('logout', [LogoutController::class, 'destroy'])->name('logout');
Route::get('register', [RegistrationController::class, 'index'])->name('register');
Route::post('register', [RegistrationController::class, 'store'])->name('register.store');


//** Dashboard Routes **//
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});
   //** Task Routes **//
Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::post('/tasks/{id}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
    Route::post('/tasks/assign-users', [TaskController::class, 'assignUsers'])->name('tasks.assignUsers');
});

 //** Employee Routes **//
Route::middleware('auth')->group(function () {
    Route::get('employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
});







