<h2>Ubah Password</h2>
@if(session('error')) <p>{{ session('error') }}</p> @endif

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <label>Password Baru</label>
    <input type="password" name="password" required>

    <label>Konfirmasi Password</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Reset Password</button>
</form>
