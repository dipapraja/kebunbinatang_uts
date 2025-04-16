@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('hewan/create') }}" class="btn btn-sm btn-primary">
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

        <table class="table table-bordered table-striped table-hover table-sm" id="table_hewan">
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th>Nama</th>
                    <th>Spesies</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Kandang</th>
                    <th width="20%" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

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

    var dataHewan;
    $(document).ready(function () {
        dataHewan = $('#table_hewan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('hewan/list') }}",
                type: "GET",
                data: function (d) {
                }
            },
            columns: [
                { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                { data: 'nama_hewan', name: 'nama_hewan' },
                { data: 'spesies', name: 'spesies' },
                { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                { data: 'tanggal_lahir', name: 'tanggal_lahir' },
                { data: 'kandang', name: 'kandang' }, // Ini akan berisi nama kandang karena diubah di controller
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false  }
            ]
        });        
    });
</script>
@endpush
