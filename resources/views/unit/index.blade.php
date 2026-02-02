@extends('layouts.app')
@section('page-title', 'Manajemen Pusat/Jurusan/Unit')

@section('content')
    <div class="row">
        <div class="col-xxl-8 col-12">
            <div class="card">
                <div class="card-body">
                    <a id="btnUnit" class="btn btn-md btn-primary mb-4" href="#"><i class="fas fa-plus"></i>&nbsp; Tambah</a>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped w-100 table-bordered table-xs" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Total Kegiatan</th>
                                    <th width="12   %">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="unitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('unit.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="mb-2 fw-bold text-capitalize" for="email">Nama Unit <span class="text-danger">*</span></label>
                            <input type="text" id="activityName" class="form-control" name="name" required value="">
                        </div>
                        <button type="submit" class="btn btn-success mb-1">Tambah</button>
                    </form>
                </div>
                </div>
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
            ajax: '',
            serverSide: true,
            processing: true,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'name'},
                {data: 'activities', name: 'activities'},   
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        $('#btnUnit').on('click',function(){
            $('#unitModal').modal("toggle")
        })

        $(document).on('click', '.delete-unit', function(e) {
            e.preventDefault();
            let unitId = $(this).data('id');

            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus unit ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `unit/delete/${unitId}`,
                        type: 'get',
                        data: {
                            id: unitId,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            Swal.fire(
                                'Berhasil',
                                response.success,
                                'success'
                            ).then(() => {
                                $('#datatable').DataTable().ajax.reload(); // Reload datatable setelah penghapusan berhasil
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal',
                                xhr.responseJSON.error || "Terjadi kesalahan saat menghapus unit.",
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
@endsection
