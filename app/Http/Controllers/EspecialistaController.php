<?php

namespace App\Http\Controllers;

use App\Models\Especialista; 
use Illuminate\Http\Request;

class EspecialistaController extends Controller
{
    // Muestra la lista de especialistas (Consultar)
    public function index()
    {
        $especialistas = Especialista::all();
        // Traemos todos los usuarios para poder ligarlos en el formulario
        $usuarios = \App\Models\Usuario::where('rol', 'ESPECIALISTA')->get(); 
        return view('especialistas.index', compact('especialistas', 'usuarios'));
    }


    // Guarda un nuevo especialista (Crear)
// 2. Guardar un nuevo especialista en el catálogo
    public function store(Request $request)
    {
        // Validamos usando el nombre de tu input (lo cambiaremos en el paso 3)
        $request->validate([
            'id_usuario' => 'required',
            'especialidad' => 'required|string|max:255',
            'consultorio' => 'required|string|max:50',
            'imagen_url' => 'nullable|url' 
        ]);

        // Guardamos en la base de datos empatando con tus columnas reales
        Especialista::create([
            'id_usuario' => $request->id_usuario,
            'especialidad' => $request->especialidad,
            'consultorio' => $request->consultorio,
            'imagen_url' => $request->imagen_url 
        ]);

        return redirect()->route('especialistas.index')->with('success', 'Especialista agregado al catálogo.');
    }


    // Elimina un especialista (Eliminar)
    public function destroy($id) {
        Especialista::find($id)->delete();
        // Enviamos el mensaje 'success' a la sesión
        return redirect()->back()->with('success', 'Especialista eliminado del sistema.');
    }
}