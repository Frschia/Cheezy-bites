<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Cheezy Bites</title>

    <!-- WAJIB responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- MIDTRANS SNAP -->
    <script 
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>

    <style>
        body {
            font-family: Arial;
            background-color: #fff8f0;
            margin: 0;
            text-align: center;
            padding: 50px 20px;
        }

        .box {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        .btn {
            border: none;
            padding: 15px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        .pay {
            background: orange;
            color: white;
        }

        .pay:hover {
            background: darkorange;
        }

        .cancel {
            background: #ddd;
            color: black;
        }

        .cancel:hover {
            background: #ccc;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            .box {
                padding: 20px;
            }

            h2 {
                font-size: 18px;
            }

            .btn {
                font-size: 14px;
                padding: 12px;
            }
        }
    </style>
</head>

<body>

<div class="box">

    <h2>Total Bayar: Rp {{ number_format($total) }}</h2>

    <button id="pay-button" class="btn pay">Bayar Sekarang</button>

    <a href="/cart">
        <button class="btn cancel">Batalkan</button>
    </a>

</div>

<script>
document.getElementById('pay-button').addEventListener('click', function () {

    snap.pay('{{ $snapToken }}', {

        onSuccess: function(result){
            alert("Pembayaran berhasil!");
            console.log(result);
            window.location.href = "/";
        },

        onPending: function(result){
            alert("Menunggu pembayaran...");
            console.log(result);
        },

        onError: function(result){
            alert("Pembayaran gagal!");
            console.log(result);
        },

        onClose: function(){
            alert('Kamu menutup popup tanpa bayar 😢');
        }

    });

});
</script>

</body>
</html>