<?php
namespace App\Http\Controllers;

use App\Models\Usuario; // Tu modelo personalizado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,correo',
            'password' => 'required|string|min:8|confirmed',
            'country_code' => 'required',
            'phone_prefix' => 'required',
            'telefono' => 'required|numeric',
            'idioma' => 'nullable|string|max:255',
            'zona_horaria' => 'required|string',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->email, // Guardamos el valor del input 'email' en la columna 'correo'
            'password' => Hash::make($request->password), // En la columna 'contraseña'
            'country_code' => $request->country_code,
            'phone_prefix' => $request->phone_prefix,
            'telefono' => $request->telefono,
            'idioma' => $request->idioma,
            'zona_horaria' => $request->zona_horaria,
            'rol' => 'Paciente', // Asignamos el rol de Paciente por defecto
        ]);

        return redirect()->route('login')->with('success', '¡Registro exitoso! Ya puedes iniciar sesión.');
    }
}