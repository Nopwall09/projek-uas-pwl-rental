@extends('layouts.master')
@section('title', 'Daftar Mobil')

@section('content')
<div class="container">
    <h3 class="mb-4">Daftar Mobil</h3>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Gambar</th>
                <th>Plat</th>
                <th>Merk</th>
                <th>Class</th>
                <th>Tipe</th>
                <th>Warna</th>
                <th>Transmisi</th>
                <th>Status</th>
                <th>Tahun</th>
                <th>Harga Sewa</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mobils as $mobil)
            <tr>
                <td>
                    @if($mobil->mobil_image)
                        <img src="{{ asset('img/'.$mobil->mobil_image) }}" alt="Gambar Mobil" width="80">
                    @else
                        <span>-</span>
                    @endif
                </td>
                <td>{{ $mobil->mobil_plat }}</td>
                <td>{{ $mobil->merk->nama_merk ?? '-' }}</td>
                <td>{{ $mobil->class->nama_class ?? '-' }}</td>
                <td>{{ $mobil->tipe->nama_tipe ?? '-' }}</td>
                <td>{{ $mobil->mobil_warna }}</td>
                <td>{{ $mobil->Transmisi }}</td>
                <td>{{ $mobil->mobil_status }}</td>
                <td>{{ $mobil->mobil_tahun }}</td>
                <td>Rp {{ number_format($mobil->harga_rental, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center">Belum ada data mobil</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $mobils->links() }}
    </div>
</div>
@endsection
