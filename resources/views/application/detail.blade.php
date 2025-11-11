@extends('layouts.app')
@section('page-title', 'Pengajuan Kegiatan')
<style>
/* Responsive Status Timeline */
.status-timeline {
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-align: center;
}

.status-item {
    flex: 1;
    min-width: 0;
}

.status-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.status-icon i {
    color: #ffffff;
    font-size: 24px;
}

.status-title {
    margin-top: 13px;
    font-size: 14px;
    word-wrap: break-word;
}

.status-info {
    font-size: 12px;
}

.status-line {
    flex-grow: 1;
    height: 1px;
    background-color: #018797;
    margin: 10px 5px;
    margin-bottom: 4%;
}

/* Desktop - Default styling sudah ada di blade */

/* Tablet (768px ke bawah) */
@media (max-width: 768px) {
    /* Kurangi ukuran icon circle */
    .status-icon {
        width: 40px !important;
        height: 40px !important;
    }
    
    .status-icon i {
        font-size: 18px !important;
    }

    .status-info{
        font-size: 0.6rem;
    }

    .card-title .fw-bold {
        font-size: 0.9rem !important; 
    }
}

/* Mobile (576px ke bawah) */
@media (max-width: 576px) {
    /* Layout vertikal untuk mobile */
    .status-container {
        flex-direction: column !important;
        align-items: center !important;
    }
    
    .status-item {
        width: 100% !important;
        text-align: center !important;
        margin-bottom: 15px;
    }
    
    /* Icon lebih kecil */
    .status-icon {
        width: 35px !important;
        height: 35px !important;
    }
    
    .status-icon i {
        font-size: 16px !important;
    }
    
    /* Text lebih kecil */
    .status-title{
        font-size: 0.5rem !important;
        margin-top: 6px !important;
    }

    .status-title-alt{
        font-size: 0.3rem !important;
        margin-top: 6px !important;
    }

    .status-line{
        height: 1px;
    }

    .status-info{
        font-size: 0.4rem;
    }

    /* Padding card body */
    .card-body {
        padding: 15px 10px !important;
    }

    .card-title .fw-bold {
        font-size: 0.9rem !important; 
    }

    .badge{
        font-size: 11px !important;
        width: 330px !important;
    }

    .card-body span,
    .card-body div,
    .card-body p,
    .card-body .h6,
    .card-body .h5 {
        font-size: 0.6rem !important;
    }

   .btn {
        padding: 0.25rem 0.5rem !important; /* kecilkan padding */
        font-size: 0.5rem !important;        /* kecilkan teks */
        border-radius: 4px !important;       /* opsional: sudut lebih halus */
    }

    /* Jika tombol pakai ikon, kecilkan juga ikonnya */
    .btn i {
        font-size: 0.8rem !important;
    }

}

/* Mobile kecil (400px ke bawah) */
@media (max-width: 400px) {
    .status-icon {
        width: 20px !important;
        height: 20px !important;
    }
    
    .status-icon i {
        font-size: 11px !important;
    }

    .card-title .fw-bold {
        font-size: 0.9rem !important; 
    }

    .badge{
        font-size: 10px !important;
        width: 280px !important;
        margin-top: 3px;
    }

    .btn {
        padding: 0.25rem 0.5rem !important; /* kecilkan padding */
        font-size: 0.4rem !important;        /* kecilkan teks */
        border-radius: 4px !important;       /* opsional: sudut lebih halus */
    }

    /* Jika tombol pakai ikon, kecilkan juga ikonnya */
    .btn i {
        font-size: 0.8rem !important;
    }
}

