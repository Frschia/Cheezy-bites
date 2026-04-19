<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Cheezy Bites</title>
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
            min-height:100vh;
            padding:25px 15px;
        }

        .box{
            max-width:600px;
            margin:auto;
            background:white;
            padding:28px;
            border-radius:20px;
            box-shadow:0 5px 15px rgba(0,0,0,0.08);
        }

        h2{
            color:orange;
            text-align:center;
            font-size:30px;
            margin-bottom:18px;
        }

        .total{
            font-size:22px;
            text-align:center;
            font-weight:bold;
            color:#333;
            margin-bottom:20px;
            word-break:break-word;
        }

        label{
            display:block;
            margin-top:14px;
            margin-bottom:6px;
            font-weight:bold;
            color:#444;
            font-size:15px;
        }

        input,
        select,
        textarea{
            width:100%;
            padding:12px;
            border-radius:12px;
            border:1px solid #ddd;
            font-size:15px;
            outline:none;
        }

        input:focus,
        select:focus,
        textarea:focus{
            border-color:orange;
        }

        textarea{
            resize:none;
        }

        .btn{
            width:100%;
            border:none;
            padding:14px;
            font-size:16px;
            font-weight:bold;
            border-radius:12px;
            cursor:pointer;
            margin-top:15px;
            transition:0.3s;
        }

        .pay{
            background:orange;
            color:white;
        }

        .pay:hover{
            background:darkorange;
        }

        .cancel{
            background:#ddd;
            color:#333;
        }

        .cancel:hover{
            background:#c8c8c8;
        }

        /* ===== TABLET ===== */
        @media (max-width:768px){
            .box{
                padding:24px 20px;
            }

            h2{
                font-size:26px;
            }

            .total{
                font-size:20px;
            }

            .btn{
                font-size:15px;
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

<div class="box">

    <h2>🛒 Checkout</h2>

    <p class="total">
        Total Bayar: Rp {{ number_format($total) }}
    </p>

    <form method="POST" action="/checkout">
        @csrf

        <label>Nama</label>
        <input type="text" name="nama"
            value="{{ auth()->user()->name }}" required>

        <label>Email</label>
        <input type="email" name="email"
            value="{{ auth()->user()->email }}" required>

        <label>No HP</label>
        <input type="text" name="phone"
            value="{{ auth()->user()->phone }}" required>

        <label>Metode Pengambilan</label>
        <select name="metode" id="metode" required>
            <option value="">Pilih</option>
            <option value="Ambil ke seller">Ambil ke seller</option>
            <option value="Janjian di tempat">Janjian di tempat</option>
            <option value="Antar ke rumah">Antar ke rumah</option>
        </select>

        <label>Alamat</label>
        <textarea
            name="alamat"
            id="alamat"
            rows="4">{{ auth()->user()->address }}</textarea>

        <button type="submit" class="btn pay">
            Lanjut Bayar
        </button>

    </form>

    <a href="/cart">
        <button type="button" class="btn cancel">
            Batalkan
        </button>
    </a>

</div>

<script>
const metode = document.getElementById('metode');
const alamat = document.getElementById('alamat');

metode.addEventListener('change', function () {

    if(this.value === 'Antar ke rumah'){
        alamat.required = true;
    }else{
        alamat.required = false;
    }

});
</script>

</body>
</html>