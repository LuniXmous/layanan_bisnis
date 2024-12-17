@extends('layouts.app')
@section('page-title', 'Laporan Tahunan ' . $year)
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
                            <h6 class="card-title">Total Nilai Kontrak Yang Di Terima:</h6>
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
                    <a href="{{ route('application.exportDana') }}" class="btn btn-primary mb-3" ><i class="fas fa-file-excel"></i> Generate Excel</a>
                @endif
                <div class="table-responsive mt-4">
                    <table class="table table-striped w-100 table-bordered table-xs table-hover" id="datatable-rekap">
                        <thead>
                            <tr>
                                <th width="3%" data-order="asc">No</th>
                                <th data-order="asc">Judul Permohonan</th>
                                <th data-order="asc">Nilai Kontrak Yang Di Ajukan</th>
                                <th data-order="asc">Nilai Kontrak Yang Diterima</th>
                                <th data-order="asc">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekapDana as $index => $rekap)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $rekap->application->title }}</td>
                                <td>Rp. {{ number_format($rekap->nominal, 2, ',', '.') }}</td>
                                <td>Rp. {{ number_format($rekap->nilai_kontrak, 2, ',', '.') }}</td>
                                <td>{{ $rekap->created_at->format('d-m-Y') }}</td>

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
        @section('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    @endsection

    @section('script')
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable-rekap').DataTable({
                ordering: true, // Aktifkan sorting
                columnDefs: [
                    { orderable: true, targets: [1, 2, 3] }, // Atur kolom yang bisa diurutkan
                    { orderable: false, targets: [0] } // Nonaktifkan sorting di kolom nomor
                ],
                processing: true,
                serverSide: false,
            });
        });
    </script>
    @endsection
@endsection
