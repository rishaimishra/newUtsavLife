<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VandorForgetPassword extends Mailable
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
    } //
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd(env('MAIL_USERNAME'),env('APP_NAME'),env('MAIL_HOST'),env('MAIL_PORT'),env('MAIL_ENCRYPTION'));
        $data['data'] =  $this->data;
        //dump($this->request);
        $subject=env('APP_NAME')." -Vendor Reset Password";
        
        return $this->view('mail.vandor_fg', $data)
                     ->to($this->data['email'])
                     ->subject($subject)
                     ->from(env('MAIL_USERNAME'),env('APP_NAME'));
    }
}
