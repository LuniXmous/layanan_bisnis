<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Application;

class ReminderAktor extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function build()
    {
        return $this->subject('Reminder Pengajuan Belum Ditinjau Admin Layanan Bisnis')
            ->view('mail.reminder_pengajuan_aktor')
            ->with([
                'application' => $this->application,
            ]);
    }
}
