@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="login-wrapper">
    <div class="login-card">
        <h2>Masuk ke Akun</h2>

        @if (session('error'))
            <p class="error-msg">{{ session('error') }}</p>
        @endif

        <form method="POST" action="#">
            !!!csrf

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <p class="register-text">
            Belum punya akun?
            <a href="#">Register</a>
        </p>
    </div>
</div>

