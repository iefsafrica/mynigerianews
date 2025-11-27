<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailService extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        return $this->from($this->details->email)
            ->subject(__('messages.enquiry'))
            ->markdown('emails.MailService', [
                'data' => $this->details,
            ]);
    }
}
