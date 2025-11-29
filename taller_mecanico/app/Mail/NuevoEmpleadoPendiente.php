<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class NuevoEmpleadoPendiente extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $puesto;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $puesto = null)
    {
        $this->user = $user;
        $this->puesto = $puesto;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Nuevo registro de empleado pendiente de aprobación')
            ->view('emails.nuevo_empleado');
    }
}
