@extends('layouts.master')
@section('title', 'Dashboard Kasir')

@section('content')
<div class="container-fluid">

    <!-- Header + Action -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Dashboard Kasir</h1>

        <div class="d-flex gap-2">
            <a href="{{ route('kasir.create') }}" class="btn btn-primary">
                + Transaksi Baru
            </a>
            <a href="{{ route('kasir.index') }}" class="btn btn-outline-secondary">
                Data Transaksi
            </a>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Mobil Tersedia</p>
                    <h3 class="fw-bold">{{ $mobilTersedia }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Mobil Disewa</p>
                    <h3 class="fw-bold">{{ $mobilDisewa }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Transaksi Hari Ini</p>
                    <h3 class="fw-bold">{{ $transaksiHariIni }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Pendapatan Hari Ini</p>
                    <h5 class="fw-bold">
                        Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}
                    </h5>
                </div>
            </div>
        </div>

    </div>

    <!-- Tabel Sewa Aktif -->
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Sewa Aktif</h5>
                <a href="{{ route('kasir.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Pelanggan</th>
                        <th>Mobil</th>
                        <th>Tanggal Sewa</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($sewaAktif as $item)
                        <tr>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->mobil->nama_mobil ?? '-' }}</td>
                            <td>{{ $item->tgl }}</td>
                            <td>{{ $item->jatuh_tempo }}</td>
                            <td>
                                <span class="badge bg-warning">Disewa</span>
                            </td>
                            <td class="d-flex gap-1">

                                <!-- SELESAI (DELETE) -->
                                <form action="{{ route('kasir.destroy', $item->rental_id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Selesaikan sewa? Mobil akan tersedia kembali.')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-success">
                                        Selesai
                                    </button>
                                </form>

                                <!-- PERPANJANG -->
                                <a href="{{ route('kasir.update', $item->rental_id) }}"
                                   class="btn btn-sm btn-warning">
                                    Perpanjang
                                </a>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Tidak ada sewa aktif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection