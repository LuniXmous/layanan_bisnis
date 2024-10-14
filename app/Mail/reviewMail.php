<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class reviewMail extends Mailable
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
            $subject = 'Permintaan Review ' . $this->extraApp . ' Layanan Bisnis Politeknik Negeri Jakarta';
            $body = 'Permintaan Review ' . $this->extraApp . ' Layanan Bisnis, dengan detail:';
        } else {
            $subject = 'Permintaan Review Layanan Bisnis Politeknik Negeri Jakarta';
            $body = 'Permintaan Review Layanan Bisnis, dengan detail:';
        }
        // dd($this->subject($subject)
        //     ->view('mail.default', [
        //         'subject' => $body,
        //     ]));
        return $this->subject($subject)
            ->view('mail.default', [
                'subject' => $body,
            ]);
    }
}
