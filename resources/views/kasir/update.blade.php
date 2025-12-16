@extends('layouts.master')
@section('title', 'Edit Transaksi Rental')

@section('content')
<div class="container">

    <h3 class="mb-4">Edit / Perpanjang Transaksi Rental</h3>

    <form action="{{ route('kasir.update', $rental->rental_id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- JENIS TRANSAKSI --}}
        <div class="mb-3">
            <label>Jenis Transaksi</label>
            <input type="text"
                   class="form-control"
                   value="{{ ucfirst($rental->booking_source) }}"
                   disabled>
        </div>

        {{-- ONLINE / OFFLINE --}}
        @if ($rental->booking_source === 'online')
            <div class="mb-3">
                <label>User</label>
                <input type="text"
                       class="form-control"
                       value="{{ $rental->user->name ?? 'User tidak ditemukan' }}"
                       disabled>
            </div>
        @else
            <div class="mb-3">
                <label>Nama Pelanggan</label>
                <input type="text"
                       name="nama_Pelanggan"
                       class="form-control"
                       value="{{ $rental->nama_Pelanggan }}"
                       required>
            </div>
        @endif

        {{-- MOBIL --}}
        <div class="mb-3">
            <label>Mobil</label>
            <select name="mobil_id" class="form-control" required>
                @foreach ($mobils as $mobil)
                    <option value="{{ $mobil->mobil_id }}"
                        {{ $mobil->mobil_id == $rental->mobil_id ? 'selected' : '' }}
                        {{ $mobil->mobil_status === 'Disewa' && $mobil->mobil_id != $rental->mobil_id ? 'disabled' : '' }}>
                        {{ $mobil->merk->merk_nama ?? '-' }}
                        {{ $mobil->nama_mobil }}
                        | {{ $mobil->mobil_plat }}
                        | {{ $mobil->Transmisi }}
                        | {{ $mobil->mobil_status }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- DURASI --}}
        <div class="mb-3">
            <label>Lama Rental (Hari)</label>
            <input type="number"
                   name="lama_rental"
                   class="form-control"
                   min="1"
                   value="{{ $rental->lama_rental }}"
                   required>
        </div>

        {{-- PILIHAN --}}
        <div class="mb-3">
            <label>Pilihan</label>
            <select name="pilihan" class="form-control" required>
                <option value="lepas kunci"
                    {{ $rental->pilihan === 'lepas kunci' ? 'selected' : '' }}>
                    Lepas Kunci
                </option>
                <option value="dengan driver"
                    {{ $rental->pilihan === 'dengan driver' ? 'selected' : '' }}>
                    Dengan Driver
                </option>
            </select>
        </div>

        {{-- TANGGAL --}}
        <div class="mb-3">
            <label>Tanggal Sewa</label>
            <input type="date"
                   class="form-control"
                   value="{{ $rental->tgl_sewa->format('Y-m-d') }}"
                   disabled>
        </div>

        <div class="mb-3">
            <label>Tanggal Kembali</label>
            <input type="date"
                   name="tgl_kembali"
                   class="form-control"
                   value="{{ $rental->tgl_kembali->format('Y-m-d') }}"
                   required>
        </div>

        {{-- TOTAL --}}
        <div class="mb-3">
            <label>Total Sewa</label>
            <input type="number"
                   name="total_sewa"
                   class="form-control"
                   value="{{ $rental->total_sewa }}"
                   required>
        </div>

        {{-- JAMINAN --}}
        <div class="mb-3">
            <label>Jaminan</label>
            <input type="text"
                   name="jaminan"
                   class="form-control"
                   value="{{ $rental->jaminan }}"
                   required>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('kasir.transaksi') }}"
               class="btn btn-secondary">
                Batal
            </a>
        </div>

    </form>

</div>
@endsection
