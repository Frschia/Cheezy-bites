<!DOCTYPE html>
<html>
<head>
    <title>Cheezy Bites</title>

    <!-- WAJIB biar mobile kebaca -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial;
            background-color: #fff8f0;
            text-align: center;
            margin: 0;
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

        /* ===== CONTAINER ===== */
        .container {
            padding: 20px;
        }

        /* ===== PRODUK GRID (RESPONSIVE INTI) ===== */
        .product-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
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
        }

        .btn {
            background: orange;
            border: none;
            padding: 10px 15px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background: darkorange;
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
                max-width: 300px;
            }

            h1 {
                font-size: 22px;
            }

            p {
                font-size: 14px;
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

    <h1>🧀 Cheezy Bites</h1>
    <p>
        Camilan kekinian dengan tekstur renyah di luar dan lumer di dalam.
        Tersedia berbagai varian rasa favorit!
    </p>

    <h2>Katalog Preview</h2>

    <!-- PRODUK WRAPPER RESPONSIVE -->
    <div class="product-wrapper">
        @foreach($products as $p)
        <div class="product">
            <img src="{{ asset('images/'.$p->gambar) }}" class="img-produk">
            <h3>{{ $p->nama }}</h3>
            <p>{{ $p->deskripsi }}</p>
            <p><b>Rp {{ number_format($p->harga) }}</b></p>
        </div>
        @endforeach
    </div>

    <br><br>

    <a href="/produk">
        <button class="btn">Lihat Semua Produk</button>
    </a>

</div>

</body>
</html>