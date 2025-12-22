@include('layouts.navbar')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Mobil</title>
    <link rel="stylesheet" href="{{ asset('css/katalog.css') }}">
</head>
<body>

@foreach ($classes as $class)
    @if ($class->mobils->count())
        <div class="section">
            <h2 class="title">{{ $class->class_nama }}</h2>

            <div class="catalog-container">
                @foreach ($class->mobils as $mobil)
                    <div class="card">

                        {{-- GAMBAR --}}
                        <div class="card-img"
                            style="background-image: url('{{ asset('storage/mobil/'.$mobil->mobil_image) }}')">
                        </div>

                        {{-- NAMA --}}
                        <p class="car-name">
                            {{ $mobil->merk->merk_nama }}
                            {{ $mobil->nama_mobil }}
                        </p>

                        {{-- HARGA --}}
                        <p class="harga">
                            Rp {{ number_format($mobil->harga_rental, 0, ',', '.') }} / hari
                        </p>

                        {{-- BUTTON --}}
                       <a href="{{ route('pesanan.create', $mobil->mobil_id) }}">
                            <button class="btn">Booking</button>
                        </a>

                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endforeach

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
