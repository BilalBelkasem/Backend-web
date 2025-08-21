<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public ContactMessage $messageModel;

    public function __construct(ContactMessage $messageModel)
    {
        $this->messageModel = $messageModel;
    }

    public function build()
    {
        return $this->subject('Antwoord op je bericht: ' . $this->messageModel->subject)
            ->view('emails.contact-form-reply')
            ->with([
                'messageModel' => $this->messageModel,
            ]);
    }
}


