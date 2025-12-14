@include ('layouts.navbar')
<html>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- ================= HERO ================= -->
    <section class="hero-section"> 
    <img src="{{ asset('img/showroom.jpg') }}" alt="Showroom Rental Mobil" class="hero-background"/> 
    </section>


    <!-- ================= ABOUT 1 ================= -->
    <section style="background:#a8c7dd;">
        <div class="about-container">
            <div class="about-text">
                <p>About Us</p>
                <h2>Naivara Trans Group</h2>
                <p>adalah penyedia jasa sewa mobil profesional di Tulungagung yang melayani berbagai kebutuhan perjalanan mulai dari wisata, acara keluarga, perjalanan dinas, hingga antar jemput dengan pilihan armada lengkap, terawat, serta opsi dengan atau tanpa driver berpengalaman. Kami berkomitmen memberikan pelayanan terbaik dengan mengutamakan kenyamanan, keamanan, dan kepuasan pelanggan agar setiap perjalanan Anda menjadi pengalaman yang aman, tepat waktu, dan berkesan.
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
                <h2>Naivara Trans Group</h2>
                <p>merupakan layanan sewa mobil terpercaya di Tulungagung dengan armada lengkap, terawat, serta pilihan layanan dengan atau tanpa driver profesional untuk berbagai kebutuhan perjalanan. Kami mengutamakan kenyamanan, keamanan, dan pelayanan terbaik agar setiap perjalanan pelanggan berjalan lancar dan memuaskan.
                </p>
            </div>
        </div>
    </section>


    <!-- ================= PRODUK MOBIL ================= -->
    <section>
        <h2 style="margin-bottom:30px;">Pilihan Unit Tersedia</h2>

        <div class="grid-mobil">

            <!-- Card item  -->
            <div class="card">
                <img src="{{ asset('img/showroom.jpg') }}">
                <h4 style="margin-top:15px;">Brio</h4>
                <a href="{{ url('/pemesanan') }}">
                <button>Booking</button>
                </a>
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
            <a href="{{ url('/katalog') }}">
                <button style="background:#163a63;color:white;padding:12px 28px;border:none;border-radius:25px;">Lihat semua unit</button>
            </a>
        </div>
    </section>


    <!-- ================= TESTIMONI ================= -->
    <section>
        <div class="testi-wrap">
            <div class="testi-img"></div>
            <div class="testi-text">
                <h2>Testimoni Klien</h2>
                <p>Pelayanan Navara Trans Group sangat memuaskan, mobil bersih, nyaman, dan kondisi prima sehingga perjalanan terasa aman dan menyenangkan. Proses pemesanan mudah, respon cepat, serta driver yang ramah dan profesional membuat kami tidak ragu untuk menggunakan layanan ini kembali.
                </p>
            </div>
        </div>
    </section>   
    <script src="script.js"></script>
</body>
</html>