@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('hewan.update', $hewan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $hewan->nama }}" required>
            </div>
            <div class="form-group">
                <label for="spesies">Spesies</label>
                <input type="text" name="spesies" class="form-control" value="{{ $hewan->spesies }}" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Jantan" {{ $hewan->jenis_kelamin == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                    <option value="Betina" {{ $hewan->jenis_kelamin == 'Betina' ? 'selected' : '' }}>Betina</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="{{ $hewan->tanggal_lahir }}" required>
            </div>
            <div class="form-group">
                <label for="kandang_id">Kandang</label>
                <select name="kandang_id" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($kandang as $item)
                        <option value="{{ $item->id }}" {{ $hewan->kandang_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection