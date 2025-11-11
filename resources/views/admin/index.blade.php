@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('content')
    <div class="container">
        <h2 class="page-title-text">
            @if(Auth::user()->role->alias == 'admin')
                Selamat Datang Admin {{ Auth::user()->name }}!
            @elseif(Auth::user()->role->alias == 'applicant')
                Selamat Datang {{ Auth::user()->name }}!
            @elseif(Auth::user()->role->alias == 'direktur')
                Selamat Datang Direktur {{ Auth::user()->name }}!
            @elseif(Auth::user()->role->alias == 'wadir2')
                Selamat Datang Wakil Direktur 2 {{ Auth::user()->name }}!
            @elseif(Auth::user()->role->alias == 'wadir4')
                Selamat Datang Wakil Direktur 4 {{ Auth::user()->name }}!
            @else
                Selamat Datang, {{ Auth::user()->name }}!
            @endif
        </h2>
        <!-- Statistik Panel Admin-->
        <div class="row mt-4">
            @if (Auth::user()->role->alias == 'wadir4'|| env('GOD_MODE'))
            <div class="col-md-13">
                <div class="card">
                    <div class="card-body text-center">
                    <h3>Nilai Kontrak Di Cairkan Tahun {{ $year }}</h3>
                        <h5>Total Nominal: Rp. {{ number_format($totalNilaiKontrak, 2, ',', '.') }}</h5><br>
                        <a href="{{ route('application.report') }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @elseif (Auth::user()->role->alias == 'admin')
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
            <div class="col-md-13">
                <div class="card">
                    <div class="card-body text-center">
                    <h3>Nilai Kontrak Di Cairkan Tahun {{ $year }}</h3>
                        <h5>Total Nominal: Rp. {{ number_format($totalNilaiKontrak, 2, ',', '.') }}</h5><br>
                        <a href="{{ route('application.report') }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- Chart Section != applicant -->
        @if (Auth::user()->role->alias != 'applicant')
        <div class="row mt-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 for="jurusan">Pusat/Jurusan/Unit :</h5>
                        <canvas id="barChart" style="margin-bottom: 10px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">Jumlah Pusat/Jurusan/Unit</h5> <br>
                        <canvas id="pieChart" style="margin: -15px; margin-bottom: 10px;"></canvas>
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
        @endif
        <!-- Dashboard Applicant -->
        @if (Auth::user()->role->alias == 'applicant')
        <div class="row mt-3">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                    <h3><i class="fa-solid fa-file"></i> {{ $jumlahPengajuan }}</h3>
                        <h6>JUMLAH PENGAJUAN ANDA</h6><br>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3><i class="fa-solid fa-bars-progress"></i> {{ $jumlahOnProgress }}</h3>
                        <h6>JUMLAH PENGAJUAN ON PROGRESS</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                    <h3><i class="fa-solid fa-square-check"></i> {{ $jumlahSelesai }}</h3>
                        <h6>JUMLAH PENGAJUAN SELESAI</h6><br>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                    <h3><i class="fa-solid fa-square-xmark"></i> {{ $jumlahDiTolak }}</h3>
                        <h6>JUMLAH PENGAJUAN DI TOLAK</h6><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 for="jurusan">Pusat/Jurusan/Unit :</h5>
                        <canvas id="barChart" style="margin-bottom: 10px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">Jumlah Pusat/Jurusan/Unit</h5> <br>
                        <canvas id="pieChart" style="margin: -15px; margin-bottom: 10px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-13">
            <div class="card">
                <div class="card-body text-start">
                    <h4>Apa Yang Bisa Kamu Lakukan Sebagai Applicant?</h4><br>
                    <ul>
                        <li>
                            <h5>1. Kamu bisa membuat Pengajuan Kegiatan</h5>
                            <p>Di Pengajuan Kamu bisa membuat Pengajuan Kegiatan Baru, Mengisi Form dan Dokumen yang dibutuhkan yang untuk nantinya di ajukan kepada atasan agar kegiatan bisa dilaksanakan.</p>
                        </li>
                        <li>
                            <h5>2. Kamu bisa melihat Pengajuan Kegiatan yang Telah Kamu Ajukan</h5>
                            <p>Di Detail Surat Pengajuan Sudah ada tracking surat yang memudahkan anda untuk melihat surat pengajuan anda sudah berada di tahap mana.</p>
                        </li>
                        <li>
                            <h5>3. Time Line Pengajuan</h5>
                            <p>Kegiatan Pengajuan anda akan melewati 3 tahap:</p>
                            <ul>
                                <li>
                                    <h5>1. Pengajuan Kegiatan</h5>
                                    <p>Tahap yang pertama pengajuan kegiatan anda akan di review oleh beberapa petinggi di bawah ini, lalu saat pengajuan sudah selesai anda akan mendapatkan notifikasi email pengajuan anda telah selesai.</p>
                                    <div style="display: flex; align-items: center; justify-content: space-between; text-align: center;">
                                        <div>
                                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                <i class="fa-solid fa-user" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                            </div>
                                            <h6 style="margin-top: 13px;">Admin Layanan Bisnis</h6>
                                        </div>
                                        <div style="flex-grow: 1; height: 2px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>

                                        <div>
                                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                            </div>
                                            <h6 style="margin-top: 13px;">Wakil Direktur 4</h6>
                                        </div>
                                            <div style="flex-grow: 1; height: 2px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>

                                        <div>
                                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                            </div>
                                            <h6 style="margin-top: 13px;">Wakil Direktur 2</h6>
                                        </div>
                                    
                                        <div style="flex-grow: 1; height: 2px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>

                                        <div>
                                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                            </div>
                                            <h6 style="margin-top: 13px;">Direktur</h6>
                                        </div>
                                            <div style="flex-grow: 1; height: 2px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>

                                        <div>
                                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                <i class="fa-solid fa-circle-check" style="color: #ffffff; font-size: 27px; margin: 10px;"></i>
                                            </div>
                                            <h6 style="margin-top: 13px;">Review Selesai</h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <br>
                            <ul>
                                <li>
                                    <h5>2. Permohonan Pencairan Dana/Dana operasional </h5>
                                    <p>Tahap yang ke dua anda bisa melakukan pengajuan pencairan dana/pencairan dana operasional saat pengajuan kegiatan anda telah disetujui oleh direktur, lalu saat pengajuan sudah selesai anda akan mendapatkan notifikasi email pengajuan anda telah selesai.</p>
                                    <div style="display: flex; flex-direction: column; align-items: center; margin-top: 20px; padding: 130px 0px 130px 0px">
                                        
                                        <!-- Garis utama horizontal -->
                                        <div style="display: flex; align-items: center; justify-content: center; position: relative;">
                                            <div style="text-align: center;">
                                                <div style="width: 55px; height: 55px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                    <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 28px;"></i>
                                                </div>
                                                <h6 style="margin-top: 8px;">Admin Layanan Bisnis</h6>
                                            </div>

                                            <div style="width: 60px; height: 3px; background-color: #018797;"></div>

                                            <!-- Wakil Direktur 4 -->
                                            <div style="text-align: center;">
                                                <div style="width: 55px; height: 55px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                    <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 28px;"></i>
                                                </div>
                                                <h6 style="margin-top: 8px;">Wakil Direktur 1</h6>
                                            </div>

                                            <!-- Garis horizontal -->
                                            <div style="width: 80px; height: 3px; background-color: #018797; margin: 0 10px;"></div>

                                            <!-- Titik percabangan -->
                                            <div style="width: 20px; height: 20px; border-radius: 50%; background-color: #018797; position: relative; margin-right: 180px;">
                                                <!-- Garis ke atas (Income) -->
                                                <div style="position: absolute; top: -80px; left: 9px; width: 2px; height: 60px; background-color: #018797;"></div>
                                                <!-- Garis ke bawah (Non-Income) -->
                                                <div style="position: absolute; bottom: -80px; left: 9px; width: 2px; height: 60px; background-color: #018797;"></div>
                                            </div>

                                            <!-- Jalur Income (atas) -->
                                            <div style="position: absolute; top: -130px; left: 340px; display: flex; align-items: center;">
                                                <h6 style="color: #018797; margin-right: 10px;">Income</h6>

                                                <!-- Icon: Wakil Direktur 2 -->
                                                <div style="text-align: center; margin-right: 20px;">
                                                    <div style="width: 55px; height: 55px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 28px;"></i>
                                                    </div>
                                                    <h6 style="margin-top: 8px;">Wakil Direktur 2</h6>
                                                </div>

                                                <!-- Garis horizontal -->
                                                <div style="width: 60px; height: 2px; background-color: #018797;"></div>

                                                <!-- Icon: PPK -->
                                                <div style="text-align: center; margin-left: 20px;">
                                                    <div style="width: 55px; height: 55px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 28px;"></i>
                                                    </div>
                                                    <h6 style="margin-top: 8px;">PPK</h6>
                                                </div>
                                            </div>

                                            <!-- Jalur Non-Income (bawah) -->
                                            <div style="position: absolute; bottom: -150px; left: 340px; display: flex; align-items: center;">
                                                <h6 style="color: #018797; margin-right: 10px;">Non-Income</h6>

                                                <!-- Icon: Direktur -->
                                                <div style="text-align: center; margin-right: 20px;">
                                                    <div style="width: 55px; height: 55px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 28px;"></i>
                                                    </div>
                                                    <h6 style="margin-top: 8px;">Direktur</h6>
                                                </div>

                                                <!-- Garis horizontal -->
                                                <div style="width: 60px; height: 2px; background-color: #018797;"></div>

                                                <!-- Icon: Wakil Direktur 2 -->
                                                <div style="text-align: center; margin-right: 20px;">
                                                    <div style="width: 55px; height: 55px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                        <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 28px;"></i>
                                                    </div>
                                                    <h6 style="margin-top: 8px;">Wakil Direktur 2</h6>
                                                </div>
                                            </div>

                                            <!-- Titik percabangan -->
                                            <div style="width: 20px; height: 20px; border-radius: 50%; background-color: #018797; position: relative;">
                                                <!-- Garis ke atas (Income) -->
                                                <div style="position: absolute; top: -80px; left: 9px; width: 2px; height: 60px; background-color: #018797;"></div>
                                                <!-- Garis ke bawah (Non-Income) -->
                                                <div style="position: absolute; bottom: -80px; left: 9px; width: 2px; height: 60px; background-color: #018797;"></div>
                                            </div>

                                            <div style="width: 60px; height: 3px; background-color: #018797;"></div>

                                            <!-- Review Selesai -->
                                            <div style="text-align: center;">
                                                <div style="width: 55px; height: 55px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                    <i class="fa-solid fa-circle-check" style="color: #ffffff; font-size: 27px;"></i>
                                                </div>
                                                <h6 style="margin-top: 8px;">Review Selesai</h6>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <br>
                            <ul>
                                <li>                                    
                                    <h5>3. Pengajuan Pemberitahuan Kegiatan Selesai </h5>
                                    <p>Tahap yang ke tiga yaitu tahap akhir adalah melaporkan kegiatan anda telah selesai dilaksanakan anda bisa mengajukan pengajuan ini setelah pengajuan pencairan dana/dana operasional sudah disetujui agar petinggi bisa tau bahwa kegiatan anda sudah selesai dilaksanakan, lalu saat pengajuan sudah selesai anda akan mendapatkan notifikasi email pengajuan anda telah selesai.</p>
                                 <div style="display: flex; align-items: center; justify-content: space-between; text-align: center; width: 700px; margin-left: 100px;">
                                    <div>
                                        <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                            </div>
                                            <h6 style="margin-top: 13px;">Admin Layanan Bisnis</h6>
                                        </div>
                                            <div style="flex-grow: 1; height: 2px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>

                                        <div>
                                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                            </div>
                                            <h6 style="margin-top: 13px;">Wakil Direktur 1</h6>
                                        </div>
                                            <div style="flex-grow: 1; height: 2px; background-color: #018797; margin:10px; margin-bottom: 5%;"></div>

                                        <div>
                                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #018797; display: flex; align-items: center; justify-content: center; margin: auto;">
                                                <i class="fa-solid fa-circle-check" style="color: #ffffff; font-size: 27px;margin: 10px;"></i>                     
                                            </div>
                                            <h6 style="margin-top: 13px;">Review Selesai</h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <br>
                            <li>
                                <h5>4. Mapping Warna Icon</h5>
                                <p>Warna Pada icon akan berubah hijau saat telah di review dan disetujui oleh petinggi,<br> Warna icon kuning akan menjadi kuning saat surat sedang berada di petinggi sesuai dengan aktor pada icon, <br>Warna merah pada icon akan menjadi merah jika pengajuan anda di tolak pada salah satu petinggi dan anda bisa memperbaiki nya, jangan lupa liat catatannya ya!.</p>
                                 <div style="display: flex; justify-content: center; align-items: center; gap: 20px; text-align: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #198754 ; display: flex; align-items: center; justify-content: center;">
                                            <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                        </div>
                                        <h6 style="margin-top: 10px;">Selesai di<br> Review</h6>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #ffc107; display: flex; align-items: center; justify-content: center;">
                                            <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>
                                        </div>
                                        <h6 style="margin-top: 10px;">Menunggu <br> Review</h6>
                                    </div>
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #dc3545 ; display: flex; align-items: center; justify-content: center;">
                                            <i class="fa-solid fa-user-tie" style="color: #ffffff; font-size: 30px; margin: 10px;"></i>                                        </div>
                                        <h6 style="margin-top: 10px;">Pengajuan <br>Ditolak</h6>
                                    </div>
                                </div>
                            </li>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @endif


    </div>
    @endsection

