@extends('layouts.master')
@section('title', 'Data Mobil')

@section('content')
<div class="container-fluid">

    <h1 class="mb-4">Data Mobil</h1>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nama Mobil</th>
                        <th>Merk</th>
                        <th>Kelas</th>
                        <th>Tipe</th>
                        <th>Transmisi</th>
                        <th>Plat</th>
                        <th>Tahun</th>
                        <th>Warna</th>
                        <th>Status</th>
                        <th>Harga / Hari</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($mobils as $mobil)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            @if($mobil->mobil_image)
                                <img src="{{ asset('storage/'.$mobil->mobil_image) }}"
                                     width="80" class="rounded">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>

                        <td>{{ $mobil->nama_mobil }}</td>
                        <td>{{ $mobil->merk->nama_merk ?? '-' }}</td>
                        <td>{{ $mobil->carclass->nama_class ?? '-' }}</td>
                        <td>{{ $mobil->tipe->nama_tipe ?? '-' }}</td>
                        <td>{{ $mobil->Transmisi }}</td>
                        <td>{{ $mobil->mobil_plat }}</td>
                        <td>{{ $mobil->mobil_tahun }}</td>
                        <td>{{ $mobil->mobil_warna }}</td>

                        <td>
                            @if($mobil->mobil_status == 'Tersedia')
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Disewa</span>
                            @endif
                        </td>

                        <td>
                            Rp {{ number_format($mobil->harga_rental, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center text-muted">
                            Data mobil belum tersedia
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $mobils->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
