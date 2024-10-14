<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class approveExtraApplicationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $application;
    public $extraApplication;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($application, $extraApplication)
    {
        $this->application = $application;
        $this->extraApplication = $extraApplication;
    }
    public function build()
    {
        $extraApplication = '';
        switch ($this->extraApplication->type) {
            case 'dana':
                $extraApplication = 'Permintaan Pencairan Dana';
                break;
            case 'operasional':
                $extraApplication = 'Permintaan Pencairan Dana Operasional';
                break;
            case 'kegiatan':
                $extraApplication = 'Pengajuan Pemberitahuan Kegiatan Selesai Dilaksanakan';
                break;
        }
        $subjectEmail = "$extraApplication Anda Telah Diterima";

        return $this->subject($subjectEmail)
            ->view('mail.default', [
                'subject' => $subjectEmail . ', dengan detail:',
            ]);
    }
}
