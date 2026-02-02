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
        'income',
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
            return ['status' => 'Pengajuan Ditolak', 'class' => 'bg-danger', 'users' => [$this->user], 'must_role' => [0]];
        } else if ($this->status == 1) {
            if ($this->approve_status == 0) {   
                return ['status' => 'Menunggu Review Admin Unit', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 2)->get(), 'must_role' => [2, 0]];
            } else if ($this->approve_status == 1) {
                return ['status' => 'Menunggu Review Admin Layanan Bisnis', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 0)->get(), 'must_role' => [0]];
            } else if ($this->approve_status == 2) {
                return ['status' => 'Menunggu Review Wakil Direktur 4', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 4)->get(), 'must_role' => [4, 0, 3]];
            } else if ($this->approve_status == 3) {
                return ['status' => 'Menunggu Review Wakil Direktur 2', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 3)->get(), 'must_role' => [3]];
            } else if ($this->approve_status == 4) {   
                return ['status' => 'Menunggu Review Direktur', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 5)->get(), 'must_role' => [5, 0, 3, 4]];
            } else if ($this->approve_status == 5) {
                return ['status' => 'Pengajuan Telah Disetujui', 'class' => 'bg-success', 'users' => [$this->user], 'must_role' => [5,0, 3]];
            }
        } else if ($this->status == 2) {
            $latestExtraType = $this->extra()->orderBy('created_at', 'desc')->first()?->typeAlias();
            if ($this->approve_status == 0) {
                return ['status' => "Pengajuan $latestExtraType Telah Ditolak", 'class' => 'bg-danger', 'users' => [$this->user], 'must_role' => [0, 3]];
            } else if ($this->approve_status == 1) {
                return ['status' => 'Menunggu Review Admin Layanan Bisnis Permohonan Pencairan Dana Operasional', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 0)->get(), 'must_role' => [0, 3, 4]];
            } else if ($this->approve_status == 2) {
                return ['status' => 'Menunggu Review Wakil Direktur 1 Permohonan Pencairan Dana Operasional', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 6)->get(), 'must_role' => [6, 0]];
            } else if ($this->approve_status == 3) {
                if ($this->income === 'income') {
                    $mustRole = [0, 3, 6, 7];
                    return [
                        'status'    => 'Menunggu Review Penjabat Pembuat Komitmen Permohonan Pencairan Dana Operasional',
                        'class'     => 'bg-warning text-dark',
                        'users'     => User::select('email')->where('role_id', 7)->get(),
                        'must_role' => $mustRole,
                    ];
                } else {
                    $mustRole = [0, 5, 3, 6];
                    return [
                        'status'    => 'Menunggu Review Direktur Permohonan Pencairan Dana Operasional',
                        'class'     => 'bg-warning text-dark',
                        'users'     => User::select('email')->where('role_id', 5)->get(),
                        'must_role' => $mustRole,
                    ];
                }
            }

            else if ($this->approve_status == 4) {
                if ($this->income === 'income') {
                    $mustRole = [7, 0, 3, 6];
                    return [
                        'status'    => 'Menunggu Review Wakil Direktur 2 Pencairan Dana Operasional',
                        'class'     => 'bg-warning text-dark',
                        'users'     => User::select('email')->where('role_id', 3)->get(),
                        'must_role' => $mustRole,
                    ];
                } else {
                    $mustRole = [0, 3, 5, 6];
                    return [
                        'status'    => 'Menunggu Review Wakil Direktur 2 Pencairan Dana Operasional',
                        'class'     => 'bg-warning text-dark',
                        'users'     => User::select('email')->where('role_id', 3)->get(),
                        'must_role' => $mustRole,
                    ];
                }
            } else if ($this->approve_status == 5) {
                return ['status' => "Pengajuan $latestExtraType Telah Disetujui", 'class' => 'bg-success', 'users' => [$this->user], 'must_role' => [0, 3, 7]];
            } else {
                return ['status' => '', 'class' => '', 'users' => null, 'must_role' => []];
            }
        } else if ($this->status == 3) {
            $latestExtraType = $this->extra()->orderBy('created_at', 'desc')->first()?->typeAlias();
            if ($this->approve_status == 0) {
                return ['status' => "Pengajuan $latestExtraType Telah Ditolak", 'class' => 'bg-danger', 'users' => [$this->user], 'must_role' => [0, 3]];
            } else if ($this->approve_status == 1) {
                return ['status' => 'Menunggu Review Admin Layanan Bisnis: Pemberitahuan Kegiatan Selesai Dilaksanakan', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 4)->get(), 'must_role' => [4, 0, 3]];
            } else if ($this->approve_status == 2) {
                return ['status' => 'Menunggu Review Wakil Direktur 1: Pemberitahuan Kegiatan Selesai Dilaksanakan', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 3)->get(), 'must_role' => [6, 0, 3]];
            } else if ($this->approve_status == 3) {
                return ['status' => "Pengajuan $latestExtraType Telah Disetujui", 'class' => 'bg-success', 'users' => [$this->user], 'must_role' => [0, 3, 6]];
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

    public function rekapDana()
    {
        return $this->hasOne(RekapDana::class, 'application_id', 'id');
    }
        
    
    
}
