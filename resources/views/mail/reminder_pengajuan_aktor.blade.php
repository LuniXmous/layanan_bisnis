<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
@extends('mail.default')

@section('title', 'Pengingat Pengajuan')

@section('content')
    <table cellpadding="5" cellspacing="0" border="0">
        <tr>
            <td><strong>Judul</strong></td>
            <td>:</td>
            <td>{{ $application->title }}</td>
        </tr>
        <tr>
            <td><strong>Deskripsi</strong></td>
            <td>:</td>
            <td>{{ $application->description }}</td>
        </tr>
        <tr>
            <td><strong>Unit yang diajukan</strong></td>
            <td>:</td>
            <td>{{ $application->activity->unit->name }}</td>
        </tr>
        <tr>
            <td><strong>Kategori yang diajukan</strong></td>
            <td>:</td>
            <td>{{ $application->activity->category->name }}</td>
        </tr>
        <tr>
            <td><strong>Layanan yang diajukan</strong></td>
            <td>:</td>
            <td>{{ $application->activity->name }}</td>
        </tr>
    </table>

    <br>
    Klik link di bawah untuk menuju permintaan terkait:<br>
    <a href="#">http://inicontohEmail</a>
@endsection
</body>
</html>
