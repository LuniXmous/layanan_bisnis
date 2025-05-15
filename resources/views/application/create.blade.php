@extends('layouts.app')
@section('page-title', 'Buat Pengajuan Kegiatan Baru')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body wizard-content">
                    <form action="" class="tab-wizard validation-wizard wizard-circle" method="POST" 
                    enctype="multipart/form-data">
                        @csrf
                {{-- STEP 1 --}}
                        <h6>Form Pengajuan</h6>
                        <section class="mb-3">
                            <div class="form-group mb-3">
                                <label class="mb-2 text-dark fw-bold text-capitalize">Unit 
                                    <span class="text-danger">*</span></label>
                                <select name="unit" id="unit" class="form-control required mb-2" required>
                                    <option value="">--- Pilih ---</option>
                                    @foreach ($unit as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3" id="category-form">
                                <label class="mb-2 text-dark fw-bold text-capitalize"> Kategori <span
                                        class="text-danger">*</span></label>
                                <select name="category" id="category" class="form-control required mb-2" required>
                                    <option value="">--- Pilih ---</option>
                                </select>
                            </div>
                            <div id="form1">
                                <div class="form-group mb-3" id="activity-form">
                                    <label class="text-dark mb-2 fw-bold text-capitalize"> Aktivitas <span
                                            class="text-danger">*</span></label>
                                    <select name="activity" id="activity" class="form-control required mb-2" required>
                                        <option value="">--- Pilih ---</option>
                                    </select>
                                    <div class="text-muted fw-bold">Jika aktivitas tidak tersedia,
                                        silahkan hubungi admin layanan bisnis: <span class="text-primary">081293398862
                                            (Tias)
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="text-dark mb-2 fw-bold text-capitalize" for="title"> Judul Permohonan
                                        <span class="text-danger">*</span></label>
                                    <input type="text"
                                        placeholder="Judul Permohonan Kegiatan" name="title"
                                        id="title" class="form-control required" value="{{ old('title') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="text-dark mb-2 fw-bold text-capitalize" for="nominal">Nominal Kontrak yang Di Ajukan <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number"  placeholder="Masukkan Nominal" name="nominal" 
                                        id="nominal" class="form-control required" oninput="updateFormattedValue(this); validateInput(this);" required>
                                    </div>
                                    <div id="validationMessage" class="text-danger mt-2"></div> <!-- Untuk pesan validasi -->
                                    <div id="formattedValue" class="mt-2" style="font-weight: bold;"></div> <!-- Untuk menampilkan nilai format -->
                                </div>
                                <div class="form-group mb-3">
                                    <label class="text-dark mb-2 fw-bold" for="summernote">Deskripsi Permohonan <span
                                            class="text-danger">*</span></label>
                                    <br>
                                    <textarea name="desc" id="summernote" class="form-control required" rows="3" required></textarea>
                                </div>
                        <!-- Pertanyaan 1 -->
                                <div id="question-1" class="question" style="display: none">
                                    <!-- <div class="form-group mb-4">
                                        <label class="text-dark mb-2 fw-bold" for="lampiran_undangan">Surat Undangan (PDF)</label>
                                        <br>
                                        <input disabled type="file" name="lampiran[undangan]" id="lampiran_undangan"
                                            class="form-control" accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div> -->
                                    <div class="form-group mb-4">
                                        <label class="text-dark mb-2 fw-bold" for="lampiran_permohonan">Surat permohonan ijin kegiatan (PDF)<span class="text-danger"></span></label>
                                        <br>
                                        Format surat permohonan ijin kegiatan dapat di download disini (link) Form perubahan
                                        dapat di download disini (link)
                                        <a href="{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}">{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }} </a>
                                        <input disabled type="file" name="lampiran[permohonan ijin kegiatan]"
                                            id="lampiran_permohonan" class="form-control" accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold text-dark" for="role_id">TOR (PDF)<span
                                                class="text-danger">*</span></label>
                                        <p>
                                            Format surat TOR dapat di download disini (link) Form perubahan dapat di
                                            download disini (link) <a href="{{ url('/template/template-tor.doc') }}"
                                                target="_blank">{{ url('/template/template-tor.doc') }}</a> 
                                        </p>
                                        <input type="file" required name="lampiran[tor]" class="form-control"
                                            accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>

                                    <div class="form-group">
                                        <label class="mb-2 fw-bold text-dark" for="role_id">RAB<span
                                                class="text-danger">*</span></label>
                                        <p>
                                            Format surat RAB dapat di download disini (link) Form perubahan dapat di
                                            download disini (link) <a href="{{ url('/template/template-rab.xlsx') }}"
                                                target="_blank">{{ url('/template/template-rab.xlsx') }}</a>
                                        </p>
                                        <input type="file" required name="lampiran[rab]" class="form-control"
                                            accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>

                                    <button type="button" class="btn btn-outline-primary" onclick="addExtraFile(1)"> <i
                                            class="fas fa-plus-circle"></i>&nbsp; Tambah Dokumen</button>
                                    <div class="col-12 mb-2 mt-3" id="question-1-extra-file"></div>
                                </div>
                        <!-- Pertanyaan 2 -->
                                <div id="question-2" class="question" style="display: none">
                                    <div class="form-group mb-4">
                                        <label class="text-dark mb-2 fw-bold" for="lampiran_undangan">Surat Permohonan dari Mitra (PDF)</label>
                                        <br>
                                        <input disabled type="file" name="lampiran[permohonan dari mitra]" id="lampiran_undangan"
                                            class="form-control" accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-dark mb-2 fw-bold" for="lampiran_permohonan">Surat permohonan ijin kegiatan (PDF)<span class="text-danger"></span></label>
                                        <br>
                                        Format surat permohonan ijin kegiatan dapat di download disini (link) Form perubahan
                                        dapat di download disini (link)
                                        <a href="{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}">{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }} </a>
                                        <input disabled type="file" name="lampiran[permohonan ijin kegiatan]"
                                            id="lampiran_permohonan" class="form-control"
                                            accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold text-dark" for="role_id">TOR (PDF)<span
                                                class="text-danger">*</span></label>
                                        <p>
                                            Format surat TOR dapat di download disini (link) Form perubahan dapat di
                                            download disini (link) <a href="{{ url('/template/template-tor.doc') }}"
                                                target="_blank">{{ url('/template/template-tor.doc') }}</a>
                                        </p>
                                        <input type="file" required name="lampiran[tor]" class="form-control"
                                            accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold text-dark" for="role_id">RAB<span
                                                class="text-danger">*</span></label>
                                        <p>
                                            Format surat TOR dapat di download disini (link) Form perubahan dapat di
                                            download disini (link) <a href="{{ url('/template/template-rab.xlsx') }}"
                                                target="_blank">{{ url('/template/template-rab.xlsx') }}</a>
                                        </p>
                                        <input type="file" required name="lampiran[rab]" class="form-control"
                                            accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>

                                    <button type="button" class="btn btn-outline-primary" onclick="addExtraFile(2)"> <i
                                            class="fas fa-plus-circle"></i>&nbsp; Tambah Dokumen</button>
                                    <div class="col-12 mb-2 mt-3" id="question-2-extra-file"></div>
                                </div>
                        <!-- Pertanyaan 3 --> <!-- file -->
                                <div id="question-3" class="question" style="display: none">
                                    <div class="form-group mb-4">
                                        <label class="text-dark mb-2 fw-bold" for="lampiran_undangan">Surat Permohonan dari Mitra (PDF)</label>
                                        <br>
                                        <input disabled type="file" name="lampiran[permohonan dari mitra]" id="lampiran_undangan"
                                            class="form-control" accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-dark mb-2 fw-bold" for="lampiran_permohonan">Surat permohonan ijin kegiatan (PDF)<span class="text-danger"></span></label>
                                        <br>
                                        Format surat permohonan ijin kegiatan dapat di download disini (link) Form perubahan
                                        dapat di download disini (link)
                                        <a href="{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}">{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }} </a>
                                        <input disabled type="file" name="lampiran[permohonan ijin kegiatan]"
                                            id="lampiran_permohonan" class="form-control"
                                            accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold text-dark" for="role_id">TOR (PDF)<span
                                                class="text-danger">*</span></label>
                                        <p>
                                            Format surat TOR dapat di download disini (link) Form perubahan dapat di
                                            download disini (link) <a href="{{ url('/template/template-tor.doc') }}"
                                                target="_blank">{{ url('/template/template-tor.doc') }}</a>
                                        </p>
                                        <input type="file" required name="lampiran[tor]" class="form-control"
                                            accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold text-dark" for="role_id">RAB<span
                                                class="text-danger">*</span></label>
                                        <p>
                                            Format surat TOR dapat di download disini (link) Form perubahan dapat di
                                            download disini (link) <a href="{{ url('/template/template-rab.xlsx') }}"
                                                target="_blank">{{ url('/template/template-rab.xlsx') }}</a>
                                        </p>
                                        <input type="file" required name="lampiran[rab]" class="form-control"
                                            accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>

                                    <button type="button" class="btn btn-outline-primary" onclick="addExtraFile(3)"> <i
                                            class="fas fa-plus-circle"></i>&nbsp; Tambah Dokumen</button>
                                    <div class="col-12 mb-2 mt-3" id="question-3-extra-file"></div>
                                </div>
                        <!-- Pertanyaan 4  --> 
                                <div id="question-4" class="question" style="display: none">
                                    <div class="form-group mb-4">
                                        <label class="text-dark mb-2 fw-bold" for="lampiran_undangan">Surat Permohonan dari Mitra (PDF)</label>
                                        <br>
                                        <input disabled type="file" name="lampiran[permohonan dari mitra]" id="lampiran_undangan"
                                            class="form-control" accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="text-dark mb-2 fw-bold" for="lampiran_permohonan">Surat permohonan
                                            ijin kegiatan (PDF)<span class="text-danger">*</span></label>
                                        <br>
                                        Format surat permohonan ijin kegiatan dapat di download disini (link) Form perubahan
                                        dapat di download disini (link) <a
                                            href="{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}">{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}
                                        </a>
                                        <input disabled type="file" required name="lampiran[permohonan ijin kegiatan]"
                                            id="lampiran_permohonan" class="form-control required"
                                            accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold text-dark" for="role_id">TOR (PDF)<span
                                                class="text-danger">*</span></label>
                                        <p>
                                            Format surat TOR dapat di download disini (link) Form perubahan dapat di
                                            download disini (link) <a href="{{ url('/template/template-tor.doc') }}"
                                                target="_blank">{{ url('/template/template-tor.doc') }}</a>
                                        </p>
                                        <input type="file" required name="lampiran[tor]" class="form-control"
                                            accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold text-dark" for="role_id">RAB<span
                                                class="text-danger">*</span></label>
                                        <p>
                                            Format surat TOR dapat di download disini (link) Form perubahan dapat di
                                            download disini (link) <a href="{{ url('/template/template-rab.xlsx') }}"
                                                target="_blank">{{ url('/template/template-rab.xlsx') }}</a>
                                        </p>
                                        <input type="file" required name="lampiran[rab]" class="form-control"
                                            accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>

                                    <button type="button" class="btn btn-outline-primary" onclick="addExtraFile(4)"> <i
                                            class="fas fa-plus-circle"></i>&nbsp; Tambah Dokumen</button>
                                    <div class="col-12 mb-2 mt-3" id="question-4-extra-file"></div>
                                </div>
                            </div>

                            <div id="form2" style="display:none">
                                <p class="text-danger">Kategori yang anda pilih belum tersedia pada unit ini</p>
                            </div>

                            <div class="form-group mt-5">
                                <button type="submit" id="submitButton" class="btn btn-success">Submit</button>
                            </div>
                        </section>
                    </form>
                </div>
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
    <style>
        .note-editable {
            font-family: 'Nunito'
        }

        .wizard-content .actions.clearfix {
            display: none !important;
        }

        .btn-success {
            background-color: #018797;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #00616C;
            color: #fff; 
            cursor: pointer;
        }
        #submitButton:disabled {
            background-color: #00616C !important; 
            cursor: not-allowed; 
            border-color: #00616C; 
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
                headerTag: "h6",
                bodyTag: "section",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#',
                labels: {
                    finish: "Submit",
                },
                onStepChanging: function(event, currentIndex, newIndex) {
                    // return (
                    //     currentIndex > newIndex ||
                    //     ( !(3 === newIndex && Number($("#age-2").val()) < 18) &&
                    //         (currentIndex < newIndex && (
                    //                 form.find(".body:eq(" + newIndex + ") label.error").remove(),
                    //                 form.find(".body:eq(" + newIndex + ") .error").removeClass("error")
                    //             ),
                    //             (form.validate().settings.ignore = ":disabled,:hidden"),
                    //             form.valid()
                    //         )
                    //     )
                    // );
                },
                onFinishing: function(event, currentIndex) {
                    // return (form.validate().settings.ignore = ":disabled"), form.valid();
                },
                onFinished: function(event, currentIndex) {
                    // alert('Form Submitted.')
                    // swal(
                    //     "Form Submitted!",
                    //     "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed."
                    // );
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
            });
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
                        tempCat = ['Jasa', 'Pelatihan', 'Inovasi', 'Produk']
                        let options = '';
                        $.each(data, function(key, val) {
                            options += `<option value="${val.id}">${val.name}</option>`;
                            $.each(tempCat, function(tKey, tVal) {
                                if (tVal == val.name) {
                                    tempCat[tKey] = ""
                                }
                            })
                        });
                        $.each(tempCat, function(key, val) {
                            if (val != '') {
                                options += `<option value="0">${val}</option>`;
                            }
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
                if ($("#category").val() != 0) {
                    console.log($("#category").val())
                    $("#form1").show()
                    $("#form2").hide()
                    $.get("{{ url('/api/activity') }}/" + $("#category").val() + "/" + $("#unit").val())
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
                    console.log("here")
                    $("#form1").hide()
                    $("#form2").show()
                }
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

        function updateFormattedValue(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            
            let formattedValue = '';
            if (value) {
                formattedValue = 'Rp. ' + parseInt(value).toLocaleString('id-ID'); // Format sebagai ID
            }
            
            document.getElementById('formattedValue').innerText = formattedValue;
            
            input.value = value;
        }

        function validateInput(inputElement) {
            const maxLimit = 10 ** 13;
            const validationMessageElement = document.getElementById("validationMessage");
            const submitButton = document.getElementById("submitButton");

            const value = parseInt(inputElement.value, 10);

            if (value > maxLimit) {
                validationMessageElement.textContent = "Nominal tidak bisa lebih dari Rp." + maxLimit.toLocaleString();
                inputElement.value = maxLimit;
                submitButton.disabled = true;
            } else {
                validationMessageElement.textContent = ""; 
                submitButton.disabled = false;
            }
        }
    </script>
@endsection
