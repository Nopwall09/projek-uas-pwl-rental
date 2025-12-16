@extends('layouts.master')
@section('title', 'Laporan Transaksi')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4">Laporan Transaksi Rental</h3>

    {{-- FILTER --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label>Dari Tanggal</label>
                        <input type="date" name="from" class="form-control"
                            value="{{ request('from') }}">
                    </div>
                    <div class="col-md-4">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="to" class="form-control"
                            value="{{ request('to') }}">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary">
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Mobil</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($laporan as $item)
                @php $grandTotal += $item->total_sewa; @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tgl_sewa }}</td>
                    <td>{{ $item->nama_Pelanggan }}</td>
                    <td>
                        {{ $item->mobil->merk->merk_nama ?? '-' }}
                        {{ $item->mobil->nama_mobil ?? '-' }}
                    </td>
                    <td>
                        Rp {{ number_format($item->total_sewa, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
                </tbody>

                <tfoot class="table-light">
                    <tr>
                        <th colspan="4" class="text-end">Total Pendapatan</th>
                        <th>
                            Rp {{ number_format($grandTotal, 0, ',', '.') }}
                        </th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>

</div>
@endsection
