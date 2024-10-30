@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
@section('content')
<div class="container">
    <div class="row mt-3">
    @if (Auth::user()->role->alias == 'admin')
        <h3 class="mb-4">Selamat Datang {{ Auth::user()->name }}!</h3>
    @endif
        <!-- Statistik Panel -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                <h3><i class="fa-solid fa-file"></i> {{ $jumlahPengajuan }}</h3>
                    <p>JUMLAH PENGAJUAN</p>
                    <a href="{{ route('application.index') }}" class="btn btn-primary btn-sm">Lihat Detail >></a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                <h3><i class="fa-solid fa-file"></i> {{ $jumlahPengajuan }}</h3>
                    <p>LAPORAANNnn</p>
                    <a href="{{ route('application.report') }}" class="btn btn-primary btn-sm">Lihat Detail >></a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                <h3><i class="fa-solid fa-square-check"></i> {{ $jumlahSelesai }}</h3>
                    <p>JUMLAH SELESAI</p>
                    <a href="{{ route('application.index', ['approve_status' => '4']) }}" class="btn btn-primary btn-sm">Lihat Detail >></a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                <h3><i class="fa-solid fa-bars-progress"></i> {{ $jumlahOnProgress }}</h3>
                    <p>JUMLAH ON PROGRESS</p>
                    <a href="{{ route('application.index', ['approve_status' => '1,2']) }}" class="btn btn-primary btn-sm">Lihat Detail >></a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                <h3><i class="fa-solid fa-users"></i> {{ $jumlahPengguna }}</h3>
                    <p>JUMLAH PENGGUNA</p>
                    <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">Lihat Detail >></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="row mt-2">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 for="jurusan">Jurusan :</h5>
                <select id="jurusan" class="form-control mb-3">
                    <option value="TIK">Teknik Informatika</option>
                    <option value="Mesin">Teknik Mesin</option>
                    <option value="Elektro">Teknik Elektro</option>
                    <option value="Sipil">Teknik Sipil</option>
                </select>
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Jumlah Unit</h5>
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('script')
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize pie and bar charts
        var ctxBar = document.getElementById('barChart').getContext('2d');
        var ctxPie = document.getElementById('pieChart').getContext('2d');
        
        var barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Jasa', 'Pelatihan', 'Inovasi', 'Produk'],  // Static labels, adjust as needed
                datasets: [{
                    label: 'Jumlah',
                    data: [],  // Data to be dynamically updated
                    backgroundColor: ['rgba(54, 162, 235, 0.6)'],
                    borderColor: ['rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
        var pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: [],  // Unit names
                datasets: [{
                    label: 'Jumlah Unit',
                    data: [],  // Activity counts for each unit
                    backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#9966ff'], // Adjust colors as needed
                    hoverOffset: 4
                }]
            }
        });
        // Fetch data from server and update the charts
        function loadChartData() {
            $.ajax({
                url: '{{ route("unit.index", ["for" => "charts"]) }}',  // Fetch chart data
                method: 'GET',
                success: function(response) {
                    var chartData = response.chartData;

                    // Update pie chart (unit names and activity counts)
                    pieChart.data.labels = chartData.units;
                    pieChart.data.datasets[0].data = chartData.activityCounts;
                    pieChart.update();

                    // Update bar chart (activity breakdown by unit)
                    barChart.data.datasets[0].data = chartData.activityBreakdown.map(function(item) {
                        return item.categories.reduce(function(a, b) { return a + b; }, 0); // Sum of all categories for each unit
                    });
                    barChart.update();
                },
                error: function(xhr, status, error) {
                    console.error('Failed to load chart data:', error);
                }
            });
        }
        // Initialize DataTable
        var table = $('#datatable').DataTable({
            ajax: '{{ route("unit.index") }}',  // DataTables AJAX without chart query parameter
            serverSide: true,
            processing: true,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'name'},
                {data: 'activities', name: 'activities'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        // Call the function to load chart data
        loadChartData();
    </script>
@endsection




