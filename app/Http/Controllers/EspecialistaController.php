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
        return view('especialistas', compact('especialistas', 'usuarios'));
    }


    // Guarda un nuevo especialista (Crear)
    public function store(Request $request)
    {
        // El request ya trae el 'id_usuario' desde el <select> del formulario
        Especialista::create($request->all()); 
        return redirect()->back()->with('success', 'Especialista ligado y registrado correctamente.');
    }


    // Elimina un especialista (Eliminar)
    public function destroy($id) {
        Especialista::find($id)->delete();
        // Enviamos el mensaje 'success' a la sesión
        return redirect()->back()->with('success', 'Especialista eliminado del sistema.');
    }
}