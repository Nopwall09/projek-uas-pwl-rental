<!DOCTYPE html>
<html>
<head>
    <title>Struk Rental</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 300px;
            margin: auto;
        }
        h3 {
            text-align: center;
            margin-bottom: 5px;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        table {
            width: 100%;
            font-size: 14px;
        }
        td {
            padding: 3px 0;
        }
        .right {
            text-align: right;
        }
    </style>
</head>
<body onload="window.print()">

<h3>STRUK RENTAL MOBIL</h3>
<p style="text-align:center;">{{ now()->format('d/m/Y H:i') }}</p>

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
        <td>Tgl Sewa</td>
        <td class="right">{{ $rental->tgl_sewa }}</td>
    </tr>
    <tr>
        <td>Tgl Kembali</td>
        <td class="right">{{ $rental->tgl_kembali }}</td>
    </tr>
    <tr>
        <td>Driver</td>
        <td class="right">{{ ucfirst($rental->pilihan) }}</td>
    </tr>
</table>

<div class="line"></div>

<table>
    <tr>
        <td><strong>Total</strong></td>
        <td class="right">
            <strong>
                Rp {{ number_format($rental->total_sewa, 0, ',', '.') }}
            </strong>
        </td>
    </tr>
</table>

<div class="line"></div>

<p style="text-align:center;">
    Terima kasih 🙏<br>
    Selamat jalan
</p>

</body>
</html>
