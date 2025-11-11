@extends('layouts.app')
@section('page-title', 'Pengajuan Kegiatan')

@section('content')
    <div class="card">
        <div class="card-body">
            @if (Auth::user()->role_id != 1)
                <a href="{{ route('application.export') }}" class="btn btn-primary mb-3" ><i class="fas fa-file-excel"></i> Generate Excel</a>
            @endif
            @if (Auth::user()->role->alias == 'applicant')
                <a class="btn btn-md btn-primary mb-4" href="{{ route('application.create') }}"><i class="fas fa-plus"></i>&nbsp; Buat Pengajuan Baru</a>
            @endif
            <div class="table-responsive">
                <table class="table table-striped w-100 table-bordered table-xs table-hover" id="datatable-ajax">
                    <thead>
                        <tr>
                            <th width="3%">No</th>
                            <th>Judul Permohonan</th>
                            <th>Nama Pemohon</th>
                            <th>Pusat/Unit/Jurusan yang diajukan</th>
                            <th>Kategori</th>
                            <th>Kegiatan</th>
                            <th>Status</th>
                            <th>Dibuat Pada</th>
                            <th>Terakhir diperbarui</th>
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
        $('#datatable-ajax').DataTable({
            ajax: '',
            serverSide: true,
            processing: true,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'title'
                },
                {
                    data: 'applicant_name',
                    name: 'applicant_name'
                },
                {
                    data: 'unit_name',
                    name: 'unit_name'
                },
                {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'activity_name',
                    name: 'activity_name'
                },
                {
                    data: 'status_applicant',
                    name: 'status_applicant'
                },
                {
                    data: 'created_at',
                },
                {
                    data: 'updated_at',
                },
            ],
            columnDefs: [{
                render: function(data, type, full, meta) {
                    return "<div class='text-nowrap'>" + data + "</div>";
                },
                targets: [1, 2, 3, 4, 5, 6, 7]
            }]
        });
    </script>
</script>
@endsection
