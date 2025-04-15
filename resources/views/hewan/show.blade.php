@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr><th>Nama</th><td>{{ $hewan->nama }}</td></tr>
            <tr><th>Spesies</th><td>{{ $hewan->spesies }}</td></tr>
            <tr><th>Jenis Kelamin</th><td>{{ $hewan->jenis_kelamin }}</td></tr>
            <tr><th>Tanggal Lahir</th><td>{{ $hewan->tanggal_lahir }}</td></tr>
            <tr><th>Kandang</th><td>{{ $hewan->kandang->nama ?? '-' }}</td></tr>
        </table>
        <a href="{{ route('hewan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection