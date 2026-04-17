<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Especialista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CitaController extends Controller
{
    public function index()
    {
        $rol = Auth::user()->rol;

        if ($rol == 'Paciente') {
            // CAMBIO AQUÍ: Cambia 'id_usuario' por 'id_paciente'
            $citas = Cita::where('id_paciente', Auth::user()->id_usuario)->get();
        } else {
            // Admin y Especialista ven todo
            $citas = Cita::with(['paciente', 'especialista.usuario'])->get();
        }

        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        // Necesitamos la lista de médicos para el formulario
        $especialistas = Especialista::with('usuario')->get();
        return view('citas.create', compact('especialistas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_especialista' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        // 1. Guardamos la cita en una variable ($cita) para poder usar sus datos después
        $cita = Cita::create([
            'id_paciente' => Auth::user()->id_usuario, 
            'id_especialista' => $request->id_especialista,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'Pendiente'
        ]);

        // 2. Enviamos el correo (esto debe ir ANTES del redirect)
        // Usamos Auth::user()->email para que le llegue al paciente real
        Mail::raw("Hola " . Auth::user()->nombre . ", tu cita ha sido programada exitosamente para el día {$cita->fecha} a las {$cita->hora}.", function ($message) {
            $message->to(Auth::user()->correo) // Envía al correo del usuario logueado
                    ->subject('Confirmación de Cita Médica - Sabi Núcleo Médico');
        });

        // 3. Ahora sí, después de enviar el correo, redireccionamos
        return redirect()->route('citas.index')->with('success', 'Tu cita ha sido agendada y se ha enviado un correo de confirmación.');
    }

    // 1. Mostrar el formulario de edición
    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $especialistas = Especialista::with('usuario')->get();
        return view('citas.edit', compact('cita', 'especialistas'));
    }

    // 2. Procesar el cambio en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_especialista' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update([
            'id_especialista' => $request->id_especialista,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
        ]);

        return redirect()->route('citas.index')->with('success', 'La cita se ha modificado correctamente.');
    }
}