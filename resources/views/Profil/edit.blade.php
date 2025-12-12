@extends('layout')

@section('content')
<div class="card p-4">
  <h4>Edit Profil</h4>
  <form action="{{ route('profile.update') }}" method="POST">
    @csrf

    <label>Nama</label>
    <input type="text" name="name" class="form-control mb-3" value="{{ $user->name }}">

    <label>Email</label>
    <input type="email" name="email" class="form-control mb-3" value="{{ $user->email }}">

    <label>No. Telepon</label>
    <input type="number" name="number" class="form-control mb-3" value="{{ $user->no }}">

    <button class="btn btn-success">Simpan Perubahan</button>
  </form>
</div>
@endsection
