@extends('layouts.master')
@section('title', 'Transaksi Rental')

@section('content')
<div class="container">
    <h3 class="mb-4">Transaksi Rental</h3>

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
            <select name="mobil_id" class="form-control" required>
                <option value="">-- Pilih Mobil --</option>
                @foreach ($mobils as $mobil)
                    <option value="{{ $mobil->mobil_id }}"
                        {{ $mobil->status === 'Disewa' ? 'disabled' : '' }}>
                        {{ $mobil->mobil_plat }} | {{ $mobil->Transmisi }} | {{ $mobil->status }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Durasi Rental</label>
            <input type="text" name="lama_rental" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pilihan</label>
            <select name="pilihan" class="form-control">
                <option value="lepas kunci">Lepas Kunci</option>
                <option value="dengan driver">Dengan Driver</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Rental</label>
            <input type="date" name="tgl" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Total Sewa</label>
            <input type="number" name="total_sewa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jaminan</label>
            <input type="text" name="jaminan" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('kasir.dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

{{-- JS TOGGLE ONLINE / OFFLINE --}}
<script>
document.getElementById('booking_source').addEventListener('change', function () {
    let userField = document.getElementById('user_field');
    let namaField = document.getElementById('nama_field');

    userField.classList.add('d-none');
    namaField.classList.add('d-none');

    if (this.value === 'online') {
        userField.classList.remove('d-none');
    }

    if (this.value === 'offline') {
        namaField.classList.remove('d-none');
    }
});
</script>
@endsection
