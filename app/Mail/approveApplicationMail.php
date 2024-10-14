<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class approveApplicationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $application;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($application)
    {
        $this->application = $application;
    }

    public function build()
    {
        $subject = 'Permintaan Pengajuan Layanan Bisnis Anda Telah Diterima';
        return $this->subject($subject)
            ->view('mail.default', [
                'subject' => $subject . ', dengan detail:',
            ]);
    }
}
