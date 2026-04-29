<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Mail\PasswordChangedMail; // Importamos el nuevo Mailable
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 2. Procesar el inicio de sesión
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        $credenciales = [
            'correo' => $request->correo,
            'password' => $request->password 
        ];

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); 
        }

        return back()->withErrors([
            'correo' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // 3. Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // 4. Mostrar formulario de "Olvidé mi contraseña"
    public function showForgotForm()
    {
        return view('auth.forgot-password'); 
    }

    // 5. Enviar el código de recuperación por correo
    public function sendResetLink(Request $request)
    {
        $request->validate(['correo' => 'required|email']);
        $usuario = Usuario::where('correo', $request->correo)->first();

        if ($usuario) {
            $codigo = rand(1000, 9999); 

            // Guardamos en sesión el código y el correo para la siguiente fase
            session(['reset_code' => $codigo, 'reset_email' => $request->correo]);

            Mail::raw("Hola {$usuario->nombre}, tu código de recuperación para Sabi Núcleo Médico es: $codigo", function ($message) use ($usuario) {
                $message->to($usuario->correo)->subject('Restablecer Contraseña');
            });

            return redirect()->route('password.reset')->with('success', 'Código enviado correctamente.');
        }

        return back()->withErrors(['correo' => 'El correo electrónico no se encuentra registrado.']);
    }

    // 6. Mostrar el formulario para ingresar el código y la nueva clave
    public function showResetForm() 
    {
        return view('auth.reset-password');
    }

    // 7. Procesar la actualización de la contraseña
    public function updatePassword(Request $request) 
    {
        $request->validate([
            'codigo' => 'required',
            'password' => 'required|min:6|confirmed' 
        ]);

        // Validar que el código ingresado coincida con el guardado en sesión
        if ($request->codigo != session('reset_code')) {
            return back()->withErrors(['codigo' => 'El código de verificación es incorrecto.']);
        }

        // Buscar al usuario por el correo que tenemos en sesión
        $usuario = Usuario::where('correo', session('reset_email'))->first();

        if ($usuario) {
            // Actualizar y cifrar la nueva contraseña
            $usuario->password = Hash::make($request->password);
            $usuario->save();

            // --- NUEVAS MODIFICACIONES ---

            // A. Enviar correo de confirmación de éxito
            // Asegúrate de haber creado el mailable con 'php artisan make:mail PasswordChangedMail'
            Mail::to($usuario->correo)->send(new PasswordChangedMail());

            // B. Limpiar los datos de recuperación de la sesión por seguridad
            session()->forget(['reset_code', 'reset_email']);

            // C. Mostrar la vista de éxito en lugar de redireccionar directamente al login
            return view('auth.password-success');
        }

        return redirect()->route('login')->with('error', 'Ocurrió un error al procesar la solicitud.');
    }
}