<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStatusLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'status',
        'approve_status',
        'role_id',
        'user_id',
    ];

    public function typeAlias()
    {
        if ($this) {
            if ($this->type == "dana") {
                return "Pencairan Dana";
            } else if ($this->type == "operasional") {
                return "Pencairan Dana Operasional";
            } else if ($this->type == "kegiatan") {
                return "Pemberitahuan Kegiatan Selesai Dilaksanakan";
            } else {
                return '';
            }
        }
        return '';
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
                return ['status' => 'Selesai Di Review Admin Unit', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 2)->get(), 'must_role' => [2, 0]];
            } else if ($this->approve_status == 2) {
                return ['status' => 'Disetujui Oleh Admin Layanan Bisnis', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 0)->get(), 'must_role' => [0]];
            } else if ($this->approve_status == 3) {
                return ['status' => 'Disetujui Oleh Wakil Direktur 4', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 4)->get(), 'must_role' => [4, 0, 3]];
            } else if ($this->approve_status == 4) {
                return ['status' => 'Disetujui Oleh Wakil Direktur 2', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 3)->get(), 'must_role' => [4, 0, 3]];
            } else if ($this->approve_status == 5) {
                return ['status' => 'Disetujui Oleh Direktur ', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 5)->get(), 'must_role' => [5, 0, 3]];
            } 
        } else if ($this->status == 2) {
            if ($this->approve_status == 0) {
                return ['status' => "Pengajuan Telah Ditolak", 'class' => 'bg-danger', 'users' => [$this->user], 'must_role' => [0, 3]];
            } else if ($this->approve_status == 2) {
                return ['status' => 'Permohonan Pencairan Dana Operasional Disetujui Oleh Admin Layanan Bisnis', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 4)->get(), 'must_role' => [4, 0, 3]];
            } else if ($this->approve_status == 3) {
                return ['status' => 'Permohonan Pencairan Dana Operasional Disetujui Oleh Wakil direktur 1', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 6)->get(), 'must_role' => [4, 0, 3]];
            } else if ($this->approve_status == 4) {
                $income = $this->income ?? ($this->application ? $this->application->income : null);
                if ($income === 'income') {
                    return [
                        'status'    => 'Permohonan Pencairan Dana Operasional Disetujui Oleh Wakil Direktur 2',
                        'class'     => 'bg-warning text-dark',
                        'users'     => User::select('email')->where('role_id', 3)->get(),
                        'must_role' => [3],
                    ];
                } else {
                    return [
                        'status'    => 'Permohonan Pencairan Dana Operasional Disetujui Oleh Direktur',
                        'class'     => 'bg-warning text-dark',
                        'users'     => User::select('email')->where('role_id', 5)->get(),
                        'must_role' => [5],
                    ];
                }
            } else if ($this->approve_status == 5) {
                $income = $this->income ?? ($this->application ? $this->application->income : null);
                if ($income === 'income') {
                    return [
                        'status'    => 'Permohonan Pencairan Dana Operasional Disetujui Oleh PPK',
                        'class'     => 'bg-warning text-dark',
                        'users'     => User::select('email')->where('role_id', 7)->get(),
                        'must_role' => [7],
                    ];
                } else {
                    return [
                        'status'    => 'Permohonan Pencairan Dana Operasional Disetujui Oleh Wakil Direktur 2',
                        'class'     => 'bg-warning text-dark',
                        'users'     => User::select('email')->where('role_id', 3)->get(),
                        'must_role' => [3],
                    ];
                }
            } else if ($this->approve_status == 6) {
                return ['status' => 'Pemberitahuan Kegiatan Selesai Dilaksanakan Disetujui Oleh', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 3)->get(), 'must_role' => [3, 0, 3]];
            } else {
                return ['status' => '', 'class' => '', 'users' => null, 'must_role' => []];
            }
        } else if ($this->status == 3) {
            $latestExtraType = $this->application? $this->application->extra()->orderBy('created_at', 'desc')->first()?->typeAlias(): '';            if ($this->approve_status == 0) {
                return ['status' => "Pengajuan $latestExtraType Telah Ditolak", 'class' => 'bg-danger', 'users' => [$this->user], 'must_role' => [0, 3]];
            } else if ($this->approve_status == 2) {
                return ['status' => 'Menunggu Review Admin Layanan Bisnis: Pemberitahuan Kegiatan Selesai Dilaksanakan', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 4)->get(), 'must_role' => [4, 0, 3]];
            } else if ($this->approve_status == 3) {
                return ['status' => 'Menunggu Review Wakil Direktur 1: Pemberitahuan Kegiatan Selesai Dilaksanakan', 'class' => 'bg-warning text-dark', 'users' => User::select('email')->where('role_id', 3)->get(), 'must_role' => [6, 0, 3]];
            } else if ($this->approve_status == 4) {
                return ['status' => "Pengajuan $latestExtraType Telah Disetujui", 'class' => 'bg-success', 'users' => [$this->user], 'must_role' => [0, 3]];
            } else {
                return ['status' => '', 'class' => '', 'users' => null, 'must_role' => []];
            }
        } else {
            return ['status' => 'Selesai', 'class' => 'bg-success', 'users' => [$this->user->email], 'must_role' => [0, 3]];
        }
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
    public function user ()
    {
        return $this->belongsTo(User::class);
    }
    public function role ()
    {
        return $this->belongsTo(role::class, 'role_id');
    }
    
}
