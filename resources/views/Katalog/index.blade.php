@include('layouts.navbar')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Mobil</title>
    <link rel="stylesheet" href="{{ asset('css/katalog.css') }}">
</head>
<body>

{{-- ================= CITY CAR ================= --}}
<div class="section">
    <h2 class="title">City Car</h2>
    <div class="catalog-container">

        @foreach ($cityCars as $mobil)
            <div>
                <h3>{{ $mobil->merk->merk_nama }} {{ $mobil->tipe->tipe_nama ?? '' }}</h3>
                <p>Harga: Rp {{ number_format($mobil->harga_rental,0,',','.') }}</p>
                <a href="{{ route('pesanan.detail', $mobil->mobil_id) }}">Booking</a>
            </div>
        @endforeach


    </div>
</div>


{{-- ================= FAMILY CAR ================= --}}
<div class="section">
    <h2 class="title">Family car</h2>
    <div class="catalog-container">

        @foreach ($cityCars as $mobil)
            <div>
                <h3>{{ $mobil->merk->merk_nama }} {{ $mobil->tipe->tipe_nama ?? '' }}</h3>
                <p>Harga: Rp {{ number_format($mobil->harga_rental,0,',','.') }}</p>
                <a href="{{ route('pesanan.detail', $mobil->mobil_id) }}">Booking</a>
            </div>
        @endforeach

    </div>
</div>


{{-- ================= LUXURY CAR ================= --}}
<div class="section">
    <h2 class="title">Luxury car</h2>
    <div class="catalog-container">

        @foreach ($familyCars as $mobil)
            <div class="card">
                <div class="card-img"
                    style="background-image:url('{{ asset('storage/'.$mobil->mobil_image) }}')">
                </div>

                <p class="car-name">
                    {{ $mobil->merk->merk_nama }}
                    {{ $mobil->tipe->tipe_nama ?? '' }}
                </p>

                <p class="harga">
                    Rp {{ number_format($mobil->harga_rental, 0, ',', '.') }} / hari
                </p>

                <a href="{{ url('/pemesanan/'.$mobil->mobil_id) }}">
                    <button class="btn">Booking</button>
                </a>
            </div>
        @endforeach

    </div>
</div>


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
