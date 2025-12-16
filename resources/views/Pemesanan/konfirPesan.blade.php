<form action="{{ route('pesanan.store') }}" method="POST">
@csrf

<main class="wrapper">

    <!-- CATATAN -->
    <section class="box note">
        <h3>Catatan Tambahan :</h3>
        <textarea 
            name="catatan"
            placeholder="Masukan catatan"
        ></textarea>
    </section>

    <!-- SUMMARY -->
    <section class="box summary">
        <h3>Pesanan</h3>

        <p><strong>Mobil</strong> : {{ $mobil->merk->merk_nama }} {{ $mobil->tipe->tipe_nama }}</p>
        <p><strong>Check In</strong> : {{ $tgl }}</p>
        <p><strong>Lama Sewa</strong> : {{ $lama_rental }} hari</p>
        <p><strong>Opsi</strong> : {{ $pilihan }}</p>

        <div class="subtotal">
            <span>SubTotal</span>
            <b>Rp {{ number_format($total_sewa,0,',','.') }}</b>
        </div>

        <div class="total">
            <span>Total</span>
            <b>Rp {{ number_format($total_sewa,0,',','.') }}</b>
        </div>
    </section>

    <!-- PAYMENT -->
    <section class="box payment-method">
        <label>
            <input type="radio" name="jaminan" value="Transfer BCA" required>
            Transfer Bank BCA
        </label>

        <label>
            <input type="radio" name="jaminan" value="Tunai">
            Bayar Tunai
        </label>

        <button type="submit" class="submit-btn">
            Buat Pesanan
        </button>
    </section>

    <!-- HIDDEN -->
    <input type="hidden" name="mobil_id" value="{{ $mobil->mobil_id }}">
    <input type="hidden" name="lama_rental" value="{{ $lama_rental }}">
    <input type="hidden" name="total_sewa" value="{{ $total_sewa }}">
    <input type="hidden" name="pilihan" value="{{ $pilihan }}">
    <input type="hidden" name="tgl" value="{{ $tgl }}">
    <input type="hidden" name="booking_source" value="online">

</main>
</form>
