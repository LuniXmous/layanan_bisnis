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

    @if ($application->activity->category->id == 1)
        <div id="question-e76240de-80c2-4094-99be-b7783421b9a3" class="question">
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti Surat Undangan (PDF) (<span role="button" id="document-lampiran"
                        class="ms-2 text-capitalize fw-bold text-primary {{ $application->document->where('type', 'undangan')->first() ? '' : 'd-none' }} "
                        data-type="doc"
                        data-file="{{ $application->document->where('type', 'undangan')->first() ? asset('dokumen_bisnis/' . $application->document->where('type', 'undangan')->first()->file) : '' }}"><i
                            class="fas fa-file-pdf"></i>&nbsp; Dokumen Surat Undangan </span>)</label>
                <br>
                <input type="file" name="lampiran[undangan]" id="lampiran_undangan" class="form-control"
                    accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti Surat Permohonan Ijin Kegiatan (PDF)(<span role="button"
                        id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary"
                        data-type="doc"
                        data-file="{{ asset('dokumen_bisnis/' . $application->document->where('type', 'permohonan ijin kegiatan')->first()->file) }}"><i
                            class="fas fa-file-pdf"></i>&nbsp; Dokumen Surat Permohonan Ijin Kegiatan</span>)</label>
                <br>
                Format surat permohonan ijin kegiatan dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}"
                    target="_blank">{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}</a>
                <input type="file" name="lampiran[permohonan ijin kegiatan]" id="lampiran_permohonan"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti TOR (PDF)(<span role="button" id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary" data-type="doc"
                        data-file="{{ asset('dokumen_bisnis/' . $application->document->where('type', 'tor')->first()->file) }}"><i class="fas fa-file-pdf"></i>&nbsp; Dokumen TOR</span>)</label>
                <br>
                Format TOR dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-tor.doc') }}"
                    target="_blank">{{ url('/template/template-tor.doc') }}</a>
                <input type="file" name="lampiran[tor]" id="lampiran_tor"
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
                                    (<span role="button" id="document-lampiran"
                                        class="ms-2 text-capitalize fw-bold text-primary"
                                        data-type="doc"
                                        data-file="{{ asset('dokumen_bisnis/' . $file->file) }}"><i
                                            class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} </span>)
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
    @elseif ($application->activity->category->id == 2)
        <div id="question-5d99567c-e2d9-4e48-8e77-85bee1a755de" class="question">
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti Surat Permohonan dari Mitra (PDF) (<span role="button"
                        id="document-lampiran"
                        class="ms-2 text-capitalize fw-bold text-primary {{ $application->document->where('type', 'permohonan dari mitra')->first() ? '' : 'd-none' }} "
                        data-type="doc"
                        data-file="{{ $application->document->where('type', 'permohonan dari mitra')->first() ? asset('dokumen_bisnis/' . $application->document->where('type', 'permohonan dari mitra')->first()->file) : '' }}"><i
                            class="fas fa-file-pdf"></i>&nbsp; Dokumen Surat Permohonan dari Mitra </span>)</label>
                <br>
                <input type="file" name="lampiran[permohonan dari mitra]" id="lampiran_undangan" class="form-control"
                    accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti Surat Permohonan Ijin Kegiatan (PDF) (<span role="button"
                        id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary"
                        data-type="doc"
                        data-file="{{ asset('dokumen_bisnis/' . $application->document->where('type', 'permohonan ijin kegiatan')->first()->file) }}"><i
                            class="fas fa-file-pdf"></i>&nbsp; Dokumen Surat Permohonan Ijin Kegiatan</span>)</label>
                <br>
                Format surat permohonan ijin kegiatan dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}"
                    target="_blank">{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}</a>
                <input type="file" name="lampiran[permohonan ijin kegiatan]" id="lampiran_permohonan"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>

            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti TOR (PDF)(<span role="button" id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary" data-type="doc"
                        data-file="{{ asset('dokumen_bisnis/' . $application->document->where('type', 'tor')->first()->file) }}"><i class="fas fa-file-pdf"></i>&nbsp; Dokumen TOR</span>)</label>
                <br>
                Format TOR dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-tor.doc') }}"
                    target="_blank">{{ url('/template/template-tor.doc') }}</a>
                <input type="file" name="lampiran[tor]" id="lampiran_tor"
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
                                    (<span role="button" id="document-lampiran"
                                        class="ms-2 text-capitalize fw-bold text-primary"
                                        data-type="doc"
                                        data-file="{{ asset('dokumen_bisnis/' . $file->file) }}"><i
                                            class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} </span>)
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
    @elseif ($application->activity->category->id == 3)
        <div id="question-64abcd6b-af85-47a4-8b0a-c690fe36625f" class="question">
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti Surat Permohonan dari Mitra (PDF) (<span role="button"
                        id="document-lampiran"
                        class="ms-2 text-capitalize fw-bold text-primary {{ $application->document->where('type', 'permohonan dari mitra')->first() ? '' : 'd-none' }} "
                        data-type="doc"
                        data-file="{{ $application->document->where('type', 'permohonan dari mitra')->first() ? asset('dokumen_bisnis/' . $application->document->where('type', 'permohonan dari mitra')->first()->file) : '' }}"><i
                            class="fas fa-file-pdf"></i>&nbsp; Dokumen Surat Permohonan dari Mitra </span>)</label>
                <br>
                <input type="file" name="lampiran[permohonan dari mitra]" id="lampiran_undangan" class="form-control"
                    accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti Surat Permohonan Ijin Kegiatan (PDF) (<span role="button"
                        id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary"
                        data-type="doc"
                        data-file="{{ asset('dokumen_bisnis/' . $application->document->where('type', 'permohonan ijin kegiatan')->first()->file) }}"><i
                            class="fas fa-file-pdf"></i>&nbsp; Dokumen Surat Permohonan Ijin Kegiatan</span>)</label>
                <br>
                Format surat permohonan ijin kegiatan dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}"
                    target="_blank">{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}</a>
                <input type="file" name="lampiran[permohonan ijin kegiatan]" id="lampiran_permohonan"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti TOR (PDF)(<span role="button" id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary" data-type="doc"
                        data-file="{{ asset('dokumen_bisnis/' . $application->document->where('type', 'tor')->first()->file) }}"><i class="fas fa-file-pdf"></i>&nbsp; Dokumen TOR</span>)</label>
                <br>
                Format TOR dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-tor.doc') }}"
                    target="_blank">{{ url('/template/template-tor.doc') }}</a>
                <input type="file" name="lampiran[tor]" id="lampiran_tor"
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
                                    (<span role="button" id="document-lampiran"
                                        class="ms-2 text-capitalize fw-bold text-primary"
                                        data-type="doc"
                                        data-file="{{ asset('dokumen_bisnis/' . $file->file) }}"><i
                                            class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} </span>)
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
    @elseif ($application->activity->category->id == 4)
        <div id="question-0c8ed87c-bede-429c-b64e-b1f6145be72a" class="question">
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti Surat Permohonan dari Mitra (PDF) (<span role="button"
                        id="document-lampiran"
                        class="ms-2 text-capitalize fw-bold text-primary {{ $application->document->where('type', 'permohonan dari mitra')->first() ? '' : 'd-none' }} "
                        data-type="doc"
                        data-file="{{ $application->document->where('type', 'permohonan dari mitra')->first() ? asset('dokumen_bisnis/' . $application->document->where('type', 'permohonan dari mitra')->first()->file) : '' }}"><i
                            class="fas fa-file-pdf"></i>&nbsp; Dokumen Surat Permohonan dari Mitra </span>)</label>
                <br>
                <input type="file" name="lampiran[permohonan dari mitra]" id="lampiran_undangan" class="form-control"
                    accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti Surat Permohonan Ijin Kegiatan (PDF) (<span role="button"
                        id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary"
                        data-type="doc"
                        data-file="{{ asset('dokumen_bisnis/' . $application->document->where('type', 'permohonan ijin kegiatan')->first()->file) }}"><i
                            class="fas fa-file-pdf"></i>&nbsp; Dokumen Surat Permohonan Ijin Kegiatan</span>)</label>
                <br>
                Format surat permohonan ijin kegiatan dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}"
                    target="_blank">{{ url('/template/template-surat-permohonan-ijin-kegiatan.docx') }}</a>
                <input type="file" name="lampiran[permohonan ijin kegiatan]" id="lampiran_permohonan"
                    class="form-control" accept="application/pdf">
                <small class="text-muted">Format file harus berupa PDF</small>
            </div>
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti TOR (PDF)(<span role="button" id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary" data-type="doc"
                        data-file="{{ asset('dokumen_bisnis/' . $application->document->where('type', 'tor')->first()->file) }}"><i class="fas fa-file-pdf"></i>&nbsp; Dokumen TOR</span>)</label>
                <br>
                Format TOR dapat di download disini (link) Form perubahan dapat di download
                disini (link) <a href="{{ url('/template/template-tor.doc') }}"
                    target="_blank">{{ url('/template/template-tor.doc') }}</a>
                <input type="file" name="lampiran[tor]" id="lampiran_tor"
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
                                    (<span role="button" id="document-lampiran"
                                        class="ms-2 text-capitalize fw-bold text-primary"
                                        data-type="doc"
                                        data-file="{{ asset('dokumen_bisnis/' . $file->file) }}"><i
                                            class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} </span>)
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
