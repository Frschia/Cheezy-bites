<x-guest-layout>

<style>
body{
    margin:0;
    font-family:Arial, sans-serif;
    background:linear-gradient(135deg,#fff8f0,#ffe0b3);
    min-height:100vh;
}

.register-box{
    width:100%;
    max-width:450px;
    margin:40px auto;
    background:white;
    padding:30px 25px;
    border-radius:25px;
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
    box-sizing:border-box;
}

.logo{
    text-align:center;
    margin-bottom:20px;
}

.logo img{
    width:90px;
    height:90px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid orange;
}

.title{
    text-align:center;
    font-size:28px;
    font-weight:bold;
    color:orange;
    margin-bottom:5px;
}

.sub{
    text-align:center;
    color:#888;
    margin-bottom:25px;
}

label{
    font-weight:bold;
    color:#444;
    display:block;
    margin-bottom:5px;
}

input[type=text],
input[type=email],
input[type=password]{
    width:100%;
    padding:13px;
    border:1px solid #ddd;
    border-radius:14px;
    outline:none;
    box-sizing:border-box;
}

input:focus{
    border-color:orange;
}

.mt{
    margin-top:15px;
}

.bottom{
    margin-top:20px;
}

.btn-register{
    width:100%;
    background:orange;
    color:white;
    border:none;
    padding:14px;
    border-radius:15px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

.btn-register:hover{
    background:#ff9800;
}

.link{
    display:block;
    text-align:center;
    margin-top:15px;
    color:#777;
    text-decoration:none;
    font-size:14px;
}

.link:hover{
    color:orange;
}

/* HP */
@media(max-width:768px){

    .register-box{
        width:92%;
        margin:20px auto;
        padding:25px 18px;
    }

    .title{
        font-size:24px;
    }

    .btn-register{
        font-size:15px;
        padding:13px;
    }

    .logo img{
        width:80px;
        height:80px;
    }
}

/* Tablet */
@media(min-width:769px) and (max-width:1024px){

    .register-box{
        max-width:520px;
        margin-top:60px;
    }
}
</style>

<div class="register-box">

    <div class="logo">
        <img src="{{ asset('images/logo.jpg') }}">
    </div>

    <div class="title">Cheezy Bites</div>
    <div class="sub">Daftar dulu yuk 🧀💛</div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- NAME -->
        <div>
            <label>Nama</label>

            <x-text-input
                id="name"
                type="text"
                name="name"
                class="block mt-2 w-full"
                :value="old('name')"
                required autofocus />
        </div>

        <x-input-error :messages="$errors->get('name')" class="mt-2" />

        <!-- EMAIL -->
        <div class="mt">
            <label>Email</label>

            <x-text-input
                id="email"
                type="email"
                name="email"
                class="block mt-2 w-full"
                :value="old('email')"
                required />
        </div>

        <x-input-error :messages="$errors->get('email')" class="mt-2" />

        <!-- PASSWORD -->
        <div class="mt">
            <label>Password</label>

            <x-text-input
                id="password"
                type="password"
                name="password"
                class="block mt-2 w-full"
                required />
        </div>

        <x-input-error :messages="$errors->get('password')" class="mt-2" />

        <!-- CONFIRM -->
        <div class="mt">
            <label>Konfirmasi Password</label>

            <x-text-input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                class="block mt-2 w-full"
                required />
        </div>

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

        <!-- BUTTON -->
        <div class="bottom">

            <button type="submit" class="btn-register">
                Register Sekarang
            </button>

            <a href="{{ route('login') }}" class="link">
                Sudah punya akun? Login
            </a>

        </div>

    </form>

</div>

</x-guest-layout>