<h2>Daftar User Chat</h2>

@foreach($users as $item)
    <a href="/admin/chat/{{ $item->user_id }}">
        {{ $item->user->name ?? 'User '.$item->user_id }}
    </a><br>
@endforeach
