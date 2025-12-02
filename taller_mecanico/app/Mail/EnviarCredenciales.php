<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarCredenciales extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $correo;
    public $password;

    public function __construct($nombre, $correo, $password)
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Credenciales de acceso')
            ->view('emails.credenciales');
    }
}
