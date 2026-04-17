<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // <-- Importante para encriptar contraseñas

class UsuarioController extends Controller
{
    // 1. Mostrar la tabla con todos los usuarios
    public function index()
    {
        $usuarios = Usuario::all(); 
        return view('usuarios.index', compact('usuarios'));
    }

    // 2. Mostrar el formulario visual para crear un usuario
    public function create()
    {
        return view('usuarios.create');
    }

    // 3. Recibir los datos del formulario y guardarlos en la base de datos
    public function store(Request $request)
    {
        // Validamos que llenen todo correctamente
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo', // Que el correo no se repita
            'contraseña' => 'required|min:6',
            'rol' => 'required'
        ]);

        // Creamos al usuario en la base de datos
        Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contraseña' => Hash::make($request->contraseña), // Encriptamos la clave por seguridad
            'rol' => $request->rol
        ]);

        // Lo regresamos a la tabla con un mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // 4. Mostrar el formulario con los datos precargados para editar
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id); // Busca al usuario por su ID
        return view('usuarios.edit', compact('usuario'));
    }

    // 5. Guardar los cambios editados en la base de datos
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        // Validamos. Ojo aquí: le decimos a Laravel que ignore el correo de este mismo usuario para que no marque error de "correo repetido"
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo,' . $usuario->id_usuario . ',id_usuario',
            'rol' => 'required'
        ]);

        // Actualizamos los datos
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->rol = $request->rol;

        // Si escribieron una contraseña nueva, la encriptamos y la guardamos. Si lo dejaron en blanco, se queda la misma.
        if ($request->filled('contraseña')) {
            $usuario->contraseña = Hash::make($request->contraseña);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }

    // 6. Eliminar al usuario de la base de datos
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}