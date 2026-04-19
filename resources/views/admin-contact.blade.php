<!DOCTYPE html>
<html>
<head>
    <title>Admin Contact Setting - Cheezy Bites</title>
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
            align-items:center;
            gap:10px;
            flex-wrap:wrap;
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
            max-width:700px;
            margin:auto;
            padding:25px 15px;
        }

        .box{
            background:white;
            padding:25px;
            border-radius:18px;
            box-shadow:0 3px 10px rgba(0,0,0,0.08);
        }

        h2{
            margin-bottom:20px;
            color:#333;
            font-size:28px;
        }

        label{
            display:block;
            margin-top:10px;
            margin-bottom:6px;
            font-weight:bold;
            color:#444;
        }

        input{
            width:100%;
            padding:12px;
            border-radius:10px;
            border:1px solid #ddd;
            margin-bottom:15px;
            font-size:15px;
        }

        button{
            width:100%;
            padding:14px;
            background:orange;
            color:white;
            border:none;
            border-radius:10px;
            cursor:pointer;
            font-size:16px;
            font-weight:bold;
            transition:0.3s;
        }

        button:hover{
            background:darkorange;
        }

        .success{
            background:#d4edda;
            color:#155724;
            padding:12px;
            border-radius:10px;
            margin-top:15px;
            text-align:center;
        }

        /* ===== TABLET ===== */
        @media (max-width: 992px){
            .brand{
                font-size:20px;
            }

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

            .nav-right a{
                font-size:14px;
                padding:8px 10px;
            }

            .box{
                padding:20px;
            }

            h2{
                font-size:22px;
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

<div class="container">

    <div class="box">

        <h2>📞 Edit Contact Seller</h2>

        <form method="POST" action="/admin/contact">
            @csrf

            <label>WhatsApp</label>
            <input type="text" name="whatsapp" value="{{ $setting->whatsapp }}">

            <label>Instagram</label>
            <input type="text" name="instagram" value="{{ $setting->instagram }}">

            <label>Jam Operasional</label>
            <input type="text" name="jam" value="{{ $setting->jam }}">

            <label>Lokasi</label>
            <input type="text" name="lokasi" value="{{ $setting->lokasi }}">

            <button type="submit">Simpan Perubahan</button>

            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

        </form>

    </div>

</div>

</body>
</html>