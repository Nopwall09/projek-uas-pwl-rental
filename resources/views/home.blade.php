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

        @foreach ($mobils as $mobil)
            <div class="card">
                <img src="{{ asset('storage/'.$mobil->mobil_image) }}"
                    alt="{{ $mobil->merk->merk_nama ?? 'Mobil' }}">

                <h4 style="margin-top:15px;">
                    {{ $mobil->merk->merk_nama }}
                    {{ $mobil->tipe->tipe_nama ?? '' }}
                </h4>

                <p>Rp {{ number_format($mobil->harga_rental, 0, ',', '.') }} / hari</p>

                <a href="{{ url('/pemesanan/'.$mobil->mobil_id) }}">
                    <button>Booking</button>
                </a>
            </div>
        @endforeach

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
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Praesent nibh elit, tristique sit amet egestas quis, lobortis 
                    a enim. Nullam lacus tortor, fermentum a posuere non, congue 
                    a ex.
                </p>
            </div>
        </div>
    </section>   
    <!-- jika pakai Font Awesome -->
    <div id="livechat-button">💬</div>
    <!-- Chat Popup -->
    <div id="chat-popup">
        <div class="chat-header">
            <span>Live Chat</span>
            <button id="chat-close">✕</button>
        </div>

        <div class="chat-body">
            <!-- Pesan masuk -->
            <div class="chat-message incoming">
                <p>Halo 👋 Ada yang bisa kami bantu?</p>
            </div>

        </div>

        <div class="chat-footer">
            <input type="text" id="chat-input" placeholder="Ketik pesan..." />
            <button id="send-btn">Kirim</button>
        </div>
    </div>
    <script src="https://js.pusher.com/8.0/pusher.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatBtn = document.getElementById('livechat-button');
        const chatPopup = document.getElementById('chat-popup');
        const chatClose = document.getElementById('chat-close');
        const sendBtn = document.getElementById('send-btn');
        const chatInput = document.getElementById('chat-input');
        const chatBody = document.querySelector('.chat-body');

        chatBtn.addEventListener('click', function () {
            chatPopup.style.display = 'flex';
            loadMessages();
        });
        chatClose.addEventListener('click', () => chatPopup.style.display = 'none');

        function loadMessages() {
            fetch('/chat/messages')
                .then(res => res.json())
                .then(data => {
                    chatBody.innerHTML = '';
                    
                    data.forEach(msg => {
                        const div = document.createElement('div');
                        div.classList.add(
                            'chat-message',
                            msg.sender_role === 'admin' ? 'incoming' : 'outgoing'
                        );
                        div.innerHTML = `<p>${msg.message}</p>`;
                        chatBody.appendChild(div);
                    });
                    chatBody.scrollTop = chatBody.scrollHeight;
                });
        }
        // ⬇️ PERBAIKAN DI SINI
        sendBtn.addEventListener('click', function () {
            const text = chatInput.value.trim();
            if (text === '') return;

            // 1️⃣ Tampilkan pesan langsung (OUTGOING)
            const msgDiv = document.createElement('div');
            msgDiv.classList.add('chat-message', 'outgoing');
            msgDiv.innerHTML = `<p>${text}</p>`;
            chatBody.appendChild(msgDiv);
            chatBody.scrollTop = chatBody.scrollHeight;

            // 2️⃣ Kirim ke server
            fetch('/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: text })
            });

            chatInput.value = '';
        });

        chatInput.addEventListener('keypress', e => {
            if (e.key === 'Enter') sendBtn.click();
        });

        // ================= PUSHER =================
        const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            encrypted: true
        });

        const channel = pusher.subscribe('private-chat');
        channel.bind('App\\Events\\MessageSent', function (data) {
            const msgDiv = document.createElement('div');
            msgDiv.classList.add(
                'chat-message',
                data.message.sender_role === 'admin' ? 'incoming' : 'outgoing'
            );
            msgDiv.innerHTML = `<p>${data.message.message}</p>`;
            chatBody.appendChild(msgDiv);
            chatBody.scrollTop = chatBody.scrollHeight;
        });

        // const channel = pusher.subscribe(
        //     'private-chat-user-{{ auth()->user()->user_id }}'
        // );

        
    });
    </script>



    <script src="script.js"></script>
</body>
</html>