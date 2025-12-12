<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger alert dissmisible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-class" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>