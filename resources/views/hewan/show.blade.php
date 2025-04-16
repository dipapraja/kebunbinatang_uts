@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr><th>Nama</th><td>{{ $hewan->nama_hewan }}</td></tr>
            <tr><th>Spesies</th><td>{{ $hewan->spesies }}</td></tr>
            <tr><th>Jenis Kelamin</th><td>{{ $hewan->jenis_kelamin }}</td></tr>
            <tr><th>Tanggal Lahir</th><td>{{ $hewan->tanggal_lahir }}</td></tr>
            <tr><th>Kandang</th><td>{{ $hewan->kandang->nama_kandang ?? '-' }}</td></tr>
        </table>

        <div class="mt-3">
            <a href="{{ route('hewan.edit', $hewan->id_hewan) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('hewan.destroy', $hewan->id_hewan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
            <a href="{{ route('hewan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection