@extends('layouts.master')
@section('title', 'History Rental')

@section('content')
<div class="container-fluid">

    <h1 class="mb-4">History Rental</h1>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Mobil</th>
                        <th>Aksi</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($history as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->user->name ?? '-' }}</td>
                        <td>{{ $item->rentalitem->mobil->nama_mobil ?? '-' }}</td>
                        <td>{{ $item->aksi }}</td>
                        <td>{{ $item->waktu }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada history rental</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

            <div class="mt-3">
                {{ $history->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
