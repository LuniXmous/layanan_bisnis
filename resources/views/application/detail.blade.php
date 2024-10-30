@extends('layouts.app')
@section('page-title', 'Pengajuan Kegiatan')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-0">
                        <span class="fw-bold">Status Pengajuan </span>
                        <span class="badge {{ $application->statusAlias()['class'] }}">
                        {{ $application->statusAlias()['status'] }} </span>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-12" style="text-align: center; position: relative;">
            <div class="card shadow-sm border mb-3">
                <div class="card-body">
                    <!-- Flexbox parent div -->
                    <div style="display: flex; justify-content: center; align-items: flex-start; position: relative; margin: 10px auto; padding: 0; width: 100%; max-width: 900px;">
                        @if($application->status == '1')
                            <!-- First block -->
                            <div style="display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
                                @if($application->approve_status == '1')   
                                <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #ffc107 ; margin-bottom: 10px;">
                                    <i class="fa-solid fa-user" style="color: #ffffff;font-size: 30px; margin: 10px;"></i>
                                </div>
                                @else($application->approve_status != '1')
                                <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797  ; margin-bottom: 10px;">
                                    <i class="fa-solid fa-user" style="color: #ffffff;font-size: 30px; margin: 10px;"></i>
                                </div>
                                @endif
                                <h6>Review Admin Layanan Bisnis</h6>
                                @if($application->approve_status == '1')    
                                    <p style="font-size: 17px; text-align: center;">{{ $application->statusAlias()['status'] }}</p>
                                    <p style="font-size: 15px; text-align: center;">{{ $application->updated_at }}</p>
                                @else($application->approve_status != '1')
                                    <p style="font-size: 17px; text-align: center;">Telah Direview Admin</p>
                                    @foreach ($submissionLogs as $log )
                                        {{ $log->created_at }}
                                        &nbsp;
                                    @endforeach 
                                @endif
                            </div>
                            <hr style="flex: 1; border: none; border-top: 2px solid #018797; margin: 20px 10px;">
                            
                            <!-- Second block -->
                            <div style="display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
                                @if($application->approve_status == '2')   
                                <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #ffc107 ; margin-bottom: 10px;">
                                    <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                </div>
                                @else($application->approve_status != '2')
                                <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797  ; margin-bottom: 10px;">
                                    <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                </div>
                                @endif
                                <h6>Review Wakil Direktur 4</h6>
                                @if($application->approve_status == '2')
                                    <p style="font-size: 17px; text-align: center;">{{ $application->statusAlias()['status'] }}</p>
                                    <p style="font-size: 15px; text-align: center;">{{ $application->updated_at }}</p>
                                @elseif($application->approve_status == '4')
                                    <p style="font-size: 17px; text-align: center;">    
                                    @foreach ($submissionLogs as $log )
                                        Telah Direview  {{ $log->user->name }} <br>
                                        {{ $log->created_at }}
                                        &nbsp;
                                    @endforeach
                                    </p>
                                @else($application->approve_status == '1')
                                    <p style="display: none;"></p>          
                                @endif
                            </div>
                            <hr style="flex: 1; border: none; border-top: 2px solid #018797; margin: 20px 10px;">

                            <!-- Third block -->
                            <div style="display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
                                @if($application->approve_status == '4')   
                                <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #198754 ; margin-bottom: 10px;">
                                    <i class="fa-solid fa-user-check" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                </div>
                                @else($application->approve_status != '4')
                                <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797  ; margin-bottom: 10px;">
                                    <i class="fa-solid fa-user-check" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                </div>
                                @endif
                                <h6>Selesai Di Review</h6>
                                @if($application->approve_status == '4')
                                    <p style="font-size: 17px; text-align: center;">Telah Selesai Di Review</p>
                                    <p style="font-size: 14px; text-align: center;">{{ $application->updated_at }}</p>
                                @else($application->approve_status != '4')
                                    <p style="font-size: 14px; text-align: center; display: none;">Telah Selesai Di Review</p>
                                @endif
                            </div>
                        @else {{-- jika status != 1 --}}
                            <div style="display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
                                <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797  ; margin-bottom: 10px;">
                                    <i class="fa-solid fa-user" style="color: #ffffff;font-size: 30px; margin: 10px;"></i>
                                </div>
                                <h6>Review Admin Layanan Bisnis</h6>
                            </div>
                                <hr style="flex: 1; border: none; border-top: 2px solid #018797; margin: 20px 10px;">
                            <div style="display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
                                <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797  ; margin-bottom: 10px;">
                                    <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                </div>
                                <h6>Review Admin Layanan Bisnis</h6>
                            </div>
                                <hr style="flex: 1; border: none; border-top: 2px solid #018797; margin: 20px 10px;">
                            <div style="display: flex; flex-direction: column; align-items: center; margin-right: 20px;">
                                <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #198754 ; margin-bottom: 10px;">
                                    <i class="fa-solid fa-user-check" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                </div>
                                <h6>Review Admin Layanan Bisnis</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-8">
            <div class="card shadow-sm border mb-4">
                @if ($application->note)
                    <div class="card-header border-bottom" style="background-color: rgba(220,53,69,0.3);">
                        <div class="card-title text-danger fw-bold">
                            <span class="text-dark h5">Catatan Perbaikan: </span>{{ $application->note }}
                        </div>
                    </div>
                @endif
                <div class="card-body pt-4 fs-6">
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
                                <span class="fw-bold h6">Unit yang Diajukan: </span> &nbsp;
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
                            @foreach ($application->document->whereNotIn('type', ['lainnya', 'extra']) as $file)
                                <div class="mb-2">
                                    <span role="button" id="document-lampiran"
                                        class="ms-2 text-capitalize fw-bold text-primary"
                                        data-file="{{ asset('dokumen_bisnis/' . $file->file) }}"
                                        data-type="{{ $file->ext }}"><i class="fas fa-file-pdf"></i>&nbsp; Dokumen
                                        {{ $file->title }} 
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        @if ($application->document->where('type', 'lainnya')->count() > 0)
                            <div class="col-xl-6">
                                <div class="fw-bold h5">Lampiran Pendukung</div>
                                @foreach ($application->document->where('type', 'lainnya') as $file)
                                    <div class="mb-2">
                                        <span role="button" id="document-lampiran"
                                            class="ms-2 text-capitalize fw-bold text-primary"
                                            data-type="{{ $file->ext }}"
                                            data-file="{{ asset('dokumen_bisnis/' . $file->file) }}"><i
                                            class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} 
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if ($application->extra->where('type', 'dana')->first())
            <div class="col-xxl-8">
                @php
                    $extra = $application->extra->where('type', 'dana')->first();
                @endphp
                <div class="card shadow-sm border mb-4">
                    <div class="card-header border-bottom">
                        <div class="card-title h5 mb-0">Permohonan Pencairan Dana</div>
                    </div>
                    <div class="card-header border-bottom">
                    </div>
                    <div class="card-body pt-4 fs-6">
                        <div class="mb-3">
                            <span class="fw-bold h6">Judul Permohonan: </span> &nbsp; <br>
                            {{ $extra->title }}
                        </div>
                        <div class="mb-3">
                            <span class="fw-bold h6">Deskripsi Permohonan: </span> &nbsp; <br>
                            {!! $extra->description !!}
                        </div>
                        </div>
                        <div class="row border-top pt-4">
                            <div class="col-xxl-4 col-xl-6">
                              
                                @foreach ($rekapDana as $rekap)
                                    Total Transfer :{{ $rekap->nominal }}
                                    
                                @endforeach
                                <div class="fw-bold h5">Lampiran </div>
                                @foreach ($extra->document->whereNotIn('type', ['lainnya', 'extra']) as $file)
                                    <div class="mb-2">
                                        <span role="button" id="document-lampiran" data-type="{{ $file->ext }}"
                                            class="ms-2 text-capitalize fw-bold text-primary"
                                            data-file="{{ asset('dokumen_bisnis/' . $file->file) }}"><i
                                            class="fas fa-file"></i>&nbsp; Dokumen {{ $file->title }} 
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($application->extra->where('type', 'operasional')->first())
            <div class="col-xxl-8">
                @php
                    $extra = $application->extra->where('type', 'operasional')->first();
                @endphp
                <div class="card shadow-sm border mb-4">
                    <div class="card-header border-bottom">
                        <div class="card-title h5 mb-0">Permohonan Pencairan Dana Operasional</div>
                    </div>

                    <div class="card-body pt-4 fs-6">
                        <div class="mb-3">
                            <span class="fw-bold h6">Judul Permohonan: </span> &nbsp; <br>
                            {{ $extra->title }}
                        </div>
                        <div class="mb-3">
                            <span class="fw-bold h6">Deskripsi Permohonan: </span> &nbsp; <br>
                            {!! $extra->description !!}
                        </div>
                        <div class="row border-top pt-4">
                            <div class="col-xl-4">
                                <div class="fw-bold h5">Lampiran </div>
                                @foreach ($extra->document->whereNotIn('type', ['lainnya', 'extra']) as $file)
                                    <div class="mb-2">
                                        <span role="button" id="document-lampiran"
                                            class="ms-2 text-capitalize fw-bold text-primary"
                                            data-type="{{ $file->ext }}"
                                            data-file="{{ asset('dokumen_bisnis/' . $file->file) }}"><i
                                            class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} 
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($application->extra->where('type', 'kegiatan')->first())
            <div class="col-xxl-8">
                @php
                    $extra = $application->extra->where('type', 'kegiatan')->first();
                @endphp
                <div class="card shadow-sm border mb-4">
                    <div class="card-header border-bottom">
                        <div class="card-title h5 mb-0">
                            Pengajuan Pemberitahuan Kegiatan Selesai Dilaksanakan
                        </div>
                    </div>
                    <div class="card-body pt-4 fs-6">
                        <div class="mb-3">
                            <span class="fw-bold h6">Judul Permohonan: </span> &nbsp; <br>
                            {{ $extra->title }}
                        </div>
                        <div class="mb-3">
                            <span class="fw-bold h6">Deskripsi Permohonan: </span> &nbsp; <br>
                            {!! $extra->description !!}
                        </div>
                        <div class="row border-top pt-4">
                            <div class="col-xl-4">
                                <div class="fw-bold h5">Lampiran </div>
                                @foreach ($extra->document->whereNotIn('type', '!=', 'lainnya') as $file)
                                    <div class="mb-2">
                                        <span role="button" id="document-lampiran"
                                            class="ms-2 text-capitalize fw-bold text-primary"
                                            data-type="{{ $file->ext }}"
                                            data-file="{{ asset('dokumen_bisnis/' . $file->file) }}"><i
                                            class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ str_replace('lpj', 'Dokumentasi Kegiatan', $file->title) }} 
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($application->document->where('type', 'extra')->count() != 0)
            <div class="col-xxl-8">
                <div class="card shadow-sm border mb-4">
                    <div class="card-body fs-6">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="fw-bold h5">Lampiran Tambahan Penyetujuan</div>
                                @foreach ($application->document->where('type', 'extra') as $file)
                                    <div class="mb-2">
                                        <span role="button" id="document-lampiran"
                                            class="ms-2 text-capitalize fw-bold text-primary"
                                            data-type="{{ $file->ext }}"
                                            data-file="{{ asset('dokumen_bisnis/' . $file->file) }}"><i
                                            class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} 
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-xxl-8">
            <div class="card card-body border shadow-sm">
                <div class="d-flex">
                    <div class="ms-auto">
                        @if ($comment)
                            <a href="#" onclick="terimaPengajuan()" class="btn btn-primary">Terima Pengajuan</a>
                            <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal"
                                data-bs-target="#rejectModal">
                                Tolak Pengajuan
                            </button>
                        @endif
                        @if (Auth::user()->role_id == 1 && $extraApp != '' && $application->status != 4)
                            <a href="#" onclick="triggerPencairan()" class="btn btn-primary text-capitalize">Ajukan
                                {{ $extraApp }}</a>
                            <a href="{{ route('application.done', ['id' => $application->id]) }}"
                                class="btn btn-success">Selesai</a>
                        @endif
                        @if (
                            (Auth::user()->role_id == 1 && $application->status == 0) ||
                                (Auth::user()->role_id == 1 && $application->status >= 2 && $application->approve_status == 0))
                            <a href="{{ route('application.edit', ['id' => $application->id]) }}"
                                class="btn btn-primary">Perbaiki Pengajuan</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @if ($comment)
        <div class="modal fade" id="rejectModal" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Berikan Catatan Pengajuan <span class="text-danger">*</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('application.reject', ['id' => $application->id]) }}" method="POST">
                            @csrf
                            <textarea name="note" rows="10" required class="form-control"></textarea>
                            <br>
                            <input type="submit" name="submit" id="submit" class="btn btn-danger"
                                value="Tolak Pengajuan">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Auth::user()->role_id && $extraApp != '')
        <div class="modal fade" id="pencairanDanaModal" tabindex="-1" aria-labelledby="pencairanDanaModal"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $extraApp == 'Pengajuan Pemberitahuan Kegiatan Selesai Dilaksanakan' ? 'Ajukan' : 'Permohonan' }} {{ $extraApp }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('application.applyExtra', ['id' => $application->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="mb-2 fw-bold text-capitalize" for="role_id"> Judul {{ $extraApp == 'Pengajuan Pemberitahuan Kegiatan Selesai Dilaksanakan' ? 'Ajukan' : 'Permohonan' }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" placeholder="{{ $extraApp == 'Pengajuan Pemberitahuan Kegiatan Selesai Dilaksanakan' ? '...' : 'Permohonan pencairan dana untuk ....' }}" name="title"
                                    class="form-control" value="" required>
                            </div>
                            {{-- disini banyak casenya --}}
                            @if ($application->activity->category->id == 1)
                                <div class="form-group">
                                    <label class="mb-2 fw-bold text-capitalize" for="nominal">Nominal Jumlah Uang <span class="text-danger">*</span></label>
                                    <input type="hidden" name="extra_application_id" value="{{ $application->id }}">
                                    <input type="number" placeholder="Masukkan Nominal" name="nominal" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="mb-2 fw-bold" for="role_id">Bukti Transfer Mitra (File berupa Gambar/Screenshot)<span
                                            class="text-danger">*</span></label>
                                    <input type="file" required name="lampiran[transfer]" class="form-control"
                                        accept="image/*">
                                    <small class="text-muted">Format file harus berupa gambar</small>
                                </div>
                            @else
                                @if ($application->status == 1)
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">TOR (PDF)<span class="text-danger">*</span></label>
                                        <p>
                                            Format dokumen TOR dapat di download disini (link) Form perubahan dapat di download disini (link) <a href="{{ url('/template/template-tor.doc') }}" target="_blank">{{ url('/template/template-tor.doc') }}</a>
                                        </p>
                                        <input type="file" name="lampiran[tor]" required class="form-control required"
                                            accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">PKS (PDF)<span
                                                class="text-danger"></span></label>
                                        <p>
                                            Format surat PKS dapat di download disini (link) Form perubahan dapat di
                                            download disini (link) <a href="{{ url('/template/template-pks.docx') }}"
                                                target="_blank">{{ url('/template/template-pks.docx') }}</a>
                                        </p>
                                        <input type="file" name="lampiran[pks]" class="form-control"
                                            accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold text-capitalize" for="nominal">Nominal Jumlah Uang <span class="text-danger">*</span></label>
                                        <input type="hidden" name="extra_application_id" value="{{ $application->id }}">
                                        <input type="number" placeholder="Masukkan Nominal" name="nominal" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">Bukti Transfer Mitra (File berupa Gambar/Screenshot)<span
                                                class="text-danger">*</span></label>
                                        <input type="file" required name="lampiran[transfer]" class="form-control"
                                            accept="image/*">
                                        <small class="text-muted">Format file harus berupa gambar</small>
                                    </div>
                                @elseif($application->status == 2)
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">Dokumentasi Kegiatan (PDF)</label>
                                        {{-- <p>
                                            Format surat LPJ dapat di download disini (link) Form perubahan dapat di
                                            download disini (link) <a href="{{ url('/template/template-lpj.doc') }}"
                                                target="_blank">{{ url('/template/template-lpj.doc') }}</a>
                                        </p> --}}
                                        <input type="file" name="lampiran[dokumentasi kegiatan]" class="form-control"
                                        accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold text-capitalize" for="nominal">Nominal Jumlah Uang <span class="text-danger">*</span></label>
                                        <input type="hidden" name="extra_application_id" value="{{ $application->id }}">
                                        <input type="number" placeholder="Masukkan Nominal" name="nominal" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">Bukti Transfer Mitra (File berupa Gambar/Screenshot)<span
                                                class="text-danger">*</span></label>
                                        <input type="file" required name="lampiran[transfer]" class="form-control"
                                            accept="image/*">
                                        <small class="text-muted">Format file harus berupa gambar</small>
                                    </div>
                                @endif
                            @endif
                            <div class="form-group">
                                <label class="mb-2 fw-bold" for="role_id">Deskripsi Permohonan <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" id="summernote" class="form-control required" rows="3" required></textarea>
                            </div>
                            <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Ajukan">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
    @if (Auth::user()->role_id == 5 || Auth::user()->role_id == 0)
        <div class="modal fade" id="approve-modal" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <form action="{{ route('application.approveWithFile', ['id' => $application->id]) }}" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Terima Pengajuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <button type="button" class="btn btn-info text-dark" onclick="addExtraFile(4)">
                                <i class="fas fa-plus-circle"></i>&nbsp; Tambah Dokumen</button>
                            @csrf
                            <div class="col-12 mb-2 mt-3" id="question-4-extra-file"></div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" value="Terima Pengajuan" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/summernote.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/summernote/summernote-lite.css') }}" />
@endsection

@section('script')
    <script src="{{ asset('assets/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script>
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

        function addExtraFile(param) {
            target = $(`#question-${param}-extra-file`);
            let count = 1;
            if ($(`#question-${param}-extra-file .document:last-child`).data('number')) {
                count = $(`#question-${param}-extra-file .document:last-child`).data('number') + 1;
            }
            target.append(`
                <div class="d-flex document my-3" data-number="${count}">
                    <div>
                        <button type="button" class="btn btn-outline-danger" onclick="removeThis(this)"> <i class="fas fa-times-circle"></i></button>
                    </div>
                    <div class="ms-4 col-10">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" required name="lampiran[${count}][title]" class="form-control required" placeholder="Judul Dokumen">
                            </div>
                            <div class="col-9">
                                <input type="file" required name="lampiran[${count}][document]" class="form-control required" placeholder="Dokumen" accept="application/pdf" />
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


        function terimaPengajuan() {
            @if (Auth::user()->role_id == 5 || Auth::user()->role_id == 0 )
                $("#approve-modal").modal("toggle");
            @else
                $(location).prop('href', "{{ route('application.approve', ['id' => $application->id]) }}")
            @endif
        }

        function triggerPencairan() {
            $("#pencairanDanaModal").modal("toggle")
        }
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
    </script>
@endsection