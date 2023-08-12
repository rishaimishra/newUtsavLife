<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminOrderMail extends Mailable
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
        $subject=env('APP_NAME')." - Order Status From Vandor";
        
        return $this->view('mail.order_status_to_admin', $data)
                     ->to($this->data['admin_mail'])
                     ->subject($subject)
                     ->from(env('MAIL_USERNAME'),env('APP_NAME'));
    }
}
