<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .invoice {
            max-width: 700px;
            margin: 40px auto;
            border: 1px solid #ccc;
            padding: 30px;
            background: #fff;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .row {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 15px;
        }

        hr {
            margin: 20px 0;
        }

        .btn-print {
            margin-top: 25px;
            padding: 10px 20px;
            background: #163a63;
            color: white;
            border: none;
            cursor: pointer;
        }

        .status {
            font-weight: bold;
        }
        .btn-home {
            margin-top: 10px;
            padding: 10px 20px;
            background: #6b7280; /* abu-abu */
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

    </style>
</head>
<body>

<div class="invoice">
    <h2>INVOICE RENTAL MOBIL</h2>

    <div class="row">
        <span class="label">Nama Pelanggan:</span>
        {{ $rental->user->name }}
    </div>

    <div class="row">
        <span class="label">Mobil:</span>
        {{ $rental->mobil->merk->merk_nama }} {{ $rental->mobil->nama_mobil }}
    </div>

    <div class="row">
        <span class="label">Tanggal Sewa:</span>
        {{ $rental->tgl_sewa }}
    </div>

    <div class="row">
        <span class="label">Tanggal Kembali:</span>
        {{ $rental->tgl_kembali }}
    </div>

    <div class="row">
        <span class="label">Lama Sewa:</span>
        {{ $rental->lama_rental }} hari
    </div>

    @if($rental->driver)
        <div class="row">
            <span class="label">Driver:</span>
            {{ $rental->driver->driver_nama }}
        </div>
    @else
        <div class="row">
            <span class="label">Driver:</span>
            Tanpa Driver
        </div>
    @endif

    <hr>

    <div class="row total">
        Total Bayar:
        Rp {{ number_format($rental->total_sewa, 0, ',', '.') }}
    </div>

    <div class="row">
        <span class="label">Metode Pembayaran:</span>
        {{ strtoupper($rental->metode_bayar) }}
    </div>

    <div class="row status">
        Status Pembayaran:
        @if($rental->metode_bayar === 'Tunai' && $rental->status === 'pending')
            BELUM DIBAYAR
        @elseif($rental->status === 'pending')
            MENUNGGU KONFIRMASI
        @else
            LUNAS
        @endif
    </div>

    <button class="btn-print" onclick="window.print()">Cetak Invoice</button>

    <a href="{{ route('home') }}" class="btn-home">
        Kembali ke Home
    </a>

</div>

</body>
</html>
