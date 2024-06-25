<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClubBonusDetailsController;
use App\Http\Controllers\Admin\ComapanyInfoController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\LeadershipController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RankController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\GenerationController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\TransectionController;
use App\Http\Controllers\Admin\WithdrawController;
use App\Http\Controllers\User\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AboutSectionController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\DivisionControllelr;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\UpozilaController;


Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::get('dashboard', [DashboardController::class, 'index'])->name('home');

    Route::get('/add-about', [AboutSectionController::class, 'index'])->name('about.add');
    Route::post('/new-about', [AboutSectionController::class, 'create'])->name('category.create');
    Route::get('/manage-category', [CategoryController::class, 'manage'])->name('category.manage');
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/update-category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/delete-category/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    // categories routes
    Route::prefix('categories')->as('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    // Sub Category Routes
    Route::prefix('subcategory')->as('subcategory.')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('index');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [SubCategoryController::class, 'destroy'])->name('destroy');
    });

//    // Division Routes
//    Route::prefix('division')->as('division.')->group(function () {
//        Route::get('/', [DivisionControllelr::class, 'index'])->name('index');
//        Route::get('/create', [DivisionControllelr::class, 'create'])->name('create');
//        Route::post('/store', [DivisionControllelr::class, 'store'])->name('store');
//        Route::get('/edit/{id}', [DivisionControllelr::class, 'edit'])->name('edit');
//        Route::post('/update/{id}', [DivisionControllelr::class, 'update'])->name('update');
//        Route::get('/destroy/{id}', [DivisionControllelr::class, 'destroy'])->name('destroy');
//    });
//
//    // District Routes
//    Route::prefix('district')->as('district.')->group(function () {
//        Route::get('/', [DistrictController::class, 'index'])->name('index');
//        Route::get('/create', [DistrictController::class, 'create'])->name('create');
//        Route::post('/store', [DistrictController::class, 'store'])->name('store');
//        Route::get('/edit/{id}', [DistrictController::class, 'edit'])->name('edit');
//        Route::post('/update/{id}', [DistrictController::class, 'update'])->name('update');
//        Route::get('/destroy/{id}', [DistrictController::class, 'destroy'])->name('destroy');
//    });
//
//    // Upazila Routes
//    Route::prefix('upazila')->as('upazila.')->group(function () {
//        Route::get('/', [UpozilaController::class, 'index'])->name('index');
//        Route::get('/create', [UpozilaController::class, 'create'])->name('create');
//        Route::post('/store', [UpozilaController::class, 'store'])->name('store');
//        Route::get('/edit/{id}', [UpozilaController::class, 'edit'])->name('edit');
//        Route::post('/update/{id}', [UpozilaController::class, 'update'])->name('update');
//        Route::get('/destroy/{id}', [UpozilaController::class, 'destroy'])->name('destroy');
//        Route::get('/getDistricByDivisiion', [UpozilaController::class, 'getDistricByDivisiion'])->name('getDistricByDivisiion');
//    });



    // Products Routes
    Route::prefix('product')->as('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::get('/info/item/{id}', [ProductController::class, 'infoItem'])->name('info.item');
        Route::get('/feature/image/remove/{id}', [ProductController::class, 'feature_remove'])->name('feature.image.remove');
        Route::get('/thumbnail/remove/{id}', [ProductController::class, 'thumbnail_remove'])->name('thumbnail.remove');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::get('/search', [ProductController::class, 'search'])->name('search');
    });

    // Packages Routes
    Route::prefix('package')->as('package.')->group(function () {
        Route::get('/', [PackageController::class, 'index'])->name('index');
        Route::get('/create', [PackageController::class, 'create'])->name('create');
        Route::post('/store', [PackageController::class, 'store'])->name('store');
        Route::get('/destroy/{id}', [PackageController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [PackageController::class, 'edit'])->name('edit');
        Route::get('/view/{id}', [PackageController::class, 'show'])->name('view');
        Route::put('/update/{id}', [PackageController::class, 'update'])->name('update');
        Route::get('/image/remove/{id}', [PackageController::class, 'imageRemove'])->name('image.remove');

    });


    // User Routes
    Route::prefix('user')->as('user.')->group(function () {
        Route::get('/list', [AdminUserController::class, 'index'])->name('list');
        Route::get('/create', [AdminUserController::class, 'create'])->name('create');
        Route::post('/store', [AdminUserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AdminUserController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
    });

    // Deposit Routes
    Route::prefix('deposit')->as('deposit.')->group(function () {
        Route::get('/', [DepositController::class, 'index'])->name('index');
        Route::get('/create', [DepositController::class, 'create'])->name('create');
        Route::post('/store', [DepositController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DepositController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [DepositController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [DepositController::class, 'destroy'])->name('destroy');

        Route::get('/status/{id}/{status}', [DepositController::class, 'status'])->name('status');
    });

    // Withdraw routes
    Route::prefix('withdraw')->as('withdraw.')->group(function () {
        Route::get('/', [WithdrawController::class, 'index'])->name('index');
        Route::get('/status/{id}/{status}/{withdraw_status}', [WithdrawController::class, 'status'])->name('status');
    });

    // Rank Routes
    Route::prefix('rank')->as('rank.')->group(function () {
        Route::get('/', [RankController::class, 'index'])->name('index');
        Route::get('/create', [RankController::class, 'create'])->name('create');
        Route::post('/store', [RankController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RankController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [RankController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [RankController::class, 'destroy'])->name('destroy');
        Route::get('/rank/users', [RankController::class, 'rankUsers'])->name('users');
        Route::get('/rank/users/give/{rank_name}/{username}', [RankController::class, 'rankGive'])->name('give.user.rank');
    });

    // Leadership Routes
    Route::prefix('leadership')->as('leadership.')->group(function () {
        Route::get('/', [LeadershipController::class, 'index'])->name('index');
        Route::get('/create', [LeadershipController::class, 'create'])->name('create');
        Route::post('/store', [LeadershipController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [LeadershipController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [LeadershipController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [LeadershipController::class, 'destroy'])->name('destroy');
    });

    // Genetation Routes
    Route::prefix('generation')->as('generation.')->group(function () {
        Route::get('/', [GenerationController::class, 'index'])->name('index');
        Route::get('/create', [GenerationController::class, 'create'])->name('create');
        Route::post('/store', [GenerationController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [GenerationController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [GenerationController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [GenerationController::class, 'destroy'])->name('destroy');
    });

    // Club Bonus Details Routes
    Route::prefix('club_bonus_details')->as('club_bonus_details.')->group(function () {
        Route::get('/', [ClubBonusDetailsController::class, 'index'])->name('index');
        Route::get('/create', [ClubBonusDetailsController::class, 'create'])->name('create');
        Route::post('/store', [ClubBonusDetailsController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ClubBonusDetailsController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ClubBonusDetailsController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [ClubBonusDetailsController::class, 'destroy'])->name('destroy');
    });

    // Comapny settings routes
    Route::prefix('settings')->as('settings.')->group(function () {
        Route::get('/company-info', [ComapanyInfoController::class, 'index'])->name('index');
        Route::post('/company-info/logo/store', [ComapanyInfoController::class, 'logoUpdate'])->name('logo.store');
        Route::get('/company-info/logo/remove/{field_name}', [ComapanyInfoController::class, 'logoRemove'])->name('logo.remove');
        Route::post('/company-info/details/store', [ComapanyInfoController::class, 'companyDetails'])->name('company.details.store');

        Route::prefix('home')->as('home.')->group(function () {
            Route::get('/home-page', [PageController::class, 'index'])->name('index');
            Route::post('/home-page/banner/store', [PageController::class, 'bannerStore'])->name('banner.store');
            Route::get('/home-page/banner/remove/{id}/{class_name}', [PageController::class, 'BannerRemove'])->name('banner.remove');
            // Route::post('/company-info/details/store', [ComapanyInfoController::class, 'companyDetails'])->name('company.details.store');

        });

        Route::prefix('about')->as('about.')->group(function () {

            Route::get('/about-page', [AboutSectionController::class, 'index'])->name('index');
            Route::post('/about-page/banner/store', [AboutSectionController::class, 'store'])->name('store');
            Route::post('/about-page/banner/update/{id}', [AboutSectionController::class, 'update'])->name('update');
        });


        Route::prefix('contact')->as('contact.')->group(function () {

            Route::get('/contact-page', [ContactController::class, 'index'])->name('index');
            Route::post('/contact-page/store', [ContactController::class, 'store'])->name('store');
            Route::post('/contact-page/update/{id}', [ContactController::class, 'update'])->name('update');
        });

        Route::prefix('adds')->as('add_banner.')->group(function () {
            Route::get('/home-page', [BannerController::class, 'index'])->name('index');
            Route::post('/home-page/banner/store', [BannerController::class, 'bannerStore'])->name('banner.store');
            Route::get('/home-page/banner/remove/{id}', [BannerController::class, 'BannerRemove'])->name('banner.remove');
            // Route::post('/company-info/details/store', [ComapanyInfoController::class, 'companyDetails'])->name('company.details.store');
        });


        // Division Routes
        Route::prefix('division')->as('division.')->group(function () {
            Route::get('/', [DivisionControllelr::class, 'index'])->name('index');
            Route::get('/create', [DivisionControllelr::class, 'create'])->name('create');
            Route::post('/store', [DivisionControllelr::class, 'store'])->name('store');
            Route::get('/edit/{id}', [DivisionControllelr::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [DivisionControllelr::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [DivisionControllelr::class, 'destroy'])->name('destroy');
        });

        // District Routes
        Route::prefix('district')->as('district.')->group(function () {
            Route::get('/', [DistrictController::class, 'index'])->name('index');
            Route::get('/create', [DistrictController::class, 'create'])->name('create');
            Route::post('/store', [DistrictController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [DistrictController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [DistrictController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [DistrictController::class, 'destroy'])->name('destroy');
        });

        // Upazila Routes
        Route::prefix('upazila')->as('upazila.')->group(function () {
            Route::get('/', [UpozilaController::class, 'index'])->name('index');
            Route::get('/create', [UpozilaController::class, 'create'])->name('create');
            Route::post('/store', [UpozilaController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UpozilaController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [UpozilaController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [UpozilaController::class, 'destroy'])->name('destroy');
            Route::get('/getDistricByDivisiion', [UpozilaController::class, 'getDistricByDivisiion'])->name('getDistricByDivisiion');
        });


//        // Country Routes
//        Route::prefix('country')->as('country.')->group(function () {
//            Route::get('/', [CountryController::class, 'index'])->name('index');
//            Route::get('/create', [CountryController::class, 'create'])->name('create');
//            Route::post('/store', [CountryController::class, 'store'])->name('store');
//            Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('edit');
//            Route::post('/update/{id}', [CountryController::class, 'update'])->name('update');
//            Route::get('/destroy/{id}', [CountryController::class, 'destroy'])->name('destroy');
//        });
//
//        // State Routes
//        Route::prefix('state')->as('state.')->group(function () {
//            Route::get('/', [StateController::class, 'index'])->name('index');
//            Route::get('/create', [StateController::class, 'create'])->name('create');
//            Route::post('/store', [StateController::class, 'store'])->name('store');
//            Route::get('/edit/{id}', [StateController::class, 'edit'])->name('edit');
//            Route::post('/update/{id}', [StateController::class, 'update'])->name('update');
//            Route::get('/destroy/{id}', [StateController::class, 'destroy'])->name('destroy');
//        });

    });

    // Products Orders Routes
    Route::prefix('order/product')->as('order.')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('index');
        Route::get('/status/{id}/{status}/{order_status}', [InvoiceController::class, 'status'])->name('status');

        // Route::prefix('package')->as('package.')->group(function () {
        //     Route::get('/', [InvoiceController::class, 'package_orders'])->name('index');
        // });
    });
    // Package Orders Routes
    Route::prefix('order/package')->as('order.package.')->group(function () {
        Route::get('/', [InvoiceController::class, 'packageIndex'])->name('index');
        Route::get('/status/{id}/{status}/{order_status}', [InvoiceController::class, 'packageStatus'])->name('status');
    });

    // Agent Orders Routes
    Route::prefix('purchase')->as('purchase.')->group(function () {
        Route::get('/', [PurchaseController::class, 'index'])->name('index');
        Route::get('/status/{id}/{status}/{order_status}', [PurchaseController::class, 'status'])->name('status');

        Route::prefix('package')->as('package.')->group(function () {
            Route::get('/', [PurchaseController::class, 'package_orders'])->name('index');
            Route::get('/status/{id}/{status}/{order_status}', [PurchaseController::class, 'package_status'])->name('status');
        });
    });

    // All Transection Routes
    Route::prefix('transaction')->as('transaction.')->group(function () {
        Route::get('/', [TransectionController::class, 'index'])->name('index');
        Route::get('/destroy/{id}', [TransectionController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [TransectionController::class, 'edit'])->name('edit');
    });

    Route::prefix('rank')->as('rank.')->group(function () {
        Route::get('/run_rank',function(){
            Artisan::call('app:rank');
            return response()->json(["message"=>"Rank Cron Done"]);
        })->name('give.index');

        Route::get('/rank-commission',function(){
            Artisan::call('app:rank-commission');
            return response()->json(["message"=>"Rank Commission Done"]);
        })->name('rank.commission');
    });





});
