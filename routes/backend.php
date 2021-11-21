<?php

use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Web Routes
|--------------------------------------------------------------------------
*/

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('permission-management', function(){
    return view('backend.permission.index');
})->middleware(['auth'])->name('permission-management');
