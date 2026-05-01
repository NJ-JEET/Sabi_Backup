<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes'; //
    protected $primaryKey = 'id_paciente';

    protected $fillable = [
        'id_usuario',
        'fecha_registro',
        'historial',
    ];

    /**
     * Relación inversa: Un paciente pertenece a un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}