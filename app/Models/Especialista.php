<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_especialista';
    protected $fillable = ['especialidad', 'consultorio', 'imagen_url', 'id_usuario'];

    public function usuario()
{
    // Relacionamos id_usuario de especialistas con id_usuario de usuarios
    return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
}
}
