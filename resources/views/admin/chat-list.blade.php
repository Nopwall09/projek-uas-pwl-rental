<h2 class="chat-title">💬 Daftar User Chat</h2>

<div class="chat-list">
    @foreach($users as $item)
        <a href="/admin/chat/{{ $item->user_id }}" class="chat-item">
            <div class="avatar">
                {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}
            </div>

            <div class="chat-info">
                <div class="chat-name">
                    {{ $item->user->name ?? 'User '.$item->user_id }}
                </div>
                <small class="chat-desc">Klik untuk membuka chat</small>
            </div>

            <span class="chat-status online"></span>
        </a>
    @endforeach
</div>
