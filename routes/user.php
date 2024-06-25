<?php

use App\Helpers\Constant;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CustomerReports;
use App\Http\Controllers\Customer\InvoiceController as CustomerInvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\AgentStockController;
use App\Http\Controllers\User\ClientController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\User\PackagePurchaseController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserController2;
use App\Http\Controllers\User\WithdrawController;
use App\Http\Controllers\UserReportController;
use Illuminate\Support\Facades\Route;
Route::group(['middleware' => ['auth','blocked.users'], 'prefix' => 'user', 'as' => 'user.'], function(){

    // Agent Routes
    Route::middleware(['checkUserType:'.Constant::USER_TYPE['agent']])->group(function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('home');

        // Profile Routes
        Route::prefix('profile')->as('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::post('/update', [ProfileController::class, 'update'])->name('update');
        });

        // Profile Routes
        Route::prefix('refer')->as('refer.')->group(function () {
            Route::get('/', [UserReportController::class, 'index'])->name('index');
            Route::get('/team/count', [UserReportController::class, 'teamUserCount'])->name('team.count');
        });

        // Route::prefix('home')->as('home.')->group(function () {
        //     return view('admin.home');

        // });

        // Deposit routes
        Route::prefix('deposit')->as('deposit.')->group(function () {
            Route::get('/', [DepositController::class, 'index'])->name('index');
            Route::get('create', [DepositController::class, 'create'])->name('create');
            Route::post('/store', [DepositController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [DepositController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [DepositController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [DepositController::class, 'destroy'])->name('destroy');
        });

        // Withdraw routes
        Route::prefix('withdraw')->as('withdraw.')->group(function () {
            Route::get('/', [WithdrawController::class, 'index'])->name('index');
            Route::get('create', [WithdrawController::class, 'create'])->name('create');
            Route::post('/store', [WithdrawController::class, 'store'])->name('store');
        });

        // Checkout Routes
        // Route::prefix('checkout')->as('checkout.')->group(function () {
        //     Route::post('/store', [InvoiceController::class, 'store'])->name('store');
        // });

        Route::prefix('order')->as('order.')->group(function () {
            Route::get('product/create', [InvoiceController::class, 'create'])->name('create');

            Route::get('product/', [InvoiceController::class, 'index'])->name('index');
            Route::get('product/status/{id}/{status}/{order_status}', [InvoiceController::class, 'status'])->name('status');

            Route::get('package/', [InvoiceController::class, 'packageIndex'])->name('package.index');
            Route::get('package/status/{id}/{status}/{order_status}', [InvoiceController::class, 'packageStatus'])->name('package.status');
        });

        // Stock Routes
        Route::prefix('stock')->as('stock.')->group(function () {
            Route::get('/stock/list', [AgentStockController::class, 'stockList'])->name('list');
            Route::get('/stock/package', [AgentStockController::class, 'PackageStockList'])->name('package.list');
        });

        Route::prefix('purchase')->as('purchase.')->group(function () {
            Route::get('/', [AgentStockController::class, 'index'])->name('index');
            Route::get('/create', [AgentStockController::class, 'create'])->name('create');
            Route::post('/store', [AgentStockController::class, 'store'])->name('store');

            Route::get('/package', [AgentStockController::class, 'package_index'])->name('package.index');
            Route::get('/package/create', [AgentStockController::class, 'package_create'])->name('package.create');
            Route::post('/package/store', [AgentStockController::class, 'package_store'])->name('package.store');
        });

        Route::prefix('clients')->as('client.')->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('index');
            Route::get('/create', [ClientController::class, 'create'])->name('create');
            Route::post('/store', [ClientController::class, 'store'])->name('store');
            // Route::get('/status/{id}/{status}/{order_status}', [InvoiceController::class, 'status'])->name('status');
        });

        Route::prefix('package')->as('package.')->group(function () {
            Route::get('/purchase/client/{id}', [PackagePurchaseController::class, 'packagePurchase'])->name('purchase.create');
            Route::post('/purchase/store/client', [PackagePurchaseController::class, 'packagePurchaseStore'])->name('client.purchase.store');
        });


    });

    // Customer Routes
    Route::middleware(['checkUserType:'.Constant::USER_TYPE['user']])->group(function () {
        Route::prefix('customer')->as('customer.')->group(function () {
            Route::get('/dashboard', [CustomerController::class, 'index'])->name('home');

            // Profile Routes
            Route::prefix('profile')->as('profile.')->group(function () {
                Route::get('/', [ProfileController::class, 'index'])->name('index');
                Route::post('/update', [ProfileController::class, 'update'])->name('update');
            });

            // Profile Routes
            Route::prefix('refer')->as('refer.')->group(function () {
                Route::get('/', [UserReportController::class, 'index'])->name('index');
                Route::get('/team/count', [UserReportController::class, 'teamUserCount'])->name('team.count');
                Route::get('/team/sales', [UserReportController::class, 'teamUserSales'])->name('team.sales');
                Route::get('/team/my-gen-invest-data', [UserReportController::class, 'genInvest'])->name('team.invest');
            });

            // Orders Routes
            Route::prefix('order')->as('order.')->group(function () {
                Route::get('/', [CustomerInvoiceController::class, 'index'])->name('index');
                Route::get('create', [CustomerInvoiceController::class, 'create'])->name('create');
                Route::post('/store', [CustomerInvoiceController::class, 'store'])->name('store');
            });

            // Withdraw routes
            Route::prefix('withdraw')->as('withdraw.')->group(function () {
                Route::get('/', [WithdrawController::class, 'index'])->name('index');
                Route::get('create', [WithdrawController::class, 'create'])->name('create');
                Route::post('/store', [WithdrawController::class, 'store'])->name('store');
            });

            // All Reports routes
            Route::prefix('reports')->as('reports.')->group(function () {
                Route::get('/', [CustomerReports::class, 'index'])->name('index');
            });

        });
    });

});
