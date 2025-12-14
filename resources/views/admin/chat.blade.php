<h3>Chat User #{{ $user_id }}</h3>

<div id="chatBody">
@foreach($messages as $msg)
    <div>
        <b>{{ $msg->sender_role }}</b> : {{ $msg->message }}
    </div>
@endforeach
</div>

<input type="text" id="msg">
<button onclick="send()">Kirim</button>

<script>
function send() {
    fetch('/admin/chat/{{ $user_id }}/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            message: document.getElementById('msg').value
        })
    });
}
</script>
