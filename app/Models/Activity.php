<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'unit_id',
        'category_id',
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

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }
    public function application()
    {
        return $this->hasMany('App\Models\Application');
    }
}
