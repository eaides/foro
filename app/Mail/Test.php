<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Test extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $name = '';          // if defined as public, can be used in templates without the 'with' function

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.testmail')
            // ->with('name',$this->name)                       // not needed because $this->name is defined as public
            ->from('admin@foro.com','The Admin')
            ->subject('Test Mail by new 5.3 Mailable Class');
    }
}
