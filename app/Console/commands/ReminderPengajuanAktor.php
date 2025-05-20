<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Application;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderAktor;
use Carbon\Carbon;


class ReminderPengajuanAktor extends Command
{
    protected $signature = 'reminder:pengajuan-aktor {--minutes=5}';
    protected $description = 'Kirim email reminder ke aktor jika pengajuan belum diterima lebih dari x menit';

    public function handle()
    {
    $minutes = $this->option('minutes'); 
    $threshold = now()->subMinutes($minutes);

    $applications = Application::where('created_at', '<=', now()->subMinutes($this->option('minutes')))
    ->get();


        foreach ($applications as $application) {
            \Log::info("Ditemukan: " . $application->user->email . " - status: " . $application->status . " - created_at: " . $application->created_at);
            if ($application->user && $application->user->email) {
                Mail::to($application->user->email)->send(new ReminderAktor($application));
                $this->info("Reminder dikirim ke: " . $application->user->email);
            }
        }

        return 0;
    }
}
