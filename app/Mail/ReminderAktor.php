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
    public $reminder_pengajuan_aktor;
    public $subject;

    public function __construct($application, $reminder = false)
    {
        $this->application = $application;
        $this->reminder_pengajuan_aktor = $reminder;
    }

    public function build()
    {
    return $this->view('mail.default')
        ->with([
            'application' => $this->application,
            'reminder_pengajuan_aktor' => $this->reminder_pengajuan_aktor,
        ])
        ->subject('Reminder Pengajuan Anda Belum Diproses');
    }
}
