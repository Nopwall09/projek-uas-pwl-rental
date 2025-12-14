@if($rentals->count())
    @foreach($rentals as $rental)
        <div class="p-3 mb-3" style="border:1px solid #eee;border-radius:14px;">
            <div style="display:flex;justify-content:space-between;align-items:center;gap:20px;">

                {{-- INFO PESANAN --}}
                <div>
                    <h5 style="margin:0;font-weight:600;">
                        {{ $rental->mobil->merk->nama_merk ?? '-' }}
                        {{ $rental->mobil->tipe->nama_tipe ?? '' }}
                    </h5>

                    <p style="margin:2px 0;color:#555;">
                        Unit: {{ $rental->mobil->mobil_plat }}
                    </p>

                    <p style="margin:2px 0;color:#555;">
                        Tanggal: {{ \Carbon\Carbon::parse($rental->tgl)->format('d M Y') }}
                    </p>

                    <p style="margin:2px 0;color:#555;">
                        Status:
                        <span style="font-weight:600;color:#163a63;">
                            {{ $rental->mobil->mobil_status }}
                        </span>
                    </p>
                </div>

                {{-- FEEDBACK --}}
                <div>
                    @if($rental->feedback)
                        <p style="margin:0;font-weight:600;">
                            ⭐ {{ $rental->feedback->rating }}
                        </p>
                        <p style="margin:0;color:#555;">
                            "{{ $rental->feedback->komentar }}"
                        </p>
                    @else
                        <form action="{{ route('feedback.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="rental_id" value="{{ $rental->rental_id }}">

                            <select name="rating" required class="form-select mb-2">
                                <option value="">Rating</option>
                                <option value="5">⭐⭐⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="1">⭐</option>
                            </select>

                            <textarea name="komentar"
                                class="form-control mb-2"
                                placeholder="Tulis komentar..." required></textarea>

                            <input type="hidden" name="tanggal_feedback"
                                value="{{ now()->toDateString() }}">

                            <button class="btn btn-sm"
                                style="background:#163a63;color:white;border-radius:20px;">
                                Kirim Feedback
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    @endforeach
@else
    <p style="text-align:center;color:#666;margin-top:40px;">
        Belum ada pesanan
    </p>
@endif
