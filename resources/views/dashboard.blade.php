<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - Cheezy Bites</title>
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
            max-width:1200px;
            margin:auto;
            padding:25px 15px;
        }

        h2{
            color:#333;
            margin-bottom:18px;
            font-size:28px;
        }

        /* ===== CARD GRID ===== */
        .grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
            gap:15px;
            margin-bottom:30px;
        }

        .card{
            background:white;
            padding:20px;
            border-radius:18px;
            box-shadow:0 4px 12px rgba(0,0,0,0.07);
            text-align:center;
        }

        .card h3{
            font-size:17px;
            margin-bottom:10px;
            color:#444;
        }

        .card p{
            font-size:30px;
            font-weight:bold;
            color:orange;
        }

        /* ===== TABLE ===== */
        .table-box{
            overflow-x:auto;
            background:white;
            border-radius:18px;
            box-shadow:0 4px 12px rgba(0,0,0,0.07);
        }

        table{
            width:100%;
            border-collapse:collapse;
            min-width:700px;
        }

        th, td{
            padding:14px;
            text-align:center;
            border-bottom:1px solid #eee;
        }

        th{
            background:orange;
            color:white;
            font-size:15px;
        }

        td{
            font-size:14px;
            color:#444;
        }

        tr:hover{
            background:#fff7ea;
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

            .card p{
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

<!-- NAVBAR -->
<div class="navbar">

    <div class="nav-left">
        <img src="{{ asset('images/logo.jpg') }}" class="logo-nav">
        <span class="brand">Cheezy Bites</span>
    </div>

    <div class="nav-right">
        <a href="/dashboard">Home</a>
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

    <h2>Halo, {{ auth()->user()->name }}</h2>

    <!-- CARD -->
    <div class="grid">

        <div class="card">
            <h3>Pending</h3>
            <p>{{ $pending }}</p>
        </div>

        <div class="card">
            <h3>Diproses</h3>
            <p>{{ $process }}</p>
        </div>

        <div class="card">
            <h3>Selesai</h3>
            <p>{{ $success }}</p>
        </div>

        <div class="card">
            <h3>Dibatalkan</h3>
            <p>{{ $cancel }}</p>
        </div>

        <div class="card">
            <h3>Total User</h3>
            <p>{{ $users }}</p>
        </div>

    </div>

    <!-- TABLE -->
    <h2>📦 Pesanan Terbaru</h2>

    <div class="table-box">
        <table>
            <tr>
                <th>Nama</th>
                <th>Total</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>

            @foreach($latest as $o)
            <tr>
                <td>{{ $o->nama }}</td>
                <td>Rp {{ number_format($o->total) }}</td>
                <td>{{ strtoupper($o->status) }}</td>
                <td>{{ $o->keterangan }}</td>
            </tr>
            @endforeach

        </table>
    </div>

</div>

</body>
</html>