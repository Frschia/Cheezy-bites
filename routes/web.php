<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Order;

use Midtrans\Config;
use Midtrans\Snap;

use App\Models\Testimonial;

use App\Models\User;
use App\Models\Setting;
use App\Models\OrderItem;

/*
|--------------------------------------------------------------------------
| HALAMAN AKUN
|--------------------------------------------------------------------------
*/

Route::get('/akun', function () {

    if (Auth::check()) {
        return view('akun');
    }

    return view('pilih-login');
});

Route::post('/akun/edit', function (Request $request) {

    if (!Auth::check()) {
        return redirect('/pilih-login');
    }

    $user = User::find(Auth::id());

    $user->name = $request->name;
    $user->phone = $request->phone;
    $user->address = $request->address;

    $user->save();

    return redirect('/akun');

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $products = Product::all();
    return view('home', compact('products'));
});

/*
|--------------------------------------------------------------------------
| PRODUK
|--------------------------------------------------------------------------
*/

Route::get('/produk', function () {
    $products = Product::all();
    return view('produk', compact('products'));
});

Route::post('/produk/stok/{id}', function ($id, Request $request) {

    if (!Auth::check() || Auth::user()->role != 'superadmin') {
        abort(403);
    }

    $product = Product::findOrFail($id);

    if ($request->aksi == 'tambah') {
        $product->stok += 1;
    }

    if ($request->aksi == 'kurang' && $product->stok > 0) {
        $product->stok -= 1;
    }

    $product->save();

    return redirect()->back();

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

// tambah cart
Route::post('/cart/add/{id}', function ($id, Request $request) {

    if (!Auth::check()) {
        return redirect('/pilih-login');
    }

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {

        $cart[$id]['qty']++;

    } else {

        $product = Product::findOrFail($id);

        $cart[$id] = [
            "nama"   => $product->nama,
            "qty"    => 1,
            "harga"  => $product->harga,
            "gambar" => $product->gambar
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back();
});

// halaman cart
Route::get('/cart', function () {

    if (!Auth::check()) {
        return redirect('/pilih-login');
    }

    $cart = session('cart', []);
    return view('cart', compact('cart'));
});

// tambah qty
Route::post('/cart/increase/{id}', function ($id) {

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['qty']++;
    }

    session()->put('cart', $cart);

    return redirect()->back();
});

// kurang qty
Route::post('/cart/decrease/{id}', function ($id) {

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {

        $cart[$id]['qty']--;

        if ($cart[$id]['qty'] <= 0) {
            unset($cart[$id]);
        }
    }

    session()->put('cart', $cart);

    return redirect()->back();
});

/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
*/

Route::get('/checkout', function () {

    if (!Auth::check()) {
        return redirect('/pilih-login');
    }

    $cart = session('cart', []);

    if (count($cart) == 0) {
        return redirect('/cart');
    }

    $total = 0;

    foreach ($cart as $item) {
        $total += $item['harga'] * $item['qty'];
    }

    return view('checkout', compact('total'));

});

Route::post('/checkout', function (Request $request) {

    if (!Auth::check()) {
        return redirect('/pilih-login');
    }

    Config::$serverKey    = env('MIDTRANS_SERVER_KEY');
    Config::$isProduction = false;
    Config::$isSanitized  = true;
    Config::$is3ds        = true;

    $cart = session('cart', []);

    if (count($cart) == 0) {
        return redirect('/cart');
    }

    $total = 0;
    $items = [];

    foreach ($cart as $id => $item) {

        $items[] = [
            'id'       => $id,
            'price'    => $item['harga'],
            'quantity' => $item['qty'],
            'name'     => $item['nama'],
        ];

        $total += $item['harga'] * $item['qty'];
    }

    $product = Product::find($id);

if($product){
    $product->stok -= $item['qty'];

    if($product->stok < 0){
        $product->stok = 0;
    }

    $product->save();
}

    $params = [
        'transaction_details' => [
            'order_id'     => rand(),
            'gross_amount' => $total,
        ],

        'item_details' => $items,

        'customer_details' => [
            'first_name' => $request->nama,
            'email'      => $request->email,
            'phone'      => $request->phone,
        ],
    ];

    $snapToken = Snap::getSnapToken($params);

    $order = Order::create([
    'user_id'    => Auth::id(),
    'nama'       => $request->nama,
    'email'      => $request->email,
    'phone'      => $request->phone,
    'alamat'     => $request->alamat,
    'metode'     => $request->metode,
    'total'      => $total,
    'status'     => 'pending',
    'keterangan' => 'Menunggu pembayaran'
]);

foreach ($cart as $id => $item) {

    OrderItem::create([
        'order_id'    => $order->id,
        'product_id'  => $id,
        'nama_produk' => $item['nama'],
        'gambar'      => $item['gambar'],
        'harga'       => $item['harga'],
        'qty'         => $item['qty'],
    ]);

}

    session()->forget('cart');

    return view('checkout-bayar', compact('snapToken', 'total'));

});

/*
|--------------------------------------------------------------------------
| PESANAN
|--------------------------------------------------------------------------
| user = hanya lihat miliknya
| superadmin = lihat semua
*/

Route::get('/pesanan', function (Request $request) {

    if (!Auth::check()) {
        return redirect('/pilih-login');
    }

    $status = $request->status;

    // SUPERADMIN
    if (Auth::user()->role == 'superadmin') {

        $query = Order::with('items');

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->latest()->get();

    } else {

        // USER
        $query = Order::with('items')
            ->where('user_id', Auth::id());

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->latest()->get();
    }

    return view('pesanan', compact('orders', 'status'));

});


Route::post('/pesanan/update/{id}', function ($id, Request $request) {

    if (!Auth::check() || Auth::user()->role != 'superadmin') {
        abort(403);
    }

    $order = Order::findOrFail($id);

    $order->update([
        'status'     => $request->status,
        'keterangan' => $request->keterangan
    ]);

    return redirect()->back()->with('success', 'Pesanan berhasil diupdate');

})->middleware('auth');


Route::post('/pesanan/cancel/{id}', function ($id, Request $request) {

    if (!Auth::check()) {
        return redirect('/pilih-login');
    }

    $order = Order::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $order->update([
        'status'     => 'cancel',
        'keterangan' => $request->alasan
    ]);

    return redirect()->back()->with('success', 'Pesanan dibatalkan');

})->middleware('auth');


Route::get('/pesanan/detail/{id}', function ($id) {

    if (!Auth::check()) {
        return redirect('/pilih-login');
    }

    $query = Order::with('items')->where('id', $id);

    if (Auth::user()->role != 'superadmin') {
        $query->where('user_id', Auth::id());
    }

    $order = $query->firstOrFail();

    $setting = Setting::first();

    return view('detail-pesanan', compact(
        'order',
        'setting'
    ));

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if(Auth::user()->role != 'superadmin'){
        abort(403);
    }

    $pending = Order::where('status','pending')->count();
    $process = Order::where('status','process')->count();
    $success = Order::where('status','success')->count();
    $cancel = Order::where('status','cancel')->count();

    $users = \App\Models\User::where('role','user')->count();

    $latest = Order::latest()->take(5)->get();

    return view('dashboard', compact(
        'pending',
        'process',
        'success',
        'cancel',
        'users',
        'latest'
    ));

})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE BAWAAN LARAVEL
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| RATE / TESTIMONI
|--------------------------------------------------------------------------
*/

Route::get('/rate', function () {

    $testimonials = Testimonial::latest()->get();

    return view('rate', compact('testimonials'));

});

Route::post('/rate', function (Request $request) {

    if (!Auth::check()) {
        return redirect('/login');
    }

    Testimonial::create([
        'user_id' => Auth::id(),
        'rating'  => $request->rating,
        'pesan'   => $request->pesan
    ]);

    return redirect()->back();

})->middleware('auth');

Route::post('/rate/balas/{id}', function ($id, Request $request) {

    if (!Auth::check() || Auth::user()->role != 'superadmin') {
        abort(403);
    }

    $testimoni = \App\Models\Testimonial::findOrFail($id);

    $testimoni->balasan_admin = $request->balasan_admin;
    $testimoni->save();

    return redirect()->back();

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Pilih Login
|--------------------------------------------------------------------------
*/

Route::get('/pilih-login', function () {
    return view('pilih-login');
});

/*
|--------------------------------------------------------------------------
| Contact
|--------------------------------------------------------------------------
*/

Route::get('/contact', function () {

    $setting = \App\Models\Setting::first();

    return view('contact', compact('setting'));

});

/*
|--------------------------------------------------------------------------
| EDIT PROFILE
|--------------------------------------------------------------------------
*/

Route::get('/akun/edit', function () {

    if (!Auth::check()) {
        return redirect('/pilih-login');
    }

    return view('edit-profile');

})->middleware('auth');


Route::post('/akun/edit', function (Request $request) {

    if (!Auth::check()) {
        return redirect('/pilih-login');
    }

    $user = \App\Models\User::find(Auth::id());

    $user->name = $request->name;
    $user->phone = $request->phone;
    $user->address = $request->address;

    $user->save();

    return redirect('/akun');

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Setting
|--------------------------------------------------------------------------
*/

Route::get('/admin/contact', function () {

    if (!Auth::check() || Auth::user()->role != 'superadmin') {
        abort(403);
    }

    $setting = Setting::first();

    return view('admin-contact', compact('setting'));

})->middleware('auth');


Route::post('/admin/contact', function (Request $request) {

    if (!Auth::check() || Auth::user()->role != 'superadmin') {
        abort(403);
    }

    $setting = Setting::first();

    if (!$setting) {
        $setting = new Setting();
    }

    $setting->whatsapp  = $request->whatsapp;
    $setting->instagram = $request->instagram;
    $setting->jam       = $request->jam;
    $setting->lokasi    = $request->lokasi;

    $setting->save();

    return redirect('/contact')->with('success', 'Contact berhasil diupdate');

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';