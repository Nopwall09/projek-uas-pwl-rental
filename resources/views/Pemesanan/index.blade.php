@include('layouts.navbar')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pemesanan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<section style="padding:60px 8%;">
    <h1>Konfirmasi Pemesanan</h1>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div style="background:#fdd;padding:15px;border-radius:10px;margin-bottom:20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pesanan.store') }}" method="POST">
        @csrf

        <!-- INFO MOBIL -->
        <div style="display:flex;gap:40px;flex-wrap:wrap;margin-bottom:30px;">
            <img 
                src="{{ asset('storage/'.$mobil->mobil_image) }}" 
                style="width:320px;border-radius:15px;"
            >

            <div>
                <h2>
                    {{ $mobil->merk->merk_nama }} 
                    {{ $mobil->tipe->tipe_nama ?? '' }}
                </h2>

                <p>Harga / hari :
                    <strong>
                        Rp {{ number_format($mobil->harga_rental,0,',','.') }}
                    </strong>
                </p>

                <p>Transmisi : {{ $mobil->Transmisi }}</p>
                <p>Warna : {{ $mobil->mobil_warna }}</p>
            </div>
        </div>

        <!-- INPUT SEWA -->
        <div style="max-width:400px;">
            <label>Lama Sewa (hari)</label>
            <input type="number" name="lama_rental" min="1" required>

            <label>Tanggal Mulai</label>
            <input type="date" name="tgl" required>

            <label>Opsi Sewa</label>
            <select name="pilihan" required>
                <option value="">-- Pilih --</option>
                <option value="Dengan Driver">Dengan Driver</option>
                <option value="Tanpa Driver">Tanpa Driver</option>
            </select>

            <label>Metode Pembayaran</label>
            <select name="jaminan" required>
                <option value="">-- Pilih --</option>
                <option value="Transfer BCA">Transfer BCA</option>
                <option value="Tunai">Tunai</option>
            </select>
        </div>

        <!-- DATA TERSEMBUNYI -->
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <input type="hidden" name="mobil_id" value="{{ $mobil->mobil_id }}">
        <input type="hidden" name="booking_source" value="online">

        <!-- TOTAL -->
        <input type="hidden" name="total_sewa" 
            value="{{ $mobil->harga_rental }}">

        <br><br>

        <button type="submit" style="
            background:#163a63;
            color:white;
            padding:12px 40px;
            border:none;
            border-radius:25px;
            font-size:16px;
            cursor:pointer;
        ">
            Konfirmasi & Pesan
        </button>
    </form>
</section>

</body>
</html>
