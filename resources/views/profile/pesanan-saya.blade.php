@include('layouts.navbar')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Saya</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>

<div class="wrapper">

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="sidebar-item">
            <a href="{{ route('profile') }}">Akun Saya</a>
        </div>

        <div class="sidebar-item active">
            <a href="{{ route('pesanan-saya') }}">Pesanan Saya</a>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content">
        <h2>Pesanan Saya</h2>

        @forelse($pesanan as $item)
            <div class="profile-box">

                <div class="row">
                    <span class="label">Mobil</span>
                    <span class="value">
                        {{ $item->mobil->merk->merk_nama }} {{ $item->mobil->nama_mobil }}
                    </span>
                </div>

                <div class="row">
                    <span class="label">Tanggal</span>
                    <span class="value">
                        {{ $item->tgl_sewa }} s/d {{ $item->tgl_kembali }}
                    </span>
                </div>

                <div class="row">
                    <span class="label">Total</span>
                    <span class="value">
                        Rp {{ number_format($item->total_sewa,0,',','.') }}
                    </span>
                </div>

                <div class="row">
                    <span class="label">Metode Pembayaran</span>
                    <span class="value">{{ $item->jaminan }}</span>
                </div>

                <div class="row">
                    <span class="label">Status</span>
                    <span class="value">
                        @if($item->jaminan === 'Transfer' && $item->status === 'pending')
                            Menunggu Konfirmasi
                        @elseif($item->jaminan === 'Tunai')
                            Belum Dibayar
                        @else
                            Lunas
                        @endif
                    </span>
                </div>

                {{-- BUTTON INVOICE --}}
                @if(
                    ($item->jaminan === 'Tunai') ||
                    ($item->jaminan === 'Transfer' && $item->status === 'lunas')
                )
                    <a href="{{ route('pesanan.invoice', $item->rental_id) }}"
                    class="btn-edit"
                    target="_blank">
                        Cetak Invoice
                    </a>
                @endif

                {{-- ✅ FORM RATING MOBIL --}}
                @if($item->status === 'selesai' && !$item->mobil->feedback)

                    <hr>

                    <form action="{{ route('mobil.rating', $item->mobil->mobil_id) }}" method="POST">
                        @csrf

                        <label><b>Rating Mobil</b></label>

                        <select name="rating" required>
                            <option value="">-- Pilih Rating --</option>
                            <option value="1">⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="5">⭐⭐⭐⭐⭐</option>
                        </select>

                        <textarea name="komentar"
                            placeholder="Komentar (opsional)"
                            style="width:100%;margin-top:8px"></textarea>

                        <button type="submit" class="btn-edit" style="margin-top:10px">
                            Kirim Rating
                        </button>
                    </form>

                @endif

            </div>
        @empty
            <p>Tidak ada pesanan.</p>
        @endforelse


    </div>
</div>

</body>
</html>
