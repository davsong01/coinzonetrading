<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        if($this->data['type'] == 'registration'){
            return $this->markdown('mails.notificationEmails')
                ->subject('Welcome to Coinzone');
        }

        // if($this->data['type'] == 'package-payment'){
        //     return $this->markdown('mails.notificationEmails')
        //         ->subject('New contact form');
        // }
        // if($this->data['type'] == 'new_product_user'){
        //     return $this->markdown('mails.notificationEmails')
        //         ->subject('Payment received');
        // }
        // if($this->data['type'] == 'new_product_admin'){
        //     return $this->markdown('mails.notificationEmails')
        //         ->subject('Payment received from '.$this->data['name']);
        // }
    }

}      
