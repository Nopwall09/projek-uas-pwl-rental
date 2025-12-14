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

        <div>
            <label>Nama</label>
            <input type="text" name="nama" value="{{ old('nama', auth()->user()->nama) }}">
        </div>

        <div>
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}">
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
        </div>

        <div>
            <label>Password Baru (opsional)</label>
            <input type="password" name="password">
        </div>

        <div>
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation">
        </div>

        <button type="submit">Simpan</button>
    </form>



        <a href="{{ route('profile') }}" class="btn-cancel">
            Batal
        </a>
    </form>

</div>

</body>
</html>
