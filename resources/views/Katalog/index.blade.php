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

        <div class="card"><div class="card-img"></div><p class="car-name">Honda Brio</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Toyota Agya</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Suzuki Ignis</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Daihatsu Ayla</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Honda Jazz</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Toyota Yaris</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Mazda 2</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Mini Cooper</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Volkswagen Polo</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Honda City Hatchback</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>

    </div>
</div>

{{-- ================= FAMILY CAR ================= --}}
<div class="section">
    <h2 class="title">Family Car</h2>
    <div class="catalog-container">

        <div class="card"><div class="card-img"></div><p class="car-name">Avanza</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Xenia</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Ertiga</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Xpander</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Mobilio</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Livina</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Confero</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Veloz</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">BR-V</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Rush</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>

    </div>
</div>

{{-- ================= LUXURY CAR ================= --}}
<div class="section">
    <h2 class="title">Luxury Car</h2>
    <div class="catalog-container">

        <div class="card"><div class="card-img"></div><p class="car-name">Alphard</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Vellfire</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Camry</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Pajero Sport</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Fortuner</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">BMW X1</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Mercedes C-Class</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Range Rover Evoque</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Lexus ES300h</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>
        <div class="card"><div class="card-img"></div><p class="car-name">Tesla Model 3</p><a href="/pemesanan"><button class="btn">Booking</button></a></div>

    </div>
</div>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
