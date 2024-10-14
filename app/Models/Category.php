<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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

    public function activity()
    {
        return $this->hasMany('App\Models\Activity');
    }

    public function unit()
    {
        return $this->hasManyThrough(
            'App\Models\Unit',
            'App\Models\UnitCategory',
            'category_id',
            'id',
            'id',
            'unit_id',
        );
    }
}
