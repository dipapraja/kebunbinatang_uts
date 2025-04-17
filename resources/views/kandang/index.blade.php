@extends('layouts.template')

@section('content')
@php $activeMenu = 'kandang'; @endphp
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ route('kandang.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <table class="table table-bordered table-striped table-hover table-sm" id="table_kandang">
            <thead>
                <tr>
                    <th width="7%" class="text-center">No</th>
                    <th>Nama Kandang</th>
                    <th>Tipe Kandang</th>
                    <th>Kapasitas</th>
                    <th width="20%" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
<style>
    #table_kandang thead th {
        white-space: nowrap;
        vertical-align: middle;
    }
</style>
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');
        });
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $(document).ready(function () {
        $('#table_kandang').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('kandang/list') }}",
                type: "GET"
            },
            columns: [
                { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                { data: 'nama_kandang', name: 'nama_kandang' },
                { data: 'tipe_kandang', name: 'tipe_kandang' },
                { data: 'kapasitas', name: 'kapasitas' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush