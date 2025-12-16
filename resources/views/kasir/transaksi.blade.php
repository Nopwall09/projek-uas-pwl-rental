@extends('layouts.master')
@section('title', 'Data Transaksi')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Data Transaksi Rental</h3>
        <a href="{{ route('kasir.create') }}" class="btn btn-primary">
            + Transaksi Baru
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Mobil</th>
                        <th>Tgl Sewa</th>
                        <th>Tgl Kembali</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($transaksi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_Pelanggan }}</td>
                    <td>
                        {{ $item->mobil->merk->merk_nama ?? '-' }}
                        {{ $item->mobil->nama_mobil ?? '-' }}
                    </td>
                    <td>{{ $item->tgl_sewa }}</td>
                    <td>{{ $item->tgl_kembali }}</td>
                    <td>
                        Rp {{ number_format($item->total_sewa, 0, ',', '.') }}
                    </td>
                    <td>
                        @if(now()->lte($item->tgl_kembali))
                            <span class="badge bg-warning">Disewa</span>
                        @else
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Belum ada transaksi
                    </td>
                </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
