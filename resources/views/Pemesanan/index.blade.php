<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<main class="page-wrap">
        <div class="container">
            <!-- LEFT: DETAIL -->
            <article class="detail-card">
                <div class="media-and-title">
                    <div class="media">
                        <img src="{{ asset('img/car.png') }}" alt="Car image" />
                    </div>
                    <h1 class="car-title">Nama Mobil</h1>
                </div>

                <hr class="sep">

                <section class="specs">
                    <h3>Rincian Unit:</h3>
                    <div class="icons">
                        <div class="icon-row">
                            <div class="icon-item">
                                <span class="big"></span>
                                <div class="meta">0</div>
                            </div>
                            <div class="icon-item">
                                <span class="big"></span>
                                <div class="meta">Matic</div>
                            </div>
                            <div class="icon-item">
                                <span class="big"></span>
                                <div class="meta">City Car</div>
                            </div>
                            <div class="icon-item">
                                <span class="big"></span>
                                <div class="meta">Bensin</div>
                            </div>
                        </div>
                    </div>
                </section>

                <hr class="sep">

                <section class="desc">
                    <h3>Rincian Unit:</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vehicula rhoncus mauris a condimentum.
                        Mauris facilisis finibus mauris nec sodales. Mauris tempus feugiat lorem, ut iaculis eros fringilla vitae.
                    </p>
                </section>

                <div class="cta-row">
                    <a href="" class="btn-contact">
                        <span class="phone-icon"></span> Hubungi Kami
                    </a>
                </div>

                <section class="howto">
                    <h3>Cara Memesan:</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer et pretium erat. Morbi porttitor quis velit at ultricies.
                    </p>
                </section>

                <section class="payment">
                    <h3>Menyelesaikan pembayaran:</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum congue massa blandit mollis egestas.
                    </p>
                </section>

                <section class="confirm">
                    <h3>Konfirmasi pembayaran:</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum congue massa blandit mollis egestas.
                    </p>
                </section>
            </article>

            <!-- RIGHT: SIDEBAR BOOKING -->
            <aside class="sidebar-booking">
                <div class="price-head">
                    <div class="price-title">Mulai Dari</div>
                    <div class="price">Rp. -</div>
                </div>

                <form class="booking-form" id="bookingForm" onsubmit="return false;">
                    <label>Email
                        <input type="email" name="email" placeholder="email@gmail.com" required>
                    </label>

                    <label>Nama Lengkap
                        <input type="text" name="name" placeholder="Nama lengkap" required>
                    </label>

                    <label>No. Hp
                        <input type="tel" name="phone" placeholder="08xxxxxxxxxx" required>
                    </label>

                    <div class="date-row">
                        <label>Tanggal Ambil
                            <input type="date" name="pickup">
                        </label>
                        <label>Tanggal Kembali
                            <input type="date" name="return">
                        </label>
                    </div>

                    <fieldset class="facilities">
                        <legend>Fasilitas Tambahan :</legend>
                        <label><input type="checkbox" name="driver" value="with-driver"> Dengan Driver</label>
                        <label><input type="checkbox" name="nodriver" value="without-driver"> Tanpa Driver</label>
                        <label><input type="checkbox" name="allin" value="all-in"> All in</label>
                    </fieldset>

                    <div class="total-line">
                        <span>Total :</span>
                        <span id="totalPrice">Rp. 0</span>
                    </div>

                    <a href="{{ url('/Konfirmasi-pembayaran') }}">
                    <button class="btn-book" id="bookBtn">Pesan Sekarang</button>
                    </a>
                </form>
            </aside>
        </div>
    </main>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>