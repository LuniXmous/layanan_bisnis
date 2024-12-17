@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('page-title', Auth::user()->role->alias == 'admin' ? 'Selamat Datang ' . Auth::user()->name . '!' : '')
    @section('content')
    <div class="container">
        <div class="row mt-3">
            <!-- Statistik Panel -->
            <div class="col-md-13">
                <div class="card">
                    <div class="card-body text-center">
                    <h3>Nilai Kontrak Masuk Tahun {{ $year }}</h3>
                        <h5>Total Nominal: Rp. {{ number_format($totalNilaiKontrak, 2, ',', '.') }}</h5><br>
                        <a href="{{ route('application.report') }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                    <h3><i class="fa-solid fa-file"></i> {{ $jumlahPengajuan }}</h3>
                        <h6>JUMLAH PENGAJUAN</h6><br>
                        <a href="{{ route('application.index') }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3><i class="fa-solid fa-bars-progress"></i> {{ $jumlahOnProgress }}</h3>
                        <h6>JUMLAH ON PROGRESS</h6><br>
                        <a href="{{ route('application.index', ['approve_status' => '1,2']) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                    <h3><i class="fa-solid fa-square-check"></i> {{ $jumlahSelesai }}</h3>
                        <h6>JUMLAH SELESAI</h6><br>
                        <a href="{{ route('application.index', ['approve_status' => '3,4', 'status' => '1,2,3']) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                    <h3><i class="fa-solid fa-square-xmark"></i> {{ $jumlahDiTolak }}</h3>
                        <h6>JUMLAH DI TOLAK</h6><br>
                        <a href="{{ route('application.index', ['approve_status' => '0', 'status' => '0,2,3']) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                    <h3><i class="fa-solid fa-users"></i> {{ $jumlahPengguna }}</h3>
                        <p>JUMLAH PENGGUNA</p>
                        <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div> -->
        </div>

        <!-- Chart Section -->
        <!-- Chart Section -->
        <div class="row mt-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 for="jurusan">Jurusan :</h5>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="height: 92%;">
                    <div class="card-body">
                        <h5 class="text-center">Jumlah Pusat/Jurusan/Unit</h5> <br>
                        <canvas id="pieChart" style="margin: -15px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-8" style="width: 100%;">
                <div class="card">
                    <div class="card-body">
                        <h5 for="jurusan">Nilai Kontrak :</h5>
                        <canvas id="yearlyChart" ></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('scripts')
<script>
    // Ambil data dari API menggunakan AJAX
fetch('/api/chartdata')
    .then(response => response.json())
    .then(data => {
        const jsonData = data.data;
        
        // Mengelompokkan data berdasarkan kategori untuk Bar Chart
        const categories = {
            1: 'Jasa',
            2: 'Pelatihan',
            3: 'Inovasi',
            4: 'Produk'
        };
        
        const units = [...new Set(jsonData.map(item => item.unit_name))];
        const categoryData = {
            1: new Array(units.length).fill(0),
            2: new Array(units.length).fill(0),
            3: new Array(units.length).fill(0),
            4: new Array(units.length).fill(0)
        };
        
        // Isi categoryData berdasarkan activity_count untuk setiap unit dan kategori
        jsonData.forEach(item => {
            const unitIndex = units.indexOf(item.unit_name);
            if (categoryData[item.category_id]) {
                categoryData[item.category_id][unitIndex] = item.activity_count;
            }
        });

        // Siapkan data untuk Bar Chart
        const barChartData = {
            labels: units,
            datasets: Object.keys(categories).map(categoryId => ({
                label: categories[categoryId],
                data: categoryData[categoryId],
                backgroundColor: getRandomColor(),
                borderWidth: 1
            }))
        };

        // Render Bar Chart
        const ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: barChartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });

        // Menyiapkan data untuk Pie Chart - total aktivitas per unit
        const pieChartData = {
            labels: units,
            datasets: [{
                data: units.map(unit => {
                    return jsonData
                        .filter(item => item.unit_name === unit) 
                        .reduce((sum, item) => sum + item.activity_count, 0);
                }),
                backgroundColor: units.map(() => getRandomColor()),
                hoverOffset: 4
            }]
        };

        // Render Pie Chart
        const ctxPie = document.getElementById('pieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: pieChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching chart data:', error));

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    };

    document.addEventListener('DOMContentLoaded', () => {
    fetch('/api/chartvalue')
        .then(response => response.json())
        .then(data => {
            const labels = data.data.map(item => item.year);
            const nominalData = data.data.map(item => item.total_nominal);
            const kontrakData = data.data.map(item => item.total_kontrak);

            const ctx = document.getElementById('yearlyChart').getContext('2d');
            const config = {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Total Nilai Kontrak yang Di Ajukan',
                            data: nominalData,
                            fill: false,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang area (warna hijau-biru dengan transparansi)
                            borderColor: 'rgb(75, 192, 192)', // Warna garis biru-hijau
                            borderWidth: 2, // Ketebalan garis
                            tension: 0.1,
                            pointRadius: 5, // Ukuran titik pada chart
                            pointHoverRadius: 10, // Ukuran titik saat hover
                            pointBackgroundColor: 'rgb(75, 192, 192)', // Warna titik
                        },
                        {
                            label: 'Total Nilai Kontrak yang Di Terima',
                            data: kontrakData,
                            fill: false,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna latar belakang area (warna merah dengan transparansi)
                            borderColor: 'rgb(255, 99, 132)', // Warna garis merah
                            borderWidth: 2, // Ketebalan garis
                            tension: 0.1,
                            pointRadius: 5, // Ukuran titik pada chart
                            pointHoverRadius: 10, // Ukuran titik saat hover
                            pointBackgroundColor: 'rgb(255, 99, 132)', // Warna titik
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: false,
                            text: 'Chart Berdasarkan Tahun'
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Jumlah (Rp)'
                            },
                            beginAtZero: true
                        }
                    }
                }
            };

            new Chart(ctx, config);
        })
        .catch(error => console.error('Error fetching chart data:', error));
    });
</script>

@endsection




