<?php

namespace App\Utils;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public  $title;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $message)
    {
        //
        $this->title = $title;
        $this->message= $$message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title);
    }

    
}