<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'activity_id',
        'user_id',
        'title',
        'description',
        'status',
        'approve_status',
        'note',
        'checkpoint',
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
        return $this->belongsTo('App\Models\Activity');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function document()
    {
        return $this->hasMany('App\Models\Document')->orderBy('created_at', 'asc');
    }
    public function extra()
    {
        return $this->hasMany('App\Models\ExtraApplication');
    }
    public function latestExtra()
    {
        return $this->hasMany('App\Models\ExtraApplication')->orderBy('created_at', 'desc');
    }
    public function statusAlias()
    {
        if ($this->status == 0) {
            return ['status' => 'Perlu Perbaikan', 'class' => 'bg-danger', 'users' => [$this->user], 'must_role' => [0]];
        } else if ($this->status == 1) {
            if ($this->approve_status == 0) {   
                return ['status' => 'Menunggu Review Admin Unit', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 2)->get(), 'must_role' => [2, 0]];
            } else if ($this->approve_status == 1) {
                return ['status' => 'Menunggu Review Admin Layanan Bisnis', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 0)->get(), 'must_role' => [0]];
            } else if ($this->approve_status == 2) {
                return ['status' => 'Menunggu Review Wakil Direktur 4', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 4)->get(), 'must_role' => [4, 0, 3]];
            } else if ($this->approve_status == 3) {
                return ['status' => 'Menunggu Review Direktur', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 5)->get(), 'must_role' => [5, 0, 3]];
            } else if ($this->approve_status == 4) {
                return ['status' => 'Selesai Review', 'class' => 'bg-success', 'users' => [$this->user], 'must_role' => [0, 3]];
            }
        } else if ($this->status == 2) {
            $latestExtraType = $this->extra()->orderBy('created_at', 'desc')->first()?->typeAlias();
            if ($this->approve_status == 0) {
                return ['status' => "Pengajuan $latestExtraType Telah Ditolak", 'class' => 'bg-danger', 'users' => [$this->user], 'must_role' => [0, 3]];
            } else if ($this->approve_status == 1) {
                return ['status' => 'Menunggu Review Wakil Direktur 4 Permohonan Pencairan Dana Operasional', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 4)->get(), 'must_role' => [4, 0, 3]];
            } else if ($this->approve_status == 2) {
                return ['status' => 'Menunggu Review Wakil Direktur 2 Permohonan Pencairan Dana Operasional', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 3)->get(), 'must_role' => [3, 0, 3]];
            } else if ($this->approve_status == 3) {
                return ['status' => "Pengajuan $latestExtraType Telah Disetujui", 'class' => 'bg-success', 'users' => [$this->user], 'must_role' => [0, 3]];
            } else {
                return ['status' => '', 'class' => '', 'users' => null, 'must_role' => []];
            }
        } else if ($this->status == 3) {
            $latestExtraType = $this->extra()->orderBy('created_at', 'desc')->first()?->typeAlias();
            if ($this->approve_status == 0) {
                return ['status' => "Pengajuan $latestExtraType Telah Ditolak", 'class' => 'bg-danger', 'users' => [$this->user], 'must_role' => [0, 3]];
            } else if ($this->approve_status == 1) {
                return ['status' => 'Menunggu Review Wakil Direktur 4: Pemberitahuan Kegiatan Selesai Dilaksanakan', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 4)->get(), 'must_role' => [4, 0, 3]];
            } else if ($this->approve_status == 2) {
                return ['status' => 'Menunggu Review Wakil Direktur 2: Pemberitahuan Kegiatan Selesai Dilaksanakan', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 3)->get(), 'must_role' => [3, 0, 3]];
            } else if ($this->approve_status == 3) {
                return ['status' => "Pengajuan $latestExtraType Telah Disetujui", 'class' => 'bg-success', 'users' => [$this->user], 'must_role' => [0, 3]];
            } else {
                return ['status' => '', 'class' => '', 'users' => null, 'must_role' => []];
            }
        } else {
            return ['status' => 'Selesai', 'class' => 'bg-success', 'users' => [$this->user->email], 'must_role' => [0, 3]];
        }
    }
    use HasFactory;

    // Relasi ke log status
    public function statusLogs()
    {
        return $this->hasMany(ApplicationStatusLog::class);
    }
    
}
