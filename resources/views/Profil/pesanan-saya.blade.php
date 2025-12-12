@section('content')
<div class="container">
    <h2 style="font-weight:600;margin-bottom:20px;">Pesanan Saya</h2>

    <div class="card" style="border-radius:18px;">
        <div class="card-body">

            <!-- Kalau nanti mau looping pesanan dari database -->
            <div class="p-3 mb-3" style="border:1px solid #eee;border-radius:14px;">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    
                    <div>
                        <h5 style="margin:0;font-weight:600;">Pesanan</h5>
                        <p style="margin:2px 0;color:#555;">Unit: </p>
                        <p style="margin:2px 0;color:#555;">Tanggal: </p>
                        <p style="margin:2px 0;color:#555;">Status: 
                            <span style="font-weight:600;color:#163a63;">
                                Status
                            </span>
                        </p>
                    </div>

                    <a href="#" 
                        style="padding:8px 18px;border-radius:20px;background:#163a63;color:white;text-decoration:none;">
                        Detail
                    </a>
                </div>
            </div>

                <p style="text-align:center;color:#666;margin-top:40px;">Belum ada pesanan</p>

        </div>
    </div>
</div>

