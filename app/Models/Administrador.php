<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $table = 'administradores'; 
    protected $primaryKey = 'id_admin'; // Correcto: coincide con tu migración

    protected $fillable = [
        'id_usuario',
        'nivel_acceso',
        'fecha_asig',   // Agregado para el seeder
        'departamento', // Agregado para el seeder
    ];

    /**
     * Relación inversa: Un administrador pertenece a un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}