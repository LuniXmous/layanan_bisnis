@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
@section('content')
<div class="container">
    <div class="row mt-3">
    @if (Auth::user()->role->alias == 'admin')
        <h3 class="mb-4">Selamat Datang {{ Auth::user()->name }}!</h3>
    @endif
        <!-- Statistik Panel -->
        <div class="col-md-13">
            <div class="card">
                <div class="card-body text-center">
                <h1>Dana Masuk Tahun {{ $year }}</h1>
                    <h5>Total Nominal: Rp. {{ number_format($totalNominal, 2, ',', '.') }}</h5><br>
                    <a href="{{ route('application.report') }}" class="btn btn-primary btn-sm">Lihat Detail >></a>
                </div>
            </div>
        </div>
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
                <h3><i class="fa-solid fa-square-check"></i> {{ $jumlahSelesai }}</h3>
                    <p>JUMLAH SELESAI</p>
                    <a href="{{ route('application.index', ['approve_status' => '3,4', 'status' => '1,2,3']) }}" class="btn btn-primary btn-sm">Lihat Detail >></a>
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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for each department
    const dataByJurusan = {
        TIK: [4, 3, 2, 1],     // Data untuk Teknik Informatika
        Mesin: [3, 2, 4, 2],   // Data untuk Teknik Mesin
        Elektro: [1, 2, 3, 2], // Data untuk Teknik Elektro
        Sipil: [2, 3, 1, 4]    // Data untuk Teknik Sipil
    };

    // Initialize the chart
    var ctxBar = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Jasa', 'Pelatihan', 'Inovasi', 'Produk'],
            datasets: [{
                label: 'Jumlah',
                data: dataByJurusan['TIK'], // default data for Teknik Informatika
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

    // Update the chart based on selected jurusan
    document.getElementById('jurusan').addEventListener('change', function() {
        const selectedJurusan = this.value;
        barChart.data.datasets[0].data = dataByJurusan[selectedJurusan];
        barChart.update();
    });

    // Update the chart based on selected jurusan
    document.getElementById('jurusan').addEventListener('change', function() {
        const selectedJurusan = this.value;
        barChart.data.datasets[0].data = dataByJurusan[selectedJurusan];
        barChart.update();
    });

    // Pie chart configuration
    var ctxPie = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['TIK', 'Teknik Mesin', 'Teknik Elektro', 'Teknik Sipil'],
            datasets: [{
                label: 'Jumlah Unit',
                data: [10, 16, 11, 14],
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#9966ff'],
                hoverOffset: 4
            }]
        }
    });
</script>
@endsection




