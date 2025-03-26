<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewDeviceNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $ip;
    public $userAgent;

    public function __construct($ip, $userAgent)
    {
        $this->ip = $ip;
        $this->userAgent = $userAgent;
    }

    public function build()
    {
        return $this->subject('Nouvel appareil détecté')
                    ->view('emails.newDevice')
                    ->with([
                        'ip' => $this->ip,
                        'userAgent' => $this->userAgent,
                    ]);
    }
}
