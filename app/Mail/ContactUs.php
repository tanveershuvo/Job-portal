<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @param $request
     */
    public function __construct($request)
    {
        $this->data = $request;
        $this->subject = config('app.name') . " | New Contact-Us Query";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->data['email'])
            ->to(config('mail.username'))
            ->subject($this->subject)
            ->markdown('emails.contact_us');
    }
}
