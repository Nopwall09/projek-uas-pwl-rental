<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">

<main class="wrapper">

    <section class="box detail">
        <h3>Detail pesanan</h3>
        <div class="input-group"><label>Nama Lengkap</label><input type="text" placeholder="Nama Lengkap Anda" required></div>
        <div class="input-group"><label>Email</label><input type="text" placeholder="email.anda@gmail.com" required></div>
        <div class="input-group"><label>Alamat</label><input type="text" placeholder="Masukkan Alamat Lengkap" required></div>
        <div class="input-group"><label>Kota</label><input type="text" placeholder="Masukkan Kota" required></div>
        <div class="input-group"><label>Provinsi</label><input type="text" placeholder="Masukkan Provinsi" required></div>
        <div class="input-group"><label>No. HP</label><input type="text" placeholder="Masukkan No.Hp" required></div>
    </section>

    <section class="box note">
        <h3>Catatan Tambahan :</h3>
        <textarea placeholder="Masukan catatan" required></textarea>
    </section>

    <section class="box summary">
        <h3>Pesanan</h3>
        <p><strong>Mobil</strong>  : Mobil</p>
        <p><strong>Check In</strong> : - </p>
        <p><strong>Check Out</strong>: -</p>
        <p><strong>Opsi</strong>     : -</p>

        <div class="subtotal">
            <span>SubTotal</span><b>Rp. - </b>
        </div>

        <div class="total">
            <span>Total</span><b>Rp. - </b>
        </div>
    </section>

    <section class="box payment-method">
        <label><input type="radio" name="pay"> Transfer Bank BCA</label>
        <label><input type="radio" name="pay"> Bayar Tunai</label>

        <button class="submit-btn">Buat Pesanan</button>
    </section>

</main>
