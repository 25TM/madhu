<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
// batch

class WelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $emailContent;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $emailContent )
    {
        $this->name = $name;
        $this->emailContent = $emailContent;
    }
    
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // batch
       
        return $this->subject('Welcome to Guild')
        ->setBody('<html><body>'.$this->emailContent.'</body></html>', 'text/html')
        ->attach(public_path('files/').$this->name)
        ->view('emails.welcome')
        ->with([
            'name' => $this->name,
            'emailContent' => $this->emailContent,
        ])
        ;
    }

}