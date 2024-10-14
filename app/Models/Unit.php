<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
        'admin_id',
    ];
    use HasFactory;
    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }
    public function getIncrementing()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }

    public function activity()
    {
        return $this->hasMany('App\Models\Activity');
    }

    public function category()
    {
        $activity = Activity::select('category_id')->distinct()->where('unit_id', $this->id)->get();
        $listCategory = [];
        foreach ($activity as $act) {
            $listCategory[] = $act->category_id;
        }
        return Category::whereIn('id', $listCategory)->get();
    }
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\User', 'admin_id', 'id');
    }
}
