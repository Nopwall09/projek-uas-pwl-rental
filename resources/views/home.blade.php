@include ('layouts.navbar')
<html>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- ================= HERO ================= -->
    <section>
    <div class="hero-img">
            <div class="about-image">
              <img src="Gree.png" alt="Tim HDB Airconds Profesional" />
            </div>
        </div>
    </section>


    <!-- ================= ABOUT 1 ================= -->
    <section style="background:#a8c7dd;">
        <div class="about-container">
            <div class="about-text">
                <p>About Us</p>
                <h2>Rental Mobil</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Praesent nibh elit, tristique sit amet egestas quis, lobortis 
                    a enim. Nullam lacus tortor, fermentum a posuere non, congue 
                    a ex. Faser fringilla libero sed fermentum placerat.
                </p>
            </div>

            <div class="about-img" style="height:170px;background:#d9d9d9;border-radius:15px;"></div>
        </div>
    </section>


    <!-- ================= ABOUT 2 (mirroring kiri-kanan) ================= -->
    <section>
        <div class="about-container">

            <div class="about-img" style="height:200px;background:#d9d9d9;border-radius:20px;"></div>

            <div class="about-text">
                <p>About Us</p>
                <h2>Rental Mobil</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Praesent nibh elit, tristique sit amet egestas quis, lobortis 
                    a enim. Nullam lacus tortor, fermentum a posuere non, congue 
                    a ex. Vestibulum ut felis.
                </p>
            </div>
        </div>
    </section>


    <!-- ================= PRODUK MOBIL ================= -->
    <section>
        <h2 style="margin-bottom:30px;">Pilihan Unit Tersedia</h2>

        <div class="grid-mobil">

            <!-- Card item → tinggal duplicate -->
            <div class="card">
                <img>
                <h4 style="margin-top:15px;">Brio</h4>
                <button>Booking</button>
            </div>

            <div class="card">
                <img>
                <h4 style="margin-top:15px;">Brio</h4>
                <button>Booking</button>
            </div>

            <div class="card">
                <img>
                <h4 style="margin-top:15px;">Brio</h4>
                <button>Booking</button>
            </div>

            <div class="card">
                <img>
                <h4 style="margin-top:15px;">Brio</h4>
                <button>Booking</button>
            </div>

            <div class="card">
                <img>
                <h4 style="margin-top:15px;">Brio</h4>
                <button>Booking</button>
            </div>

            <div class="card">
                <img>
                <h4 style="margin-top:15px;">Brio</h4>
                <button>Booking</button>
            </div>

        </div>
    </section>


    <!-- ================= CTA ================= -->
    <section>
        <div class="cta">
            <p>Semua unit bersih, wangi, dan siap jalan setiap hari. Klik tombol berikut untuk cek unit kami yang lain!</p>
            <button style="background:#163a63;color:white;padding:12px 28px;border:none;border-radius:25px;">Lihat semua unit</button>
        </div>
    </section>


    <!-- ================= TESTIMONI ================= -->
    <section>
        <div class="testi-wrap">
            <div class="testi-img"></div>
            <div class="testi-text">
                <h2>Testimoni Klien</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Praesent nibh elit, tristique sit amet egestas quis, lobortis 
                    a enim. Nullam lacus tortor, fermentum a posuere non, congue 
                    a ex.
                </p>
            </div>
        </div>
    </section>   
    <script src="script.js"></script>
</body>
</html>