<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsSendToSender extends Mailable
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
        $this->subject = config('app.name') . " | We Got Your Message";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(get_option('email_address'))
            ->to($this->data['email'])
            ->subject($this->subject)
            ->markdown('emails.contact_us_send_to_sender');

    }
}
