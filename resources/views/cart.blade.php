<!DOCTYPE html>
<html>
<head>
    <title>Keranjang - Cheezy Bites</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial;
            background-color: #fff8f0;
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

        /* ===== CONTAINER ===== */
        .container {
            padding: 20px;
        }

        /* ===== CART ITEM ===== */
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 15px;
            gap: 10px;
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .cart-info {
            flex: 1;
            text-align: left;
            margin-left: 10px;
        }

        .cart-info h3 {
            margin: 0;
        }

        .cart-info p {
            margin: 5px 0;
        }

        /* ===== QTY ===== */
        .qty-control {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .qty-control button {
            background: orange;
            border: none;
            padding: 5px 10px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .qty-number {
            font-weight: bold;
            min-width: 20px;
            text-align: center;
        }

        /* ===== TOTAL ===== */
        .total {
            text-align: right;
            font-size: 18px;
            margin-top: 20px;
        }

        /* ===== CHECKOUT ===== */
        .checkout {
            background: green;
            color: white;
            padding: 10px 20px;
            border: none;
            float: right;
            margin-top: 10px;
            border-radius: 5px;
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

            .cart-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .cart-info {
                margin-left: 0;
                text-align: center;
            }

            .qty-control {
                margin-top: 10px;
            }

            .total {
                text-align: center;
                font-size: 16px;
            }

            .checkout {
                width: 100%;
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

    <h2>🛒 Keranjang Kamu</h2>

    @php $total = 0; @endphp

    @if(count($cart) > 0)

        @foreach($cart as $id => $item)

        @php
        $subtotal = $item['harga'] * $item['qty'];
        $total += $subtotal;
        @endphp

        <div class="cart-item">

            <img src="{{ asset('images/'.$item['gambar']) }}">

            <div class="cart-info">
                <h3>{{ $item['nama'] }}</h3>
                <p>Rp {{ number_format($item['harga']) }}</p>
                <p><b>Rp {{ number_format($subtotal) }}</b></p>
            </div>

            <div class="qty-control">

                <form action="/cart/decrease/{{ $id }}" method="POST">
                    @csrf
                    <button type="submit">➖</button>
                </form>

                <span class="qty-number">{{ $item['qty'] }}</span>

                <form action="/cart/increase/{{ $id }}" method="POST">
                    @csrf
                    <button type="submit">➕</button>
                </form>

            </div>

        </div>

        @endforeach

        <div class="total">
            <b>Total: Rp {{ number_format($total) }}</b>
        </div>

        <a href="/checkout">
            <button class="checkout">Checkout</button>
        </a>

    @else
        <p>Keranjang kosong 😢</p>
    @endif

</div>

</body>
</html>