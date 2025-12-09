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
            <li><a href="">LOGIN</a></li>
        </ul>
    </nav>
</header>
