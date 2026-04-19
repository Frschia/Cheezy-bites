<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi - Cheezy Bites</title>
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
            position:relative;
        }

        .nav-right a:hover{
            background:rgba(255,255,255,.2);
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
        }

        .container{
            max-width:1100px;
            margin:auto;
            padding:25px 15px;
        }

        .title{
            font-size:30px;
            margin-bottom:20px;
        }

        .filter{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
            margin-bottom:25px;
        }

        .btn-filter{
            border:none;
            padding:10px 16px;
            border-radius:30px;
            color:white;
            cursor:pointer;
            font-weight:bold;
        }

        .all{background:#666;}
        .pending{background:orange;}
        .process{background:#3498db;}
        .success{background:#27ae60;}
        .cancel{background:#e74c3c;}

        .card{
            background:white;
            border-radius:18px;
            padding:20px;
            margin-bottom:18px;
            box-shadow:0 4px 12px rgba(0,0,0,.07);
        }

        .top{
            display:flex;
            justify-content:space-between;
            flex-wrap:wrap;
            gap:10px;
            margin-bottom:15px;
            font-weight:bold;
        }

        .status{
            color:orange;
        }

        .card-link{
            text-decoration:none;
            color:inherit;
        }

        .product-row{
            display:flex;
            gap:15px;
            margin-bottom:15px;
            align-items:center;
        }

        .product-img{
            width:85px;
            height:85px;
            border-radius:14px;
            object-fit:cover;
        }

        .product-info{
            flex:1;
        }

        .product-name{
            font-weight:bold;
            margin-bottom:5px;
        }

        .small{
            font-size:14px;
            color:#777;
        }

        .price{
            font-weight:bold;
            margin-top:5px;
        }

        .line{
            border-top:1px solid #eee;
            margin:14px 0;
        }

        .total{
            text-align:right;
            font-weight:bold;
            margin-bottom:15px;
        }

        .action{
            display:flex;
            justify-content:flex-end;
            gap:10px;
            flex-wrap:wrap;
        }

        .btn{
            border:none;
            padding:11px 18px;
            border-radius:12px;
            cursor:pointer;
            font-weight:bold;
            min-width:130px;
        }

        .orange-btn{
            background:orange;
            color:white;
        }

        .gray{
            background:#eee;
            color:#333;
        }

        .red{
            background:#e74c3c;
            color:white;
        }

        select, textarea{
            width:100%;
            padding:12px;
            border-radius:12px;
            border:1px solid #ddd;
            margin-top:10px;
            font-size:14px;
        }

        textarea{
            resize:none;
        }

        @media(max-width:768px){

            .navbar{
                flex-direction:column;
                align-items:flex-start;
            }

            .nav-left,.nav-right{
                width:100%;
                justify-content:center;
            }

            .title{
                text-align:center;
                font-size:26px;
            }

            .product-row{
                flex-direction:column;
                text-align:center;
            }

            .product-img{
                width:100%;
                max-width:220px;
                height:auto;
            }

            .action{
                flex-direction:column;
            }

            .btn{
                width:100%;
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

<div class="navbar">

    <div class="nav-left">
        <img src="{{ asset('images/logo.jpg') }}" class="logo-nav">
        <span class="brand">Cheezy Bites</span>
    </div>

    <div class="nav-right">

        @if(auth()->user()->role == 'superadmin')
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

<h2 class="title">📦 Riwayat Transaksi</h2>

<div class="filter">
    <a href="/pesanan"><button class="btn-filter all">Semua</button></a>
    <a href="/pesanan?status=pending"><button class="btn-filter pending">Pending</button></a>
    <a href="/pesanan?status=process"><button class="btn-filter process">Diproses</button></a>
    <a href="/pesanan?status=success"><button class="btn-filter success">Selesai</button></a>
    <a href="/pesanan?status=cancel"><button class="btn-filter cancel">Dibatalkan</button></a>
</div>

@if(count($orders) > 0)

@foreach($orders as $o)

<div class="card">

    <div class="top">
        <div>Order #{{ $o->id }}</div>
        <div class="status">{{ strtoupper($o->status) }}</div>
    </div>

    <a href="/pesanan/detail/{{ $o->id }}" class="card-link">

        @foreach($o->items as $item)

        <div class="product-row">

            <img src="{{ asset('images/' . $item->gambar) }}" class="product-img">

            <div class="product-info">
                <div class="product-name">{{ $item->nama_produk }}</div>
                <div class="small">Qty : {{ $item->qty }}</div>
                <div class="price">Rp {{ number_format($item->harga) }}</div>
            </div>

        </div>

        @endforeach

    </a>

    <div class="line"></div>

    <div class="total">
        Total Pesanan : Rp {{ number_format($o->total) }}
    </div>

    {{-- USER --}}
    @if(auth()->user()->role != 'superadmin')

    <div class="action">

        @if($o->status == 'success')

            <a href="/produk"><button class="btn gray">Beli Lagi</button></a>
            <a href="/rate"><button class="btn orange-btn">Nilai</button></a>

        @elseif($o->status == 'cancel')

            <a href="/produk"><button class="btn gray">Beli Lagi</button></a>

        @elseif($o->status == 'pending')

            <button onclick="document.getElementById('cancel{{ $o->id }}').style.display='block'" class="btn red">
                Batalkan
            </button>

        @else

            <button class="btn gray">Diproses</button>

        @endif

    </div>

    @if($o->status == 'pending')

    <div id="cancel{{ $o->id }}" style="display:none; margin-top:10px;">

        <form action="/pesanan/cancel/{{ $o->id }}" method="POST">
            @csrf

            <select name="alasan" required>
                <option value="">Pilih alasan</option>
                <option value="Ubah varian">Ubah varian</option>
                <option value="Tidak jadi pesan">Tidak jadi pesan</option>
                <option value="Pesan terlalu lama">Pesan terlalu lama</option>
            </select>

            <button type="submit" class="btn red" style="margin-top:10px;">
                Konfirmasi Batal
            </button>
        </form>

    </div>

    @endif

    {{-- ADMIN --}}
    @else

    <form action="/pesanan/update/{{ $o->id }}" method="POST">
        @csrf

        <select name="status">
            <option value="pending" {{ $o->status=='pending' ? 'selected' : '' }}>Pending</option>
            <option value="process" {{ $o->status=='process' ? 'selected' : '' }}>Diproses</option>
            <option value="success" {{ $o->status=='success' ? 'selected' : '' }}>Selesai</option>
            <option value="cancel" {{ $o->status=='cancel' ? 'selected' : '' }}>Dibatalkan</option>
        </select>

        <textarea name="keterangan" rows="3">{{ $o->keterangan }}</textarea>

        <button type="submit" class="btn orange-btn" style="margin-top:10px;">
            Update Pesanan
        </button>

    </form>

    @endif

</div>

@endforeach

@else

<p>Tidak ada pesanan 😢</p>

@endif

</div>

</body>
</html>