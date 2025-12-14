@extends('layouts.master')
@section('title', 'Dashboard Kasir')


@section('content')

<div class="container-fluid">

    <!-- Header + Action -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Dashboard Kasir</h1>

        <div class="d-flex gap-2">
            <a href="{{ route('kasir.transaksi') }}" class="btn btn-primary">
                + Transaksi Baru
            </a>
            <a href="#" class="btn btn-outline-secondary">
                Data Transaksi
            </a>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <a href="{{ url('/mobil') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Mobil Tersedia</p>
                        <h3 class="fw-bold">12</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Mobil Disewa</p>
                    <h3 class="fw-bold">8</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <a href="{{ url('/transaksi') }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Transaksi Hari Ini</p>
                        <h3 class="fw-bold">5</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Pendapatan Hari Ini</p>
                    <h3 class="fw-bold">Rp 2.500.000</h3>
                </div>
            </div>
        </div>

    </div>

    <!-- Tabel Sewa Aktif -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Sewa Aktif</h5>
                <a href="{{ url(path: '/transaksi') }}" class="btn btn-sm btn-outline-primary">
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
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Andi</td>
                        <td>Avanza</td>
                        <td>10-12-2025</td>
                        <td>15-12-2025</td>
                        <td><span class="badge bg-warning">Disewa</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-success">Selesai</a>
                            <a href="#" class="btn btn-sm btn-warning">Perpanjang</a>
                        </td>
                    </tr>

                    <tr>
                        <td>Budi</td>
                        <td>Innova</td>
                        <td>09-12-2025</td>
                        <td>14-12-2025</td>
                        <td><span class="badge bg-danger">Telat</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-success">Selesai</a>
                            <a href="#" class="btn btn-sm btn-warning">Perpanjang</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
