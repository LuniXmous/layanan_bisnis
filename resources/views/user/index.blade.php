@extends('layouts.app')
@section('page-title', 'Manajemen Pengguna')

@section('content')
    <div class="card">
        <div class="card-body">
            <a class="btn btn-md btn-primary mb-4" href="{{ route('user.create') }}"><i class="fas fa-plus"></i>&nbsp; Tambah</a>
            <br>
            <table class="table table-striped w-100 table-bordered table-xs" id="datatable-ajax">
                <thead>
                    <tr>
                        <th width="4%">No</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/datatables.min.js') }}"></script>
    <script>
        $('#datatable-ajax').DataTable({
            ajax: '',
            serverSide: true,
            processing: true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'name'},
                {data: 'email'},
                {data: 'role', name: 'role'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
    <script>
        function nonactiveUser(userId){
            Swal.fire({
                title: 'Apakah anda yakin ingin mengubah status pengguna ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get('{{ url("pengguna") }}/' + userId + '/delete')
                    .done(function () {
                        location.reload();
                    })
                    .fail(function () {
                        Swal.fire(
                            'Gagal',
                            'Gagal mengubah status pengguna',
                            'error'
                        )
                    })
                }
            })
        }
    </script>
@endsection
