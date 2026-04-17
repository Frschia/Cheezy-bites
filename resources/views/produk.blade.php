<!DOCTYPE html>
<html>
<head>
    <title>Cheezy Bites</title>

    <!-- WAJIB responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial;
            background-color: #fff8f0;
            text-align: center;
            margin: 0;
        }

        .container {
            padding: 20px;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: orange;
            padding: 10px 20px;
            color: white;
            flex-wrap: wrap;
        }

        .nav-left {
            display: flex;
            align-items: center;
        }

        .logo-nav {
            width: 40px;
            margin-right: 10px;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
        }

        .nav-right {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .nav-right a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 5px;
        }

        .nav-right a:hover {
            text-decoration: underline;
        }

        /* ===== PRODUK GRID ===== */
        .product-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .product {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            width: 200px;
            background: white;
        }

        .img-produk {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            object-position: center;
            display: block;
            margin: 0 auto 10px;
        }

        button {
            background: orange;
            border: none;
            padding: 10px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background: darkorange;
        }

        /* ===== FLOAT CART ===== */
        .cart-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: orange;
            padding: 15px;
            border-radius: 50%;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }

        /* ===== RESPONSIVE HP ===== */
        @media (max-width: 768px) {

            .navbar {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .nav-right {
                justify-content: center;
            }

            .product {
                width: 90%;
                max-width: 320px;
            }

            button {
                font-size: 14px;
            }

            .brand {
                font-size: 18px;
            }
        }

    </style>
</head>

<body>

@php
$cart = session('cart', []);
$totalQty = 0;

foreach($cart as $item){
    $totalQty += $item['qty'];
}
@endphp

<!-- NAVBAR -->
<div class="navbar">
    <div class="nav-left">
        <img src="{{ asset('images/logo.jpg') }}" class="logo-nav">
        <span class="brand">Cheezy Bites</span>
    </div>

    <div class="nav-right">
        <a href="/">Home</a>
        <a href="/produk">Produk</a>
        <a href="/pesanan">Pesanan</a>

        <a href="/cart" style="position: relative;">
            Cart
            @if($totalQty > 0)
            <span style="
                position:absolute;
                top:-5px;
                right:-10px;
                background:red;
                color:white;
                border-radius:50%;
                padding:2px 6px;
                font-size:12px;">
                {{ $totalQty }}
            </span>
            @endif
        </a>
    </div>
</div>

<div class="container">

    <p>Snack lumer favorit kamu!</p>

    <!-- PRODUK WRAPPER -->
    <div class="product-wrapper">

        @if($products->count() > 0)
            @foreach($products as $p)
            <div class="product">
                <img src="{{ asset('images/'.$p->gambar) }}" class="img-produk">
                <h3>{{ $p->nama }}</h3>
                <p>Rp {{ number_format($p->harga) }}</p>

                <form action="/cart/add/{{ $p->id }}" method="POST">
                    @csrf
                    <button type="submit">Tambah Ke Keranjang</button>
                </form>
            </div>
            @endforeach
        @else
            <p>Produk belum tersedia</p>
        @endif

    </div>

</div>

<!-- FLOAT CART -->
@if($totalQty > 0)
<a href="/cart" style="text-decoration:none;">
<div class="cart-float">
    🛒
    <span style="
        position:absolute;
        top:0;
        right:0;
        background:red;
        border-radius:50%;
        padding:2px 6px;
        font-size:12px;">
        {{ $totalQty }}
    </span>
</div>
</a>
@endif

</body>
</html>