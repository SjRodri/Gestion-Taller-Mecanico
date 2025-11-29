<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tabla real en la BD
    protected $table = 'usuarios';

    // Primary Key
    protected $primaryKey = 'usuario_id';

    // Si tu tabla NO tiene columnas created_at / updated_at
    public $timestamps = false;

    // Campos asignables
    protected $fillable = [
        'email',
        'password_hash',
        'rol',
        'cliente_id',
        'empleado_id',
        'activo',
    ];

    // Ocultar atributos sensibles
    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    // public function empleado()
    // {
    //     return $this->belongsTo(Empleado::class, 'empleado_id');
    // }
    // public function cliente()
    // {
    //     return $this->belongsTo(Cliente::class, 'cliente_id');
    // }

    /**
     * 🔐 Método requerido por Laravel para saber qué campo es la contraseña.
     * Retorna password_hash en lugar de password.
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    /**
     * ⚙️ Casting de atributos
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }
}
