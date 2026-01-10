<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\ShipmentController;

use App\Http\Controllers\HomeController;


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


Route::get("/", 'App\Http\Controllers\HomeController@index');

Route::get('/menu', [MenuController::class, 'menu'])->name('menu');

Route::get('/trace-my-order', [ShipmentController::class, 'trace'])->name('trace-my-order');
Route::get('/my-order', [ShipmentController::class, 'my_order'])->name('my-order');
Route::post("/register/confirm", [HomeController::class, 'register'])->name('register/confirm');
Route::get("/redirects", [HomeController::class, 'redirects']); // Keep redirects for any old methods that might need it, but simplify the method if needed.


Route::get("/rate/{id}", [HomeController::class, 'rate'])->name('rate');
Route::get("/top/rated", [HomeController::class, 'top_rated'])->name('top/rated');
Route::get("edit/rate/{id}", [HomeController::class, 'edit_rate'])->name('edit/rate');
Route::post("coupon/apply", [ShipmentController::class, 'coupon_apply'])->name('coupon/apply');
Route::get("delete/rate", [HomeController::class, 'delete_rate'])->name('delete/rate');
Route::get("/rate/confirm/{value}", [HomeController::class, 'store_rate'])->name('rate.confirm');

Route::get("/cart", [CartController::class, 'index'])->name('cart');
Route::post('/cart/checkout/{total}', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/menu/{product}', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/mails/shipped/{total}', [ShipmentController::class, 'place_order'])->name('mails.shipped');
Route::post('/confirm_place_order/{total}', [ShipmentController::class, 'send'])->name('confirm_place_order');
Route::post('/reserve/confirm', [HomeController::class, 'reservation_confirm'])->name('reserve.confirm');
Route::post('/trace/confirm', [ShipmentController::class, 'trace_confirm'])->name('trace.confirm');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');
