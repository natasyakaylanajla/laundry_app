@extends('_layouts.blank')

@php
    $page_title = 'Masuk'
@endphp

@section('content')
<p class="login-box-msg">Masuk ke aplikasi</p>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0 pl-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('handleLogin') }}" method="post">
    @csrf
    <div class="form-group">
        <input name="username" type="text" class="form-control" placeholder="Masukkan username anda">
    </div>
    <div class="form-group">
        <input name="password" type="password" class="form-control" placeholder="Masukkan password anda">
    </div>
    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
    <div class="text-center mt-3">
        <a href="{{ route('viewRegister') }}">Registrasi outlet</a>
    </div>
</form>
@endsection