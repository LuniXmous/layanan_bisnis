<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class rejectApplicationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $application;
    public $extraApp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($application, $extraApp = null)
    {
        $this->application = $application;
        $this->extraApp = $extraApp;
    }

    public function build()
    {
        if ($this->extraApp) {
            $subject = 'Permintaan Pengajuan ' . $this->extraApp . ' Anda Telah Ditolak';
        } else {
            $subject = 'Permintaan Pengajuan Layanan Bisnis Anda Telah Ditolak';
        }
        return $this->subject($subject)
            ->view('mail.default', [
                'subject' => $subject . ', dengan detail:',
            ]);
    }
}
