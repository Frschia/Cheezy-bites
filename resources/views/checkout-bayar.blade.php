<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran - Cheezy Bites</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>

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
            display:flex;
            justify-content:center;
            align-items:center;
            padding:20px;
        }

        .box{
            width:100%;
            max-width:500px;
            background:white;
            padding:30px 25px;
            border-radius:20px;
            box-shadow:0 5px 15px rgba(0,0,0,0.08);
            text-align:center;
        }

        h2{
            color:orange;
            font-size:30px;
            margin-bottom:20px;
        }

        .label{
            color:#666;
            font-size:16px;
            margin-bottom:8px;
        }

        .price{
            font-size:30px;
            font-weight:bold;
            color:#333;
            margin-bottom:20px;
            word-break:break-word;
        }

        .btn{
            width:100%;
            padding:14px;
            border:none;
            border-radius:12px;
            cursor:pointer;
            margin-top:12px;
            font-size:16px;
            font-weight:bold;
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
            background:#e0e0e0;
            color:#333;
        }

        .cancel:hover{
            background:#cfcfcf;
        }

        /* ===== TABLET ===== */
        @media (max-width:768px){
            .box{
                padding:25px 20px;
            }

            h2{
                font-size:26px;
            }

            .price{
                font-size:26px;
            }
        }

        /* ===== HP ===== */
        @media (max-width:480px){
            body{
                padding:15px;
            }

            .box{
                padding:22px 18px;
                border-radius:16px;
            }

            h2{
                font-size:22px;
            }

            .label{
                font-size:14px;
            }

            .price{
                font-size:22px;
            }

            .btn{
                font-size:14px;
                padding:12px;
            }
        }
    </style>
</head>

<body>

<div class="box">

    <h2>💳 Pembayaran</h2>

    <p class="label">Total Bayar:</p>
    <div class="price">Rp {{ number_format($total) }}</div>

    <button id="pay-button" class="btn pay">
        Bayar Sekarang
    </button>

    <a href="/pesanan">
        <button class="btn cancel">
            Lihat Pesanan
        </button>
    </a>

</div>

<script>
document.getElementById('pay-button').onclick = function () {

    snap.pay('{{ $snapToken }}', {

        onSuccess: function(result){
            alert("Pembayaran berhasil!");
            window.location.href = "/pesanan";
        },

        onPending: function(result){
            alert("Menunggu pembayaran...");
            window.location.href = "/pesanan";
        },

        onError: function(result){
            alert("Pembayaran gagal!");
        },

        onClose: function(){
            alert("Kamu menutup pembayaran.");
        }

    });

};
</script>

</body>
</html>