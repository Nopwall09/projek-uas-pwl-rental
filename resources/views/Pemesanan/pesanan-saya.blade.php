@include('layouts.navbar')

<link rel="stylesheet" href="{{ asset('css/receipt.css') }}">

<div class="receipt-wrapper">

    <h2>Pesanan Saya</h2>

    @forelse ($rentals as $rental)
    <div class="receipt-card">

        <div class="receipt-header">
            <h3>STRUK PEMESANAN</h3>
            <span>#INV-{{ $rental->id }}</span>
        </div>

        <div class="receipt-body">

            <div class="row">
                <span>Nama Pemesan</span>
                <b>{{ auth()->user()->nama }}</b>
            </div>

            <div class="row">
                <span>Mobil</span>
                <b>
                    {{ $rental->mobil->merk->merk_nama }}
                    {{ $rental->mobil->tipe->tipe_nama }}
                </b>
            </div>

            <div class="row">
                <span>Kelas Mobil</span>
                <b>{{ $rental->mobil->carclass->class_nama ?? '-' }}</b>
            </div>

            <div class="row">
                <span>Tanggal Sewa</span>
                <b>{{ \Carbon\Carbon::parse($rental->tgl)->format('d M Y') }}</b>
            </div>

            <div class="row">
                <span>Lama Sewa</span>
                <b>{{ $rental->lama_rental }} Hari</b>
            </div>

            <div class="row">
                <span>Opsi</span>
                <b>{{ $rental->pilihan }}</b>
            </div>

            <div class="row">
                <span>Metode Pembayaran</span>
                <b>{{ $rental->jaminan }}</b>
            </div>

            <hr>

            <div class="row total">
                <span>Total Bayar</span>
                <b>Rp {{ number_format($rental->total_sewa,0,',','.') }}</b>
            </div>

        </div>

        <div class="receipt-footer">
            <span>Status Mobil:</span>
            <b class="{{ $rental->mobil->mobil_status == 'Disewa' ? 'badge-red' : 'badge-green' }}">
                {{ $rental->mobil->mobil_status }}
            </b>

            <button onclick="window.print()">Cetak</button>
        </div>

    </div>
    @empty
        <p class="empty">Belum ada pesanan.</p>
    @endforelse

</div>
