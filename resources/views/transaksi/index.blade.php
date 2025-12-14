@extends('layouts.master')
@section('title', 'Transaksi Rental')

@section('content')
<div class="container">
    <h3 class="mb-4">Transaksi Rental</h3>

    {{-- Form Tambah Transaksi --}}
    <form action="{{ route('kasir.store') }}" method="POST">
        @csrf

        {{-- User --}}
        <div class="mb-3">
            <label>User ID</label>
            <input type="text" name="user_id" class="form-control" required>
        </div>

        {{-- Pilih Mobil --}}
        <div class="mb-3">
            <label>Mobil</label>
            <select name="mobil_id" class="form-control" required>
                <option value="">-- Pilih Mobil --</option>
                @foreach($mobils as $mobil)
                    <option value="{{ $mobil->mobil_id }}"
                        {{ $mobil->mobil_status === 'Disewa' ? 'disabled' : '' }}>
                        {{ $mobil->mobil_plat }} | {{ $mobil->Transmisi }} | {{ $mobil->mobil_status }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Lama Rental --}}
        <div class="mb-3">
            <label>Lama Rental (hari)</label>
            <input type="number" name="lama_rental" class="form-control" min="1" value="1" required>
        </div>

        {{-- Total Sewa --}}
        <div class="mb-3">
            <label>Total Sewa</label>
            <input type="number" name="total_sewa" class="form-control" readonly>
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

        {{-- Booking --}}
        <div class="mb-3">
            <label>Booking</label>
            <select name="booking_source" class="form-control">
                <option value="offline">Offline</option>
                <option value="online">Online</option>
            </select>
        </div>

        {{-- Jaminan --}}
        <div class="mb-3">
            <label>Jaminan</label>
            <input type="text" name="jaminan" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
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
                        <td>{{ $tr->user?->name ?? $tr->nama_Pelanggan }}</td>
                        <td>{{ $tr->mobil->mobil_plat ?? '-' }}</td>
                        <td>{{ $tr->lama_rental }}</td>
                        <td>{{ number_format($tr->total_sewa, 0, ',', '.') }}</td>
                        <td>{{ $tr->pilihan }}</td>
                        <td>{{ $tr->tgl->format('d-m-Y') }}</td>
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

        {{ $transaksis->links() }} {{-- Pagination --}}
    </div>
</div>
@endsection
