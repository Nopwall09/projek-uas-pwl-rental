<div class="content">
    <h2>Profil Saya</h2>
    <p class="desc">
        Kelola informasi profil Anda untuk mengontrol, melindungi, dan mengamankan akun.
    </p>
    <div class="profile-box">

        <div class="row">
            <span class="label">Nama</span>
            <span class="value">{{ $user->nama }}</span>
            <a class="edit" href="#">Ubah</a>
        </div>

        <div class="row">
            <span class="label">Email</span>
            <span class="value">{{ $user->email }}</span>
            <a class="edit" href="#">Ubah</a>
        </div>

        <div class="row">
            <span class="label">Username</span>
            <span class="value">{{ $user->username }}</span>
            <a class="edit" href="#">Ubah</a>
        </div>

        <div class="row">
            <span class="label">Role</span>
            <span class="value">{{ ucfirst($user->role) }}</span>
        </div>

        <div class="row">
            <span class="label">Password</span>
            <span class="value">********</span>
            <a class="edit" href="#">Ubah</a>
        </div>

    </div>
</div>