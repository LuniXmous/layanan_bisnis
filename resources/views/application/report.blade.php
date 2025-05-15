@extends('layouts.app')
@section('page-title', 'Nilai Kontrak Tahun ' . $year)
@section('content')
<div class="row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Total Nilai Kontrak Yang Di Ajukan:</h6>
                <h1 class="card-text">Rp. {{ number_format($totalNominal, 2, ',', '.') }}</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Total Nilai Kontrak Yang Di Cairkan:</h6>
                <h1 class="card-text">Rp. {{ number_format($totalNilaiKontrak, 2, ',', '.') }}</h1>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route('application.report') }}" class="mb-4" style="flex: end;">
            <label for="year" class="form-label" style="font-size: 20px;">Pilih Tahun:</label>
            <input type="number" name="year" value="{{ $year }}" min="2000" max="{{ date('Y') }}" class="form-control w-auto d-inline-block" style="margin-right: 10px;">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </form>
        @if (Auth::user()->role_id != 1)
            <a href="{{ route('application.exportDana') }}" class="btn btn-primary mb-3"><i class="fas fa-file-excel"></i> Generate Excel</a>
        @endif
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-xs table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Permohonan</th>
                        <th>Nilai Kontrak Yang Di Ajukan</th>
                        <th>Nilai Kontrak Yang Di Cairkan</th>
                        <th>Status</th>
                        <th style="width:10vh;">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{!! $item['title'] !!}</td>
                            <td>Rp. {{ number_format($item['nominal'], 2, ',', '.') }}</td>
                            <td>Rp. {{ number_format($item['nilai_kontrak'], 2, ',', '.') }}</td>
                            <td>{!! $item['status_applicant'] !!}</td>
                            <td>{{ $item['created_at'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <style>
        .table th, .table td {
            padding: 20px;
        }
        .table th, .table td {
            white-space: nowrap;
        }
        @media (max-width: 768px) {
            .table th, .table td {
                font-size: 12px; 
            }
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable-rekap').DataTable({
                ordering: true,
                columnDefs: [
                    { orderable: true, targets: [1, 2, 3] },
                    { orderable: false, targets: [0] }
                ],
                processing: true,
                serverSide: false,
            });
        });
    </script>
@endsection