@section('scripts')
<script>
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

        const categoryColors = {
            1: '#FF6384', // Warna untuk Jasa
            2: '#36A2EB', // Warna untuk Pelatihan
            3: '#FFCE56', // Warna untuk Inovasi
            4: '#4BC0C0'  // Warna untuk Produk
        };

        const units = [...new Set(jsonData.map(item => item.unit_name))];
        const categoryData = {
            1: new Array(units.length).fill(0),
            2: new Array(units.length).fill(0),
            3: new Array(units.length).fill(0),
            4: new Array(units.length).fill(0)
        };

        jsonData.forEach(item => {
            const unitIndex = units.indexOf(item.unit_name);
            if (categoryData[item.category_id]) {
                categoryData[item.category_id][unitIndex] = item.activity_count;
            }
        });

        const barChartData = {
            labels: units,
            datasets: Object.keys(categories).map(categoryId => ({
                label: categories[categoryId],
                data: categoryData[categoryId],
                backgroundColor: categoryColors[categoryId],
                borderWidth: 1
            }))
        };

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

       const pieChartColors = [
            '#FF6384', 
            '#36A2EB', 
            '#FFCE56', 
            '#4BC0C0', 
            '#9966FF', 
            '#FF9F40', 
            '#C9CBCF', 
            '#E7E9ED', 
            '#B39DDB', 
            '#FFB74D', 
            '#64B5F6', 
            '#4DB6AC', 
            '#DCE775', 
            '#BA68C8', 
            '#A1887F'  
        ];

        const pieChartData = {
            labels: units,
            datasets: [{
                data: units.map(unit => {
                    return jsonData
                        .filter(item => item.unit_name === unit) 
                        .reduce((sum, item) => sum + item.activity_count, 0);
                }),
                backgroundColor: pieChartColors.slice(0, units.length), // Ambil warna sebanyak unit yang ada
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




