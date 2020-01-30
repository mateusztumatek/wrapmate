<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    protected  $name, $email, $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->name = $data->name;
        $this->email = $data->email;
        $this->content = $data->content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)->subject('Kontakt ze strony'. config('app.name'))->view('mails.contact')->with(['name' => $this->name, 'email' => $this->email, 'content' => $this->content]);
    }
}
