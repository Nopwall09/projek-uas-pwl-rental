@extends('layouts.master')
@section('title', 'Transaksi Kasir')

@section('content')
<div class="container">
    <h3 class="mb-4">Daftar Transaksi</h3>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Pelanggan</th>
                <th>Mobil</th>
                <th>Driver</th>
                <th>Tanggal Rental</th>
                <th>Durasi</th>
                <th>Pilihan</th>
                <th>Total Sewa</th>
                <th>Booking</th>
                <th>Jaminan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $tr)
            <tr>
                <td>{{ $tr->user->name ?? $tr->nama_Pelanggan }}</td>
                <td>{{ $tr->mobil->mobil_plat ?? '-' }}</td>
                <td>{{ $tr->driver->nama ?? '-' }}</td>
                <td>{{ $tr->tgl->format('d-m-Y') }}</td>
                <td>{{ $tr->lama_rental }}</td>
                <td>{{ $tr->pilihan }}</td>
                <td>{{ number_format($tr->total_sewa,0,',','.') }}</td>
                <td>{{ ucfirst($tr->booking_source) }}</td>
                <td>{{ $tr->jaminan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $laporan->links() }} {{-- pagination --}}
</div>
@endsection
