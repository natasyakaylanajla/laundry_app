@extends('_layouts.dashboard')

@php
    $page_title = 'Laporan'
@endphp

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center mb-3">
            <h5 class="w-100 d-none d-md-block">Laporan</h5>
            <form method="get">
                <div class="input-group" style="min-width: 30rem">
                    <input type="date" name="start" class="form-control" value="{{ $times['start'] }}">
                    <input type="date" name="end" class="form-control" value="{{ $times['end'] }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar member</h3>
                <div class="card-addon">
                    <form action="{{ route('handlePrintMember') }}" method="get">
                        <input type="hidden" name="start" value="{{ $times['start'] }}">
                        <input type="hidden" name="end" value="{{ $times['end'] }}">
                        <button type="submit" class="btn btn-info">Print</button>
                    </form>
                </div>
            </div>
            <div class="card-body">

                <div class="list">
                    @forelse($members as $member)
                        <div class="list-item">
                            <div class="list-content">
                                <h4 class="list-title">{{ $member->nama }} <span class="badge badge-info">{{ $member->jenis_kelamin }}</span></h4>
                                <span class="list-subtitle">{{ $member->tlp }}</span>
                                <p class="list-subtitle">{{ $member->alamat }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger justify-content-center mb-0">Tidak ada data</div>
                    @endforelse
                </div>

            </div>
        </div>

    </div>
    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar transaksi selesai</h3>
                <div class="card-addon">
                    <form action="{{ route('handlePrintTransaction') }}" method="get">
                        <input type="hidden" name="start" value="{{ $times['start'] }}">
                        <input type="hidden" name="end" value="{{ $times['end'] }}">
                        <button type="submit" class="btn btn-info">Print</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                
                <div class="list">
                    @forelse($transactions as $transaction)
                        <div class="list-item">
                            <div class="list-content">
                                <h4 class="list-title">
                                    {{ $transaction->member->nama }}
                                    <span class="badge badge-primary">
                                        {{ [
                                            'baru' => 'Baru',
                                            'proses' => 'Proses',
                                            'selesai' => 'Selesai',
                                            'diambil' => 'Diambil',
                                        ][$transaction->status] }}
                                    </span>
                                </h4>
                                <span class="list-subtitle">
                                    {{ count($transaction->transactionDetail) }} Pesanan - {{ number_format($transaction->total) }}
                                    <span class="badge badge-info">
                                        {{ [
                                            'dibayar' => 'Dibayar',
                                            'belum_dibayar' => 'Belum dibayar',
                                        ][$transaction->dibayar] }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger justify-content-center mb-0">Tidak ada data</div>
                    @endforelse
                </div>

            </div>
        </div>

    </div>
</div>
@endsection