@media (max-width: 340px) {
    
    .status-icon i {
        font-size: 9px !important;
    }
    
    .status-info{
        font-size: 0.3rem;
    }

    .card-title .fw-bold {
        font-size: 0.9rem !important; 
    }

    .card-title .badge {
        font-size: 0.5rem !important;
        padding: 0.25rem 0.4rem !important; 
        margin-top: 3px;
        width: 230px !important;
        margin-top: 2px;
    }

    .btn {
        padding: 0.25rem 0.5rem !important; /* kecilkan padding */
        font-size: 0.3rem !important;        /* kecilkan teks */
        border-radius: 4px !important;       /* opsional: sudut lebih halus */
    }

    /* Jika tombol pakai ikon, kecilkan juga ikonnya */
    .btn i {
        font-size: 0.8rem !important;
    }
}
</style>
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
            <div class="card shadow-sm border mb-3" style="width: 100%; max-width: 100%; margin: auto;">
                <div class="card-body">
                    <div class="status-timeline">
                        @if($application->status == '1' || $application->status == '0')
                            <!-- Icon 1: Review Admin Layanan Bisnis -->
                            <div class="status-item">
                                <div class="status-icon" style="background-color: 
                                    @php
                                        $latestLog = $submissionLogs->sortByDesc('created_at')->first();
                                    @endphp
                                    @if($application->approve_status == '1') 
                                        #ffc107
                                    @elseif(in_array($application->approve_status, ['2','3', '4'])) 
                                        #198754 
                                    @elseif($latestLog && $latestLog->status == 0 && $latestLog->approve_status == 0 && $latestLog->role_id == 0)
                                        #dc3545 
                                    @else 
                                        #018797 
                                    @endif;">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <h6 class="status-title">Admin Layanan Bisnis</h6>
                                <div class="status-info">
                                    @if($application->approve_status == '1')
                                        {{ $application->statusAlias()['status'] }}<br>
                                        {{ $application->updated_at }}
                                    @else
                                        @foreach ($submissionLogs as $log)
                                            @if ($log->status == 1 && $log->approve_status == 2)
                                                {{ $log->StatusAlias()['status'] }} <br>
                                                {{ $log->created_at }}
                                            @elseif($latestLog && $latestLog->status == 0 && $latestLog->approve_status == 0 && $latestLog->role_id == 0)
                                                {{ $log->StatusAlias()['status'] }} <br>
                                                {{ $log->created_at }}
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Garis -->
                            <div class="status-line"></div>
                            
                            <!-- Icon 2: Review Wakil Direktur 4 -->
                            <div class="status-item">
                                <div class="status-icon" style="background-color: 
                                    @php
                                        $latestLog = $submissionLogs->sortByDesc('created_at')->first();
                                    @endphp
                                    @if($application->approve_status == '2') 
                                        #ffc107 
                                    @elseif(in_array($application->approve_status, ['3', '4'])) 
                                        #198754 
                                    @elseif($latestLog && $latestLog->status == 0 && $latestLog->approve_status == 0 && $latestLog->role_id == 4)
                                        #dc3545 
                                    @else 
                                        #018797
                                    @endif;">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <h6 class="status-title">Wakil Direktur 4</h6>
                                <div class="status-info">
                                    @if($application->approve_status == '2')
                                        {{ $application->statusAlias()['status'] }}<br>
                                        {{ $application->updated_at }}
                                    @else
                                        @foreach ($submissionLogs->sortByDesc('created_at') as $log)
                                            @if ($log->status == 1 && $log->approve_status == 3)
                                                {{ $log->StatusAlias()['status'] }} <br>
                                                {{ $log->created_at }}
                                                @break
                                            @elseif ($log->status == 0 && $log->approve_status == 0 && $log->role_id == 4)
                                                {{ $log->StatusAlias()['status'] }} <br>
                                                {{ $log->created_at }}
                                                @break
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Garis -->
                            <div class="status-line"></div>
                            
                            <!-- Icon 3: Review WD 2 -->
                            <div class="status-item">
                                <div class="status-icon" style="background-color: 
                                    @if($application->approve_status == '3') 
                                        #ffc107 
                                    @elseif(in_array($application->approve_status, ['3', '4'])) 
                                        #198754 
                                    @elseif(isset($submissionLogs) && $submissionLogs->where('status', 0)->where('approve_status', 0)->where('role_id', 5)->isNotEmpty()) 
                                        #dc3545
                                    @else 
                                        #018797
                                    @endif;">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <h6 class="status-title">Wakil Direktur 2</h6>
                                <div class="status-info">
                                    @if($application->approve_status == '3')
                                        {{ $application->statusAlias()['status'] }}<br>
                                        {{ $application->updated_at }}
                                    @else
                                        @foreach ($submissionLogs as $log)
                                            @if ($log->status == 1 && $log->approve_status == 4)
                                                {{ $log->StatusAlias()['status'] }} <br>
                                                {{ $log->created_at }}
                                                @break 
                                            @elseif ($log->status == 0 && $log->approve_status == 0 && $log->role_id == 3)
                                                {{ $log->StatusAlias()['status'] }} <br>
                                                {{ $log->created_at }}
                                                @break
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Garis -->
                            <div class="status-line"></div>
                            
                            <!-- Icon 4: Review Direktur -->
                            <div class="status-item">
                                <div class="status-icon" style="background-color: 
                                    @if($application->approve_status == '4') 
                                        #ffc107 
                                    @elseif(in_array($application->approve_status, ['4'])) 
                                        #198754 
                                    @elseif(isset($submissionLogs) && $submissionLogs->where('status', 0)->where('approve_status', 0)->where('role_id', 5)->isNotEmpty()) 
                                        #dc3545
                                    @else 
                                        #018797
                                    @endif;">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <h6 class="status-title">Direktur</h6>
                                <div class="status-info">
                                    @if($application->approve_status == '4')
                                        {{ $application->statusAlias()['status'] }}<br>
                                        {{ $application->updated_at }}
                                    @else
                                        @foreach ($submissionLogs as $log)
                                            @if ($log->status == 1 && $log->approve_status == 4)
                                                {{ $log->StatusAlias()['status'] }} <br>
                                                {{ $log->created_at }}
                                                @break 
                                            @elseif ($log->status == 0 && $log->approve_status == 0 && $log->role_id == 5)
                                                {{ $log->StatusAlias()['status'] }} <br>
                                                {{ $log->created_at }}
                                                @break
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Garis -->
                            <div class="status-line"></div>
                            
                            <!-- Icon 5: Selesai -->
                            <div class="status-item">
                                <div class="status-icon" style="background-color: {{ $application->approve_status == '5' ? '#198754' : '#018797' }};">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <h6 class="status-title">Review Selesai</h6>
                                @if($application->approve_status == '5')
                                    <div class="status-info">
                                        {{ $application->statusAlias()['status'] }}<br>
                                        {{ $application->updated_at }}
                                    </div>
                                @endif
                            </div>
                        @else
                            <!-- Status alternatif -->
                            <div class="status-item">
                                <div class="status-icon" style="background-color: #018797;">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <h6 class="status-title-alt">Admin Layanan Bisnis</h6>
                            </div>
                            
                            <div class="status-line"></div>
                            
                            <div class="status-item">
                                <div class="status-icon" style="background-color: #018797;">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <h6 class="status-title-alt">Wakil Direktur 4</h6>
                            </div>
                            
                            <div class="status-line"></div>
                            
                            <div class="status-item">
                                <div class="status-icon" style="background-color: #018797;">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <h6 class="status-title-alt">Wakil Direktur 2</h6>
                            </div>
                            
                            <div class="status-line"></div>
                            
                            <div class="status-item">
                                <div class="status-icon" style="background-color: #018797;">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <h6 class="status-title-alt">Direktur</h6>
                            </div>
                            
                            <div class="status-line"></div>
                            
                            <div class="status-item">
                                <div class="status-icon" style="background-color: #018797;">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <h6 class="status-title-alt">Review Selesai</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-xxl-13">
            <div class="card shadow-sm border mb-4">
                @if ($application->note)
                    <div class="card-header border-bottom" style="background-color: rgba(220,53,69,0.3);">
                        <div class="card-title text-danger fw-bold">
                            <span class="text-dark h5">Catatan Penolakan: </span>{{ $application->note }}
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
                            <div class="mb-3">
                                <span class="fw-bold h6">Nilai Kontrak Yang Di Ajukan: </span> &nbsp;
                                @foreach ($rekapDana as $rekap)
                                    Rp.{{ number_format($rekap->nominal, 0, ',', '.') }}
                                @endforeach
                            </div>
                            @if (Auth::user()->role_id != 1)
                            <div class="mb-3">
                                <span class="fw-bold h6">Jenis Income: </span> &nbsp;
                                {{ ucfirst($application->income) }} Generate
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row border-top pt-4">
                        <div class="col-xl-4">
                            <div class="fw-bold h5">Lampiran </div>
                            @foreach ($application->document->whereNotIn('type', ['lainnya', 'extra']) as $file)
                                <div class="mb-2">
                                    <span role="button" id="document-lampiran"
                                        class="ms-2 text-capitalize fw-bold text-primary"
                                        data-file="{{ url('dokumen_bisnis/' . rawurlencode($file->file)) }}"
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
                                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($file->file)) }}"><i
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
                        <div class="card-title h5">Permohonan Pencairan Dana</div>
                    </div>
                    <div class="card-header border-bottom">
                        <div  class="status-timeline" style="display: flex; align-items: center; justify-content: space-between; text-align: center;">
                            @if($application->status == '2')
                            <!-- Icon 1: Review Admin Layanan Bisnis -->
                            <div class="status-item">
                                <div class="status-icon" style="background-color: 
                                    @php
                                        $latestLog = $submissionLogs->sortByDesc('created_at')->first();
                                    @endphp
                                        @if($application->approve_status == '1') 
                                            #ffc107 /* kuning */
                                        @elseif(in_array($application->approve_status, ['2', '3'])) 
                                            #198754 /* hijau */
                                        @elseif($latestLog && $latestLog->status == 2 && $latestLog->approve_status == 0 && $latestLog->role_id == 4)
                                            #dc3545 /* merah */
                                        @else 
                                            #018797 /* biru tua */
                                        @endif; 
                                    display: flex; align-items: center; justify-content: center; margin: auto;">
                                    <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 24px;"></i>
                                </div>
                                <h6 class="status-title" style="margin-top: 13px;">Admin Layanan Bisnis</h6>
                                <div class="status-info">
                                    @if($application->approve_status == '1')
                                        {{ $application->statusAlias()['status'] }}<br>
                                        {{ $application->updated_at }}
                                    @else($application->approve_status != '1')
                                        @foreach ($submissionLogs as $log)
                                            @if ($log->status == 2 && $log->approve_status == 2)
                                                {{ $log->StatusAlias()['status'] }} <br>
                                                {{ $log->created_at }}
                                                &nbsp;
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div style="flex-grow: 1; height: 1px; background-color: #018797; margin-bottom: 10%;"></div>
                            <!-- Icon 2: Review Wakil Direktur 1 -->
                                <div class="status-item">
                                    <div class="status-icon" style="background-color: 
                                            @if($application->approve_status == '2') 
                                                #ffc107 /* kuning */
                                            @elseif(in_array($application->approve_status, ['3'])) 
                                                #198754 /* hijau */
                                            @else 
                                                #018797 /* biru tua */
                                            @endif; 
                                        display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 24px;"></i>
                                    </div>
                                    <h6 class="status-title" style="margin-top: 13px;">Wakil Direktur 1</h6>
                                    <div class="status-info">
                                        @if($application->approve_status == '2')
                                        {{ $application->statusAlias()['status'] }}
                                        {{ $application->updated_at }}
                                            @else($application->approve_status != '2')
                                            @foreach ($submissionLogs as $log)
                                                @if ($log->status == 2 && $log->approve_status == 3)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div style="flex-grow: 1; height: 1px; background-color: #018797; margin-bottom: 10%;"></div>
                            <!-- Icon 3: Selesai Di Review restart -->
                                <div style="width:30%; text-align:center;">
                                    <div style="width: 50px; height: 50px; border-radius: 50%; background-color: {{ $application->approve_status == '3' ? '#198754' : '#018797' }}; display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-circle-check" style="color: #ffffff; font-size: 24px;"></i>                     
                                    </div>
                                    <h6 class="status-title" style="margin-top: 13px;">Review Selesai</h6>
                                    <div class="status-info">
                                        @if($application->approve_status == '3')
                                            {{ $application->statusAlias()['status'] }} <br>
                                            {{ $application->updated_at }}
                                        @endif
                                    </div>
                                </div>
                            @else ($application->status != '2')
                                <div>
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                    </div>
                                    <h6 class="status-title-alt" style="margin-top: 13px;">Wakil Direktur 4</h6>
                                </div>
                                    <div style="flex-grow: 1; height: 0.5px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>

                                <div>
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                    </div>
                                    <h6 class="status-title-alt" style="margin-top: 13px;">Review Wakil Direktur 2</h6>
                                </div>
                                    <div style="flex-grow: 1; height: 0.5px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>

                                <div>
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-circle-check" style="color: #ffffff; font-size: 27px;margin: 10px;"></i>                     
                                    </div>
                                    <h6 class="status-title-alt" style="margin-top: 13px;">Review Selesai</h6>
                                </div>
                            @endif
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
                            <div class="row border-top pt-4 fs-6">
                                <div class="col-xxl-4">
                                    <div class="fw-bold h5">Lampiran:</div>
                                    @foreach ($extra->document->whereNotIn('type', ['lainnya', 'extra', 'pencairan dana']) as $file)
                                        <div class="mb-2">
                                            <span role="button" id="document-lampiran" data-type="{{ $file->ext }}"
                                                class="ms-2 text-capitalize fw-bold text-primary"
                                                data-file="{{ url('dokumen_bisnis/' . rawurlencode($file->file)) }}">
                                                <i class="fas fa-file"></i>&nbsp; Dokumen {{ $file->title }} 
                                            </span> 
                                        </div>
                                    @endforeach
                                </div>
                            </div><br>
                            <div class="row border-top pt-4 fs-6">
                                <div class="col-12 mb-3">
                                    @if (!empty($note))
                                        <span class="fw-bold h6"> Direktur 2: </span><br>
                                        {!! $note !!}
                                    @else
                                        <span class="text-muted" style="display:none;">Belum ada catatan.</span>
                                    @endif
                                </div>
                                @php
                                    $pencairanFiles = $extra->document->where('type', 'pencairan dana');
                                @endphp 
                                @if ($pencairanFiles->isNotEmpty())
                                    <div class="col-12">
                                        <div class="fw-bold h5">Lampiran:</div>
                                        @foreach ($pencairanFiles as $file)
                                            <div class="mb-2">
                                                <span role="button" id="document-lampiran" data-type="{{ $file->ext }}"
                                                    class="ms-2 text-capitalize fw-bold text-primary"
                                                    data-file="{{ url('dokumen_bisnis/' . rawurlencode($file->file)) }}">
                                                    <i class="fas fa-file"></i>&nbsp; Dokumen {{ $file->type }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-muted" style="display:none;">Belum ada lampiran</div>
                                @endif
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
                        <div class="card-title h5">Permohonan Pencairan Dana Operasional</div>
                    </div>
                    <div class="card-header border-bottom" style="padding-left: 7%; padding-right: 8%;">
                        <div style="display: flex; align-items: center; justify-content: space-between; text-align: center;">
                            @if($application->status == '2')
                        <!-- Icon 1: Review Admin Layanan bisnis -->
                                <div style="width:30%; text-align:center;">
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; 
                                        background-color: 
                                        @php
                                            $latestLog = $submissionLogs->sortByDesc('created_at')->first();
                                        @endphp
                                            @if($application->approve_status == '1') 
                                                #ffc107 /* kuning */
                                            @elseif(in_array($application->approve_status, ['2','3','4','5'])) 
                                                #198754 /* hijau */
                                            @elseif($latestLog && $latestLog->status == 2 && $latestLog->approve_status == 0 && $latestLog->role_id == 4)
                                                #dc3545 /* merah */
                                            @else 
                                                #018797 /* biru tua */
                                            @endif; 
                                        display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 24px;"></i>
                                    </div>
                                    <h6 class="status-title" style="margin-top: 13px;">Admin Layanan Bisnis</h6>
                                    <div class="status-info">
                                        @if($application->approve_status == '1')
                                            {{ $application->statusAlias()['status'] }}<br>
                                            {{ $application->updated_at }}
                                        @else
                                            @foreach ($submissionLogs->sortByDesc('created_at') as $log)
                                                @if ($log->status == 2 && $log->approve_status == 2)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @elseif ($log->status == 2 && $log->approve_status == 0 && $log->role_id == 4)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div style="flex-grow: 1; height: 1px; background-color: #018797; margin: 20px 10px;"></div>
                        <!-- Icon 2: Review Wakil Direktur 1 -->
                                <div style="width:30%; text-align:center;">
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; 
                                        background-color: 
                                        @php
                                            $latestLog = $submissionLogs->sortByDesc('created_at')->first();
                                        @endphp
                                            @if($application->approve_status == '2') 
                                                #ffc107 /* kuning */
                                            @elseif(in_array($application->approve_status, ['3','4','5'])) 
                                                #198754 /* hijau */
                                            @elseif($latestLog && $latestLog->status == 2 && $latestLog->approve_status == 0 && $latestLog->role_id == 6)
                                                #dc3545 /* merah */
                                            @else 
                                                #018797 /* biru tua */
                                            @endif; 
                                        display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 24px;"></i>
                                    </div>
                                    <h6 class="status-title" style="margin-top: 13px;">Wakil Direktur 1</h6>
                                    <div class="status-info">
                                        @if($application->approve_status == '2')
                                            {{ $application->statusAlias()['status'] }}<br>
                                            {{ $application->updated_at }}
                                        @else
                                            @foreach ($submissionLogs->sortByDesc('created_at') as $log)
                                                @if ($log->status == 2 && $log->approve_status == 3)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @elseif ($log->status == 2 && $log->approve_status == 0 && $log->role_id == 6)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div style="flex-grow: 1; height: 1px; background-color: #018797; margin: 20px 10px;"></div>
                                @if ($application->income == 'income')  <!-- income -->
                                <div style="width:30%; text-align:center;">
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; 
                                        background-color: 
                                        @php
                                            $latestLog = $submissionLogs->sortByDesc('created_at')->first();
                                        @endphp
                                            @if($application->approve_status == '3') 
                                                #ffc107 /* kuning */
                                            @elseif(in_array($application->approve_status, ['4','5'])) 
                                                #198754 /* hijau */
                                            @elseif($latestLog && $latestLog->status == 2 && $latestLog->approve_status == 0 && $latestLog->role_id == 3)
                                                #dc3545 /* merah */
                                            @else 
                                                #018797 /* biru tua */
                                            @endif; 
                                        display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 24px;"></i>
                                    </div>
                                    <h6 class="status-title" style="margin-top: 13px;">Wakil Direktur 2 </h6>
                                    <div class="status-info">
                                        @if($application->approve_status == '3')
                                            {{ $application->statusAlias()['status'] }}<br>
                                            {{ $application->updated_at }}
                                        @else
                                            @foreach ($submissionLogs->sortByDesc('created_at') as $log)
                                                @if ($log->status == 2 && $log->approve_status == 4)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @elseif ($log->status == 2 && $log->approve_status == 0 && $log->role_id == 3)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div style="width:30%; text-align:center;">
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; 
                                        background-color: 
                                        @php
                                            $latestLog = $submissionLogs->sortByDesc('created_at')->first();
                                        @endphp
                                            @if($application->approve_status == '4') 
                                                #ffc107 /* kuning */
                                            @elseif(in_array($application->approve_status, ['5','6'])) 
                                                #198754 /* hijau */
                                            @elseif($latestLog && $latestLog->status == 2 && $latestLog->approve_status == 0 && $latestLog->role_id == 7)
                                                #dc3545 /* merah */
                                            @else 
                                                #018797 /* biru tua */
                                            @endif; 
                                        display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 24px;"></i>
                                    </div>
                                    <h6 class="status-title" style="margin-top: 13px;">Penjabat Pembuat Komitmen</h6>
                                    <div class="status-info">
                                        @if($application->approve_status == '4')
                                            {{ $application->statusAlias()['status'] }}<br>
                                            {{ $application->updated_at }}
                                        @else
                                            @foreach ($submissionLogs->sortByDesc('created_at') as $log)
                                                @if ($log->status == 2 && $log->approve_status == 5)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @elseif ($log->status == 2 && $log->approve_status == 0 && $log->role_id == 3)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                @elseif ($application->income == 'non_income') <!-- non income -->
                                <div style="width:30%; text-align:center;">
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; 
                                        background-color: 
                                        @php
                                            $latestLog = $submissionLogs->sortByDesc('created_at')->first();
                                        @endphp
                                            @if($application->approve_status == '3') 
                                                #ffc107 /* kuning */
                                            @elseif(in_array($application->approve_status, ['4','5'])) 
                                                #198754 /* hijau */
                                            @elseif($latestLog && $latestLog->status == 2 && $latestLog->approve_status == 0 && $latestLog->role_id == 3)
                                                #dc3545 /* merah */
                                            @else 
                                                #018797 /* biru tua */
                                            @endif; 
                                        display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 24px;"></i>
                                    </div>
                                    <h6 class="status-title" style="margin-top: 13px;">Direktur</h6>
                                    <div class="status-info">
                                        @if($application->approve_status == '3')
                                            {{ $application->statusAlias()['status'] }}<br>
                                            {{ $application->updated_at }}
                                        @else
                                            @foreach ($submissionLogs->sortByDesc('created_at') as $log)
                                                @if ($log->status == 2 && $log->approve_status == 4)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @elseif ($log->status == 2 && $log->approve_status == 0 && $log->role_id == 3)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div style="width:30%; text-align:center;">
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; 
                                        background-color: 
                                        @php
                                            $latestLog = $submissionLogs->sortByDesc('created_at')->first();
                                        @endphp
                                            @if($application->approve_status == '4') 
                                                #ffc107 /* kuning */
                                            @elseif(in_array($application->approve_status, ['5','6'])) 
                                                #198754 /* hijau */
                                            @elseif($latestLog && $latestLog->status == 2 && $latestLog->approve_status == 0 && $latestLog->role_id == 3)
                                                #dc3545 /* merah */
                                            @else 
                                                #018797 /* biru tua */
                                            @endif; 
                                        display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 24px;"></i>
                                    </div>
                                    <h6 class="status-title" style="margin-top: 13px;">Wakil Direktur 2</h6>
                                    <div class="status-info">
                                        @if($application->approve_status == '4')
                                            {{ $application->statusAlias()['status'] }}<br>
                                            {{ $application->updated_at }}
                                        @else
                                            @foreach ($submissionLogs->sortByDesc('created_at') as $log)
                                                @if ($log->status == 2 && $log->approve_status == 4)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @elseif ($log->status == 2 && $log->approve_status == 0 && $log->role_id == 3)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                @endif
                            <!-- Icon 3: Selesai Di Review -->
                                <div style="width:30%; text-align:center;">
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: {{ $application->approve_status == '5' ? '#198754' : '#018797' }}; display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-circle-check" style="color: #ffffff; font-size: 24px;"></i>                     
                                    </div>
                                    <h6 class="status-title" style="margin-top: 13px;">Review Selesai</h6>
                                    <div class="status-info">
                                        @if($application->approve_status == '5')
                                            {{ $application->statusAlias()['status'] }}<br>
                                            {{ $application->updated_at }}
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div>
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user" style="color: #ffffff;font-size: 30px; margin: 10px;"></i>
                                    </div>
                                    <h6 class="status-title-alt" style="margin-top: 13px;">Admin Layanan Bisnis</h6>
                                </div>

                                    <div style="flex-grow: 1; height: 1px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>
                                <div>
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                    </div>
                                    <h6 class="status-title-alt" style="margin-top: 13px;">Wakil Direktur 1</h6>
                                </div>
                                    <div style="flex-grow: 1; height: 1px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>
                                @if ($application->income == 'income') 
                                    <div>
                                        <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                            <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                        </div>
                                        <h6 class="status-title-alt" style="margin-top: 13px;">Wakil Direktur 2</h6>
                                    </div>
                                        <div style="flex-grow: 1; height: 1px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>
                                    <div>
                                        <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                            <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                        </div>
                                        <h6 class="status-title-alt" style="margin-top: 13px; width: 90%;">PPK</h6>
                                    </div>
                                        <div style="flex-grow: 1; height: 1px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>
                                @elseif($application->income == 'non_income') 
                                    <div>
                                        <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                            <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                        </div>
                                        <h6 class="status-title-alt" style="margin-top: 13px;">Direktur</h6>
                                    </div>
                                        <div style="flex-grow: 1; height: 1px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>
                                    <div>
                                        <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                            <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                        </div>
                                        <h6 class="status-title-alt" style="margin-top: 11px; width: 100%;">Wakil Direktur 2</h6>
                                    </div>
                                        <div style="flex-grow: 1; height: 1px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>
                                @endif
                                <div>
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-circle-check" style="color: #ffffff; font-size: 27px;margin: 10px;"></i>                     
                                    </div>
                                    <h6 class="status-title-alt" style="margin-top: 13px;">Review Selesai</h6>
                                </div>
                            @endif
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
                                <div class="fw-bold h5">Lampiran: </div>
                                @foreach ($extra->document->whereNotIn('type', ['lainnya', 'extra', 'pencairan dana operasional']) as $file)
                                    <div class="mb-2">
                                        <span role="button" id="document-lampiran"
                                            class="ms-2 text-capitalize fw-bold text-primary"
                                            data-type="{{ $file->ext }}"
                                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($file->file)) }}"><i
                                            class="fas fa-file-pdf"></i>&nbsp; Dokumen {{ $file->title }} 
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div><br>
                        <!-- <div class="row border-top pt-4">
                            @php
                                $pencairanFiles = $extra->document->where('type', 'pencairan dana operasional');
                            @endphp
                            @if ($pencairanFiles->isNotEmpty())
                                <div class="fw-bold h6">Lampiran:</div>
                                @foreach ($pencairanFiles as $file)
                                    <div class="mb-2">
                                        <span role="button" id="document-lampiran" data-type="{{ $file->ext }}"
                                            class="ms-2 text-capitalize fw-bold text-primary"
                                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($file->file)) }}">
                                            <i class="fas fa-file"></i>&nbsp; Dokumen {{ $file->type }}
                                        </span>
                                    </div>
                                @endforeach
                            @else
                                <div class="fw-bold h6" style="display: none;">Lampiran:</div>
                            @endif
                        </div> -->
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
                    <div class="card-header border-bottom" style="padding-left: 7%; padding-right: 8%;">
                        <div style="display: flex; align-items: center; justify-content: space-between; text-align: center;">
                            @if($application->status == '3')
                            <!-- Icon 1:  Review admin Layanan bisnis -->
                                <div style="width:30%; text-align:center;">
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; 
                                        background-color: 
                                        @php
                                            $latestLog = $submissionLogs->sortByDesc('created_at')->first();
                                        @endphp
                                            @if($application->approve_status == '1') 
                                                #ffc107 /* kuning */
                                            @elseif(in_array($application->approve_status, ['2', '3'])) 
                                                #198754 /* hijau */
                                            @elseif($latestLog && $latestLog->status == 3 && $latestLog->approve_status == 0 && $latestLog->role_id == 4)
                                                #dc3545 /* merah */
                                            @else 
                                                #018797 /* biru tua */
                                            @endif; 
                                        display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 24px;"></i>
                                    </div>
                                    <h6 class="status-title" style="margin-top: 13px;">Admin Layanan Bisnis </h6>
                                    <div class="status-info">
                                        @if($application->approve_status == '1')
                                            {{ $application->statusAlias()['status'] }}<br>
                                            {{ $application->updated_at }}
                                        @else
                                            @foreach ($submissionLogs->sortByDesc('created_at') as $log)
                                                @if ($log->status == 3 && $log->approve_status == 2)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @elseif ($log->status == 3 && $log->approve_status == 0 && $log->role_id == 4)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div style="flex-grow: 1; height: 1px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>
                            <!-- Icon 2: Review Wakil Direktur 1 -->
                                <div style="width:30%; text-align:center;">
                                   <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; 
                                        background-color: 
                                        @php
                                            $latestLog = $submissionLogs->sortByDesc('created_at')->first();
                                        @endphp
                                        @if($application->approve_status == '2') 
                                            #ffc107 
                                        @elseif(in_array($application->approve_status, ['3'])) 
                                            #198754
                                        @elseif($latestLog && $latestLog->status == 3 && $latestLog->approve_status == 0 && $latestLog->role_id == 3)
                                          #dc3545 
                                        @else 
                                            #018797 /* biru tua */
                                        @endif; 
                                        display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 24px;"></i>
                                    </div>
                                    <h6 class="status-title" style="margin-top: 13px;">Wakil Direktur 1</h6>
                                    <div class="status-info">
                                        @if($application->approve_status == '2')
                                            {{ $application->statusAlias()['status'] }}<br>
                                            {{ $application->updated_at }}
                                        @else
                                            @foreach ($submissionLogs->sortByDesc('created_at') as $log)
                                                @if ($log->status == 3 && $log->approve_status == 3)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @elseif ($log->status == 3 && $log->approve_status == 0 && $log->role_id == 3)
                                                    {{ $log->StatusAlias()['status'] }} <br>
                                                    {{ $log->created_at }}
                                                    &nbsp;
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            <!-- Garis Horizontal -->
                                <div style="flex-grow: 1; height: 1px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>
                                <!-- Icon 3: Selesai Di Review -->
                                <div style="width:30%; text-align:center;">
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: {{ $application->approve_status == '3' ? '#198754' : '#018797' }}; display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-circle-check" style="color: #ffffff; font-size: 24px;"></i>                     
                                    </div>
                                    <h6 class="status-title" style="margin-top: 13px;">Review Selesai</h6>
                                    <div class="status-info">
                                        @if($application->approve_status == '3')
                                            {{ $application->statusAlias()['status'] }} <br>
                                            {{ $application->updated_at }} 
                                        @endif
                                    </div>
                                </div>
                            @else ($application->status == '3')  
                                <div>
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user" style="color: #ffffff;font-size: 30px; margin: 10px;"></i>
                                    </div>
                                    <h6 class="status-title-alt" style="margin-top: 13px;">Admin Layanan Bisnis</h6>
                                </div>
                                    <div style="flex-grow: 1; height: 1px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>
                                <div>
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                    </div>
                                    <h6 class="status-title-alt" style="margin-top: 13px;">Review Wakil Direktur 1</h6>
                                </div>
                                    <div style="flex-grow: 1; height: 1px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>
                                <div>
                                    <div class="status-icon" style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                        <i class="fa-solid fa-user-check" style="color: #ffffff; font-size: 27px; margin: 10px;"></i>
                                    </div>
                                    <h6 class="status-title-alt" style="margin-top: 13px;">Review Selesai</h6>
                                </div>
                            @endif
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
                            <div class="fw-bold h5">Lampiran:</div>
                            @foreach ($extra->document->whereNotIn('type', ['lainnya', 'extra']) as $file)
                                <div class="mb-2">
                                    <span role="button" id="document-lampiran" data-type="{{ $file->ext }}"
                                        class="ms-2 text-capitalize fw-bold text-primary"
                                        data-file="{{ url('dokumen_bisnis/' . rawurlencode($file->file)) }}">
                                        <i class="fas fa-file"></i>&nbsp; Dokumen {{ $file->type }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        @if (Auth::user()->role_id == 1)
                        <div class="row border-top pt-4" style="margin-top: 1%;">
                            <span class="fw-bold h6">Surat Keterangan Penyelesaian Kegiatan:</span><br>
                            <br>
                            <p style="margin-top: -20px">Surat di Print lalu di Tanda Tangani secara Manual sebagai pengesahan </p>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                @if ($application->status == 3 && $application->approve_status == 3)
                                    <a href="{{ route('application.pengajuan.generateSuratSelesai', $application->id) }}" class="btn btn-sm btn-primary " target="_blank">
                                        Pernyataan Surat Selesai
                                    </a>
                                @endif                            
                            </div>
                        </div><br>
                        @else
                            <div class="row border-top pt-4" style="margin-top: 1%;" style="display: none;"></div>
                        @endif
                        @php
                            $pencairanFiles = $extra->document->where('type', 'pencairan dana kegiatan');
                        @endphp 
                        @if (Auth::user()->role_id == 3)
                           <div class="fw-bold h5">Lampiran Memo:</div>
                                @foreach ($application->document->where('type', 'memo') as $file)
                                    <div class="mb-2">
                                        <span role="button" id="document-lampiran" data-type="{{ $file->ext }}"
                                            class="ms-2 text-capitalize fw-bold text-primary"
                                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($file->file)) }}">
                                            <i class="fas fa-file"></i>&nbsp; Dokumen {{ $file->type }}
                                        </span>
                                    </div>
                                @endforeach
                        @else
                            <div class="row border-top" style="display: none;"></div>
                        @endif

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
                                            data-file="{{ url('dokumen_bisnis/' . rawurlencode($file->file)) }}"><i
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

        <div class="col-xxl-13">
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
<!-- modalll -->
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
                                <label class="mb-2 fw-bold text-capitalize" for="role_id"> Judul {{ $extraApp == 'Pengajuan Pemberitahuan Kegiatan Selesai Dilaksanakan' ? 'Ajukan' : 'Permohonan' }} 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                    name="title"
                                    class="form-control" 
                                    value="{{ $application->title ?? '' }}" 
                                    readonly>
                            </div>
                            {{-- disini banyak casenya --}}
                            @if ($application->activity->category->id == 1)
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
                                        <label class="mb-2 fw-bold" for="role_id">Bukti Transfer Mitra (File berupa Gambar/Screenshot)<span
                                                class="text-danger">*</span></label>
                                        <input type="file" required name="lampiran[transfer]" class="form-control"
                                            accept="image/*">
                                        <small class="text-muted">Format file harus berupa gambar</small>
                                    </div>
                                @elseif($application->status == 2)
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">Dokumentasi Kegiatan (PDF)</label>
                                        <input type="file" name="lampiran[dokumentasi kegiatan]" class="form-control"
                                        accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2 fw-bold" for="role_id">Laporan Pertanggung Jawaban (PDF)</label>
                                        <p>
                                            Format surat LPJ dapat di download disini (link) Form perubahan dapat di
                                            download disini (link) <a href="{{ url('/template/template-lpj.doc') }}"
                                            target="_blank">{{ url('/template/template-lpj.doc') }}</a>
                                        </p> 
                                        <input type="file" name="lampiran[lpj]" class="form-control"
                                        accept="application/pdf">
                                        <small class="text-muted">Format file harus berupa PDF</small>
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
    @if (Auth::user()->role_id == 6)
        <div class="modal fade" id="addMemo" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <form action="{{ route('application.approveWithMemo', ['id' => $application->id]) }}" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Terima Pengajuan & Tambahkan Memo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <button type="button" class="btn btn-info text-dark" onclick="addExtraFile(4)">
                                <i class="fas fa-plus-circle"></i>&nbsp; Tambah Memo</button>
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
@if (auth()->user()->role_id == 3 && ($application->status == 1) && $application->approve_status == 3)
        <div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Jenis Income</h5><span class="text-danger">*</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('application.approveWithIncome', $application->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="income" class="form-label">Pilih Jenis Income</label>
                                <select class="form-select" id="income" name="income" required>
                                    <option value="" disabled selected>-- Pilih --</option>
                                    <option value="income">Income Generate</option>
                                    <option value="non_income">Non Income Generate</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Terima Pengajuan</button>
                        </form>
                    </div>
                </div>
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
            @if (Auth::user()->role_id == 5 || Auth::user()->role_id == 0)
                $("#approve-modal").modal("toggle");
            @elseif (Auth::user()->role_id == 3 && ($application->status == 1) && $application->approve_status == 3)
                $("#addNoteModal").modal("toggle");
            @elseif (Auth::user()->role_id == 6 && ($application->status == 3) && $application->approve_status == 2)
                $("#addMemo").modal("toggle")
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

        $(document).ready(function() {
        $('#document-preview').on('shown.bs.modal', function () {
            $(this).removeAttr('aria-hidden');
        });

        $('#document-preview').on('hidden.bs.modal', function () {
            $(this).attr('aria-hidden', 'true');
        });
    });

    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function (e) {
        e.preventDefault();
        
        let value = this.getAttribute('data-value'); 
        let text = this.textContent; 
        
        // ubah teks tombol
        document.getElementById('dropdownMenuButton').textContent = text;

        // isi hidden input
        document.getElementById('incomeInput').value = value;
        });
    });
    </script>
