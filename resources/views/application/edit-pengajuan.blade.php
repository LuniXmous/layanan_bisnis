{{-- STEP 1 --}}
<h6>Form Pengajuan</h6>
<section class="mb-3">
    <div class="row">
        <div class="col">
            <div class="form-group mb-3">
                <label class="mb-2 fw-bold text-dark text-capitalize">Unit <span class="text-danger">*</span></label>
                <input type="text" disabled class="form-control" value="{{ $application->activity->unit->name }}">
            </div>
        </div>
        <div class="col">
            <div class="form-group mb-3">
                <label class="mb-2 fw-bold text-dark text-capitalize">Kategori <span
                        class="text-danger">*</span></label>
                <input type="text" disabled class="form-control"
                    value="{{ $application->activity->category->name }}">
            </div>
        </div>
        <div class="col">
            <div class="form-group mb-3">
                <label class="mb-2 fw-bold text-dark text-capitalize">Aktivitas <span
                        class="text-danger">*</span></label>
                <input type="text" disabled class="form-control" value="{{ $application->activity->name }}">
            </div>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="mb-2 fw-bold text-dark text-capitalize" for="title"> Judul Permohonan <span
                class="text-danger">*</span></label>
        <input type="text" placeholder="Permohonan menjadi narasumber di ….. pada tanggal ……." name="title"
            id="title" class="form-control required" value="{{ $application->title }}" required>
    </div>
    <div class="form-group mb-3">
        <label class="mb-2 fw-bold text-dark" for="summernote">Deskripsi Permohonan <span
                class="text-danger">*</span></label>
        <br>
        <textarea name="desc" id="summernote" class="form-control required" rows="3" required>{{ $application->description }}</textarea>
    </div>
        <!-- pengajuan ke 1 jasa -->
    @if ($application->activity->category->id == 1)
        <div id="question-e76240de-80c2-4094-99be-b7783421b9a3" class="question">
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Surat Undangan (PDF)</label>
                <br>
                @php
                    $docPU = $application->document->where('type', 'undangan')->first();
                @endphp
                @if($docPU)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docPU->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen Permohonan dari Mitra sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text"><strong>Dokumen sebelumnya:</strong> Tidak ada dokumen "undangan" yang anda ajukan sebelumnya.</p>
                @endif
                <input type="file" name="lampiran[undangan]" id="lampiran_undangan" class="form-control"
                    accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Surat Permohonan Ijin Kegiatan (PDF)</label>
                <br>
                Format surat permohonan ijin kegiatan dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}"
                target="_blank">{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}</a>
                @php
                    $docPIK = $application->document->where('type', 'permohonan ijin kegiatan')->first();
                @endphp
                @if($docPIK)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docPIK->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen Permohonan ijin kegiatan sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text"><strong>Dokumen sebelumnya:</strong> Tidak ada dokumen "Surat permohonan ijin kegiatan" yang anda ajukan sebelumnya.</p>
                @endif
                <input type="file" name="lampiran[permohonan ijin kegiatan]" id="lampiran_permohonan"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Dokumen TOR (PDF)</label>
                <br>
                Format TOR dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-tor.doc') }}"
                    target="_blank">{{ url('/template/template-tor.doc') }}</a>
                @php
                    $docTOR = $application->document->where('type', 'tor')->first();
                @endphp
                @if($docTOR)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docTOR->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen TOR sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text"><strong>Dokumen sebelumnya:</strong> Tidak ada dokumen "TOR" yang anda ajukan sebelumnya.</p>
                @endif
                <input type="file" name="lampiran[tor]" id="lampiran_tor"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Dokumen RAB (PDF)</label>
                <br>
                Format RAB dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-rab.xlsx') }}"
                    target="_blank">{{ url('/template/template-rab.xlsx') }}</a>
                @php
                    $docRAB = $application->document->where('type', 'rab')->first();
                @endphp
                @if($docRAB)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docRAB->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen RAB sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text"><strong>Dokumen sebelumnya:</strong> Tidak ada dokumen "RAB" yang anda ajukan sebelumnya.</p>
                @endif
                <input type="file" name="lampiran[rab]" id="lampiran_rab"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <button type="button" class="btn btn-outline-primary" onclick="addExtraFile(1)"> <i
                    class="fas fa-plus-circle"></i>&nbsp; Tambah Dokumen</button>
            <div class="col-12 mb-2 mt-3" id="question-1-extra-file">
                @foreach ($application->document->where('type', 'lainnya') as $file)
                    <div class="d-flex document mb-2" data-number="{{ $loop->index + 1 }}">
                        <div class="pt-3">
                            <button type="button" class="btn btn-outline-danger" onclick="removeThis(this)"> <i
                                    class="fas fa-times-circle"></i></button>
                        </div>
                        <div class="ms-4 col-10">
                            <div class="row">
                                <div class="col-12">
                                    <strong>Dokumen sebelumnya:</strong>
                                    <span role="button" id="document-lampiran"
                                            class="ms-2 text-capitalize fw-bold text-primary"
                                            data-type="{{ $file->ext }}"
                                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($file->file)) }}"><i
                                            class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} sebelumnya
                                    </span>
                                </div>
                                <div class="col-3">
                                    <input type="hidden" value="{{ $file->id }}"
                                        name="lampiran[lainnya][{{ $loop->index + 1 }}][i]" class="form-control"
                                        readonly>
                                    <input type="text" value="{{ $file->title }}"
                                        name="lampiran[lainnya][{{ $loop->index + 1 }}][title]" class="form-control"
                                        placeholder="Judul Dokumen">
                                </div>
                                <div class="col-9">
                                    <input type="file" value=""
                                        name="lampiran[lainnya][{{ $loop->index + 1 }}][document]"
                                        class="form-control" placeholder="Dokumen" accept="application/pdf" />
                                    <small class="text-muted">Format file harus berupa PDF</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- pengajuan ke 2 Pelatihan -->
    @elseif ($application->activity->category->id == 2) 
        <div id="question-5d99567c-e2d9-4e48-8e77-85bee1a755de" class="question">
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Surat Permohonan dari Mitra (PDF)</label>
                @php
                    $docPM = $application->document->where('type', 'permohonan dari mitra')->first();
                @endphp
                @if($docPM)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docPM->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen Permohonan dari Mitra sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text">Tidak ada dokumen "permohonan dari mitra" yang anda ajukan.</p>
                @endif
                <input type="file" name="lampiran[permohonan dari mitra]" id="lampiran_undangan" class="form-control"
                    accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="text-dark mb-2 fw-bold" for="lampiran_permohonan">Surat Permohonan Ijin Kegiatan (PDF)</label>
                <br>
                Format surat permohonan ijin kegiatan dapat di-download disini:
                <a href="{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}" target="_blank">
                    {{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}
                </a>
                @php
                    $docPIK = $application->document->where('type', 'permohonan ijin kegiatan')->first();
                @endphp
                @if($docPIK)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docPIK->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen TOR sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text">Tidak ada dokumen "permohonan dari mitra" yang anda ajukan.</p>
                @endif
                <input type="file" name="lampiran[permohonan ijin kegiatan]" id="lampiran_permohonan"
                    class="form-control mt-2" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="text-dark mb-2 fw-bold" for="tor">TOR (PDF)</label>
                <br>
                Format TOR dapat di-download disini:
                <a href="{{ url('/template/template-tor.doc') }}"target="_blank">{{ url('/template/template-tor.doc') }}</a>
                @php
                    $docTOR = $application->document->where('type', 'tor')->first();
                @endphp
                @if($docTOR)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docTOR->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen TOR sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text">Tidak ada dokumen "TOR" yang anda ajukan.</p>
                @endif
                <input type="file" name="lampiran[tor]" id="lampiran_tor"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">RAB (PDF)</label>
                <br>
                Format RAB dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-rab.xlsx') }}"
                    target="_blank">{{ url('/template/template-rab.xlsx') }}</a>
                @php
                    $docRAB = $application->document->where('type', 'rab')->first();
                @endphp
                @if($docRAB)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docRAB->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen RAB sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text">Tidak ada dokumen "RAB" yang anda ajukan.</p>
                @endif
                <input type="file" name="lampiran[rab]" id="lampiran_rab"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>

            <button type="button" class="btn btn-outline-primary" onclick="addExtraFile(2)"> <i
                    class="fas fa-plus-circle"></i>&nbsp; Tambah Dokumen</button>
            <div class="col-12 mb-2 mt-3" id="question-2-extra-file">
                @foreach ($application->document->where('type', 'lainnya') as $file)
                    <div class="d-flex document mb-2" data-number="{{ $loop->index + 1 }}">
                        <div class="pt-3">
                            <button type="button" class="btn btn-outline-danger" onclick="removeThis(this)"> <i
                                    class="fas fa-times-circle"></i></button>
                        </div>
                        <div class="ms-4 col-10">
                            <div class="row">
                            <div class="col-12">
                                    <strong>Dokumen sebelumnya:</strong>
                                    <span role="button" id="document-lampiran"
                                            class="ms-2 text-capitalize fw-bold text-primary"
                                            data-type="{{ $file->ext }}"
                                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($file->file)) }}"><i
                                            class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} sebelumnya
                                    </span>
                                </div>
                                <div class="col-3">
                                    <input type="hidden" value="{{ $file->id }}"
                                        name="lampiran[lainnya][{{ $loop->index + 1 }}][i]" class="form-control"
                                        readonly>
                                    <input type="text" value="{{ $file->title }}"
                                        name="lampiran[lainnya][{{ $loop->index + 1 }}][title]" class="form-control"
                                        placeholder="Judul Dokumen">
                                </div>
                                <div class="col-9">
                                    <input type="file" value=""
                                        name="lampiran[lainnya][{{ $loop->index + 1 }}][document]"
                                        class="form-control" placeholder="Dokumen" accept="application/pdf" />
                                    <small class="text-muted">Format file harus berupa PDF</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    <!-- pengajuan ke 3 inovasi-->
    @elseif ($application->activity->category->id == 3)
        <div id="question-64abcd6b-af85-47a4-8b0a-c690fe36625f" class="question">
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti Surat Permohonan dari Mitra (PDF)</label>
                <br>
                @php
                    $docPM = $application->document->where('type', 'permohonan dari mitra')->first();
                @endphp
                @if($docPM)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docPM->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen Permohonan dari Mitra sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text">Tidak ada dokumen "permohonan dari mitra" yang anda ajukan.</p>
                @endif
                <input type="file" name="lampiran[permohonan dari mitra]" id="lampiran_undangan" class="form-control"
                    accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti Surat Permohonan Ijin Kegiatan (PDF)</label>
                <br>
                Format surat permohonan ijin kegiatan dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}"
                    target="_blank">{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}</a>
                @php
                    $docPIK = $application->document->where('type', 'permohonan ijin kegiatan')->first();
                @endphp
                @if($docPIK)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docPIK->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen Permohonan ijin kegiatan sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text">Tidak ada dokumen "permohonan ijin kegiatan" yang anda ajukan.</p>
                @endif
                <input type="file" name="lampiran[permohonan ijin kegiatan]" id="lampiran_permohonan"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Dokumen TOR (PDF)</label>
                <br>
                Format TOR dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-tor.doc') }}"
                    target="_blank">{{ url('/template/template-tor.doc') }}</a>
                @php
                    $docTOR = $application->document->where('type', 'tor')->first();
                @endphp
                @if($docTOR)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docTOR->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen TOR sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text">Tidak ada dokumen "TOR" yang anda ajukan.</p>
                @endif
                <input type="file" name="lampiran[tor]" id="lampiran_tor"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Dokumen RAB (PDF)</label>
                <br>
                Format RAB dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-rab.xlsx') }}"
                    target="_blank">{{ url('/template/template-rab.xlsx') }}</a>
                @php
                    $docRAB = $application->document->where('type', 'rab')->first();
                @endphp
                @if($docRAB)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docRAB->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen RAB sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text">Tidak ada dokumen "RAB" yang anda ajukan.</p>
                @endif
                <input type="file" name="lampiran[rab]" id="lampiran_rab"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>

            <button type="button" class="btn btn-outline-primary" onclick="addExtraFile(3)"> <i
                    class="fas fa-plus-circle"></i>&nbsp; Tambah Dokumen</button>
            <div class="col-12 mb-2 mt-3" id="question-3-extra-file">
                @foreach ($application->document->where('type', 'lainnya') as $file)
                    <div class="d-flex document mb-2" data-number="{{ $loop->index + 1 }}">
                        <div class="pt-3">
                            <button type="button" class="btn btn-outline-danger" onclick="removeThis(this)"> <i
                                    class="fas fa-times-circle"></i></button>
                        </div>
                        <div class="ms-4 col-10">
                            <div class="row">
                                <div class="col-12">
                                    <strong>Dokumen sebelumnya:</strong> 
                                    <span role="button" id="document-lampiran"
                                            class="ms-2 text-capitalize fw-bold text-primary"
                                            data-type="{{ $file->ext }}"
                                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($file->file)) }}"><i
                                            class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} sebelumnya
                                    </span>
                                </div>
                                <div class="col-3">
                                    <input type="hidden" value="{{ $file->id }}"
                                        name="lampiran[lainnya][{{ $loop->index + 1 }}][i]" class="form-control"
                                        readonly>
                                    <input type="text" value="{{ $file->title }}"
                                        name="lampiran[lainnya][{{ $loop->index + 1 }}][title]" class="form-control"
                                        placeholder="Judul Dokumen">
                                </div>
                                <div class="col-9">
                                    <input type="file" value=""
                                        name="lampiran[lainnya][{{ $loop->index + 1 }}][document]"
                                        class="form-control" placeholder="Dokumen" accept="application/pdf" />
                                    <small class="text-muted">Format file harus berupa PDF</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- pengajuan ke 4 produk-->
    @elseif ($application->activity->category->id == 4)
        <div id="question-0c8ed87c-bede-429c-b64e-b1f6145be72a" class="question">
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti Surat Permohonan dari Mitra (PDF)</label>
                <br>
                @php
                    $docPM = $application->document->where('type', 'permohonan dari mitra')->first();
                @endphp
                @if($docPM)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docPM->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen Permohonan dari Mitra sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text">Tidak ada dokumen "permohonan dari mitra" yang anda ajukan.</p>
                @endif
                <input type="file" name="lampiran[permohonan dari mitra]" id="lampiran_undangan" class="form-control"
                    accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti Surat Permohonan Ijin Kegiatan (PDF)</label>
                <br>
                Format surat permohonan ijin kegiatan dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}"
                    target="_blank">{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}</a>
                @php
                    $docPIK = $application->document->where('type', 'permohonan ijin kegiatan')->first();
                @endphp
                @if($docPIK)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docPIK->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen Permohonan ijin kegiatan sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text">Tidak ada dokumen "permohonan ijin kegiatan" yang anda ajukan.</p>
                @endif
                <input type="file" name="lampiran[permohonan ijin kegiatan]" id="lampiran_permohonan"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti TOR (PDF)</label>
                <br>
                Format TOR dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-tor.doc') }}"
                    target="_blank">{{ url('/template/template-tor.doc') }}</a>
                @php
                    $docTOR = $application->document->where('type', 'tor')->first();
                @endphp
                @if($docTOR)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docTOR->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen TOR sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text">Tidak ada dokumen "TOR" yang anda ajukan.</p>
                @endif
                <input type="file" name="lampiran[tor]" id="lampiran_tor"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti RAB (PDF)</label>
                <br>
                Format RAB dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-rab.xlsx') }}"
                    target="_blank">{{ url('/template/template-rab.xlsx') }}</a>
                @php
                    $docRAB = $application->document->where('type', 'rab')->first();
                @endphp
                @if($docRAB)
                    <div class="mt-2">
                        <strong>Dokumen sebelumnya:</strong>
                        <span role="button" id="document-lampiran"
                            class="ms-2 text-capitalize fw-bold text-primary"
                            data-type="doc"
                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($docRAB->file)) }}">
                            <i class="fas fa-file-pdf"></i>&nbsp; Dokumen RAB sebelumnya
                        </span>
                    </div>
                @else
                    <p class="text">Tidak ada dokumen "RAB" yang anda ajukan.</p>
                @endif
                <input type="file" name="lampiran[rab]" id="lampiran_rab"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>

            <button type="button" class="btn btn-outline-primary" onclick="addExtraFile(4)"> <i
                    class="fas fa-plus-circle"></i>&nbsp; Tambah Dokumen</button>
            <div class="col-12 mb-2 mt-3" id="question-4-extra-file">
                @foreach ($application->document->where('type', 'lainnya') as $file)
                    <div class="d-flex document mb-2" data-number="{{ $loop->index + 1 }}">
                        <div class="pt-3">
                            <button type="button" class="btn btn-outline-danger" onclick="removeThis(this)"> <i
                                    class="fas fa-times-circle"></i></button>
                        </div>
                        <div class="ms-4 col-10">
                            <div class="row">
                                <div class="col-12">
                                    <strong>Dokumen sebelumnya:</strong> 
                                    <span role="button" id="document-lampiran"
                                            class="ms-2 text-capitalize fw-bold text-primary"
                                            data-type="{{ $file->ext }}"
                                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($file->file)) }}"><i
                                            class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} sebelumnya
                                    </span>
                                </div>
                                <div class="col-3">
                                    <input type="hidden" required value="{{ $file->title }}"
                                        name="lampiran[lainnya][{{ $loop->index + 1 }}][i]"
                                        class="form-control required" readonly>
                                    <input type="text" required value="{{ $file->title }}"
                                        name="lampiran[lainnya][{{ $loop->index + 1 }}][title]"
                                        class="form-control required" placeholder="Judul Dokumen">
                                </div>
                                <div class="col-9">
                                    <input type="file" required value=""
                                        name="lampiran[lainnya][{{ $loop->index + 1 }}][document]"
                                        class="form-control required" placeholder="Dokumen"
                                        accept="application/pdf" />
                                    <small class="text-muted">Format file harus berupa PDF</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>
