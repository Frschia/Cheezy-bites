<!DOCTYPE html>
<html>
<head>
    <title>Cheezy Bites</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial, sans-serif;
            background:#fff8f0;
            color:#333;
        }

        .container{
            max-width:1200px;
            margin:auto;
            padding:25px 15px;
            text-align:center;
        }

        /* ===== NAVBAR ===== */
        .navbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            background:orange;
            padding:12px 20px;
            color:white;
            flex-wrap:wrap;
            gap:15px;
        }

        .nav-left{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .logo-nav{
            width:42px;
            height:42px;
            object-fit:cover;
            border-radius:50%;
        }

        .brand{
            font-size:22px;
            font-weight:bold;
            white-space:nowrap;
        }

        .nav-right{
            display:flex;
            flex-wrap:wrap;
            gap:10px;
            align-items:center;
        }

        .nav-right a{
            color:white;
            text-decoration:none;
            font-weight:bold;
            padding:8px 12px;
            border-radius:8px;
            transition:0.3s;
            position:relative;
        }

        .nav-right a:hover{
            background:rgba(255,255,255,0.2);
        }

        .cart-badge{
            position:absolute;
            top:-5px;
            right:-8px;
            background:red;
            color:white;
            border-radius:50%;
            min-width:18px;
            height:18px;
            font-size:11px;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:2px;
        }

        /* ===== PRODUCT GRID ===== */
        .product-wrapper{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:18px;
            margin-top:25px;
        }

        .product{
            background:white;
            border-radius:18px;
            padding:20px;
            box-shadow:0 4px 12px rgba(0,0,0,0.07);
        }

        .img-produk{
            width:130px;
            height:130px;
            border-radius:50%;
            object-fit:cover;
            object-position:center;
            display:block;
            margin:0 auto 14px;
        }

        .product h3{
            font-size:20px;
            margin-bottom:8px;
        }

        .product p{
            margin-bottom:8px;
            font-size:14px;
        }

        button{
            background:orange;
            border:none;
            padding:12px;
            color:white;
            border-radius:10px;
            cursor:pointer;
            width:100%;
            font-weight:bold;
            transition:0.3s;
        }

        button:hover{
            background:darkorange;
        }

        .stok-form{
            display:flex;
            gap:8px;
            margin-bottom:10px;
        }

        .stok-form button{
            width:100%;
        }

        /* FLOAT CART */
        .cart-float{
            position:fixed;
            bottom:20px;
            right:20px;
            background:orange;
            width:58px;
            height:58px;
            border-radius:50%;
            color:white;
            font-size:24px;
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow:0 5px 15px rgba(0,0,0,0.2);
        }

        .float-badge{
            position:absolute;
            top:-3px;
            right:-3px;
            background:red;
            color:white;
            border-radius:50%;
            min-width:20px;
            height:20px;
            font-size:11px;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        /* ===== TABLET ===== */
        @media (max-width:768px){

            .navbar{
                flex-direction:column;
                align-items:flex-start;
            }

            .nav-left{
                width:100%;
                justify-content:center;
            }

            .nav-right{
                width:100%;
                justify-content:center;
            }

            .brand{
                font-size:20px;
            }
        }

        /* ===== HP ===== */
        @media (max-width:480px){

            .nav-right{
                flex-direction:column;
                align-items:stretch;
            }

            .nav-right a{
                width:100%;
                text-align:center;
            }

            .brand{
                font-size:18px;
            }

            .product{
                padding:18px;
            }

            .img-produk{
                width:110px;
                height:110px;
            }

            button{
                font-size:14px;
                padding:11px;
            }

            .cart-float{
                width:52px;
                height:52px;
                font-size:20px;
                bottom:15px;
                right:15px;
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

        @if(auth()->check() && auth()->user()->role == 'superadmin')
            <a href="/dashboard">Home</a>
        @else
            <a href="/">Home</a>
        @endif

        <a href="/produk">Produk</a>
        <a href="/pesanan">Pesanan</a>
        <a href="/rate">Rate</a>

        @if(auth()->check() && auth()->user()->role != 'superadmin')
        <a href="/cart">
            Cart
            @if($totalQty > 0)
                <span class="cart-badge">{{ $totalQty }}</span>
            @endif
        </a>
        @endif

        <a href="/contact">Contact</a>
        <a href="/akun">Profile</a>

    </div>

</div>

<div class="container">

    <p>Snack lumer favorit kamu!</p>

    <div class="product-wrapper">

        @if($products->count() > 0)

            @foreach($products as $p)

            <div class="product">

                <img src="{{ asset('images/'.$p->gambar) }}" class="img-produk">

                <h3>{{ $p->nama }}</h3>

                <p>Rp {{ number_format($p->harga) }}</p>

                <p><b>Stok:</b> {{ $p->stok }}</p>

                @if(auth()->check() && auth()->user()->role == 'superadmin')

                <form action="/produk/stok/{{ $p->id }}" method="POST" class="stok-form">
                    @csrf
                    <button type="submit" name="aksi" value="kurang">➖</button>
                    <button type="submit" name="aksi" value="tambah">➕</button>
                </form>

                @endif

                @if(!auth()->check() || auth()->user()->role != 'superadmin')

                <form action="/cart/add/{{ $p->id }}" method="POST">
                    @csrf
                    <button type="submit">Tambah Ke Keranjang</button>
                </form>

                @endif

            </div>

            @endforeach

        @else

            <p>Produk belum tersedia</p>

        @endif

    </div>

</div>

@if($totalQty > 0)
<a href="/cart" style="text-decoration:none;">

<div class="cart-float">
    🛒
    <span class="float-badge">{{ $totalQty }}</span>
</div>

</a>
@endif

</body>
</html>