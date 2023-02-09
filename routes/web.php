<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StripeWebhookController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use TCG\Voyager\Facades\Voyager;

Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])
    ->name('cart.store');
Route::patch('/cart/{rowId}', [CartController::class, 'update'])
    ->name('cart.update');
Route::delete('/cart/{rowId}', [CartController::class, 'destroy'])
    ->name('cart.destroy');
Route::post('/cart/to-favorites/{rowId}', [CartController::class, 'switchToFavorites'])
    ->name('cart.switchToFavorites');

Route::delete('/favorites/{rowId}', [FavoritesController::class, 'destroy'])
    ->name('favorites.destroy');
Route::post('/favorites/to-cart/{rowId}', [FavoritesController::class, 'switchToCart'])
    ->name('favorites.switchToCart');

Route::post('/coupon', [CouponsController::class, 'store'])
    ->name('coupon.store');
Route::delete('/coupon', [CouponsController::class, 'destroy'])
    ->name('coupon.destroy');

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');
Route::post('/checkout/payment-intent', [CheckoutController::class, 'createPaymentIntent'])
    ->name('checkout.createPaymentIntent');
Route::get('/checkout/success', [CheckoutController::class, 'success'])
    ->name('checkout.success');

Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])
    ->name('webhook.handle');

Route::get('/about', [InformationController::class, 'index'])
    ->name('information.index');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();
