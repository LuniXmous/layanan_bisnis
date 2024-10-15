@extends('layouts.app')

@section('page-title', 'Pengajuan Menunggu Review Admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100 table-bordered table-xs table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemohon</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/datatables.min.js') }}"></script>
    <script>
        $('#datatable').DataTable({
            ajax: '{{ route('application.reviewAdmin') }}',  // Memanggil rute baru
            serverSide: true,
            processing: true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    </script>
@endsection
