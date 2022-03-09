<?php

use App\Http\Controllers\Backend\ProductController;
use App\Http\Livewire\MyLicense;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Document;
use App\Http\Livewire\Git;
use App\Http\Livewire\License;
use App\Http\Livewire\LicenseCategory;
use App\Http\Livewire\LicenseSubCategory;
use App\Http\Livewire\Operator;
use App\Http\Livewire\Payment;
use App\Http\Livewire\PaymentMethod;
use App\Http\Livewire\PaymentReceive;
use App\Http\Livewire\PermissionManagement;
use App\Http\Livewire\ReceiveFee;
use App\Http\Livewire\ReceivePeriod;
use App\Http\Livewire\Report;
use App\Http\Livewire\User;
use App\Http\Livewire\Application;
use App\Http\Livewire\Expiration;
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
    Route::get('user', User::class)->name('user')->middleware(['permission:user']);
    Route::get('document', Document::class)->name('document')->middleware(['permission:document']);

    Route::get('application', Application::class)->name('application')->middleware(['permission:application']);
    Route::get('operator', Operator::class)->name('operator')->middleware(['permission:operator']);
    Route::get('expiration', Expiration::class)->name('expiration')->middleware(['permission:expiration']);

    Route::get('payment-method', PaymentMethod::class)->name('payment-method')->middleware(['permission:payment-method']);
    Route::get('license-category', LicenseCategory::class)->name('license-category')->middleware(['permission:license-category']);
    Route::get('license-sub-category', LicenseSubCategory::class)->name('license-sub-sategory')->middleware(['permission:license-sub-category']);
    Route::get('receiver-fee', ReceiveFee::class)->name('receiver-fee')->middleware(['permission:receiver-fee']);
    Route::get('receiver-period', ReceivePeriod::class)->name('receiver-period')->middleware(['permission:receiver-period']);

    Route::get('license', License::class)->name('license')->middleware(['permission:license']);
    Route::get('payment-receive', PaymentReceive::class)->name('payment-receive')->middleware(['permission:payment-receive']);
    Route::get('permission-management', PermissionManagement::class)->name('permission-management')->middleware(['permission:permission-management']);
    Route::get('report', Report::class)->name('report')->middleware(['permission:report']);
    Route::get('my-license', MyLicense::class)->name('my-license')->middleware(['permission:my-license']);
    Route::get('payment', Payment::class)->name('payment')->middleware(['permission:payment']);
    Route::get('git', Git::class)->name('git')->middleware(['permission:git']);
});