@endsection
@section('script')
    <script src="{{ asset('assets/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Handler untuk semua form di halaman
            $('form').on('submit', function(e) {
                const $form = $(this);
                const $submitBtn = $form.find('input[type="submit"], button[type="submit"]');
                
                // Cek apakah form sudah dalam proses submit
                if ($form.data('submitting') === true) {
                    e.preventDefault();
                    return false;
                }
                
                // Validasi form HTML5
                if (!this.checkValidity()) {
                    return true; // Biarkan validasi browser berjalan
                }
                
                // Tandai form sedang dalam proses submit
                $form.data('submitting', true);
                
                // Disable tombol submit dan ubah teksnya
                $submitBtn.prop('disabled', true);
                
                // Simpan teks original
                const originalText = $submitBtn.val() || $submitBtn.text();
                $submitBtn.data('original-text', originalText);
                
                // Ubah teks tombol
                if ($submitBtn.is('input')) {
                    $submitBtn.val('Mengirim...');
                } else {
                    $submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Mengirim...');
                }
                
                // Timeout safety: re-enable setelah 30 detik jika tidak ada response
                setTimeout(function() {
                    if ($form.data('submitting') === true) {
                        $form.data('submitting', false);
                        $submitBtn.prop('disabled', false);
                        
                        if ($submitBtn.is('input')) {
                            $submitBtn.val(originalText);
                        } else {
                            $submitBtn.text(originalText);
                        }
                    }
                }, 30000);
            });
            
            // Reset form state jika ada error dan halaman di-reload
            $(window).on('pageshow', function(event) {
                if (event.originalEvent.persisted) {
                    $('form').each(function() {
                        const $form = $(this);
                        const $submitBtn = $form.find('input[type="submit"], button[type="submit"]');
                        
                        $form.data('submitting', false);
                        $submitBtn.prop('disabled', false);
                        
                        const originalText = $submitBtn.data('original-text');
                        if (originalText) {
                            if ($submitBtn.is('input')) {
                                $submitBtn.val(originalText);
                            } else {
                                $submitBtn.text(originalText);
                            }
                        }
                    });
                }
            });
        });

        // Fungsi khusus untuk form modal dengan AJAX (opsional)
        function setupModalFormProtection(modalId) {
            $(`${modalId} form`).on('submit', function(e) {
                const $form = $(this);
                const $submitBtn = $form.find('input[type="submit"], button[type="submit"]');
                
                if ($form.data('submitting') === true) {
                    e.preventDefault();
                    return false;
                }
                
                $form.data('submitting', true);
                $submitBtn.prop('disabled', true);
                
                const originalText = $submitBtn.val() || $submitBtn.text();
                if ($submitBtn.is('input')) {
                    $submitBtn.val('Mengirim...');
                } else {
                    $submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Mengirim...');
                }
                
                // Reset after modal closes
                $(`${modalId}`).on('hidden.bs.modal', function() {
                    $form.data('submitting', false);
                    $submitBtn.prop('disabled', false);
                    
                    if ($submitBtn.is('input')) {
                        $submitBtn.val(originalText);
                    } else {
                        $submitBtn.text(originalText);
                    }
                });
            });
        }
    </script>
@endsection