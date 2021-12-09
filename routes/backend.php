<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserPermissionController;
use App\Http\Livewire\Document;
use App\Http\Livewire\LicenseCategory;
use App\Http\Livewire\LicenseSubCategory;
use App\Http\Livewire\Operator;
use App\Http\Livewire\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Web Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/user-permission', [UserPermissionController::class, 'index'])->name('user-permission.index')->middleware(['permission:manage user permission']);
Route::get('/user-permission/edit/{id}', [UserPermissionController::class, 'edit'])->name('user-permission.edit')->middleware(['permission:manage user permission']);
Route::patch('/user-permission/edit/{id}', [UserPermissionController::class, 'update'])->name('user-permission.update')->middleware(['permission:manage user permission']);
Route::get('/user-permission/role/{id}', [UserPermissionController::class, 'editUserRole'])->name('user-permission.role.edit')->middleware(['permission:manage user permission']); // Edit Roles of a user {user_id}
Route::patch('/user-permission/role/{id}', [UserPermissionController::class, 'updateUserRole'])->name('user-permission.role.update')->middleware(['permission:manage user permission']); // Update Roles of a user {user_id}
Route::get('/role', [RoleController::class, 'index'])->name('role.index')->middleware(['permission:manage user permission']);
Route::get('/role/create', [RoleController::class, 'create'])->name('role.create')->middleware(['permission:manage user permission']);
Route::post('/role/create', [RoleController::class, 'store'])->name('role.store')->middleware(['permission:manage user permission']);
Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware(['permission:manage user permission']);
Route::patch('/role/edit/{id}', [RoleController::class, 'update'])->name('role.update')->middleware(['permission:manage user permission']);
Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy')->middleware(['permission:manage user permission']);
Route::get('product', [ProductController::class, 'index'])->middleware(['auth'])->name('product.index')->middleware(['permission:product list']);
Route::get('product-export', [ProductController::class, 'export'])->middleware(['auth'])->name('product.export')->middleware(['permission:product export']);
Route::post('product-import', [ProductController::class, 'import'])->middleware(['auth'])->name('product.import')->middleware(['permission:product import']);

// Livewire
Route::get('user', User::class)->name('user');
Route::get('document', Document::class)->name('document');
Route::get('license-category', LicenseCategory::class)->name('licenseCategory');
Route::get('license-sub-category', LicenseSubCategory::class)->name('licenseSubCategory');
Route::get('operator', Operator::class)->name('operator');

});
