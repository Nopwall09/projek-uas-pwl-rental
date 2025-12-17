<table class="table table-bordered">
    <tr>
        <th width="35%">ID History</th>
        <td>{{ $history->history_id }}</td>
    </tr>
    <tr>
        <th>User</th>
        <td>{{ $history->user->name ?? '-' }}</td>
    </tr>
    <tr>
        <th>Nama Pelanggan</th>
        <td>{{ $history->rentalitem->nama_Pelanggan ?? '-' }}</td>
    </tr>
    <tr>
        <th>Mobil</th>
        <td>{{ $history->rentalitem->mobil->nama_mobil ?? '-' }}</td>
    </tr>
    <tr>
        <th>Tanggal Sewa</th>
        <td>{{ $history->rentalitem->tgl_sewa }}</td>
    </tr>
    <tr>
        <th>Tanggal Kembali</th>
        <td>{{ $history->rentalitem->tgl_kembali }}</td>
    </tr>
    <tr>
        <th>Total Sewa</th>
        <td>Rp {{ number_format($history->rentalitem->total_sewa, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <th>Aksi</th>
        <td>{{ $history->aksi }}</td>
    </tr>
    <tr>
        <th>Waktu</th>
        <td>{{ $history->waktu }}</td>
    </tr>
</table>
