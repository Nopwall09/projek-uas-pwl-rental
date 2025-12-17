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
                        <th>Merk</th>
                        <th>Nama Mobil</th>
                        <th>Kelas</th>
                        <th>Transmisi</th>
                        <th>Plat</th>
                        <th>Tahun</th>
                        <th>Warna</th>
                        <th>Status</th>
                        <th>Harga / Hari</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($mobils as $mobil)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            @if($mobil->mobil_image)
                                <img src="{{ asset('storage/mobil/'.$mobil->mobil_image) }}" width="80" class="rounded">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>

                        <td>{{ $mobil->merk->merk_nama ?? '-' }}</td>
                        <td>{{ $mobil->nama_mobil }}</td>
                        <td>{{ $mobil->carclass->class_nama ?? '-' }}</td>
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
                        <td>Rp {{ number_format($mobil->harga_rental, 0, ',', '.') }}</td>

                        <td>
                            <button type="button" class="btn btn-info btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#detailMobilModal{{ $mobil->mobil_id }}">
                                Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13" class="text-center text-muted">
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
@foreach($mobils as $mobil)
<div class="modal fade" id="detailMobilModal{{ $mobil->mobil_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $mobil->nama_mobil }} - Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($mobil->mobil_image)
                            <img src="{{ asset('storage/mobil/'.$mobil->mobil_image) }}" class="img-fluid rounded">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <p><strong>Merk:</strong> {{ $mobil->merk->merk_nama ?? '-' }}</p>
                        <p><strong>Kelas:</strong> {{ $mobil->carclass->class_nama ?? '-' }}</p>
                        <p><strong>Transmisi:</strong> {{ $mobil->Transmisi }}</p>
                        <p><strong>Plat:</strong> {{ $mobil->mobil_plat }}</p>
                        <p><strong>Tahun:</strong> {{ $mobil->mobil_tahun }}</p>
                        <p><strong>Warna:</strong> {{ $mobil->mobil_warna }}</p>
                        <p><strong>Status:</strong>
                            @if($mobil->mobil_status == 'Tersedia')
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Disewa</span>
                            @endif
                        </p>
                        <p><strong>Harga / Hari:</strong> Rp {{ number_format($mobil->harga_rental, 0, ',', '.') }}</p>
                        <p><strong>Fasilitas:</strong>
                            @if(!empty($mobil->fasilitas) && is_array($mobil->fasilitas))
                                <ul class="mb-0">
                                    @foreach($mobil->fasilitas as $f)
                                        <li>{{ $f['nama'] ?? '-' }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">Tidak ada fasilitas</span>
                            @endif
                        </p>


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
