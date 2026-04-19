<!DOCTYPE html>
<html>
<head>
    <title>Profile - Cheezy Bites</title>
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
            padding:30px 15px;
        }

        .box{
            background:white;
            max-width:420px;
            margin:auto;
            padding:25px;
            border-radius:18px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
            text-align:center;
        }

        h2{
            margin-bottom:20px;
            color:#333;
            font-size:28px;
        }

        .box p{
            font-size:16px;
            margin:12px 0;
            color:#444;
            word-wrap:break-word;
        }

        .button-group{
            display:flex;
            flex-direction:column;
            gap:12px;
            margin-top:22px;
        }

        .btn{
            width:100%;
            background:orange;
            color:white;
            border:none;
            padding:12px;
            border-radius:10px;
            cursor:pointer;
            font-size:15px;
            font-weight:bold;
            transition:0.3s;
        }

        .btn:hover{
            background:darkorange;
        }

        /* ===== TABLET ===== */
        @media (max-width: 992px){
            .nav-right{
                width:100%;
                justify-content:center;
            }
        }

        /* ===== HP ===== */
        @media (max-width: 768px){
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

            .box{
                width:100%;
                padding:22px;
            }

            h2{
                font-size:24px;
            }
        }

        /* ===== HP KECIL ===== */
        @media (max-width: 480px){
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

            h2{
                font-size:22px;
            }

            .box p{
                font-size:14px;
            }

            .btn{
                font-size:14px;
                padding:11px;
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

<!-- PROFILE -->
<div class="container">

    <div class="box">

        <h2>👤 Profile Saya</h2>

        <p><b>Nama:</b> {{ auth()->user()->name }}</p>
        <p><b>Email:</b> {{ auth()->user()->email }}</p>
        <p><b>No HP:</b> {{ auth()->user()->phone ?? '-' }}</p>
        <p><b>Alamat:</b> {{ auth()->user()->address ?? '-' }}</p>

        <div class="button-group">

            @if(auth()->user()->role != 'superadmin')
            <a href="/pesanan">
                <button class="btn">Riwayat Pesanan</button>
            </a>
            @endif

            <a href="/akun/edit">
                <button class="btn">Edit Profile</button>
            </a>

            <form method="POST" action="/logout">
                @csrf
                <button class="btn">Logout</button>
            </form>

        </div>

    </div>

</div>

</body>
</html>