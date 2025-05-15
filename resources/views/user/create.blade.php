@extends('layouts.app')
@section('page-title', 'Tambah Pengguna')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label class="mb-2 fw-bold text-capitalize" for="username">Nama Pengguna<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" required value="">
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label class="mb-2 fw-bold text-capitalize" for="email">Email <span class="text-danger">*</span></label>
                                <input type="text" id="email" class="form-control" name="email" required value="">
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label class="mb-2 fw-bold text-capitalize" for="role_id">Role <span class="text-danger">*</span></label>
                                <select name="role" id="role" class="form-control" >
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label class="mb-2 fw-bold text-capitalize" for="password">Password</label>
                                <input type="password" id="password" class="form-control" name="password" >
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label class="mb-2 fw-bold text-capitalize" for="re_password">Masukan Ulang Password</label>
                                <input type="password" id="re_password" class="form-control" name="re_password" >
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
@endsection
