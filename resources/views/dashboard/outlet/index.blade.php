@extends('_layouts.dashboard')

@php
    $page_title = 'Konfigurasi Outlet'
@endphp

@section('content')
<div class="row">
    <div class="col-md-5 col-lg-4">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi outlet</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('handleUpdateOutlet') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input name="nama" type="text" class="form-control" placeholder="Masukkan nama outlet" value="{{ $outlet->nama }}">
                    </div>
                    <div class="form-group">
                        <textarea name="alamat" cols="30" rows="10" class="form-control" placeholder="Masukkan alamat outlet">{{ $outlet->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <input name="tlp" type="tel" class="form-control" placeholder="Masukkan nomor telepon outlet" value="{{ $outlet->tlp }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Ubah</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar admin</h3>
                <div class="card-addon">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-admin-modal">Tambah</button>
                </div>
            </div>
            <div class="card-body">
                @include('_partials.list.user', [
                    'users' => $admins
                ])
            </div>
        </div>

    </div>
    <div class="col-md-7 col-lg-8">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 pl-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar paket</h3>
                <div class="card-addon">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-package-modal">Tambah</button>
                </div>
            </div>
            <div class="card-body">
                @include('_partials.list.package')
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar kasir</h3>
                <div class="card-addon">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-cashier-modal">Tambah</button>
                </div>
            </div>
            <div class="card-body">
                @include('_partials.list.user', [
                    'users' => $cashiers
                ])
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar owner</h3>
                <div class="card-addon">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-owner-modal">Tambah</button>
                </div>
            </div>
            <div class="card-body">
                @include('_partials.list.user', [
                    'users' => $owners
                ])
            </div>
        </div>

    </div>
</div>
@endsection

@section('modal')
    @include('_partials.modal.create-package', [
        'modalId' => 'create-package-modal',
        'modalTitle' => 'Buat paket baru'
    ])
    @include('_partials.modal.create-user', [
        'modalId' => 'create-admin-modal',
        'modalTitle' => 'Buat admin baru',
        'userRole' => 'admin'
    ])
    @include('_partials.modal.create-user', [
        'modalId' => 'create-cashier-modal',
        'modalTitle' => 'Buat kasir baru',
        'userRole' => 'kasir'
    ])
    @include('_partials.modal.create-user', [
        'modalId' => 'create-owner-modal',
        'modalTitle' => 'Buat owner baru',
        'userRole' => 'owner'
    ])
@endsection
