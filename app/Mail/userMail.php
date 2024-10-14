<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class userMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $pwd;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $pwd)
    {
        $this->user = $user;
        $this->pwd = $pwd;
    }

    public function build()
    {
        return $this->subject('Akun Baru Layanan Bisnis Politeknik Negeri Jakarta')
            ->view('mail.user');
    }
}
