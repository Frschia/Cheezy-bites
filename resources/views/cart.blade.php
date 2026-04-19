<!DOCTYPE html>
<html>
<head>
    <title>Keranjang - Cheezy Bites</title>
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
            max-width:1000px;
            margin:auto;
            padding:25px 15px;
        }

        h2{
            margin-bottom:20px;
            color:#333;
            font-size:28px;
        }

        /* ===== CART ITEM ===== */
        .cart-item{
            display:flex;
            align-items:center;
            justify-content:space-between;
            background:white;
            border-radius:15px;
            padding:15px;
            margin-bottom:15px;
            gap:15px;
            box-shadow:0 3px 10px rgba(0,0,0,0.06);
        }

        .cart-item img{
            width:90px;
            height:90px;
            object-fit:cover;
            border-radius:12px;
        }

        .cart-info{
            flex:1;
        }

        .cart-info h3{
            font-size:20px;
            margin-bottom:6px;
            color:#333;
        }

        .cart-info p{
            margin:4px 0;
            color:#555;
        }

        /* ===== QTY ===== */
        .qty-control{
            display:flex;
            align-items:center;
            gap:8px;
        }

        .qty-control button{
            background:orange;
            border:none;
            padding:8px 12px;
            color:white;
            border-radius:8px;
            cursor:pointer;
            font-size:16px;
        }

        .qty-number{
            font-weight:bold;
            min-width:25px;
            text-align:center;
            font-size:16px;
        }

        /* ===== TOTAL ===== */
        .total{
            text-align:right;
            font-size:22px;
            margin-top:20px;
            color:#333;
        }

        .checkout-wrap{
            text-align:right;
            margin-top:15px;
        }

        .checkout{
            background:green;
            color:white;
            padding:12px 24px;
            border:none;
            border-radius:10px;
            cursor:pointer;
            font-size:16px;
            font-weight:bold;
        }

        .checkout:hover{
            opacity:0.9;
        }

        .empty{
            background:white;
            padding:25px;
            border-radius:15px;
            text-align:center;
            font-size:18px;
        }

        /* ===== TABLET ===== */
        @media (max-width:992px){
            .nav-right{
                width:100%;
                justify-content:center;
            }
        }

        /* ===== MOBILE ===== */
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

            .cart-item{
                flex-direction:column;
                text-align:center;
            }

            .cart-info{
                text-align:center;
            }

            .total{
                text-align:center;
                font-size:20px;
            }

            .checkout-wrap{
                text-align:center;
            }

            .checkout{
                width:100%;
            }

            h2{
                text-align:center;
                font-size:24px;
            }
        }

        /* ===== HP KECIL ===== */
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

            h2{
                font-size:22px;
            }

            .cart-info h3{
                font-size:18px;
            }

            .qty-control button{
                padding:7px 10px;
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

        <div class="checkout-wrap">
            <a href="/checkout">
                <button class="checkout">Checkout</button>
            </a>
        </div>

    @else

        <div class="empty">
            Keranjang kosong 😢
        </div>

    @endif

</div>

</body>
</html>