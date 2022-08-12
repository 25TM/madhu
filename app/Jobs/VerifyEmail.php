<?php

namespace App\Jobs;

use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class VerifyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $email;
    public $emailContent;
    public function __construct($email,
    $emailContent
    )
    {
        $this->email = $email;
        $this->emailContent = $emailContent;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
        Mail::to($this->email)->send(new WelcomeMail($this->email, $this->emailContent));
    }

}