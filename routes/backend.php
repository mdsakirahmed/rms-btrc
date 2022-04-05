<?php

use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Document;
use App\Http\Livewire\Git;
use App\Http\Livewire\LicenseCategory;
use App\Http\Livewire\LicenseSubCategory;
use App\Http\Livewire\Operator;
use App\Http\Livewire\Payment;
use App\Http\Livewire\PermissionManagement;
use App\Http\Livewire\Report;
use App\Http\Livewire\User;
use App\Http\Livewire\Application;
use App\Http\Livewire\Bank;
use App\Http\Livewire\Expiration;
use App\Http\Livewire\FeeType;
use App\Http\Livewire\LicenseCategorywiseFee;
use App\Http\Livewire\Profile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    //Permitted first route
    Route::get('/dashboard', function () {
        return redirect()->route(auth()->user()->getAllPermissions()->first()->name);
    })->name('dashboard');

    Route::get('product', [ProductController::class, 'index'])->middleware(['auth'])->name('product.index')->middleware(['permission:product-list']);
    Route::get('product-export', [ProductController::class, 'export'])->middleware(['auth'])->name('product.export')->middleware(['permission:product-export']);
    Route::post('product-import', [ProductController::class, 'import'])->middleware(['auth'])->name('product.import')->middleware(['permission:product-import']);

    // Livewire
    Route::get('my-dashboard', Dashboard::class)->name('my-dashboard')->middleware(['permission:my-dashboard']);
    Route::get('profile', Profile::class)->name('profile')->middleware(['permission:profile']);
    Route::get('user', User::class)->name('user')->middleware(['permission:user']);
    Route::get('permission-management', PermissionManagement::class)->name('permission-management')->middleware(['permission:permission-management']);
    Route::get('document', Document::class)->name('document')->middleware(['permission:document']);
    Route::get('application', Application::class)->name('application')->middleware(['permission:application']);
    Route::get('fee-type', FeeType::class)->name('fee-type')->middleware(['permission:fee-type']);
    Route::get('license-category', LicenseCategory::class)->name('license-category')->middleware(['permission:license-category']);
    Route::get('license-sub-category', LicenseSubCategory::class)->name('license-sub-sategory')->middleware(['permission:license-sub-category']);
    Route::get('operator', Operator::class)->name('operator')->middleware(['permission:operator']);
    Route::get('expiration/{operator}', Expiration::class)->name('expiration')->middleware(['permission:expiration']);
    Route::get('license-category-wise-fee/{license_category}', LicenseCategorywiseFee::class)->name('licenseCategorywiseFee')->middleware(['permission:license-category']);
    Route::get('bank', Bank::class)->name('bank')->middleware(['permission:bank']);
    Route::get('payment', Payment::class)->name('payment')->middleware(['permission:payment']);
    // Route::get('report', Report::class)->name('report')->middleware(['permission:report']);
    Route::get('report', [ReportController::class, 'index'])->name('report')->middleware(['permission:report']);
    Route::get('report/get-suggestion-for-filter', [ReportController::class, 'getSuggestionForFilter'])->name('getSuggestionForFilter')->middleware(['permission:report']); //Use for ui auto complete
    Route::get('report/filter-submit', [ReportController::class, 'filterSubmit'])->name('filterSubmit')->middleware(['permission:report']); //Use for ui auto complete
});
