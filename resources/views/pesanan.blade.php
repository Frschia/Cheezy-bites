<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi - Cheezy Bites</title>

    <!-- WAJIB responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial;
            background: #fff8f0;
            margin: 0;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: orange;
            padding: 10px 20px;
            color: white;
            flex-wrap: wrap;
        }

        .nav-right {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .nav-right a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 5px;
        }

        /* ===== CONTAINER ===== */
        .container {
            padding: 20px;
        }

        /* ===== FILTER ===== */
        .filter {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 8px 15px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            color: white;
            font-size: 14px;
        }

        .all { background: gray; }
        .pending { background: orange; }
        .process { background: blue; }
        .success { background: green; }
        .cancel { background: red; }

        /* ===== CARD ===== */
        .card {
            background: white;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.05);
        }

        /* ===== RESPONSIVE HP ===== */
        @media (max-width: 768px) {

            .navbar {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .nav-right {
                justify-content: center;
            }

            .container {
                padding: 15px;
            }

            .btn {
                font-size: 12px;
                padding: 7px 12px;
            }

            .card {
                font-size: 14px;
            }
        }

    </style>
</head>

<body>

<div class="navbar">
    <div><b>Cheezy Bites</b></div>

    <div class="nav-right">
        <a href="/">Home</a>
        <a href="/produk">Produk</a>
        <a href="/pesanan">Pesanan</a>
        <a href="/cart">Cart</a>
    </div>
</div>

<div class="container">

<h2>📦 Riwayat Transaksi</h2>

<!-- FILTER -->
<div class="filter">
    <a href="/pesanan"><button class="btn all">Semua</button></a>
    <a href="/pesanan?status=pending"><button class="btn pending">Pending</button></a>
    <a href="/pesanan?status=process"><button class="btn process">Diproses</button></a>
    <a href="/pesanan?status=success"><button class="btn success">Selesai</button></a>
    <a href="/pesanan?status=cancel"><button class="btn cancel">Dibatalkan</button></a>
</div>

<!-- DATA -->
@if(count($orders) > 0)

    @foreach($orders as $o)
    <div class="card">
        <p><b>Nama:</b> {{ $o->nama }}</p>
        <p><b>Total:</b> Rp {{ number_format($o->total) }}</p>
        <p><b>Status:</b> {{ strtoupper($o->status) }}</p>
    </div>
    @endforeach

@else
    <p>Tidak ada pesanan 😢</p>
@endif

</div>

</body>
</html>