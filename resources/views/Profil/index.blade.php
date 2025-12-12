@include('layouts.navbar')

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-item active">
            <span class="icon">👤</span>
            <a href="{{ url('/profil') }}">Akun Saya</a>
        </div>

        <div class="sidebar-item">
            <span class="icon">📄</span>
            <a href="{{ url('/pesanan-saya') }}">Pesanan Saya</a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <h2>Profil Saya</h2>
        <p class="desc">Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun.</p>

        <div class="profile-box">
            <div class="row">
                <span class="label">Nama</span>
                <span class="value">Daffa Putra Prasetya</span>
                <a class="edit" href="#">Ubah</a>
            </div>

            <div class="row">
                <span class="label">Email</span>
                <span class="value">DaffaPutraPrasetya@gmail.com</span>
                <a class="edit" href="#">Ubah</a>
            </div>

            <div class="row">
                <span class="label">No. Telepon</span>
                <span class="value">087736117128</span>
                <a class="edit" href="#">Ubah</a>
            </div>

            <div class="row">
                <span class="label">Password</span>
                <span class="value">********</span>
                <a class="edit" href="#">Ubah</a>
            </div>
        </div>

    </div>

</div>

</body>
</html>
