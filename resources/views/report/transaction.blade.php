@extends('_layouts.print')

@php
    $page_title = "Laporan transaksi tanggal {$times['start']} sampai {$times['end']}"
@endphp

@section('content')
<h3 class="text-center mb-3">{{ $page_title }}</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>Kode invoice</td>
            <td>Member</td>
            <td>Jumlah</td>
            <td>Subtotal</td>
            <td>Biaya tambahan</td>
            <td>Pajak</td>
            <td>Diskon</td>
            <td>Total</td>
        </tr>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->kode_invoice }}</td>
                    <td>{{ $transaction->member->nama }}</td>
                    <td>{{ count($transaction->transactionDetail) }}</td>
                    <td>{{ number_format($transaction->subtotal) }}</td>
                    <td>{{ number_format($transaction->biaya_tambahan) }}</td>
                    <td>{{ number_format($transaction->pajak) }}</td>
                    <td>{{ number_format($transaction->diskon) }}</td>
                    <td>{{ number_format($transaction->total) }}</td>
                </tr>
            @endforeach
        </tbody>
    </thead>
    <tfoot>
        <tr>
            <td class="text-right" colspan="2">Total</td>
            <td>{{ number_format($summary['total_pesanan']) }}</td>
            <td>{{ number_format($summary['subtotal']) }}</td>
            <td>{{ number_format($summary['biaya_tambahan']) }}</td>
            <td>{{ number_format($summary['pajak']) }}</td>
            <td>{{ number_format($summary['diskon']) }}</td>
            <td>{{ number_format($summary['total']) }}</td>
        </tr>
    </tfoot>
</table>
@endsection