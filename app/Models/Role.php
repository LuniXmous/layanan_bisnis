<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];
    use HasFactory;

    // protected static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         if (!$model->id) {
    //             $model->id = (string) Str::uuid();
    //         }
    //     });
    // }
    // public function getIncrementing()
    // {
    //     return false;
    // }
    // public function getKeyType()
    // {
    //     return 'string';
    // }

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
