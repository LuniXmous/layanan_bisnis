<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapDana extends Model
{
    use HasFactory;

    // Atur kolom yang boleh diisi
    protected $fillable = ['extra_application_id', 'nominal'];
}

