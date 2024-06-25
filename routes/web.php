<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SendMailController;

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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'about'])->name('about_us');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact_us');
// Route::post('/contact-us/mail/send', [MailController::class, 'index'])->name('contact_us_send_mail');
Route::post('/contact-us/mail/send', [MailController::class, 'store'])->name('contact_us_store_mail');
Route::post('/achiever-list', [HomeController::class, 'achieverList'])->name('achiever_list');
Route::get('/gallary', [HomeController::class, 'gallary'])->name('gallary');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/product_list', [HomeController::class, 'productAjax'])->name('ajax');
Route::get('/product/view/{id}/{slug}', [HomeController::class, 'productView'])->name('product');


// Add to Cart Routes
Route::prefix('add-cart')->as('addCart.')->group(function () {
    Route::post('/store', [CartController::class, 'store'])->name('store');
    Route::post('/update', [CartController::class, 'update'])->name('update');
    Route::get('/get/data', [CartController::class, 'fetchData'])->name('get.data');
    Route::get('/cookie/remove/{product_id}', [CartController::class, 'destroy'])->name('destroy');

    Route::post('/agent/store', [CartController::class, 'agentStore'])->name('agent.store');
    Route::post('/agent/update', [CartController::class, 'agentUpdate'])->name('agent.update');
    Route::get('/agent/get/data', [CartController::class, 'agentFetchData'])->name('agent.get.data');
    Route::get('/agent/cookie/remove/{product_id}', [CartController::class, 'agentDestroy'])->name('agent.destroy');

    Route::post('/agent/package/store', [CartController::class, 'agentPackageStore'])->name('agent.package.store');
    Route::post('/agent/package/update', [CartController::class, 'agentPackageUpdate'])->name('agent.package.update');
    Route::get('/agent/package/get/data/{client_id}', [CartController::class, 'agentPackageFetchData'])->name('agent.package.get.data');
    Route::get('/agent/cookie/package/remove/{product_id}/{client_id}', [CartController::class, 'agentPackageDestroy'])->name('agent.package.destroy');

    Route::post('/agent/package/purchase/store', [CartController::class, 'agentPackagePurchaseStore'])->name('agent.package.purchase.store');
    Route::post('/agent/package/purchase/update', [CartController::class, 'agentPackagePurchaseUpdate'])->name('agent.package.purchase.update');
    Route::get('/agent/package/purchase/get/data', [CartController::class, 'agentPackagePurchaseFetchData'])->name('agent.package.purchase.get.data');
    Route::get('/agent/cookie/package/purchase/remove/{product_id}', [CartController::class, 'agentPackagePurchaseDestroy'])->name('agent.package.purchase.destroy');


    // Repurchase Add To Cart
    Route::post('/agent/package/user/repurchase/store', [CartController::class, 'agentPackageRePurchaseStore'])->name('agent.package.repurchase.store');
});

// Checkout Routes
Route::prefix('checkout')->as('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/register/user', [RegisteredUserController::class, 'store'])->name('register.store');
});


// Checkout Routes
Route::prefix('ajax')->as('ajax.')->group(function () {
    Route::get('/username/check/{username}', [AjaxController::class, 'username_check'])->name('username.check');
    Route::get('/refer-username/check/{username}', [AjaxController::class, 'refer_username'])->name('referusername.check');
    Route::get('/agent-username/check/{username}', [AjaxController::class, 'agent_username'])->name('agent_username.check');


    Route::get('/get-district-by-division/{id}', [AjaxController::class, 'getDistrictByDivision'])->name('get.district.by.division');
    Route::get('/get-upazila-by-district/{id}', [AjaxController::class, 'getUpazilaByDistrict'])->name('get.upazila.by.district');
    // Route::get('/get-property/{id}', [AjaxController::class, 'getProduct'])->name('get.by.category');
});

Route::get('/refer/{username}', [AjaxController::class, 'refer_link'])->name('refer.link');





// Route::get('dashboard', function () {
//     return view('user.home');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// });

Route::get('get/users', [AjaxController::class, 'getUsers'])->name('get.users');
Route::get('get/category', [AjaxController::class, 'get_category'])->name('get.category');
Route::get('get/subcategory/{id}', [AjaxController::class, 'get_subcategory'])->name('get.subcategory');
Route::get('get/states/{id}', [AjaxController::class, 'get_states'])->name('ajax.get.states');
Route::get('get/tele_code/{id}', [AjaxController::class, 'get_tele_code'])->name('ajax.get.tele_code');
Route::get('get/rank', [AjaxController::class, 'get_rank'])->name('get.rank');

Route::get('/test', [TestController::class, 'index'])->name('test');

require __DIR__ . '/user.php';
require __DIR__ . '/auth.php';
// admin routes









require __DIR__ . '/admin.php';
require __DIR__ . '/adminauth.php';
