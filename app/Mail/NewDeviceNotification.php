<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewDeviceNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $ip;
    public $appareil;
    public $id_ip;

    public function __construct($appareil)
    {
        $this->ip = $appareil->adressIP; 
        $this->appareil = $appareil->nameAppareil; 
        $this->id_ip=$appareil->id;
    }

    public function build()
    {
        return $this->subject('Nouvel appareil détecté')
                    ->view('emails.newDevice')
                    ->with([
                        'ip' => $this->ip,
                        'appareil' => $this->appareil, 
                        'id_ip'=>$this->id_ip
                        
                    ]);
    }
}
