@extends('layouts.master')
@section('title', 'Edit Transaksi Rental')

@section('content')
<div class="container">

    <h3 class="mb-4">Edit Transaksi Rental</h3>

    <form action="{{ route('kasir.update', $rental->rental_id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- MODE --}}
        <div class="mb-3">
            <label>Jenis Transaksi</label>
            <input type="text" class="form-control"
                   value="{{ $rental->booking_source }}"
                   disabled>
        </div>

        {{-- USER / OFFLINE --}}
        @if ($rental->booking_source === 'online')
            <div class="mb-3">
                <label>User ID</label>
                <input type="text" name="user_id" class="form-control"
                       value="{{ $rental->user_id }}">
            </div>
        @else
            <div class="mb-3">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama_Pelanggan" class="form-control"
                       value="{{ $rental->Nama_Pelanggan }}">
            </div>
        @endif

        {{-- MOBIL --}}
        <div class="mb-3">
            <label>Mobil</label>
            <select name="mobil_id" class="form-control" required>
                @foreach ($mobils as $mobil)
                    <option value="{{ $mobil->mobil_id }}"
                        {{ $mobil->mobil_id == $rental->mobil_id ? 'selected' : '' }}
                        {{ $mobil->status === 'Disewa' && $mobil->mobil_id != $rental->mobil_id ? 'disabled' : '' }}>
                        {{ $mobil->mobil_plat }} | {{ $mobil->Transmisi }} | {{ $mobil->status }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- DURASI --}}
        <div class="mb-3">
            <label>Durasi Rental</label>
            <input type="text" name="lama_rental" class="form-control"
                   value="{{ $rental->lama_rental }}">
        </div>

        {{-- PILIHAN --}}
        <div class="mb-3">
            <label>Pilihan</label>
            <select name="pilihan" class="form-control">
                <option value="lepas kunci" {{ $rental->pilihan == 'lepas kunci' ? 'selected' : '' }}>
                    Lepas Kunci
                </option>
                <option value="dengan driver" {{ $rental->pilihan == 'dengan driver' ? 'selected' : '' }}>
                    Dengan Driver
                </option>
            </select>
        </div>

        {{-- TANGGAL --}}
        <div class="mb-3">
            <label>Tanggal Rental</label>
            <input type="date" name="tgl" class="form-control"
                   value="{{ $rental->tgl }}">
        </div>

        {{-- TOTAL --}}
        <div class="mb-3">
            <label>Total Sewa</label>
            <input type="number" name="total_sewa" class="form-control"
                   value="{{ $rental->total_sewa }}">
        </div>

        {{-- JAMINAN --}}
        <div class="mb-3">
            <label>Jaminan</label>
            <input type="text" name="jaminan" class="form-control"
                   value="{{ $rental->jaminan }}">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('kasir.index') }}" class="btn btn-secondary">Batal</a>
    </form>

</div>
@endsection
