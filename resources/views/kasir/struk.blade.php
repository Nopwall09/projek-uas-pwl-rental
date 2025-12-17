<!DOCTYPE html>
<html>
<head>
    <title>Struk Rental</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 320px;
            margin: auto;
            padding: 5px;
            font-size: 12px;
        }
        h2, h3 {
            text-align: center;
            margin: 0;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        td {
            padding: 2px 0;
        }
        .right {
            text-align: right;
        }
        .center {
            text-align: center;
        }
        .total {
            font-weight: bold;
            font-size: 14px;
        }
        .small {
            font-size: 10px;
        }
    </style>
</head>
<body onload="window.print()">

<h2>🚗 RENTAL MOBIL</h2>
<h3>STRUK TRANSAKSI</h3>
<p class="center small">{{ now()->format('d/m/Y H:i') }}</p>

<div class="line"></div>

<table>
    <tr>
        <td>Pelanggan</td>
        <td class="right">{{ $rental->nama_Pelanggan }}</td>
    </tr>
    <tr>
        <td>Mobil</td>
        <td class="right">
            {{ $rental->mobil->merk->merk_nama ?? '-' }}
            {{ $rental->mobil->nama_mobil ?? '-' }}
        </td>
    </tr>
    <tr>
        <td>Transmisi</td>
        <td class="right">{{ $rental->mobil->Transmisi ?? '-' }}</td>
    </tr>
    <tr>
        <td>Warna</td>
        <td class="right">{{ $rental->mobil->mobil_warna ?? '-' }}</td>
    </tr>
    <tr>
        <td>Tgl Sewa</td>
        <td class="right">{{ $rental->tgl_sewa }}</td>
    </tr>
    <tr>
        <td>Tgl Kembali</td>
        <td class="right">{{ $rental->tgl_kembali }}</td>
    </tr>
    <tr>
        <td>Driver</td>
        <td class="right">{{ $rental->driver->driver_nama ?? '-' }}</td>
    </tr>
</table>

<div class="line"></div>

<table>
    <tr>
        <td class="total">Total</td>
        <td class="right total">
            Rp {{ number_format($rental->total_sewa, 0, ',', '.') }}
        </td>
    </tr>
</table>

<div class="line"></div>

<p class="center">
    Terima kasih 🙏<br>
    Selamat jalan
</p>

</body>
</html>
