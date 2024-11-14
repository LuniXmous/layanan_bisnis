@extends('layouts.app')
@section('page-title', 'Unit ' . $unit->name)

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title fw-bold h4"></div>
        </div>
        <div class="card-body">
            <button onclick="newActivity()" class="btn btn-primary mb-3"><i class="fas fa-plus-circle"></i>&nbsp; Tambah</button>
            <div class="table-responsive">
                <table class="table table-striped w-100 table-bordered table-xs" id="datatable">
                    <thead>
                        <tr>
                            <th width="3%">No</th>
                            <th>Kategori</th>
                            <th>Kegiatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-8 col-md-10 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title fw-bold h4">Admin Unit</div>
                </div>
                <div class="card-body">
                    @if($unit->admin->id != 1)
                        <form action="{{ route('user.update',["id" => $unit->admin->id]) }}" method="post">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2 fw-bold text-capitalize" for="username">Nama <span class="text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name" required value="{{ $unit->admin->name }}">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2 fw-bold text-capitalize" for="email">Email <span class="text-danger">*</span></label>
                                            <input type="text" id="email" class="form-control" name="email" required value="{{ $unit->admin->email }}">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2 fw-bold text-capitalize" for="password">Password</label>
                                            <input type="password" id="password" class="form-control" name="password" >
                                            <small id="emailHelp" class="form-text text-muted">Abaikan jika tidak ingin mengubah password</small>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2 fw-bold text-capitalize" for="re_password">Masukan Ulang Password</label>
                                            <input type="password" id="re_password" class="form-control" name="re_password" >
                                            <small id="emailHelp" class="form-text text-muted">Abaikan jika tidak ingin mengubah password</small>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary mb-1">Submit</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    @else
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>&nbsp; Unit ini belum memiliki admin
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddAdminUnit">
                            <i class="fas fa-plus-circle"></i>&nbsp; Tambahkan Admin
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @if($unit->admin->id == 1)
        <div class="modal fade" id="modalAddAdminUnit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Admin Unit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="unit" value="{{$unit->id}}" required readonly>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2 fw-bold text-capitalize" for="username">Nama <span class="text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2 fw-bold text-capitalize" for="email">Email <span class="text-danger">*</span></label>
                                            <input type="text" id="email" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2 fw-bold text-capitalize" for="password">Password <span class="text-danger">*</span></label>
                                            <input type="password" id="password" class="form-control" name="password" required>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2 fw-bold text-capitalize" for="re_password">Masukan Ulang Password <span class="text-danger">*</span></label>
                                            <input type="password" id="re_password" class="form-control" name="re_password" required>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary mb-1">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="activityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('unit.updateOrCreateActivity' , ['id'=>$unit->id]) }}" method="post">
                        @csrf
                        <input type="hidden" id="activityId" name="activity">
                        <div class="form-group">
                            <label class="mb-2 fw-bold text-capitalize" for="username">Kategori <span class="text-danger">*</span></label>
                            <select required name="category" class="form-control" id="activityCategory">
                                <option value="">--- Pilih ---</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" class="text-capitalize">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="mb-2 fw-bold text-capitalize" for="email">Nama Layanan <span class="text-danger">*</span></label>
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

@section("script")
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/datatables.min.js') }}"></script>
    <script>
        function newActivity(){
            $('#activityModal').modal('toggle');
            $('#activityModal .modal-title').text('Tambah Layanan');
            $('#activityModal button').text('Tambah');
            $('#activityId').val('');
            $('#activityCategory').val('');
            $('#activityCategory').removeAttr('disabled');
            $('#activityName').val('');
        }
        function updateActivity(id,category,name){
            $('#activityId').val(id);
            $('#activityModal .modal-title').text('Edit Layanan');
            $('#activityModal button').text('Edit');
            $('#activityCategory').val(category);
            $('#activityCategory').attr('disabled',true);
            $('#activityName').val(name);
            $('#activityModal').modal('toggle');
        }
    </script>
    <script>
        $('#datatable').DataTable({
            ajax: '',
            serverSide: true,
            processing: true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'category', name: 'category'},
                {data: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        $(document).on('click', '.delete-activity', function() {
            var activityId = $(this).data('id');
            $.ajax({
                url: '{{ route("activity.destroy") }}',
                type: 'DELETE',
                data: {
                    id: activityId, // ID activity yang ingin dihapus
                    _token: '{{ csrf_token() }}' // Token CSRF untuk keamanan
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.success);
                        // Lakukan update tampilan atau refresh data sesuai kebutuhan
                    }
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseJSON.error);
                }
            });
        });

    </script>
@endsection
