<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('products.index');

//        Inertia::render('products.index', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Account/Index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group([
    'middleware' => 'web',
], function() {
    Route::resource('products', ProductController::class)
        ->parameters(['products' => 'product:sku'])->only(['index','show']);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add-to-cart/{variant:sku}', [CartController::class, 'store'])->name('add.to.cart');
    Route::get('/update-the-cart/{variant:sku}/{quantity}', [CartController::class, 'update'])->name('update.the.cart');
    Route::get('/delete-from-cart/{variant:sku}', [CartController::class, 'destroy'])->name('delete.from.cart');
});

Route::group([
    'middleware' => 'auth'
], function() {
    Route::resource('checkout', CheckoutController::class)
        ->only(['index', 'store']);

    Route::resource('payment', PaymentController::class)
        ->parameters(['payment' => 'order:uuid'])->only(['index', 'store', 'show']);

    Route::resource('account', AccountController::class)
        ->only(['index']);

    Route::resource('orders', OrderController::class)
        ->parameters(['orders' => 'order:uuid'])->only(['index', 'show']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
