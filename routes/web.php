<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingImageController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingAcceptOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'index']);
Route::get('/hello', [IndexController::class, 'show']);

// Route::resource('listing', ListingController::class)
//     ->only(['create', 'store',])
//     ->middleware('auth');
Route::resource('listing', ListingController::class)
    ->only(['index', 'show']);

Route::resource('listing.offer', ListingOfferController::class)
->middleware('auth')
->only(['store']);    

Route::resource('notification', NotificationController::class)
->middleware('auth')
->only(['index']);

Route::put('notification/{notification}/seen', NotificationSeenController::class)
->middleware('auth')
->name('notification.seen');


Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login.store', [AuthController::class, 'store'])->name('login.store');
Route::delete('logouut', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', UserAccountController::class)->only(['create', 'store']);

Route::prefix('realtor')
    ->name('realtor.')
    ->middleware('auth')
    ->group(function() {
        Route::name('listing.restore')
        ->put(
            'listing/{listing}/restore',
            [RealtorListingController::class, 'restore']
        )->withTrashed();
        Route::resource('listing', RealtorListingController::class)
            ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
            ->withTrashed();

        Route::name('offer.accept')->put('offer/{offer}/accept', RealtorListingAcceptOfferController::class);

        Route::resource('listing.image', ListingImageController::class)->only(['create', 'store', 'destroy']);    
    });
