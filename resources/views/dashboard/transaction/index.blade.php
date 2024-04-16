@extends('_layouts.dashboard')

@php
    $page_title = 'Transaksi'
@endphp

@section('content')
<div class="row">
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
                <h3 class="card-title">Daftar transaksi</h3>
            </div>
            <div class="card-body">
                @include('_partials.list.transaction', [
                    'transactions' => $transactions
                ])
                @if ($transactions->total() > $transactions->perPage())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>
    <div class="col-md-5 col-lg-4">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar member</h3>
                <div class="card-addon">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#create-member-modal">Tambah</button>
                </div>
            </div>
            <div class="card-body">
                <form  method="get" class="mb-3">
                    <div class="input-group">
                        <input type="search" name="search_member" class="form-control" placeholder="Cari nama member" value="{{ request()->get('search_member') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
                @include('_partials.list.member', [
                    'members' => $members
                ])
            </div>
        </div>

    </div>
</div>
@endsection

@section('modal')
    @include('_partials.modal.create-member', [
        'modalId' => 'create-member-modal',
        'modalTitle' => 'Buat member baru'
    ])
@endsection
