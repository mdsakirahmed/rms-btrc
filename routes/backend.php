<?php

use App\Http\Controllers\Backend\ProductController;
use App\Http\Livewire\Activity;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Document;
use App\Http\Livewire\LicenseCategory;
use App\Http\Livewire\LicenseSubCategory;
use App\Http\Livewire\Operator;
use App\Http\Livewire\PermissionManagement;
use App\Http\Livewire\User;
use App\Http\Livewire\Application;
use App\Http\Livewire\Report\OperatorWiseFileRegister;
use App\Http\Livewire\Bank;
use App\Http\Livewire\Expiration;
use App\Http\Livewire\FeeType;
use App\Http\Livewire\LicenseCategorywiseFee;
use App\Http\Livewire\OperatorWisePayments;
use App\Http\Livewire\Payment;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Report\BankDepositWiseStatement;
use App\Http\Livewire\Report\CategoryWiseStatement;
use App\Http\Livewire\Report\DueStatement;
use App\Http\Livewire\Report\OperatorDetail;
use App\Http\Livewire\Report\Statement;
use App\Http\Livewire\Report\VatStatement;
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
    Route::get('operator-wise-payment/{operator}', OperatorWisePayments::class)->name('operator-wise-payment')->middleware(['permission:operator']);
    Route::get('expiration/{operator}', Expiration::class)->name('expiration')->middleware(['permission:expiration']);
    Route::get('license-category-wise-fee/{license_category}', LicenseCategorywiseFee::class)->name('licenseCategorywiseFee')->middleware(['permission:license-category']);
    Route::get('bank', Bank::class)->name('bank')->middleware(['permission:bank']);
    
    Route::get('payment', Payment::class)->name('payment')->middleware(['permission:payment']);
    Route::get('activity', Activity::class)->name('activity')->middleware(['permission:activity']);

    // Reports
    Route::get('operator-wise-file-register', OperatorWiseFileRegister::class)->name('operator-wise-file-register')->middleware(['permission:report']);
    Route::get('operator-detail', OperatorDetail::class)->name('operator-detail')->middleware(['permission:report']);
    Route::get('vat-statement', VatStatement::class)->name('vat-statement')->middleware(['permission:report']);
    Route::get('due-statement', DueStatement::class)->name('due-statement')->middleware(['permission:report']);
    Route::get('statement', Statement::class)->name('revenue-sharing-statement')->middleware(['permission:report']);
    Route::get('category-wise-statement', CategoryWiseStatement::class)->name('category-wise-statement')->middleware(['permission:report']);
    Route::get('bank-deposit-statement', BankDepositWiseStatement::class)->name('bank-deposit-statement')->middleware(['permission:report']);
});
