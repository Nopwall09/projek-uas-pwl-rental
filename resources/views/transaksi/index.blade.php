@extends('layouts.master')
@section('title', 'Transaksi Rental')

@section('content')
<div class="container">
    <h3 class="mb-4">Transaksi Rental</h3>

    {{-- Form Tambah Transaksi --}}
    <form action="{{ route('kasir.store') }}" method="POST">
        @csrf

        {{-- SUMBER BOOKING --}}
        <div class="mb-3">
            <label>Sumber Booking</label>
            <select name="booking_source" id="booking_source" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>
        </div>

        {{-- USER ID (ONLINE) --}}
        <div class="mb-3 d-none" id="user_field">
            <label>User ID</label>
            <input type="text" name="user_id" class="form-control">
        </div>

        {{-- NAMA PELANGGAN (OFFLINE) --}}
        <div class="mb-3 d-none" id="nama_field">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" class="form-control">
        </div>

        {{-- MOBIL --}}
        <div class="mb-3">
            <label>Mobil</label>
            <select name="mobil_id" id="mobil_id" class="form-control" required>
                <option value="">-- Pilih Mobil --</option>
                @foreach ($mobils as $mobil)
                    <option value="{{ $mobil->mobil_id }}"
                        data-harga="{{ $mobil->harga_rental }}"
                        data-gambar="{{ $mobil->mobil_image }}"
                        {{ $mobil->mobil_status === 'Disewa' ? 'disabled' : '' }}>
                        {{ $mobil->mobil_plat }} | {{ $mobil->Transmisi }} | {{ $mobil->mobil_status }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Preview Gambar --}}
        <div class="mb-3" id="preview_mobil"></div>

        {{-- Lama Rental --}}
        <div class="mb-3">
            <label>Durasi Rental (hari)</label>
            <input type="number" name="lama_rental" id="lama_rental" class="form-control" min="1" value="1" required>
        </div>

        {{-- Pilihan --}}
        <div class="mb-3">
            <label>Pilihan</label>
            <select name="pilihan" class="form-control">
                <option value="lepas kunci">Lepas Kunci</option>
                <option value="dengan driver">Dengan Driver</option>
            </select>
        </div>

        {{-- Tanggal --}}
        <div class="mb-3">
            <label>Tanggal Rental</label>
            <input type="date" name="tgl" class="form-control" required>
        </div>

        {{-- Total Sewa --}}
        <div class="mb-3">
            <label>Total Sewa</label>
            <input type="number" name="total_sewa" id="total_sewa" class="form-control" readonly>
        </div>

        {{-- Jaminan --}}
        <div class="mb-3">
            <label>Jaminan</label>
            <input type="text" name="jaminan" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('kasir.dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>

    {{-- Tabel Daftar Transaksi --}}
    <div class="mt-5">
        <h4>Daftar Transaksi</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Mobil</th>
                    <th>Lama Rental</th>
                    <th>Total Sewa</th>
                    <th>Pilihan</th>
                    <th>Tanggal</th>
                    <th>Booking</th>
                    <th>Jaminan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis as $tr)
                    <tr>
                        <td>{{ $tr->users?->name ?? $tr->nama_pelanggan }}</td>
                        <td>{{ $tr->mobil->mobil_plat ?? '-' }}</td>
                        <td>{{ $tr->lama_rental }}</td>
                        <td>{{ number_format($tr->total_sewa, 0, ',', '.') }}</td>
                        <td>{{ $tr->pilihan }}</td>
                        <td>{{ \Carbon\Carbon::parse($tr->tgl)->format('d-m-Y') }}</td>
                        <td>{{ ucfirst($tr->booking_source) }}</td>
                        <td>{{ $tr->jaminan }}</td>
                        <td>
                            <a href="{{ route('kasir.edit', $tr->rental_id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('kasir.destroy', $tr->rental_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        {{ $transaksis->links() }}
    </div>
</div>
<script>
    // Toggle field online/offline
    document.getElementById('booking_source').addEventListener('change', function () {
        let userField = document.getElementById('user_field');
        let namaField = document.getElementById('nama_field');

        userField.classList.add('d-none');
        namaField.classList.add('d-none');

        if (this.value === 'online') userField.classList.remove('d-none');
        if (this.value === 'offline') namaField.classList.remove('d-none');
    });

    // Update total sewa dan preview mobil
    document.addEventListener('DOMContentLoaded', function () {
        const mobilSelect = document.getElementById('mobil_id');
        const lamaInput = document.getElementById('lama_rental');
        const totalInput = document.getElementById('total_sewa');
        const previewMobil = document.getElementById('preview_mobil');

        function updateTotalAndPreview() {
            const selected = mobilSelect.selectedOptions[0];
            if (!selected || !selected.dataset.harga) {
                totalInput.value = '';
                previewMobil.innerHTML = '';
                return;
            }

            const harga = parseFloat(selected.dataset.harga);
            const lama = parseInt(lamaInput.value) || 1;
            totalInput.value = harga * lama;

            const imgSrc = selected.dataset.gambar ? `/img/${selected.dataset.gambar}` : '';
            previewMobil.innerHTML = imgSrc ? `<img src="${imgSrc}" class="img-fluid" style="max-width:200px">` : '';
        }

        mobilSelect.addEventListener('change', updateTotalAndPreview);
        lamaInput.addEventListener('input', updateTotalAndPreview);
    });
</script>
@endsection
