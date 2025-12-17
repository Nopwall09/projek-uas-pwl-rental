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
                        <th>ID History</th>
                        <th>User</th>
                        <th>Mobil</th>
                        <th>Aksi</th>
                        <th>Waktu</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($history as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge bg-secondary">
                                {{ $item->history_id }}
                            </span>
                        </td>
                        <td>{{ $item->user->name ?? '-' }}</td>
                        <td>{{ $item->rentalitem->mobil->nama_mobil ?? '-' }}</td>
                        <td>{{ $item->aksi }}</td>
                        <td>{{ $item->waktu }}</td>
                        <td class="text-center">
                            <button
                                class="btn btn-sm btn-info btn-detail"
                                data-id="{{ $item->history_id }}">
                                Detail
                            </button>
                        </td>

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
<!-- Modal Detail History -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detail History Rental</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="modal-body">
                <div class="text-center text-muted">
                    Memuat data...
                </div>
            </div>

        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', function () {

            let historyId = this.getAttribute('data-id');
            let modalEl = document.getElementById('detailModal');
            let modal = new bootstrap.Modal(modalEl);

            // loading
            document.getElementById('modal-body').innerHTML =
                '<div class="text-center text-muted">Memuat data...</div>';

            fetch(`/kasir/history/${historyId}/modal`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modal-body').innerHTML = html;
                    modal.show();
                })
                .catch(err => {
                    document.getElementById('modal-body').innerHTML =
                        '<div class="text-danger text-center">Gagal memuat data</div>';
                });

        });
    });

});
</script>

@endsection
