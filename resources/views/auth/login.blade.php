<x-guest-layout>

<style>
body{
    margin:0;
    font-family:Arial, sans-serif;
    background:linear-gradient(135deg,#fff8f0,#ffe0b3);
    min-height:100vh;
}

.login-box{
    width:100%;
    max-width:420px;
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

.remember{
    margin-top:15px;
    font-size:14px;
    color:#555;
}

.bottom{
    margin-top:20px;
}

.btn-login{
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

.btn-login:hover{
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

    .login-box{
        margin:20px auto;
        width:92%;
        padding:25px 18px;
    }

    .title{
        font-size:24px;
    }

    .btn-login{
        padding:13px;
        font-size:15px;
    }

    .logo img{
        width:80px;
        height:80px;
    }
}

/* Tablet */
@media(min-width:769px) and (max-width:1024px){

    .login-box{
        max-width:500px;
        margin-top:60px;
    }
}
</style>

<div class="login-box">

    <div class="logo">
        <img src="{{ asset('images/logo.jpg') }}">
    </div>

    <div class="title">Cheezy Bites</div>
    <div class="sub">Login dulu yuk 🧀💛</div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- EMAIL -->
        <div>
            <label>Email</label>

            <x-text-input
                id="email"
                type="email"
                name="email"
                class="block mt-2 w-full"
                :value="old('email')"
                required autofocus />
        </div>

        <x-input-error :messages="$errors->get('email')" class="mt-2" />

        <!-- PASSWORD -->
        <div class="mt-4">
            <label>Password</label>

            <x-text-input
                id="password"
                type="password"
                name="password"
                class="block mt-2 w-full"
                required />
        </div>

        <x-input-error :messages="$errors->get('password')" class="mt-2" />

        <!-- REMEMBER -->
        <div class="remember">
            <label>
                <input type="checkbox" name="remember">
                Remember me
            </label>
        </div>

        <!-- BUTTON -->
        <div class="bottom">

            <button type="submit" class="btn-login">
                Login Sekarang
            </button>

            @if (Route::has('password.request'))
                <a class="link" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif

            <a class="link" href="{{ route('register') }}">
                Belum punya akun? Daftar
            </a>

        </div>

    </form>

</div>

</x-guest-layout>