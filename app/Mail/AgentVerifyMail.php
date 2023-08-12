<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentVerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        $data['data'] =  $this->data;
        //dump($this->request);
        $subject=env('APP_NAME')." -Agent account activated";
        
        return $this->view('mail.agent_active', $data)
                     ->to($this->data['email'])
                     ->subject($subject)
                     ->from(env('MAIL_USERNAME'),env('APP_NAME'));
    }
}
