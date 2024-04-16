@extends('_layouts.blank')

@php
    $page_title = 'Registrasi Outlet'
@endphp

@section('content')
<p class="login-box-msg">Registrasi outlet</p>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0 pl-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('handleRegister') }}" method="post">
    @csrf
    <div class="form-group">
        <input name="outlet_nama" type="text" class="form-control" placeholder="Masukkan nama outlet anda">
    </div>
    <div class="form-group">
        <textarea name="outlet_alamat" cols="30" rows="10" class="form-control" placeholder="Masukkan alamat outlet anda"></textarea>
    </div>
    <div class="form-group">
        <input name="outlet_tlp" type="tel" class="form-control" placeholder="Masukkan nomor telepon outlet anda">
    </div>
    <hr>
    <div class="form-group">
        <input name="user_nama" type="text" class="form-control" placeholder="Masukkan nama anda">
    </div>
    <div class="form-group">
        <input name="user_username" type="text" class="form-control" placeholder="Masukkan username anda">
    </div>
    <div class="form-group">
        <input name="user_password" type="text" class="form-control" placeholder="Masukkan password anda">
    </div>
    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
    <div class="text-center mt-3">
        <a href="{{ route('viewLogin') }}">Masuk ke aplikasi</a>
    </form>
</div>
@endsection