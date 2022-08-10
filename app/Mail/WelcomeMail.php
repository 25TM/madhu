<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $email_content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name/* , $email_content */)
    {
        $this->name = $name;
        // $this->email_content = $email_content;
    }
    
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to Guild')->view('emails.welcome')->with([
            'name' => $this->name,
            'email_content' => $this->email_content,
        ]);
    }

}