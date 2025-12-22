<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menunggu Pembayaran</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg border-0" style="max-width: 420px; width: 100%;">
        <div class="card-body text-center p-4">

            <h3 class="mb-3 text-warning fw-bold">
                ⏳ Menunggu Pembayaran
            </h3>

            <p class="text-muted mb-4">
                Silakan scan QRIS di bawah untuk menyelesaikan pembayaran
            </p>

            <div class="mb-4">
                <img src="{{ asset('img/qris.png') }}"
                     alt="QRIS"
                     class="img-fluid"
                     style="max-width: 250px;">
            </div>

            <span class="badge bg-warning text-dark px-3 py-2">
                STATUS: PENDING
            </span>

            <p class="text-muted mt-3">
                Pesanan akan <b>aktif</b> setelah pembayaran dikonfirmasi oleh kasir.
            </p>

            <hr>

            <div class="d-grid gap-2">
                <div class="d-grid gap-2">
                    <a href="{{ route('pesanan.invoice', $rental->rental_id) }}"
                    class="btn btn-primary">
                        📄 Lihat Invoice
                    </a>

                    <a href="{{ route('home') }}"
                    class="btn btn-outline-dark">
                        🏠 Kembali ke Halaman Utama
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>
