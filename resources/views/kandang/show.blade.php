@extends('layouts.template')

@section('content')
@php $activeMenu = 'kandang'; @endphp
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr><th>Nama Kandang</th><td>{{ $kandang->nama_kandang }}</td></tr>
            <tr><th>Tipe Kandang</th><td>{{ $kandang->tipe_kandang }}</td></tr>
            <tr><th>Kapasitas</th><td>{{ $kandang->kapasitas }}</td></tr>
        </table>
        <a href="{{ route('kandang.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
