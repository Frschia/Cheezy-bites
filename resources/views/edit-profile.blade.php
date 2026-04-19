<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile - Cheezy Bites</title>
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
            max-width:650px;
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
            color:orange;
            margin-bottom:20px;
            text-align:center;
            font-size:28px;
        }

        label{
            display:block;
            margin-top:12px;
            margin-bottom:6px;
            font-weight:bold;
            color:#444;
            font-size:15px;
        }

        input,
        textarea{
            width:100%;
            padding:12px;
            border-radius:12px;
            border:1px solid #ddd;
            font-size:15px;
            outline:none;
        }

        input:focus,
        textarea:focus{
            border-color:orange;
        }

        textarea{
            resize:none;
        }

        button{
            width:100%;
            padding:14px;
            background:orange;
            color:white;
            border:none;
            border-radius:12px;
            font-size:16px;
            font-weight:bold;
            cursor:pointer;
            margin-top:18px;
            transition:0.3s;
        }

        button:hover{
            background:darkorange;
        }

        /* ===== TABLET ===== */
        @media(max-width:768px){

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
                font-size:24px;
            }
        }

        /* ===== HP ===== */
        @media(max-width:480px){

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
                padding:20px 16px;
                border-radius:16px;
            }

            h2{
                font-size:22px;
            }

            label{
                font-size:14px;
            }

            input,
            textarea{
                font-size:14px;
                padding:11px;
            }

            button{
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

<!-- FORM -->
<div class="container">

    <div class="box">

        <h2>👤 Edit Profile</h2>

        <form method="POST" action="/akun/edit">
            @csrf

            <label>Nama</label>
            <input type="text" name="name"
                value="{{ auth()->user()->name }}" required>

            <label>Nomor HP</label>
            <input type="text" name="phone"
                value="{{ auth()->user()->phone }}">

            <label>Alamat</label>
            <textarea name="address" rows="4">{{ auth()->user()->address }}</textarea>

            <button type="submit">Simpan Perubahan</button>

        </form>

    </div>

</div>

</body>
</html>