@extends('layouts.template')

@section('content')
@php $activeMenu = 'kandang'; @endphp
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('kandang.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_kandang">Nama Kandang</label>
                <input type="text" name="nama_kandang" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tipe_kandang">Tipe Kandang</label>
                <input type="text" name="tipe_kandang" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kapasitas">Kapasitas</label>
                <input type="number" name="kapasitas" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection