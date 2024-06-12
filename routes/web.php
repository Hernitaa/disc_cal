<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscountController;
Route::view('/', 'discount_form');
Route::get('/discount', function () {
    return view('discount_form');
})->name('discount.form');

Route::post('/calculate-discount', [DiscountController::class, 'calculateDiscount'])->name('calculate.discount');
Route::post('/cancel-purchase', [DiscountController::class, 'cancelPurchase'])->name('cancel.purchase');
