@extends('layouts.app')
@section('page-title', 'Profil saya')

<style>
    /* 🔹 pastikan icon tepat di dalam input kanan */
    .toggle-pass {
        position: absolute;
        top: 58%;
        right: 15px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
        font-size: 1rem;
        z-index: 10;
    }

    .toggle-pass:hover {
        color: #000;
    }

    /* Tambahan untuk kasih ruang kanan di input biar tidak ketimpa icon */
    .form-control.pe-5 {
        padding-right: 2.5rem !important;
    }
</style>
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label class="mb-2 fw-bold text-capitalize" for="username">Nama Pengguna <span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control" name="name" required value="{{ $data->name }}">
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label class="mb-2 fw-bold text-capitalize" for="email">Email <span class="text-danger">*</span></label>
                                <input type="text" id="email" class="form-control" name="email" disabled value="{{ $data->email }}">
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group position-relative">
                                    <label class="mb-2 fw-bold text-capitalize" for="password">Password</label>
                                    <input type="password" id="password" class="form-control pe-5" name="password">
                                    <span class="toggle-pass" data-target="password">
                                        <i class="fa-solid fa-eye-slash"></i>
                                    </span>
                                    <small class="form-text text-muted">Abaikan jika tidak ingin mengubah password</small>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group position-relative">
                                    <label class="mb-2 fw-bold text-capitalize" for="re_password">Masukan Ulang Password</label>
                                    <input type="password" id="re_password" class="form-control pe-5" name="re_password">
                                    <span class="toggle-pass" data-target="re_password">
                                        <i class="fa-solid fa-eye-slash"></i>
                                    </span>
                                    <small class="form-text text-muted">Abaikan jika tidak ingin mengubah password</small>
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
@endsection
<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggles = document.querySelectorAll(".toggle-pass");

    toggles.forEach(toggle => {
        toggle.addEventListener("click", function () {
            const targetId = this.getAttribute("data-target");
            const input = document.getElementById(targetId);
            const icon = this.querySelector("i");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            }
        });
    });
});
</script>