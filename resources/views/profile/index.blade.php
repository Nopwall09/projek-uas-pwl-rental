@include('layouts.navbar')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>

<div class="wrapper">

    <div class="sidebar">
        <div class="sidebar-item active">
            <a href="{{ route('profile') }}">Akun Saya</a>
        </div>

        <div class="sidebar-item">
            <a href="{{ route('pemesanan') }}">Pesanan Saya</a>
        </div>
    </div>

    <div class="content">
        <h2>Profil Saya</h2>

        <div class="profile-box">
            <div class="row">
                <span class="label">Nama</span>
                <span class="value">{{ $user->name }}</span>
            </div>

            <div class="row">
                <span class="label">Username</span>
                <span class="value">{{ $user->username }}</span>
            </div>

            <div class="row">
                <span class="label">Email</span>
                <span class="value">{{ $user->email }}</span>
            </div>

            {{-- <div class="row">
                <span class="label">Role</span>
                <span class="value">{{ ucfirst($user->role) }}</span>
            </div> --}}

            <div class="row">
                <span class="label">Password</span>
                <span class="value">********</span>
            </div>

            <a href="{{ route('profile.edit') }}" class="btn-edit">
                Edit Profil
            </a>

        </div>
    </div>

</div>

</body>
</html>
