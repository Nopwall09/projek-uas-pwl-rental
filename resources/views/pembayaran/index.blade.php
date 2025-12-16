@include('layouts.navbar')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>
    <style>
        .box {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 15px;
            max-width: 600px;
            margin: auto;
        }
        .rekening {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border: 1px solid #ddd;
        }
        button {
            background: #163a63;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
        }
    </style>
</head>
<body>

@php
    // Dummy data supaya halaman bisa ditampilkan tanpa database
    $rental = (object)[
        'id' => 1,
        'total_sewa' => 100000,
        'mobil' => (object)[
            'merk' => (object)['merk_nama' => 'Toyota'],
            'tipe' => (object)['tipe_nama' => 'Avanza']
        ]
    ];
@endphp

<section style="padding:60px 8%;">
    <div class="box">

        <h2>Pembayaran Transfer</h2>

        <p>
            Silakan transfer sejumlah:
            <strong>
                Rp {{ number_format($rental->total_sewa,0,',','.') }}
            </strong>
        </p>

        <div class="rekening">
            <p><strong>Bank</strong> : BCA</p>
            <p><strong>No Rekening</strong> : 1234567890</p>
            <p><strong>Atas Nama</strong> : PT Rental Mobil</p>
        </div>

        <p>
            <strong>Mobil:</strong>
            {{ $rental->mobil->merk->merk_nama }}
            {{ $rental->mobil->tipe->tipe_nama }}
        </p>

        <form action="#" method="POST">
            @csrf

            <label>
                <input type="checkbox" name="konfirmasi" required>
                Saya sudah melakukan transfer
            </label>

            <br><br>

            <button type="submit">
                Lanjutkan Pesanan
            </button>
        </form>

    </div>
</section>

</body>
</html>
