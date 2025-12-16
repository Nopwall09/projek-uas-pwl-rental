<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="d-flex">
    <div class="bg-dark text-white vh-100 p-3" style="width: 250px;">
        <h4 class="mb-4">Rental Mobil</h4>

        <ul class="nav nav-pills flex-column gap-1">

            <li class="nav-item">
                <a href="{{ route('kasir.dashboard') }}" class="nav-link text-white">
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                {{-- LIST TRANSAKSI --}}
                <a href="{{ route('kasir.index') }}" class="nav-link text-white">
                    Transaksi
                </a>
            </li>

            <li class="nav-item">
                {{-- BELUM ADA ROUTE MOBIL UNTUK KASIR --}}
                <a href="{{ route('kasir.update') }}" class="nav-link text-white disabled">
                    Mobil
                </a>
            </li>

            <li class="nav-item">
                {{-- BELUM ADA ROUTE LAPORAN --}}
                <a href="#" class="nav-link text-white disabled">
                    Laporan
                </a>
            </li>

        </ul>


        <hr class="border-secondary">

        <form action="{{ route('logout') }}" method="POST" class="mt-2">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100">
                Logout
            </button>
        </form>

    </div>
</div>
