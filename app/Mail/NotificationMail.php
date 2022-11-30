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
                ->subject('Welcome to '. config('app.name'));
        }

        if ($this->data['type'] == 'contact-mail-to-admin') {
            return $this->markdown('mails.notificationEmails')
            ->subject('Contact form filled on '. config('app.name'));
        }

        if ($this->data['type'] == 'withdrawal-notification-to-admin') {
            return $this->markdown('mails.notificationEmails')
            ->subject('A new withdrawal request on ' . config('app.name'));
        }

        if ($this->data['type'] == 'withdrawal-status-change-to-investor') {
            return $this->markdown('mails.notificationEmails')
            ->subject('Request for Withdrawal status notification');
        }

        if ($this->data['type'] == 'id-approval-by-admin') {
            return $this->markdown('mails.notificationEmails')
            ->subject('Identification Verification successful');
        }

        if ($this->data['type'] == 'upload-means-of-identification') {
            return $this->markdown('mails.notificationEmails')
            ->subject('Investor uploaded means of identification');
        }        
    }

}
