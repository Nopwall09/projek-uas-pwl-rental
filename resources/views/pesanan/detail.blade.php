@include('layouts.navbar')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Mobil</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<section style="padding:60px 8%;">
    <div style="display:flex;gap:40px;flex-wrap:wrap;">

        <!-- GAMBAR MOBIL -->
        <div style="flex:1;min-width:300px;">
            <img 
                src="{{ asset('storage/'.$mobil->mobil_image) }}" 
                alt="{{ $mobil->merk->merk_nama }}"
                style="width:100%;border-radius:20px;"
            >
        </div>

        <!-- DETAIL MOBIL -->
        <div style="flex:1;min-width:300px;">
            <h1>
                {{ $mobil->merk->merk_nama }}
                {{ $mobil->tipe->tipe_nama ?? '' }}
            </h1>

            <p style="font-size:18px;margin:10px 0;">
                <strong>Kelas:</strong> {{ $mobil->carclass->class_nama ?? '-' }}
            </p>

            <p style="font-size:18px;">
                <strong>Transmisi:</strong> {{ $mobil->Transmisi }}
            </p>

            <p style="font-size:18px;">
                <strong>Warna:</strong> {{ $mobil->mobil_warna }}
            </p>

            <p style="font-size:18px;">
                <strong>Tahun:</strong> {{ $mobil->mobil_tahun }}
            </p>

            <p style="font-size:20px;margin:15px 0;">
                <strong>Harga:</strong> 
                Rp {{ number_format($mobil->harga_rental, 0, ',', '.') }} / hari
            </p>

            <!-- STATUS -->
            @if ($mobil->mobil_status === 'Tersedia')
                <span style="color:green;font-weight:bold;">● Tersedia</span>
            @else
                <span style="color:red;font-weight:bold;">● Sedang Disewa</span>
            @endif

            <hr style="margin:20px 0;">

            <!-- BUTTON BOOKING -->
            @if ($mobil->mobil_status === 'Tersedia')
                <form action="{{ route('pemesanan.konfirmasi') }}" method="POST">
                    @csrf

                    <input type="hidden" name="mobil_id" value="{{ $mobil->mobil_id }}">

                    <button type="submit" style="
                        background:#163a63;
                        color:white;
                        padding:12px 30px;
                        border:none;
                        border-radius:25px;
                        font-size:16px;
                        cursor:pointer;
                    ">
                        Booking Sekarang
                    </button>
                </form>

            @else
                <button disabled style="
                    background:#ccc;
                    color:#666;
                    padding:12px 30px;
                    border:none;
                    border-radius:25px;
                ">
                    Tidak Tersedia
                </button>
            @endif
        </div>
    </div>
</section>

<!-- FASILITAS -->
@if ($mobil->fasilitas->count())
<section style="padding:0 8% 60px;">
    <h2>Fasilitas</h2>
    <ul>
        @foreach ($mobil->fasilitas as $f)
            <li>{{ $f->fasilitas_nama }}</li>
        @endforeach
    </ul>
</section>
@endif

<!-- FEEDBACK -->
@if ($mobil->feedback)
<section style="padding:0 8% 60px;">
    <h2>Ulasan</h2>
    <p>{{ $mobil->feedback->komentar }}</p>
</section>
@endif

</body>
</html>
