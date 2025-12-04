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
        // Censurar contraseña → solo primeros 2 caracteres
        $visible = substr($password, 0, 2);
        $oculto = str_repeat('*', max(strlen($password) - 2, 0));

        $this->password = $visible . $oculto;
    }

    public function build()
    {
        return $this->subject('Credenciales de acceso')
            ->view('emails.credenciales');
    }
}
