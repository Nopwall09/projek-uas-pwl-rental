@include('layouts.navbar')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>

<div class="wrapper">

    <h2>Edit Profil</h2>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <hr>

        <div class="form-group">
            <label>Password Baru (opsional)</label>
            <input type="password" name="password">
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation">
        </div>

        <button type="submit" class="btn-save">
            Simpan Perubahan
        </button>

        <a href="{{ route('profile') }}" class="btn-cancel">
            Batal
        </a>
    </form>

</div>

</body>
</html>
