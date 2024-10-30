<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
                                                          
    <p>permintaan layanan bisnis anda telah diterima, dengan detail :</p>
    <table>
        <tr>
            <td>Judul</td>
            <td>:</td>
            <td> {{$application->title}} </td>
        </tr>
        <tr>
            <td> Deskripsi</td>
            <td>:</td>
            <td> {{$application->description}} </td>
        </tr>
        <tr>
            <td>Unit yang diajukan</td>
            <td>:</td>
            <td> {{$application->activity->unit->name}} </td>
        </tr>
        <tr>
            <td>Kategori yang diajukan</td>
            <td>:</td>
            <td> {{$application->activity->category->name}} </td>
        </tr>
        <tr>
            <td>Layanan yang diajukan</td>
            <td>:</td>
            <td> {{$application->activity->name}} </td>
        </tr>
        <tr>
            <td>Catatan</td>
            <td>:</td>
            <td> {{$application->note}} </td>
        </tr>
        
    </table>

    klik link dibawah untuk menuju permintaan terkait <br>
    <a href="#">http://inicontohEmail</a>
    
</body>
</html>