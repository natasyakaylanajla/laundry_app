@extends('_layouts.dashboard')

@php
    $page_title = 'Detail Transaksi'
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
                <h3 class="card-title">Detail transaksi</h3>
                @if ($transaction->dibayar == 'belum_dibayar')
                    <div class="card-addon">
                        <button class="btn btn-success" data-toggle="modal" data-target="#get-package-modal">Tambah</button>
                    </div>
                @endif
            </div>
            <div class="card-body">
                @include('_partials.list.transaction-detail', [
                    'transactionDetails' => $transactionDetails
                ])
            </div>
        </div>

    </div>
    <div class="col-md-5 col-lg-4">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data member</h4>
            </div>
            <div class="card-body">
                
                <div class="list-item">
                    <div class="list-content">
                        <h4 class="list-title">{{ $transaction->member->nama }} <span class="badge badge-info">{{ $transaction->member->jenis_kelamin }}</span></h4>
                        <span class="list-subtitle">{{ $transaction->member->tlp }}</span>
                        <p class="list-subtitle">{{ $transaction->member->alamat }}</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Invoice: {{ $transaction->kode_invoice }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('handleUpdateTransaction', ['transaction' => $transaction->id]) }}" method="post">
                    @csrf
                    <table class="table">
                        <tr>
                            <td>Dibuat pada</td>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                        <tr>
                            <td>Batas waktu</td>
                            <td>
                                @if($transaction->dibayar == 'dibayar')
                                    {{ $transaction->batas_waktu }}
                                @else
                                    <input name="batas_waktu" type="datetime-local" class="form-control" value="{{ $transaction->batas_waktu_formated }}">
                                @endif
                            </td>
                        </tr>
                        @if($transaction->dibayar == 'dibayar')
                            <tr>
                                <td>Dibayar pada</td>
                                <td>{{ $transaction->tgl_bayar }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>Status pesanan</td>
                            <td>
                                <span class="badge badge-primary">
                                    {{ [
                                        'baru' => 'Baru',
                                        'proses' => 'Proses',
                                        'selesai' => 'Selesai',
                                        'diambil' => 'Diambil',
                                    ][$transaction->status] }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Status pembayaran</td>
                            <td>
                                <span class="badge badge-info">
                                    {{ [
                                        'dibayar' => 'Dibayar',
                                        'belum_dibayar' => 'Belum dibayar',
                                    ][$transaction->dibayar] }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Subtotal</td>
                            <td>{{ number_format($transaction->subtotal) }}</td>
                        </tr>
                        <tr>
                            <td>Biaya tambahan</td>
                            <td>
                                @if($transaction->dibayar == 'dibayar')
                                    {{ $transaction->biaya_tambahan }}
                                @else
                                    <input name="biaya_tambahan" min="0" type="number" class="form-control" placeholder="Biaya tambahan" value="{{ $transaction->biaya_tambahan }}">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Pajak</td>
                            <td>
                                @if($transaction->dibayar == 'dibayar')
                                    {{ $transaction->pajak }}
                                @else
                                    <input name="pajak" min="0" type="number" class="form-control" placeholder="Biaya tambahan" value="{{ $transaction->pajak }}">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td>
                                @if($transaction->dibayar == 'dibayar')
                                    {{ $transaction->diskon }}
                                @else
                                    <input name="diskon" min="0" type="number" class="form-control" placeholder="Biaya tambahan" value="{{ $transaction->diskon }}">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>{{ number_format($transaction->total) }}</td>
                        </tr>
                    </table>
                    @if ($transaction->dibayar == 'belum_dibayar')
                        <button type="submit" class="btn btn-primary btn-block mb-2">Ubah</button>
                    @endif
                </form>
            </div>
        </div>
        @if ($transaction->dibayar == 'belum_dibayar')
            <form action="{{ route('handlePaymentTransaction', ['transaction' => $transaction->id]) }}" method="post" class="mb-3" onsubmit="return confirm('Apakah anda ingin membayar transaksi ini')">
                @csrf
                <button type="submit" class="btn btn-success btn-block">Bayar</button>
            </form>
        @endif
        @if ($transaction->status != 'diambil')
            <form action="{{ route('handleProcessTransaction', ['transaction' => $transaction->id]) }}" method="post" onsubmit="return confirm('Apakah anda ingin memproses transaksi ini')">
                @csrf
                <button type="submit" class="btn btn-secondary btn-block">
                    {{
                        [
                            'baru' => 'Proses',
                            'proses' => 'Selesai',
                            'selesai' => 'Ambil',
                        ][$transaction->status]
                    }}
                </button>
            </form>
        @endif
    </div>
</div>
@endsection

@section('modal')
    @include('_partials.modal.get-package', [
        'modalId' => 'get-package-modal',
        'modalTitle' => 'Pilih paket',
        'packages' => $packages,
        'transactionId' => $transaction->id,
    ])
@endsection