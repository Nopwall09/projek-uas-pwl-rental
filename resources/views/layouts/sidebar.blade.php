<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div class="d-flex">
    <div class="bg-dark text-white vh-100 p-3" style="width: 250px;">
        <h4 class="mb-4">🚗 Rental Mobil</h4>

        <ul class="nav nav-pills flex-column gap-1">

            <li class="nav-item">
                <a href="{{ route('kasir.dashboard') }}"
                   class="nav-link text-white {{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('kasir.create') }}"
                   class="nav-link text-white {{ request()->routeIs('kasir.create') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle me-2"></i>
                    Transaksi Baru
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('kasir.transaksi') }}"
                   class="nav-link text-white {{ request()->routeIs('kasir.transaksi') ? 'active' : '' }}">
                    <i class="bi bi-list-check me-2"></i>
                    Data Transaksi
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('kasir.laporan') }}"
                   class="nav-link text-white {{ request()->routeIs('kasir.laporan') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Laporan
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('kasir.mobil') }}"
                   class="nav-link text-white {{ request()->routeIs('kasir.mobil') ? 'active' : '' }}">
                    <i class="bi bi-car-front-fill me-2"></i>
                    Data Mobil
                </a>
            </li>

        </ul>

        <hr class="border-secondary">

        <form action="{{ route('logout') }}" method="POST" class="mt-2">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
            </button>
        </form>

    </div>
</div>
