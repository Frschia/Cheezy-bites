<!DOCTYPE html>
<html>
<head>
    <title>Detail Pesanan - Cheezy Bites</title>
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

        /* ===== CONTENT ===== */
        .container{
            max-width:900px;
            margin:auto;
            padding:25px 15px;
        }

        .card{
            background:white;
            padding:22px;
            border-radius:18px;
            box-shadow:0 4px 12px rgba(0,0,0,0.07);
            margin-bottom:18px;
        }

        h2{
            color:orange;
            margin-bottom:15px;
            font-size:28px;
        }

        .status{
            font-size:18px;
            font-weight:bold;
            color:orange;
        }

        .line{
            border-top:1px solid #eee;
            margin:16px 0;
        }

        /* ===== ITEM ===== */
        .item{
            display:flex;
            gap:15px;
            align-items:center;
            margin-top:15px;
        }

        .item img{
            width:95px;
            height:95px;
            object-fit:cover;
            border-radius:12px;
        }

        .info{
            flex:1;
            color:#444;
            line-height:1.7;
        }

        .total{
            text-align:right;
            font-size:20px;
            font-weight:bold;
            color:#333;
        }

        /* ===== BUTTON ===== */
        .btn{
            width:100%;
            border:none;
            padding:13px;
            border-radius:12px;
            cursor:pointer;
            font-weight:bold;
            margin-top:12px;
            font-size:15px;
            transition:0.3s;
        }

        .wa{
            background:#25D366;
            color:white;
        }

        .wa:hover{
            opacity:0.9;
        }

        .gray{
            background:#e5e5e5;
            color:#333;
        }

        .gray:hover{
            background:#d5d5d5;
        }

        .orange{
            background:orange;
            color:white;
        }

        .orange:hover{
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

            h2{
                font-size:24px;
                text-align:center;
            }

            .item{
                flex-direction:column;
                text-align:center;
            }

            .item img{
                width:100%;
                max-width:220px;
                height:auto;
            }

            .info{
                text-align:center;
            }

            .total{
                text-align:center;
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
                ({{ $totalQty }})
            @endif
        </a>
        @endif

        <a href="/contact">Contact</a>
        <a href="/akun">Profile</a>

    </div>

</div>

<!-- CONTENT -->
<div class="container">

    <!-- STATUS -->
    <div class="card">

        <h2>📦 Detail Pesanan</h2>

        <p class="status">
            Status: {{ strtoupper($order->status) }}
        </p>

        <p style="margin-top:10px;">
            <b>Keterangan:</b> {{ $order->keterangan }}
        </p>

    </div>

    <!-- PENERIMA -->
    <div class="card">

        <p><b>🚚 Metode Penerimaan</b><br>{{ $order->metode }}</p>

        <div class="line"></div>

        <p><b>👤 Kontak Penerima</b></p>

        <p>{{ $order->nama }}</p>
        <p>{{ $order->phone }}</p>
        <p>{{ $order->alamat }}</p>

    </div>

    <!-- PRODUK -->
    <div class="card">

        <p><b>🧀 Produk Dipesan</b></p>

        @foreach($order->items as $item)

        <div class="item">

            <img src="{{ asset('images/' . $item->gambar) }}">

            <div class="info">
                <b>{{ $item->nama_produk }}</b><br>
                Qty : {{ $item->qty }} <br>
                Rp {{ number_format($item->harga) }}
            </div>

        </div>

        @endforeach

        <div class="line"></div>

        <div class="total">
            Total : Rp {{ number_format($order->total) }}
        </div>

    </div>

    <!-- BANTUAN -->
    <div class="card">

        <p><b>❓ Butuh Bantuan?</b></p>

        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp) }}">
            <button class="btn wa">
                Hubungi Penjual via WhatsApp
            </button>
        </a>

        @if($order->status == 'success')
        <a href="/rate">
            <button class="btn orange">
                Beri Nilai
            </button>
        </a>

        @elseif($order->status == 'cancel')
        <a href="/produk">
            <button class="btn gray">
                Beli Lagi
            </button>
        </a>
        @endif

    </div>

</div>

</body>
</html>