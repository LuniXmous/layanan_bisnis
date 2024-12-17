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

    .image {
      flex: 1;
      text-align: right;
    }

    .image img {
      max-width: 100%;
      height: auto;
    }

    .services {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-gap: 20px;
      margin-top: 40px;
    }

    .service-item {
      text-align: center;
    }

    .service-item img {
      max-width: 100px;
    }

    .cta {
      text-align: right;
      margin-top: 40px;
    }

    .btn {
      display: inline-block;
      background-color: #e10600;
      color: #fff;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 5px;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .fade-in-up {
      opacity: 0; 
      animation: fadeInUp 1s ease-out forwards;
      animation-delay: 1s;
    }
  </style>
</head>
      <nav class="navbar navbar-expand-lg bg-body-tertiary" >
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="{{ asset('assets/images/logo.webp') }}" alt="Logo" style="width: 60px; height: auto;"  ></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Layanan Bisnis</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li> -->
            </ul>
            <form class="d-flex" role="search" style="margin-right:5px;">
                <a href="http://127.0.0.1:5000" class="btn btn-primary" style="background-color: #018797; border: none;">
                    <i class="fa-solid fa-headset"></i>
                </a>  
            </form>
            <form class="d-flex" role="search">
              <a href="{{ route('login') }}" class="btn btn-primary" style=" background-color: #018797;">
                  Login
              </a>  
            </form>
          </div>
        </div>
      </nav>
      <div style="position: relative; width: 100%; height: auto;">
        <img src="{{ asset('assets/images/background pnj1.jpg') }}" 
            style="width: 100%; height: 550px; object-fit: cover;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #018797; opacity: 0.8;"></div>
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-align: center;">
          <h2 class="animate-on-load" style="color:white; font-size: 50px;">Layanan Bisnis</h2>
          <h4 class="animate-on-load" style="color:white; font-size: 50px;">Politeknik Negeri Jakarta</h4>
        </div>
      </div>
      <div class="container">
        <div class="content">
          <div class="header">
            <h1>Enterprise</h1>
            <p>Layanan bisnis perkuliahan merujuk pada berbagai dukungan dan fasilitas yang diberikan oleh institusi pendidikan tinggi untuk membantu mahasiswa dalam proses belajar mereka. Ini mencakup layanan akademik seperti bimbingan konsultasi, pengembangan kurikulum yang relevan dengan kebutuhan industri, serta akses ke sumber daya belajar seperti perpustakaan dan platform daring. Selain itu, layanan ini juga meliputi program pengembangan karir, pelatihan keterampilan profesional, dan jaringan alumni yang dapat membantu mahasiswa dalam mempersiapkan diri memasuki dunia kerja.</p>
          </div>
        </div>
        <div class="image">
          <img src="{{ asset('assets/images/background pnj.jpeg') }}" alt="Enterprise" style="width: 350px; height: auto; border-radius: 10%;">
        </div>
      </div>
@endsection
@section('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const elements = document.querySelectorAll(".animate-on-load");

      elements.forEach((el, index) => {
        setTimeout(() => {
          el.classList.add("fade-in-up");
        }, index * 200); // Delay animasi untuk setiap elemen
      });
    });
  </script>
@endsection
