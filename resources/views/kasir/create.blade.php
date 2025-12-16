@extends('layouts.master')
@section('title', 'Transaksi Rental')

@section('content')
<div class="container">
    <h3 class="mb-4">Transaksi Rental</h3>

    <form action="{{ route('kasir.store') }}" method="POST">
        @csrf

        {{-- NAMA PELANGGAN --}}
        <div class="mb-3">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_Pelanggan" class="form-control" required>
        </div>

        {{-- MOBIL --}}
        <div class="mb-3">
            <label>Mobil</label>
            <select name="mobil_id" id="mobil_id" class="form-control" required>
                <option value="">-- Pilih Mobil --</option>

                @foreach ($mobils as $mobil)
                    <option
                        value="{{ $mobil->mobil_id }}"
                        data-harga="{{ $mobil->harga_rental }}"
                    >
                        {{ $mobil->merk->merk_nama ?? '-' }}
                        {{ $mobil->nama_mobil }}
                        | Plat: {{ $mobil->mobil_plat }}
                        | {{ $mobil->Transmisi }}
                        | Rp {{ number_format($mobil->harga_rental, 0, ',', '.') }}/hari
                    </option>
                @endforeach

            </select>

        </div>

        {{-- DURASI --}}
        <div class="mb-3">
            <label>Lama Rental (Hari)</label>
            <input type="number" name="lama_rental" id="lama_rental" class="form-control" min="1" required>
        </div>
        {{-- DRIVER --}}
        <div class="mb-3">
            <label>Driver</label><br>
            <input type="radio" name="driver_option" value="without" checked> Tanpa Driver
            <input type="radio" name="driver_option" value="with"> Dengan Driver

            {{-- KETERANGAN BIAYA --}}
            <small id="driver_note" class="text-danger d-none">
                * Biaya tambahan driver minimal Rp150.000 / hari
            </small>
        </div>


        {{-- LIST DRIVER --}}
        <div class="mb-3 d-none" id="driver_field">
            <label>Pilih Driver</label>
            <select name="driver_id" class="form-control">
                <option value="">-- Pilih Driver --</option>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->driver_id }}">
                        {{ $driver->driver_nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- TANGGAL --}}
        <div class="mb-3">
            <label>Tanggal Sewa</label>
            <input type="date" name="tgl_sewa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Kembali</label>
            <input type="date" name="tgl_kembali" class="form-control" required>
        </div>


        {{-- TOTAL --}}
        <div class="mb-3">
            <label>Total Sewa</label>

            <!-- tampil rupiah -->
            <input type="text"
                id="total_sewa_view"
                class="form-control"
                readonly>

            <!-- nilai asli untuk backend -->
            <input type="hidden"
                name="total_sewa"
                id="total_sewa">
        </div>


        {{-- JAMINAN --}}
        <div class="mb-3">
            <label>Jaminan</label>
            <input type="text" name="jaminan" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('kasir.dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
const biayaDriver = 150000;

// format rupiah Indonesia
function formatRupiah(angka) {
    return 'Rp. ' + angka.toLocaleString('id-ID', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

function hitungTotal() {
    const mobilSelect = document.getElementById('mobil_id');
    const lamaRental  = parseInt(document.getElementById('lama_rental').value) || 0;
    const driver      = document.querySelector('input[name="driver_option"]:checked').value;

    const hargaMobil = parseInt(
        mobilSelect.options[mobilSelect.selectedIndex]?.dataset.harga || 0
    );

    let total = lamaRental * hargaMobil;

    if (driver === 'with') {
        total += biayaDriver;
    }

    // simpan angka asli
    document.getElementById('total_sewa').value = total;

    // tampilkan format rupiah
    document.getElementById('total_sewa_view').value = formatRupiah(total);
}

/* EVENT */
document.getElementById('mobil_id').addEventListener('change', hitungTotal);
document.getElementById('lama_rental').addEventListener('input', hitungTotal);

document.querySelectorAll('input[name="driver_option"]').forEach(el => {
    el.addEventListener('change', () => {
        document.getElementById('driver_field')
            .classList.toggle('d-none', el.value !== 'with');

        document.getElementById('driver_note')
            .classList.toggle('d-none', el.value !== 'with');

        hitungTotal();
    });
});
</script>


@endsection
