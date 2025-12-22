<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pemesanan</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        body {
            background: #f4f6f9;
            color: #333;
        }

        .confirmation-wrapper {
            display: flex;
            justify-content: center;
            padding: 40px 15px;
        }

        .confirmation-card {
            background: #fff;
            max-width: 900px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .confirmation-image img {
            width: 100%;
            border-radius: 10px;
            object-fit: cover;
        }

        .confirmation-info h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .price {
            font-size: 20px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 10px;
        }

        .specs {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            margin-top: 12px;
            margin-bottom: 5px;
            font-size: 14px;
        }

        input, select {
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #2563eb;
        }

        .note {
            font-size: 12px;
            color: #dc2626;
            margin-top: 5px;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            background: #2563eb;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: .3s;
        }

        button:hover {
            background: #1e40af;
        }

        .total-box {
            margin-top: 15px;
            padding: 12px;
            background: #f1f5f9;
            border-radius: 8px;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .confirmation-card {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

@include('layouts.navbar')

<section class="confirmation-wrapper">
    <div class="confirmation-card">

        {{-- IMAGE --}}
        <div class="confirmation-image">
            <img src="{{ asset('storage/mobil/'.$mobil->mobil_image) }}">
        </div>

        {{-- INFO --}}
        <div class="confirmation-info">
            <h1>{{ $mobil->merk->merk_nama }} {{ $mobil->nama_mobil }}</h1>

            <div class="price">
                Rp {{ number_format($mobil->harga_rental,0,',','.') }} / hari
            </div>

            <div class="specs">
                Transmisi : {{ $mobil->Transmisi }} <br>
                Warna : {{ $mobil->mobil_warna }}
            </div>

            {{-- ERROR --}}
            @if ($errors->any())
                <ul style="color:red;margin-bottom:10px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form action="{{ route('pesanan.store') }}" method="POST">
                @csrf

                <label>Tanggal Mulai</label>
                <input type="date" id="tgl_sewa" name="tgl_sewa" required>

                <label>Tanggal Kembali</label>
                <input type="date" id="tgl_kembali" name="tgl_kembali" required>

                <label>Lama Sewa (hari)</label>
                <input type="number" id="lama_rental" name="lama_rental" readonly>

                <label>Opsi Sewa</label>
                <select id="driver_option" name="driver_option" required>
                    <option value="">-- Pilih --</option>
                    <option value="without">Tanpa Driver</option>
                    <option value="with">Dengan Driver</option>
                </select>

                <div id="driver-wrapper" style="display:none">
                    <label>Pilih Driver</label>
                    <select name="driver_id" id="driver_id">
                        <option value="">-- Pilih Driver --</option>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->driver_id }}"
                                data-biaya="{{ $driver->biaya_driver }}">
                                {{ $driver->driver_nama }} - Rp {{ number_format($driver->biaya_driver,0,',','.') }}/hari
                            </option>
                        @endforeach
                    </select>

                    <div class="note">
                        * Biaya driver berbeda tiap driver
                    </div>
                </div>

                <label>Jaminan</label>
                <select name="jaminan" required>
                    <option value="">-- Pilih --</option>
                    <option value="KTP">KTP</option>
                    <option value="SIM">SIM</option>
                </select>

                <label>Metode Pembayaran</label>
                <select name="metode_pembayaran" required>
                    <option value="">-- Pilih --</option>
                    <option value="Tunai">Tunai</option>
                    <option value="Transfer">Transfer</option>
                </select>

                <div class="total-box">
                    Total: <span id="total_view">Rp 0</span>
                </div>

                <input type="hidden" name="mobil_id" value="{{ $mobil->mobil_id }}">
                <input type="hidden" name="total_sewa" id="total_sewa">

                <button type="submit">Konfirmasi & Pesan</button>
            </form>
        </div>
    </div>
</section>

<script>
const hargaMobil = {{ $mobil->harga_rental }};
const tglSewa = document.getElementById('tgl_sewa');
const tglKembali = document.getElementById('tgl_kembali');
const lamaRental = document.getElementById('lama_rental');
const driverOption = document.getElementById('driver_option');
const driverWrapper = document.getElementById('driver-wrapper');
const driverSelect = document.getElementById('driver_id');
const totalView = document.getElementById('total_view');
const totalInput = document.getElementById('total_sewa');

function hitungTotal() {
    if (!tglSewa.value || !tglKembali.value) return;

    const start = new Date(tglSewa.value);
    const end = new Date(tglKembali.value);
    let days = Math.ceil((end - start) / (1000*60*60*24));
    days = days < 1 ? 1 : days;

    lamaRental.value = days;

    let total = days * hargaMobil;

    if (driverOption.value === 'with') {
        const biayaDriver = driverSelect.selectedOptions[0]?.dataset.biaya || 0;
        total += days * parseInt(biayaDriver);
    }

    totalView.innerText = 'Rp ' + total.toLocaleString('id-ID');
    totalInput.value = total;
}

tglSewa.addEventListener('change', hitungTotal);
tglKembali.addEventListener('change', hitungTotal);
driverSelect.addEventListener('change', hitungTotal);

driverOption.addEventListener('change', function () {
    driverWrapper.style.display = this.value === 'with' ? 'block' : 'none';
    hitungTotal();
});
</script>

</body>
</html>
