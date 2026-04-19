<!DOCTYPE html>
<html>
<head>
    <title>Contact Seller - Cheezy Bites</title>
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
            background:orange;
            color:white;
            padding:12px 20px;
            display:flex;
            justify-content:space-between;
            align-items:center;
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
            max-width:750px;
            margin:auto;
            padding:25px 15px;
        }

        .box{
            background:white;
            padding:28px;
            border-radius:20px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
        }

        h2{
            color:#333;
            margin-bottom:20px;
            font-size:30px;
            text-align:center;
        }

        .info{
            margin-bottom:14px;
            font-size:16px;
            color:#444;
            word-break:break-word;
        }

        .btn{
            display:block;
            width:100%;
            padding:14px;
            background:orange;
            color:white;
            text-decoration:none;
            border:none;
            border-radius:12px;
            font-weight:bold;
            font-size:15px;
            cursor:pointer;
            margin-top:14px;
            text-align:center;
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
                padding:24px 20px;
            }

            h2{
                font-size:26px;
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

        <h2>📞 Contact Person Seller</h2>

        <p class="info"><b>WhatsApp:</b> {{ $setting->whatsapp }}</p>
        <p class="info"><b>Instagram:</b> {{ $setting->instagram }}</p>
        <p class="info"><b>Jam Operasional:</b> {{ $setting->jam }}</p>
        <p class="info"><b>Lokasi COD:</b> {{ $setting->lokasi }}</p>

        <a href="https://wa.me/6285798665939" class="btn">
            Chat WhatsApp
        </a>

        @if(auth()->check() && auth()->user()->role == 'superadmin')
        <a href="/admin/contact" class="btn">
            ✏️ Edit Contact
        </a>
        @endif

    </div>

</div>

</body>
</html>