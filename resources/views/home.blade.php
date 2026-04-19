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

        /* ===== CONTENT ===== */
        .container{
            max-width:1200px;
            margin:auto;
            padding:30px 15px;
            text-align:center;
        }

        h1{
            font-size:38px;
            color:orange;
            margin-bottom:12px;
        }

        .desc{
            max-width:700px;
            margin:auto;
            line-height:1.7;
            font-size:16px;
            color:#555;
        }

        h2{
            margin-top:35px;
            margin-bottom:20px;
            font-size:28px;
        }

        /* ===== PRODUCT GRID ===== */
        .product-wrapper{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:18px;
        }

        .product{
            background:white;
            border-radius:18px;
            padding:20px;
            box-shadow:0 4px 12px rgba(0,0,0,0.07);
            transition:0.3s;
        }

        .product:hover{
            transform:translateY(-4px);
        }

        .img-produk{
            width:130px;
            height:130px;
            border-radius:50%;
            object-fit:cover;
            margin-bottom:15px;
        }

        .product h3{
            font-size:20px;
            margin-bottom:8px;
        }

        .product p{
            font-size:14px;
            color:#555;
            margin-bottom:8px;
            line-height:1.5;
        }

        .price{
            font-size:18px;
            font-weight:bold;
            color:orange;
        }

        .btn{
            margin-top:30px;
            background:orange;
            border:none;
            padding:14px 22px;
            color:white;
            border-radius:12px;
            cursor:pointer;
            font-size:15px;
            font-weight:bold;
            transition:0.3s;
        }

        .btn:hover{
            background:darkorange;
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

            h1{
                font-size:30px;
            }

            h2{
                font-size:24px;
            }
        }

 <style>
/* ===== HP KECIL TAMPILAN SEPERTI TABLET ===== */

@media (max-width:480px){

    .navbar{
        padding:10px 12px;
        gap:12px;
        flex-direction:row;
        justify-content:space-between;
        align-items:center;
        overflow-x:auto;
        white-space:nowrap;
    }

    .nav-left{
        display:flex;
        align-items:center;
        gap:8px;
        flex-shrink:0;
    }

    .logo-nav{
        width:36px;
        height:36px;
    }

    .brand{
        display:block;
        font-size:18px;
        font-weight:bold;
    }

    .nav-right{
        display:flex;
        flex-direction:row;
        gap:8px;
        flex-wrap:nowrap;
        align-items:center;
    }

    .nav-right a{
        font-size:13px;
        padding:7px 10px;
        border-radius:8px;
        flex-shrink:0;
    }

    .cart-badge{
        min-width:16px;
        height:16px;
        font-size:10px;
        top:-4px;
        right:-5px;
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
        <a href="/rate">Rate</a>

        <a href="/cart">
            Cart
            @if($totalQty > 0)
                <span class="cart-badge">{{ $totalQty }}</span>
            @endif
        </a>

        <a href="/contact">Contact</a>
        <a href="/akun">Profile</a>
    </div>

</div>

<!-- CONTENT -->
<div class="container">

    <h1>🧀 Cheezy Bites</h1>

    <p class="desc">
        Camilan kekinian dengan tekstur renyah di luar dan lumer di dalam.
        Tersedia berbagai varian rasa favorit!
    </p>

    <h2>Katalog Preview</h2>

    <div class="product-wrapper">

        @foreach($products as $p)
        <div class="product">

            <img src="{{ asset('images/'.$p->gambar) }}" class="img-produk">

            <h3>{{ $p->nama }}</h3>

            <p>{{ $p->deskripsi }}</p>

            <div class="price">
                Rp {{ number_format($p->harga) }}
            </div>

        </div>
        @endforeach

    </div>

    <a href="/produk">
        <button class="btn">Lihat Semua Produk</button>
    </a>

</div>

</body>
</html>