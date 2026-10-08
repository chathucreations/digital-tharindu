<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Customer;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarxIpgController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public storefront
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Google Sign-In (Socialite)
|--------------------------------------------------------------------------
*/

Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');

/*
|--------------------------------------------------------------------------
| Authenticated customers: cart, checkout, dashboard
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/buy-now', [CartController::class, 'buyNow'])->name('cart.buy');
    Route::delete('/cart/{key}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    // Marx IPG gateway callbacks / sandbox
    Route::get('/checkout/marx/callback', [MarxIpgController::class, 'callback'])->name('checkout.marx.callback');
    Route::get('/checkout/marx/sandbox/{order}', [MarxIpgController::class, 'sandbox'])->name('checkout.marx.sandbox');
    Route::post('/checkout/marx/sandbox/{order}/complete', [MarxIpgController::class, 'sandboxComplete'])->name('checkout.marx.sandbox.complete');
    Route::get('/checkout/marx/sandbox/{order}/cancel', [MarxIpgController::class, 'sandboxCancel'])->name('checkout.marx.sandbox.cancel');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Customer dashboard
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/', [Customer\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/orders', [Customer\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [Customer\OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/payment-proof', [Customer\OrderController::class, 'uploadProof'])->name('orders.proof');
        Route::get('/invoices', [Customer\InvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/invoices/{invoice}/download', [Customer\OrderController::class, 'invoice'])->name('invoices.download');
        Route::get('/products', [Customer\ProductController::class, 'index'])->name('products');
        Route::get('/products/{item}/download', [Customer\ProductController::class, 'download'])->name('products.download');
    });
});

Route::get('/dashboard', function () {
    return auth()->user()?->isAdmin()
        ? redirect()->route('filament.admin.pages.dashboard')
        : redirect()->route('customer.dashboard');
})->middleware('auth')->name('dashboard');

require __DIR__.'/auth.php';
