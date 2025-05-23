<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            margin: 40px;
        }
        .center { text-align: center; }
        .right { text-align: right; }
        .bold { font-weight: bold; }
        .mt-2 { margin-top: 1rem; }
        .mt-4 { margin-top: 2rem; }
        .mt-5 { margin-top: 3rem; }
        
        .header-logo {
            display: flex;
            align-items: center;
        }
        
        .logo {
            width: 100px;
            height: auto;
            margin-right: 20px;
            align-self: flex-start; /* Logo berada di atas */
            margin-bottom: -100%;
        }
        
        .header-text {
            flex-grow: 1;
            text-align: center;
            line-height: 1.3;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-bottom: 40px;
            margin-top: -32px;
        }

        .single-line {
            border-top: 1px solid #000;
            margin-top: 10px;
        }
        .double-line {
            border-top: 3px solid #000;
            border-bottom: 1px solid #000;
            margin-top: 2px;
            margin-bottom: 30px;
        }
        .signature {
            text-align: justify;
            margin-top: 50px;
            width: 230px; /* atur lebar sesuai kebutuhan */
            margin-left: auto;
        }
    </style>
</head>
<body>
    <div class="header-logo">
        <img src="{{ public_path('assets/images/logo-pnj.png') }}" alt="Logo" class="logo">
        <div class="header-text">
            <div class="bold">PEMERINTAH PROVINSI JAWA BARAT</div>
            <div class="bold">DINAS PENDIDIKAN DAN KEBUDAYAAN</div>
            <div class="bold" style="font-size: 24px;">POLITEKNIK NEGERI JAKARTA</div>
            <div style="font-size: 14px;">Jl. Prof. DR. G.A. Siwabessy, Kukusan, Beji, Kota Depok, Jawa Barat</div>
            <div style="font-size: 14px;">Kode Pos. 16425 Telepon </div>
            <div style="font-size: 14px;">Email: pnj.ac.id</div>
        </div>
    </div>

    <div class="single-line"></div>
    <div class="double-line"></div>

    <div class="center mt-4" style="margin-top: -40px;">
        <h4 class="bold" style="text-decoration: underline;">SURAT KETERANGAN</h4>
    </div>

    <div class="mt-4">
        Yang bertanda tangan di bawah ini:
        <br>
        Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Dr.Syamsurizal,S.E.,M.M.<br>
        Jabatan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Direktur
    </div>

    <div class="mt-2">
        Dengan ini menerangkan bahwa:<br>
        Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $application->user->name }}<br>
        &nbsp;&nbsp;&nbsp;Unit Kerja&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $application->activity->unit->name }}
    </div>

    <div class="mt-4">
        Telah melakukan kegiatan <strong>{{ $application->activity->name }}</strong> dengan judul 
        <strong>"{{ $application->title }}"</strong>, yang dilaksanakan pada tanggal 
        {{ \Carbon\Carbon::parse($application->created_at)->format('d-m-Y') }} sampai 
        {{ \Carbon\Carbon::parse($application->updated_at)->format('d-m-Y') }}.
    </div>

    <div class="mt-4">
        Demikian surat keterangan ini dibuat untuk digunakan sebagaimana mestinya.
    </div>

    <div class="signature">
        <center>Depok, {{ \Carbon\Carbon::parse($application->updated_at)->locale('id')->translatedFormat('d F Y') }}</center><br>
        <center style="margin-top: -20px;">Direktur</center>
        <br><br><br><br><br>
        <center><strong style="text-align: justify;">Dr.Syamsurizal,S.E.,M.M.</strong></center>
    </div>
</body>
</html>