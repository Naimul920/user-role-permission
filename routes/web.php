<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/add-permission', [PermissionController::class, 'index'])->name('add.permission');
    Route::post('/create-permission', [PermissionController::class, 'store'])->name('create.permission');
    Route::get('/edit-permission/{id}', [PermissionController::class, 'edit'])->name('edit.permission');
    Route::put('/update-permission/{id}', [PermissionController::class, 'update'])->name('update.permission');
    Route::get('/delete-permission/{id}', [PermissionController::class, 'destroy'])->name('delete.permission');

    Route::get('/add-role', [RoleController::class, 'index'])->name('add.role');
    Route::post('/create-role', [RoleController::class, 'store'])->name('create.role');
    Route::get('/edit-role/{id}', [RoleController::class, 'edit'])->name('edit.role');
    Route::put('/update-role/{id}', [RoleController::class, 'update'])->name('update.role');
    Route::get('/delete-role/{id}', [RoleController::class, 'destroy'])->name('delete.role');

    Route::get('/add-edit-permission/{id}', [RoleController::class, 'addOrEditPermission'])->name('add-or-edit.permission');
    Route::put('/add-permission-to-role/{id}', [RoleController::class, 'givePermissionToRole'])->name('add-permission-to-role');

    Route::get('/add-user', [UserController::class, 'index'])->name('add.user');
    Route::post('/create-user', [UserController::class, 'store'])->name('create.user');
    Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('edit.user');
    Route::put('/update-user/{id}', [UserController::class, 'update'])->name('update.user');
    Route::get('/delete-user/{id}', [UserController::class, 'destroy'])->name('delete.user');
});

require __DIR__.'/auth.php';
