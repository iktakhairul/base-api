<?php

namespace App\Jobs;

use App\Mail\RegistrationConfirmation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email, $receiverName;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $receiverName)
    {
        $this->email = $email;
        $this->receiverName = $receiverName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new RegistrationConfirmation($this->email, $this->receiverName));
    }
}
