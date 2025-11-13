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

      .navbar .container-fluid {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .navbar-logos {
        display: flex;
        align-items: center;
        gap: 40px;
      }

      /* Tambahan styling khusus logo */
      #logo-pnj img {
        width: 110px; /* Lebih besar dari RTPU */
        height: auto; 
        color: #018797;
      }

      #logo_rtpu img {
        width: 80px; /* Ukuran tetap / lebih kecil */
        height: auto;
      }

      .navbar .navbar-brand {
        margin: 0;
        padding: 0;
      }

      .navbar .navbar-brand img {
        width: 60px;
        height: auto;
        padding: 5px;
      }

      .navbar-collapse {
        display: block !important;
      }

      .ms-auto {
        margin-left: auto;
      }

      .navbar-toggler {
        display: none;
      }

      .hero-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-align: center;
        z-index: 2;
        padding: 0 20px;
        width: 90%;
      }

      .hero-content h2, .hero-content h3, .hero-content h4 {
        margin: 0;
        line-height: 1.3;
        color: white;
      }

      .arrow-down {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        cursor: pointer;
        z-index: 3;
        transition: all 0.3s ease;
        bottom: 5%;
        font-size: 40px;
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
        gap: 40px;
      }

      .content {
        flex: 1;
        text-align: left;
      }

      .content p {
        text-align: justify;
        line-height: 1.6;
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
        border: none !important;
        font-size: 18px;
        padding: 12px 24px;
      }

      .content h1 {
        color: #018797;
      }

      /* Desktop Large (1024px and above) */
      @media (min-width: 1024px) {
        .hero {
          height: 730px;
        }

        .navbar .navbar-brand img {
          width: 80px;
          height: 85px;
        }

        .hero-content h2 {
          font-size: 40px;
        }

        .hero-content h3 {
          font-size: 50px;
        }

        .hero-content h4 {
          font-size: 70px;
        }

        .arrow-down {
          bottom: 15%;
          font-size: 80px;
        }

        .arrow-down:hover {
          bottom: 10%;
          font-size: 100px;
          transform: translateX(-50%) translateY(10px);
        }

        .container {
          flex-direction: row;
          padding: 60px 40px;
        }

        .content {
          margin-right: 40px;
        }

        .content h1 {
          font-size: 36px;
        }

        .content p {
          font-size: 16px;
        }
      }

      /* Tablet (768px - 1023px) */
      @media (max-width: 1023px) and (min-width: 768px) {
        .hero {
          height: 600px;
        }

        .navbar .navbar-brand img {
          width: 60px;
          height: 65px;
        }

        .hero-content h2 {
          font-size: 28px;
        }

        .hero-content h3 {
          font-size: 36px;
        }

        .hero-content h4 {
          font-size: 48px;
        }

        .hero-content hr {
          margin: 15px auto;
          height: 3px;
        }

        .arrow-down {
          bottom: 8%;
          font-size: 50px;
        }

        .container {
          flex-direction: column;
          padding: 40px 30px;
          gap: 30px;
        }

        .content {
          margin-right: 0;
          text-align: center;
        }

        .content h1 {
          font-size: 32px;
        }

        .content p {
          font-size: 15px;
          text-align: center;
        }

        .image {
          text-align: center;
          width: 100%;
        }

        .image img {
          max-width: 80%;
        }

        .btn {
          font-size: 16px;
          padding: 10px 20px;
        }
      }

      /* Mobile Large (425px - 767px) */
      @media (max-width: 767px) and (min-width: 425px) {
        .hero {
          height: 500px;
        }

        .navbar .navbar-brand img {
          width: 50px;
          height: 55px;
        }

        .hero-content {
          width: 95%;
        }

        .hero-content h2 {
          font-size: 20px;
        }

        .hero-content h3 {
          font-size: 26px;
        }

        .hero-content h4 {
          font-size: 32px;
        }

        .hero-content hr {
          margin: 12px auto;
          height: 2px;
        }

        .arrow-down {
          bottom: 5%;
          font-size: 40px;
        }

        .container {
          flex-direction: column;
          padding: 30px 20px;
          gap: 25px;
        }

        .content {
          margin-right: 0;
          text-align: center;
        }

        .content h1 {
          font-size: 28px;
        }

        .content p {
          font-size: 14px;
          text-align: justify;
        }

        .image {
          text-align: center;
          width: 100%;
        }

        .image img {
          max-width: 90%;
        }

        .btn {
          font-size: 15px;
          padding: 10px 18px;
        }

        .floating-headset {
          width: 50px;
          height: 50px;
          bottom: 15px;
          right: 15px;
        }

        .floating-headset i {
          font-size: 20px;
        }
      }

      /* Mobile Small (below 425px) */
      @media (max-width: 424px) {
        .hero {
          height: 450px;
        }

        .navbar .navbar-brand img {
          width: 50px;
          height: 55px;
        }

        .hero-content {
          width: 95%;
        }

        .hero-content h2 {
          font-size: 16px;
        }

        .hero-content h3 {
          font-size: 22px;
        }

        .hero-content h4 {
          font-size: 26px;
        }

        .hero-content hr {
          margin: 10px auto;
          height: 2px;
        }

        .arrow-down {
          bottom: 5%;
          font-size: 35px;
        }

        .container {
          flex-direction: column;
          padding: 25px 15px;
          gap: 20px;
        }

        .content {
          margin-right: 0;
          text-align: center;
        }

        .content h1 {
          font-size: 24px;
        }

        .content p {
          font-size: 13px;
          text-align: justify;
        }

        .image {
          text-align: center;
          width: 100%;
        }

        .image img {
          max-width: 100%;
        }

        .btn {
          font-size: 14px;
          padding: 8px 16px;
        }

        .floating-headset {
          width: 45px;
          height: 45px;
          bottom: 12px;
          right: 12px;
        }

        .floating-headset i {
          font-size: 18px;
        }
      }

      /* Animations */
      @keyframes fadeInDown {
        from {
          opacity: 0;
          transform: translateY(-30px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      @keyframes scaleLine {
        from {
          transform: scaleX(0);
          opacity: 0;
        }
        to {
          transform: scaleX(1);
          opacity: 1;
        }
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
        }
        to {
          opacity: 1;
        }
      }

      /* Apply animations */
      .hero-content h2:first-of-type {
        animation: fadeInDown 1.2s ease-out forwards;
        opacity: 0;
      }

      .hero-content hr {
        transform-origin: center;
        animation: scaleLine 1s ease-out forwards;
        animation-delay: 0.7s;
        opacity: 0;
      }

      .hero-content h3,
      .hero-content h4,
      .hero-content h2:last-of-type {
        animation: fadeIn 1.4s ease-out forwards;
        animation-delay: 1.2s;
        opacity: 0;
      }

    </style>
  </head>
    <div class="hero">
      <div class="hero-overlay"></div>
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <div class="navbar-logos">
            <a class="navbar-brand" id="logo-pnj" style="width: 70px;">
              <img src="{{ asset('assets/images/logo_pnj.png') }}" alt="Logo">
            </a>
            <a class="navbar-brand" id="logo_rtpu">
              <img src="{{ asset('assets/images/logo_rtpu.png') }}" alt="Logo">
            </a>
          </div>
          <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-primary" style="background-color: #018797;">
              Login
            </a>
          </div>
        </div>
      </nav>
    
    <img src="{{ asset('assets/images/background_homepage.jpg') }}" alt="Background">
    <div class="hero-content">
      <h2>Selamat Datang di Situs Resmi</h2>
      <hr>
      <h3>Layanan Bisnis</h3>
      <h4 style="margin-top: 15px;">Unit Rekayasa Teknologi dan Produk Unggulan (RTPU)</h4>
      <h2>Politeknik Negeri Jakarta</h2>
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