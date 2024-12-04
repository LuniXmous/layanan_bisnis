<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'type',
        'title',
        'description',  
        'note',
    ];
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

    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }
    public function document()
    {
        return $this->hasMany('App\Models\ExtraApplicationDocument');
    }
    public function typeAlias()
    {
        if ($this) {
            if ($this->type == "dana") {
                return "Pencairan Dana";
            } else if ($this->type == "operasional") {
                return "Pencairan Dana Operasional";
            } else if ($this->type == "kegiatan") {
                return "Pemberitahuan Kegiatan Selesai Dilaksanakan";
                // } else if ($this->type == "kegiatan") {
                //     return "Pencairan Dana Setelah Kegiatan";
            } else {
                return '';
            }
        }
        return '';
    }
    public function statusLogs()
    {
        return $this->hasMany(ApplicationStatusLog::class);
    }

}
