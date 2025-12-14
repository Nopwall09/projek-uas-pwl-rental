@extends('layouts.master')
@section('title', 'Transaksi Rental')

@section('content')
<div class="container">

    <h3 class="mb-4">Transaksi Rental</h3>

    <form action="{{ route('kasir.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>User ID</label>
            <input type="text" name="user_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mobil ID</label>
            <input type="text" name="mobil_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Durasi Rental</label>
            <input type="text" name="lama_rental" class="form-control">
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
            <input type="date" name="tgl" class="form-control">
        </div>

        <div class="mb-3">
            <label>Total Sewa</label>
            <input type="number" name="total_sewa" class="form-control">
        </div>

        <div class="mb-3">
            <label>Sumber Booking</label>
            <select name="booking_source" class="form-control">
                <option value="offline">Offline</option>
                <option value="online">Online</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Jaminan</label>
            <input type="text" name="jaminan" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('kasir.create') }}" class="btn btn-secondary">Batal</a>

    </form>

</div>
@endsection
