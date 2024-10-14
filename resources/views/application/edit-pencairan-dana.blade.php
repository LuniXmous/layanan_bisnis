{{-- STEP 2 --}}
<h6>Form Pengajuan {{ $latestExtra->typeAlias() }}</h6>
<section class="mb-3">
    <div class="form-group mb-3">
        <label class="mb-2 fw-bold text-capitalize" for="title"> Judul Permohonan <span
                class="text-danger">*</span></label>
        <input type="text" placeholder="Permohonan menjadi narasumber di ….. pada tanggal ……." name="title"
            id="title" class="form-control required" value="{{ $latestExtra->title }}" required>
    </div>
    <div class="form-group mb-3">
        <label class="mb-2 fw-bold text-dark" for="summernote">Deskripsi Permohonan <span
                class="text-danger">*</span></label>
        <br>
        <textarea name="desc" id="summernote" class="form-control required" rows="3" required>{{ $latestExtra->description }}</textarea>
    </div>

    @if ($latestExtra->application->activity->category->id == 1)
        <div id="question-e76240de-80c2-4094-99be-b7783421b9a3" class="question">
            <div class="form-group mb-4">
                <label class="mb-2 fw-bold text-dark">Ganti Bukti Transfer (File berupa Gambar/Screenshot) (<span role="button" id="document-lampiran"
                        class="ms-2 text-capitalize fw-bold text-primary"
                        data-file="{{ asset('dokumen_bisnis/' . $latestExtra->document->where('type', 'transfer')->first()->file) }}"><i
                            class="fas fa-file"></i>&nbsp; Dokumen Bukti Transfer </span>)</label>
                <br>
                <input type="file" name="lampiran[transfer]" id="lampiran_transfer" class="form-control"
                    accept="image/*">
                <small class="text-muted">Format file harus berupa gambar/screenshot</small>
            </div>
        </div>
    @else
        @if ($latestExtra->application->status == 2)
            <div id="question-e76240de-80c2-4094-99be-b7783421b9a3" class="question">
                <div id="question-1" class="question">
                    <div class="form-group mb-4">
                        <label class="mb-2 fw-bold text-dark">
                            Ganti TOR (PDF)
                            @if ($latestExtra->document->where('type', 'tor')->first())
                                (<span role="button" id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary" data-type="doc"
                                    data-file="{{ asset('dokumen_bisnis/' . $latestExtra->document->where('type', 'tor')->first()->file) }}"><i
                                        class="fas fa-file"></i>&nbsp; Dokumen TOR </span>)
                            @endif
                        </label>
                        <br>
                        <input type="file" name="lampiran[tor]" id="lampiran_tor" class="form-control"
                            accept="application/pdf">
                        <small class="text-muted">Format file harus berupa pdf</small>
                    </div>
                    <div class="form-group">
                        @if ($latestExtra->document->where('type', 'pks')->first())
                        <label class="mb-2 fw-bold text-dark">Ganti Dokumen PKS (PDF) (<span role="button"
                                id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary" data-type="doc"
                                data-file="{{ asset('dokumen_bisnis/' . $latestExtra->document->where('type', 'pks')->first()->file) }}"><i
                                    class="fas fa-file-pdf"></i>&nbsp; Dokumen PKS </span>)</label>
                        @else
                        <label class="mb-2 fw-bold text-dark">Dokumen PKS (PDF)</label>
                        @endif
                        <p>
                            Format dokumen PKS dapat di download disini (link) Form perubahan dapat di download disini
                            (link) <a href="{{ url('/template/template-pks.docx') }}"
                                target="_blank">{{ url('/template/template-pks.docx') }}</a>
                        </p>
                        <input type="file" name="lampiran[pks]" id="lampiran_pks" class="form-control"
                            accept="application/pdf">
                        <small class="text-muted">Format file harus berupa PDF</small>
                    </div>
                    <div class="form-group mb-4">
                        <label class="mb-2 fw-bold text-dark">
                            Ganti Bukti Transfer (File gambar/screenshot)
                            (<span role="button" id="document-lampiran"
                                class="ms-2 text-capitalize fw-bold text-primary"
                                data-file="{{ asset('dokumen_bisnis/' . $latestExtra->document->where('type', 'transfer')->first()->file) }}"><i
                                    class="fas fa-file"></i>&nbsp; Dokumen Bukti Transfer </span>)
                        </label>
                        <br>
                        <input type="file" name="lampiran[transfer]" id="lampiran_transfer" class="form-control"
                            accept="image/*">
                        <small class="text-muted">Format file harus berupa gambar</small>
                    </div>
                </div>
            </div>
        @elseif($latestExtra->application->status == 3)
            <div id="question-e76240de-80c2-4094-99be-b7783421b9a3" class="question">
                <div id="question-e76240de-80c2-4094-99be-b7783421b9a3" class="question">
                    <div class="form-group mb-4">
                        @if ($latestExtra->document->where('type', 'dokumentasi kegiatan')->first())
                        <label class="mb-2 fw-bold text-dark">Ganti Dokumentasi Kegiatan (PDF)(<span role="button"
                                id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary" data-type="doc"
                                data-file="{{ asset('dokumen_bisnis/' . $latestExtra->document->where('type', 'dokumentasi kegiatan')->first()->file) }}"><i
                                    class="fas fa-file-pdf"></i>&nbsp; Dokumentasi Kegiatan </span>)</label>
                        @else
                        <label class="mb-2 fw-bold text-dark">Dokumentasi Kegiatan (PDF)</label>
                        @endif
                        <br>
                        {{-- Format surat undangan dapat di download disini (link) Form perubahan dapat di download disini
                        (link) <a
                            href="https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa"
                            target="_blank"><i class="fas fa-link"></i>
                            https://akademik.pnj.ac.id/readmore/6034a367608c075c5d7fa566/formulir-permintaan-perubahan-data-mahasiswa</a> --}}
                        <input type="file" name="lampiran[dokumentasi kegiatan]" id="lampiran_dokumentasi kegiatan" class="form-control"
                            accept="application/pdf">
                        <small class="text-muted">Format file harus berupa PDF</small>
                    </div>
                    <div class="form-group mb-4">
                        <label class="mb-2 fw-bold text-dark">Ganti Bukti Transfer (File gambar/screenshot) (<span role="button"
                                id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary"
                                data-file="{{ asset('dokumen_bisnis/' . $latestExtra->document->where('type', 'transfer')->first()->file) }}"><i
                                    class="fas fa-file"></i>&nbsp; Dokumen Bukti Transfer </span>)</label>
                        <br>
                        <input type="file" name="lampiran[transfer]" id="lampiran_transfer" class="form-control"
                            accept="image/*">
                        <small class="text-muted">Format file harus berupa gambar</small>
                    </div>
                </div>
            </div>
        @endif
    @endif
</section>
