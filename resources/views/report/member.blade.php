@extends('_layouts.print')

@php
    $page_title = "Laporan member tanggal {$times['start']} sampai {$times['end']}"
@endphp

@section('content')
<h3 class="text-center mb-3">{{ $page_title }}</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>Nama</td>
            <td>Nomor telepon</td>
            <td>Jenis Kelamin</td>
            <td>Alamat</td>
        </tr>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member->nama }}</td>
                    <td>{{ $member->tlp }}</td>
                    <td>{{ $member->jenis_kelamin }}</td>
                    <td>{{ $member->alamat }}</td>
                </tr>
            @endforeach
        </tbody>
    </thead>
</table>
@endsection