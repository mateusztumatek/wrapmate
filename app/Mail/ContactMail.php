<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    protected  $topic, $email, $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->topic = $data['topic'];
        $this->email = $data['email'];
        $this->content = $data['content'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)->subject('Kontakt ze strony'. config('app.name'))->view('mails.contact')->with(['topic' => $this->topic, 'email' => $this->email, 'content' => $this->content]);
    }
}
