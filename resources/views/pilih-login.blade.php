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
            min-height:calc(100vh - 80px);
            display:flex;
            justify-content:center;
            align-items:center;
            padding:25px 15px;
        }

        .box{
            background:white;
            width:100%;
            max-width:430px;
            padding:30px;
            border-radius:20px;
            box-shadow:0 5px 15px rgba(0,0,0,0.08);
            text-align:center;
        }

        h2{
            color:orange;
            font-size:30px;
            margin-bottom:14px;
        }

        p{
            font-size:16px;
            color:#555;
            margin-bottom:18px;
            line-height:1.6;
        }

        .btn{
            display:block;
            width:100%;
            margin-top:14px;
            padding:14px;
            background:orange;
            color:white;
            text-decoration:none;
            border-radius:12px;
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

            .box{
                padding:26px 22px;
            }

            h2{
                font-size:26px;
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

            .box{
                padding:22px 18px;
                border-radius:16px;
            }

            h2{
                font-size:22px;
            }

            p{
                font-size:14px;
            }

            .btn{
                font-size:14px;
                padding:12px;
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

<!-- CONTENT -->
<div class="container">

    <div class="box">

        <h2>👤 Selamat Datang</h2>

        <p>
            Silakan login atau daftar terlebih dahulu
            untuk menikmati fitur Cheezy Bites.
        </p>

        <a href="/login" class="btn">
            Sudah Memiliki Akun? Login
        </a>

        <a href="/register" class="btn">
            Belum Memiliki Akun? Register
        </a>

    </div>

</div>

</body>
</html>