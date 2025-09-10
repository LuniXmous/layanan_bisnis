@extends('layouts.app')
@section('content')
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enterprise</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .hero {
      position: relative;
      width: 100%;
      height: 730px;
      overflow: hidden;
    }

    .hero img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1;
    }

    .navbar {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 10;
      background-color: transparent;
    }

    .navbar .navbar-brand img {
      width: 60px;
      height: auto;
      padding: 5px;
    }

    .navbar-collapse {
      text-align: right;
    }

    .ms-auto {
      margin-left: auto;
    }

    .navbar-toggler {
      background-color: white;
      border: none;
      border-radius: 5px;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%280,0,0,0.7%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
      width: 24px;
      height: 24px;
    }

    .hero-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      text-align: center;
      z-index: 2;
    }

    .hero-content h2, .hero-content h4 {
      margin: 0;
    }

    .arrow-down {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      color: white;
      cursor: pointer;
      z-index: 3;
      transition: all 0.3s ease;
    }

    /* Ukuran panah di mobile */
    @media (max-width: 855px) {
      .arrow-down {
        bottom: 5%;
        font-size: 40px;
      }
    }

    /* Ukuran panah di desktop */
    @media (min-width: 856px) {
      .arrow-down {
        bottom: 15%;
        font-size: 80px;
      }

      .arrow-down:hover {
        bottom: 10%;
        font-size: 100px;
        transform: translateX(-50%) translateY(10px);
      }
    }

    /* Untuk mobile */
    @media (max-width: 855px) {
      .hero-content h2, 
      .hero-content h4 {
        font-size: 20px;
        white-space: normal;
        overflow: visible;
      }
    }

    /* Untuk desktop */
    @media (min-width: 855px) {
      .hero-content h2, h4 {
        white-space: nowrap;
        overflow: hidden;
      }
    }

    .hero-content hr {
      width: 100%;
      margin: 20px auto;
      border: 0;
      height: 4px;
      background: rgba(255, 255, 255, 1);
      z-index: 3;
      position: relative;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 40px;
      display: flex;
      align-items: center;
    }

    .content {
      flex: 1;
      text-align: left;
      margin-right: 40px;
    }

    .content p {
      text-align: justify;
    }

    .image {
      flex: 1;
      text-align: right;
    }

    .image img {
      max-width: 100%;
      height: auto;
      border-radius: 5%;
    }

    .floating-headset {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #018797;
      border: 2px solid white;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      z-index: 100;
    }

    .floating-headset i {
      color: white;
      font-size: 24px;
    }

    .btn {
      border: 1px solid white !important;
    }

    .content h1 {
      color: #018797;
    }

    .btn {
      border: 1px solid white !important;
      font-size: 18px;
      padding: 12px 24px; 
    }

  </style>
</head>
  <div class="hero">
    <div class="hero-overlay"></div>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand">
          <img src="{{ asset('assets/images/logo-pnj.png') }}" alt="Logo" style="width: 80px; height: 80px;">
        </a>
        <a class="navbar-brand">
          <img src="{{ asset('assets/images/logo_rtpu.png') }}" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
          <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-primary" style="background-color: #018797;">
              Login
            </a>
          </div>
        </div>
      </div>
    </nav>
  
  <img src="{{ asset('assets/images/background_homepage.jpg') }}" alt="Background">
  <div class="hero-content">
    <h2 style="font-size: 40px; color: white;">Selamat Datang di Situs Resmi</h2>
    <hr>
    <h3 style="font-size: 50px; color: white;">Layanan Bisnis</h3>
    <h2 style="font-size: 40px; color: white; margin-top: 15px;">Unit Rekayasa Teknologi dan Produk Unggulan (RTPU)</h2   >
    <h4 style="font-size: 70px; color: white;">Politeknik Negeri Jakarta</h4>

  </div>
  <div class="arrow-down" onclick="document.getElementById('enterprise').scrollIntoView({ behavior: 'smooth' });">
    &#x25BC;
  </div>
  </div>
  <div class="container">
    <div class="content">
      <div class="header">
        <h1 id="enterprise">Enterprise</h1>
        <p>Layanan bisnis perkuliahan merujuk pada berbagai dukungan dan fasilitas yang diberikan oleh institusi pendidikan tinggi untuk membantu mahasiswa dalam proses belajar mereka. Ini mencakup layanan akademik seperti bimbingan konsultasi, pengembangan kurikulum yang relevan dengan kebutuhan industri, serta akses ke sumber daya belajar seperti perpustakaan dan platform daring. Selain itu, layanan ini juga meliputi program pengembangan karir, pelatihan keterampilan profesional, dan jaringan alumni yang dapat membantu mahasiswa dalam mempersiapkan diri memasuki dunia kerja.</p>
      </div>
    </div>
    <div class="image">
      <img src="{{ asset('assets/images/background pnj1.jpg') }}" alt="Enterprise">
    </div>
  </div>
  <a href="http://127.0.0.1:5000" class="floating-headset">
    <i class="fa-solid fa-headset"></i>
  </a>
@endsection