<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function calculateDiscount(Request $request)
{
    $items = json_decode($request->input('items'), true);
    $totalPrice = 0;
    $paymentMethod = $request->input('payment_method'); // Ambil informasi metode pembayaran yang dipilih

    // Hitung total harga dari semua barang
    foreach ($items as $item) {
        $totalPrice += $item['price'];
    }

    $discount = 0;
    $finalPrice = $totalPrice;

    // Periksa apakah total harga melebihi batas untuk mendapatkan diskon
    if ($totalPrice >= 400000) {
        $discount = round($totalPrice * 0.23);
        $finalPrice = round($totalPrice - $discount);
    }

    // Menyiapkan data untuk ditampilkan di view
    $result = [
        'total_price' => $totalPrice,
        'discount' => $discount,
        'final_price' => $finalPrice,
        'payment_method' => $paymentMethod, // Sertakan informasi metode pembayaran dalam hasil
    ];

    return view('discount_result', ['items' => $items, 'result' => $result]);
}

    
}