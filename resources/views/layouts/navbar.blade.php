<header>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
        </div>

        <div class="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <ul class="nav-menu" id="menu">
            <li><a href="{{ url('/home') }}">HOME</a></li>
            <li><a href="{{ url('/katalog') }}">KATALOG MOBIL</a></li>
            <li><a href="https://wa.me/6282333318107">KONTAK</a></li>

            @guest
                <li><a href="{{ route('login') }}">LOGIN</a></li>
            @endguest

            @auth
                <li class="nav-dropdown">
                    <a href="#" class="nav-trigger">
                        {{ Auth::user()->name }}
                        <span class="arrow">▾</span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="{{ route('open.profile') }}">Profil Saya</a></li>
                        <li><a href="{{ url('/pesanan-saya') }}">Pesanan Saya</a></li>
                        <li class="divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="logout-btn">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endauth

        </ul>
    </nav>
</header>