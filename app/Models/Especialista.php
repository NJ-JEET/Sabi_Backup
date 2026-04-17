<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    use HasFactory;

    // 1. Apuntamos a la tabla correcta
    protected $table = 'especialistas';

    // 2. Le decimos cuál es su llave primaria real
    protected $primaryKey = 'id_especialista';

    // 3. Los campos que permitimos llenar (exactamente como en tu foto)
    protected $fillable = [
        'id_usuario',
        'especialidad',
        'consultorio',
        'imagen_url'
    ];

    // (Opcional pero recomendado) Relación para obtener el nombre del usuario después
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}