<div class="row">
    <div class="col-xl-6">
        <div class="mb-3">
            <span class="fw-bold h6">Judul Permohonan: </span> &nbsp; <br>
            {{ $application->title }}
        </div>
        <div class="mb-3">
            <span class="fw-bold h6">Deskripsi Permohonan: </span> &nbsp; <br>
            {!! $application->description !!}
        </div>
    </div>
    <div class="col-xl-6">
        <div class="mb-3">
            <span class="fw-bold h6">Nama Pemohon: </span> &nbsp;
            {{ $application->user->name }}
        </div>
        <div class="mb-3">
            <span class="fw-bold h6">Email Pemohon: </span> &nbsp;
            {{ $application->user->email }}
        </div>
        <div class="mb-3">
            <span class="fw-bold h6">Unit/Jurusan yang Diajukan: </span> &nbsp;
            {{ $application->activity->unit->name }}
        </div>
        <div class="mb-3">
            <span class="fw-bold h6">Kategori: </span> &nbsp;
            {{ $application->activity->category->name }}
        </div>
        <div class="mb-3">
            <span class="fw-bold h6">Kegiatan: </span> &nbsp;
            {{ $application->activity->name }}
        </div>
    </div>
</div>
<div class="row border-top pt-4">
    <div class="col-xl-4">
        <div class="fw-bold h5">Lampiran </div>
        @foreach($application->document->where("type","!=","lainnya") as $file)
            <div class="mb-2">
                <span role="button" id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary" data-file="{{ asset('dokumen_bisnis/'.$file->file) }}"><i class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} </span>
            </div>
        @endforeach
    </div>
    @if ($application->document->where("type","lainnya")->count() > 0)
        <div class="col-xl-6">
            <div class="fw-bold h5">Lampiran Pendukung</div>
            @foreach($application->document->where("type","lainnya") as $file)
                <div class="mb-2">
                    <span role="button" id="document-lampiran" class="ms-2 text-capitalize fw-bold text-primary" data-file="{{ asset('dokumen_bisnis/'.$file->file) }}"><i class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} </span>
                </div>
            @endforeach
        </div>
    @endif
</div>
