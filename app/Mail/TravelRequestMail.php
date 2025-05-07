<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TravelRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $sender;
    public $receiver;

    public function __construct(User $sender, User $receiver)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
    }

    public function build()
    {
        return $this->subject('New Travel Request on UniBuddy')
                    ->markdown('emails.travel-request')
                    ->with([
                        'senderName' => $this->sender->name,
                        'receiverName' => $this->receiver->name,
                    ]);
    }
}
