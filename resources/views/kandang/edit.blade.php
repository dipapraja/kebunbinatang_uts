@extends('layouts.template')

@section('content')
@php $activeMenu = 'kandang'; @endphp
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('kandang.update', $kandang->id_kandang) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_kandang">Nama Kandang</label>
                <input type="text" name="nama_kandang" class="form-control" value="{{ $kandang->nama_kandang }}" required>
            </div>
            <div class="form-group">
                <label for="tipe_kandang">Tipe Kandang</label>
                <input type="text" name="tipe_kandang" class="form-control" value="{{ $kandang->tipe_kandang }}" required>
            </div>
            <div class="form-group">
                <label for="kapasitas">Kapasitas</label>
                <input type="number" name="kapasitas" class="form-control" value="{{ $kandang->kapasitas }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection