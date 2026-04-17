<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Product;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;

// HOME
Route::get('/', function () {
    $products = Product::all();
    return view('home', compact('products'));
});

// PRODUK
Route::get('/produk', function () {
    $products = Product::all();
    return view('produk', compact('products'));
});

// TAMBAH KE CART
Route::post('/cart/add/{id}', function ($id, Request $request) {
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        $cart[$id]['qty']++;
    } else {
        $product = Product::findOrFail($id);

        $cart[$id] = [
            "nama" => $product->nama,
            "qty" => 1,
            "harga" => $product->harga,
            "gambar" => $product->gambar
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back();
});

// HALAMAN CART (BIAR NGGAK 404)
Route::get('/cart', function () {
    $cart = session('cart', []);
    return view('cart', compact('cart'));
});

// TAMBAH QTY
Route::post('/cart/increase/{id}', function ($id) {
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        $cart[$id]['qty']++;
    }

    session()->put('cart', $cart);
    return redirect()->back();
});

// KURANG QTY
Route::post('/cart/decrease/{id}', function ($id) {
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        $cart[$id]['qty']--;

        if($cart[$id]['qty'] <= 0) {
            unset($cart[$id]);
        }
    }

    session()->put('cart', $cart);
    return redirect()->back();
});

Route::get('/checkout', function () {

    Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    Config::$isProduction = false;
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $cart = session('cart', []);

    $total = 0;
    $items = [];

    foreach ($cart as $id => $item) {
        $items[] = [
            'id' => $id,
            'price' => $item['harga'],
            'quantity' => $item['qty'],
            'name' => $item['nama'],
        ];

        $total += $item['harga'] * $item['qty'];
    }

    $params = [
        'transaction_details' => [
            'order_id' => rand(),
            'gross_amount' => $total,
        ],
        'item_details' => $items,
        'customer_details' => [
            'first_name' => 'Cia',
            'email' => 'cia@email.com',
        ],
    ];

    $snapToken = Snap::getSnapToken($params);

    $order = Order::create([
    'nama' => 'Cia',
    'total' => $total,
    'status' => 'pending'
]);

    return view('checkout', compact('snapToken', 'total'));
});

Route::get('/pesanan', function (Illuminate\Http\Request $request) {
    $status = $request->status;

    if ($status) {
        $orders = \App\Models\Order::where('status', $status)->get();
    } else {
        $orders = \App\Models\Order::all();
    }

    return view('pesanan', compact('orders', 'status'));
});

use Illuminate\Support\Facades\Artisan;

Route::get('/migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migration done';
});