<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @param array $application
     */
    public function __construct($application)
    {
        $this->application = $application;
        $this->subject = 'Pengingat permintaan pengajuan anda';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('mail.reminderMail')
                    ->with([
                        'application' => $this->application,
                        'subject' => $this->subject
                    ]);
    }
}
