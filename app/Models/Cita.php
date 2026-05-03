<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $primaryKey = 'id_cita';

    protected $fillable = [
        'id_paciente', // Cambiado de id_usuario a id_paciente
        'id_especialista',
        'fecha',
        'hora',
        'motivo',
        'estado'           // Pendiente, Completada, Cancelada
    ];

    // Relación: Una cita pertenece a un Paciente (Usuario)
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }

    // Relación: Una cita pertenece a un Especialista
    public function especialista()
    {
        return $this->belongsTo(Especialista::class, 'id_especialista', 'id_especialista');
    }
}