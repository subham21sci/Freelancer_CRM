<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address = 'subham21sci@gmail.com';
        $subject = 'Website Inquiry';
        $name = 'Inquiry';

        return $this->view('emails.test')
                    ->from($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([
                        'first_name' => $this->data['first_name'],
                        'last_name' => $this->data['last_name'],
                        'email' => $this->data['email'],
                        'phone' => $this->data['phone'],
                        'service' => $this->data['service']
                    ]);
    }
}
