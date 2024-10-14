@extends('layouts.app')
@section('page-title', 'Edit Pengajuan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body wizard-content">
                    <form action="" class="tab-wizard validation-wizard wizard-circle" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($latestExtra)
                            <h6>Form Pengajuan</h6>
                            <section class="mb-3">
                                @include('application.detail-pengajuan')
                            </section>
                            @include('application.edit-pencairan-dana')
                        @else
                            @include('application.edit-pengajuan')
                        @endif

                        {{-- <div class="d-flex">
                            <div class="form-group ms-auto mt-5 pe-4">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div> --}}
                    </form>
                </div>
                {{-- <div class="form-body">
                        <div id="question-1" class="question" style="display: {{ $application->activity->category_id == 1 ? "block":"none" }}">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="col-12 mb-2 mt-4">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">Surat Undangan <span class="text-danger">*</span></label>
                                        <p>
                                            Format surat undangan dapat di download disini (link) Form perubahan dapat di download disini (link) <a href="https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa" target="_blank">https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa</a>
                                        </p>
                                        <input type="file" required name="lampiran[undangan]" class="form-control" accept="application/pdf">
                                    </div>
                                </div>

                                <div class="col-12 mb-2 mt-4">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">Surat permohonan<span class="text-danger">*</span></label>
                                        <p>
                                            Format surat permohonan dapat di download disini (link) Form perubahan dapat di download disini (link) <a href="https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa" target="_blank">https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa</a>
                                        </p>
                                        <input type="file" required name="lampiran[permohonan]" class="form-control" accept="application/pdf">
                                    </div>
                                </div>
                                <div class="col-12 mb-2 mt-4" id="question-1-extra-file" >
                                </div>

                                <a href="#" class="btn btn-primary" onclick="addExtraFile('1')" >Tambah</a>
                                <a href="#" class="btn btn-danger" id="question-1-rm-extra-file"  onclick="removeExtraFile('1')" style="display:none;"">Hapus</a>
                                <div class="text-danger">
                                    <h6>Catatan Perbaikan</h6>
                                    <p>{{$application->note}}</p>
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-4">
                                    <button type="submit"  class="btn btn-primary mb-1">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div id="question-2" class="question" style="display: {{ $application->activity->category_id == 2 ? "block":"none" }}">
                            <form method="POST" enctype="multipart/form-data">
                                @csrf
                                <input required type="hidden" name="unit" class="hidden-unit">
                                <input required type="hidden" name="category" class="hidden-category">
                                <input required type="hidden" name="activity" class="hidden-activity">
                                <h2>Form Pengajuan Layanan Bisnis Pelatihan</h2>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold text-capitalize" for="role_id"> Judul Permohonan <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="Permohonan menjadi narasumber di ….. pada tanggal ……." name="title" class="form-control" value="" required>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id"> Deskripsi Permohonan <span class="text-danger">*</span></label>
                                        <textarea name="desc" id="summernote" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mb-2 mt-4">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">Surat Undangan <span class="text-danger">*</span></label>
                                        <p>
                                            Format surat undangan dapat di download disini (link) Form perubahan dapat di download disini (link) <a href="https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa" target="_blank">https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa</a>
                                        </p>
                                        <input type="file" required name="lampiran[undangan]" class="form-control" accept="application/pdf">
                                    </div>
                                </div>

                                <div class="col-12 mb-2 mt-4">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">Surat permohonan<span class="text-danger">*</span></label>
                                        <p>
                                            Format surat permohonan dapat di download disini (link) Form perubahan dapat di download disini (link) <a href="https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa" target="_blank">https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa</a>
                                        </p>
                                        <input type="file" required name="lampiran[permohonan]" class="form-control" accept="application/pdf">
                                    </div>
                                </div>

                                <div class="col-12 mb-2 mt-4">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">RAB<span class="text-danger">*</span></label>
                                        <p>
                                            Format RAB dapat di download disini (link) Form perubahan dapat di download disini (link) <a href="https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa" target="_blank">https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa</a>
                                        </p>
                                        <input type="file" required name="lampiran[rab]" class="form-control" accept="application/pdf">
                                    </div>
                                </div>

                                <div class="col-12 mb-2 mt-4" id="question-2-extra-file" >
                                </div>

                                <a href="#" class="btn btn-primary" onclick="addExtraFile(2)" >Tambah</a>
                                <a href="#" class="btn btn-danger" id="question-2-rm-extra-file"  onclick="removeExtraFile('2')" style="display:none;"">Hapus</a> <br>
                                <div class="text-danger">
                                    <h6>Catatan Perbaikan</h6>
                                    <p>{{$application->note}}</p>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-4">
                                    <button type="submit"  class="btn btn-primary mb-1">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div id="question-3" class="question" style="display: {{ $application->activity->category_id == 3 ? "block":"none" }}">
                            <form method="POST" enctype="multipart/form-data">
                                @csrf
                                <input required type="hidden" name="unit" class="hidden-unit">
                                <input required type="hidden" name="category" class="hidden-category">
                                <input required type="hidden" name="activity" class="hidden-activity">
                                <h2>Form Pengajuan Layanan Bisnis Inovasi</h2>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold text-capitalize" for="role_id"> Judul Permohonan <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="Permohonan menjadi narasumber di ….. pada tanggal ……." name="title" class="form-control" value="" required>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id"> Deskripsi Permohonan <span class="text-danger">*</span></label>
                                        <textarea name="desc" id="summernote" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mb-2 mt-4">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">Surat Undangan <span class="text-danger">*</span></label>
                                        <p>
                                            Format surat undangan dapat di download disini (link) Form perubahan dapat di download disini (link) <a href="https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa" target="_blank">https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa</a>
                                        </p>
                                        <input type="file" required name="lampiran[undangan]" class="form-control" accept="application/pdf">
                                    </div>
                                </div>

                                <div class="col-12 mb-2 mt-4">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">Surat permohonan<span class="text-danger">*</span></label>
                                        <p>
                                            Format surat permohonan dapat di download disini (link) Form perubahan dapat di download disini (link) <a href="https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa" target="_blank">https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa</a>
                                        </p>
                                        <input type="file" required name="lampiran[permohonan]" class="form-control" accept="application/pdf">
                                    </div>
                                </div>

                                <div class="col-12 mb-2 mt-4">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">RAB<span class="text-danger">*</span></label>
                                        <p>
                                            Format RAB dapat di download disini (link) Form perubahan dapat di download disini (link) <a href="https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa" target="_blank">https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa</a>
                                        </p>
                                        <input type="file" required name="lampiran[rab]" class="form-control" accept="application/pdf">
                                    </div>
                                </div>

                                <div class="col-12 mb-2 mt-4" id="question-3-extra-file" >
                                </div>

                                <a href="#" class="btn btn-primary" onclick="addExtraFile(3)" >Tambah</a>
                                <a href="#" class="btn btn-danger" id="question-3-rm-extra-file"  onclick="removeExtraFile(3)" style="display:none;"">Hapus</a>
                                <div class="text-danger">
                                    <h6>Catatan Perbaikan</h6>
                                    <p>{{$application->note}}</p>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-4">
                                    <button type="submit"  class="btn btn-primary mb-1">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div id="question-4" class="question" style="display: {{ $application->activity->category_id == 4 ? "block":"none" }}">
                            <form method="POST" enctype="multipart/form-data">
                                @csrf
                                <input required type="hidden" name="unit" class="hidden-unit">
                                <input required type="hidden" name="category" class="hidden-category">
                                <input required type="hidden" name="activity" class="hidden-activity">
                                <h2>Form Pengajuan Layanan Bisnis Produksi</h2>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold text-capitalize" for="role_id"> Judul Permohonan <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="Permohonan menjadi narasumber di ….. pada tanggal ……." name="title" class="form-control" value="" required>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id"> Deskripsi Permohonan <span class="text-danger">*</span></label>
                                        <textarea name="desc" id="summernote" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mb-2 mt-4">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">Surat Undangan <span class="text-danger">*</span></label>
                                        <p>
                                            Format surat undangan dapat di download disini (link) Form perubahan dapat di download disini (link) <a href="https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa" target="_blank">https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa</a>
                                        </p>
                                        <input type="file" required name="lampiran[undangan]" class="form-control" accept="application/pdf">
                                    </div>
                                </div>

                                <div class="col-12 mb-2 mt-4">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">Surat permohonan<span class="text-danger">*</span></label>
                                        <p>
                                            Format surat permohonan dapat di download disini (link) Form perubahan dapat di download disini (link) <a href="https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa" target="_blank">https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa</a>
                                        </p>
                                        <input type="file" required name="lampiran[permohonan]" class="form-control" accept="application/pdf">
                                    </div>
                                </div>

                                <div class="col-12 mb-2 mt-4">
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">RAB<span class="text-danger">*</span></label>
                                        <p>
                                            Format RAB dapat di download disini (link) Form perubahan dapat di download disini (link) <a href="https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa" target="_blank">https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa</a>
                                        </p>
                                        <input type="file" required name="lampiran[rab]" class="form-control" accept="application/pdf">
                                    </div>
                                </div>

                                <div class="col-12 mb-2 mt-4" id="question-4-extra-file" >
                                </div>

                                <a href="#" class="btn btn-primary" onclick="addExtraFile(4)" >Tambah</a>
                                <a href="#" class="btn btn-danger" id="question-3-rm-extra-file"  onclick="removeExtraFile(4)" style="display:none;"">Hapus</a>
                                <div class="text-danger">
                                    <h6>Catatan Perbaikan</h6>
                                    <p>{{$application->note}}</p>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-4">
                                    <button type="submit"  class="btn btn-primary mb-1">Submit</button>
                                </div>
                            </form>
                        </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/summernote.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/summernote/summernote-lite.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/jquery-steps/jquery.steps.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/jquery-steps/steps.css') }}" />
    @if (!$latestExtra)
        <style>
            .wizard-content .actions.clearfix li.disabled {
                display: none
            }
        </style>
    @endif
    <style>
        .note-editable {
            font-family: 'Nunito'
        }

        .wizard-content .actions.clearfix {
            margin-top: 30px;
            /* display: none !important; */
        }
    </style>

@endsection

@section('script')
    <script src="{{ asset('assets/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $.validator.messages = {
            required: "Tidak boleh kosong",
            email: "Alamat email tidak valid",
            date: "Format tanggal tidak valid",
            number: "Format angka tidak valid",
            accept: "Format ekstensi file tidak valid",
        };
        let form = $(".validation-wizard").show();
        $(".validation-wizard").steps({
                startIndex: {{ $latestExtra ? 1 : 0 }},
                headerTag: "h6",
                bodyTag: "section",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#',
                labels: {
                    finish: "Submit",
                },
                onStepChanging: function(event, currentIndex, newIndex) {
                    return (
                        currentIndex > newIndex ||
                        (!(3 === newIndex && Number($("#age-2").val()) < 18) &&
                            (currentIndex < newIndex && (
                                    form.find(".body:eq(" + newIndex + ") label.error").remove(),
                                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error")
                                ),
                                (form.validate().settings.ignore = ":disabled,:hidden"),
                                form.valid()
                            )
                        )
                    );
                },
                onFinishing: function(event, currentIndex) {
                    return (form.validate().settings.ignore = ":disabled"), form.valid();
                },
                onFinished: function(event, currentIndex) {
                    $(".validation-wizard").submit();
                },
            }),
            $(".validation-wizard").validate({
                ignore: "input[type=hidden]",
                errorClass: "text-danger",
                successClass: "text-success",
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                rules: {
                    email: {
                        email: !0,
                    },
                },
            });

        $('.validation-wizard').submit(() => {
            return (form.validate().settings.ignore = ":disabled"), form.valid();
        });
    </script>
    <script>
        $('span#document-lampiran').click(function() {
            type = $(this).data('type')
            if (type == "doc") {
                $('#document-preview .modal-body iframe').attr('src', $(this).data('file'));
                $('#document-preview .modal-title').text($(this).text());
                $('#document-preview').modal('show');
            } else {
                $('#document-preview-img .modal-body img').attr('src', $(this).data('file'));
                $('#document-preview-img .modal-title').text($(this).text());
                $('#document-preview-img').modal('show');
            }
        });

        function addExtraFile(param) {
            target = $(`#question-${param}-extra-file`);
            let count = 1;
            if ($(`#question-${param}-extra-file .document:last-child`).data('number')) {
                count = $(`#question-${param}-extra-file .document:last-child`).data('number') + 1;
            }
            target.append(`
                <div class="d-flex document mb-2" data-number="${count}">
                    <div>
                        <button type="button" class="btn btn-outline-danger" onclick="removeThis(this)"> <i class="fas fa-times-circle"></i></button>
                    </div>
                    <div class="ms-4 col-10">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" required name="lampiran[lainnya][${count}][title]" class="form-control required" placeholder="Judul Dokumen">
                            </div>
                            <div class="col-9">
                                <input type="file" required name="lampiran[lainnya][${count}][document]" class="form-control required" placeholder="Dokumen" accept="application/pdf" />
                                <small class="text-muted">Format file harus berupa PDF</small>
                            </div>
                        </div>
                    </div>
                </div>
            `)
        }

        function removeThis(param) {
            $(param).parent().parent().remove();
        }
        $(document).ready(function() {
            $("#summernote").summernote({
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                ]
            })
        });

        $("#unit").on('change', function(e) {
            const optionDefault = '<option value="" selected>--- Pilih ---</option>'
            $('#category-form select, #activity-form select').html(optionDefault)
            $("div.question").fadeOut();
            $("div.question input").attr('disabled', 'disabled');
            $("div#question-1-extra-file > div, div#question-2-extra-file > div, div#question-3-extra-file > div, div#question-4-extra-file > div")
                .remove();
            if ($("#unit").val()) {
                $.get("{{ url('/api/category') }}/" + $("#unit").val())
                    .done(function({
                        data
                    }) {
                        let options = '';
                        $.each(data, function(key, val) {
                            options += `<option value="${val.id}">${val.name}</option>`;
                        });
                        $('#category-form select#category').append(options)
                    })
                    .fail(function(response) {
                        $('#category-form select, #activity-form select').html(optionDefault)
                    })
            } else {
                $('#category-form select, #activity-form select').html(optionDefault)
            }
        });
        $('select#category').on('change', function(e) {
            const optionDefault = '<option value="" selected>--- Pilih ---</option>'
            $('#activity-form select').html(optionDefault);
            $("div.question").fadeOut();
            $("div.question input").attr('disabled', 'disabled');
            $("div#question-1-extra-file > div, div#question-2-extra-file > div, div#question-3-extra-file > div, div#question-4-extra-file > div")
                .remove();
            if ($("#category").val()) {
                $.get("{{ url('/api/activity') }}/" + $("#category").val())
                    .done(function({
                        data
                    }) {
                        let options = '';
                        $.each(data, function(key, val) {
                            options += `<option value="${val.id}">${val.name}</option>`;
                        });
                        $('#activity-form select').append(options)
                    })
                    .fail(function(response) {
                        $('#activity-form select').html(optionDefault)
                    })
            } else {
                $('#activity-form select').html(optionDefault)
            }
        });
        $('select#activity').on('change', function(e) {
            $("div.question").fadeOut();
            $("div.question input").attr('disabled', 'disabled');
            $("div#question-1-extra-file > div, div#question-2-extra-file > div, div#question-3-extra-file > div, div#question-4-extra-file > div")
                .remove();
            $(`#question-${$("#category").val()} input`).removeAttr('disabled');
            $(`#question-${$("#category").val()}`).fadeIn();
        });
    </script>
@endsection

@section('modal')
    <div class="modal fade" id="document-preview" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <iframe src="" frameborder="0" height="850px" class="w-100"></iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="document-preview-img" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 mx-auto d-flex justify-content-center">
                    <div class="col-6">
                        <img src="" class="w-100 img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
