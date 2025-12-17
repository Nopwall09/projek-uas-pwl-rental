@extends('layouts.master')
@section('title', 'Data Driver')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Data Driver</h1>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Driver</th>
                        <th>No SIM</th>
                        <th>No Telepon</th>
                        <th>Biaya Driver</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($drivers as $driver)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $driver->driver_nama ?? '-' }}</td>
                            <td>{{ $driver->driver_no_sim ?? '-' }}</td>
                            <td>{{ $driver->driver_no_telp ?? '-' }}</td>
                            <td>Rp {{ number_format($driver->biaya_driver, 0, ',', '.') }}</td>
                            <td>
                                @if($driver->status == 'Tersedia')
                                    <span class="badge bg-success">Tersedia</span>
                                @else
                                    <span class="badge bg-warning">Booked</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Data driver belum tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $drivers->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
