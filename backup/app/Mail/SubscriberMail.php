<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriberMail extends Mailable
{
    use Queueable, SerializesModels;

    public $input;

    public $email;

    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input, $email, $subject)
    {
        $this->input = $input;
        $this->email = $email;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {

        $subject = $this->subject;

        return $this->subject($subject)
            ->markdown('emails.subscriber_mail')
            ->with($this->input);
    }
}
