<!DOCTYPE html>
<html>
<head>
    <title>Rate & Testimoni - Cheezy Bites</title>
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
            max-width:900px;
            margin:auto;
            padding:25px 15px;
        }

        .box{
            background:white;
            padding:25px;
            border-radius:18px;
            box-shadow:0 4px 12px rgba(0,0,0,0.07);
            margin-bottom:20px;
        }

        h2{
            color:orange;
            margin-bottom:18px;
            font-size:28px;
            text-align:center;
        }

        label{
            display:block;
            margin-top:12px;
            margin-bottom:6px;
            font-weight:bold;
        }

        textarea{
            width:100%;
            padding:12px;
            border-radius:12px;
            border:1px solid #ddd;
            font-size:14px;
            resize:none;
        }

        button{
            width:100%;
            padding:13px;
            margin-top:12px;
            background:orange;
            color:white;
            border:none;
            border-radius:12px;
            cursor:pointer;
            font-weight:bold;
            transition:0.3s;
        }

        button:hover{
            background:darkorange;
        }

        .star-rating{
            font-size:38px;
            margin:10px 0 15px;
            text-align:center;
        }

        .star{
            cursor:pointer;
            color:#ddd;
            transition:0.2s;
        }

        .star.active{
            color:gold;
        }

        .review-star{
            font-size:24px;
            color:gold;
            margin-bottom:8px;
        }

        .name{
            font-weight:bold;
            margin-bottom:8px;
        }

        .date{
            color:gray;
            font-size:13px;
        }

        .reply-box{
            background:#fff3cd;
            padding:12px;
            border-radius:12px;
            margin-top:12px;
            text-align:left;
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

            h2{
                font-size:24px;
            }

            .star-rating{
                font-size:34px;
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

<div class="container">

    <!-- FORM -->
    <div class="box">

        <h2>⭐ Rate & Testimoni</h2>

        @auth

            @if(auth()->user()->role != 'superadmin')

            <form method="POST" action="/rate">
                @csrf

                <label>Rating</label>

                <div class="star-rating">
                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>
                </div>

                <input type="hidden" name="rating" id="rating-value" required>

                <label>Kritik / Saran</label>
                <textarea name="pesan" rows="4" required></textarea>

                <button type="submit">Kirim Ulasan</button>

            </form>

            @else

            <p><b>Mode Admin:</b> Balas testimoni customer.</p>

            @endif

        @else

        <p>Silakan login dulu.</p>

        @endauth

    </div>

    <!-- TESTIMONI -->
    @foreach($testimonials as $t)

    <div class="box">

        <div class="review-star">
            {{ str_repeat('★', $t->rating) }}
        </div>

        <div class="name">
            {{ $t->user->name ?? 'User' }}
        </div>

        <p>{{ $t->pesan }}</p>

        <div class="date">
            {{ $t->created_at->format('d-m-Y H:i') }}
        </div>

        @if($t->balasan_admin)
        <div class="reply-box">
            <b>Balasan Admin:</b><br>
            {{ $t->balasan_admin }}
        </div>
        @endif

        @if(auth()->check() && auth()->user()->role == 'superadmin')

        <form action="/rate/balas/{{ $t->id }}" method="POST">
            @csrf

            <textarea
                name="balasan_admin"
                rows="3"
                placeholder="Tulis balasan admin...">{{ $t->balasan_admin }}</textarea>

            <button type="submit">Kirim Balasan</button>

        </form>

        @endif

    </div>

    @endforeach

</div>

<script>
const stars = document.querySelectorAll('.star');
const ratingInput = document.getElementById('rating-value');

if(stars.length > 0){

    stars.forEach((star) => {

        star.addEventListener('click', function(){

            let value = this.getAttribute('data-value');

            ratingInput.value = value;

            stars.forEach((s)=>{
                s.classList.remove('active');
            });

            for(let i = 0; i < value; i++){
                stars[i].classList.add('active');
            }

        });

    });

}
</script>

</body>
</html>