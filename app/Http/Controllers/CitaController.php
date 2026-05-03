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
            $idPacienteReal = Auth::user()->paciente->id_paciente; // Obtenemos el ID del paciente logueado
            $citas = Cita::where('id_paciente', $idPacienteReal)->get();
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
            'motivo' => 'required|string|max:255',
        ]);

        $horaFormateada = date('H:i:00', strtotime($request->hora));

        $existeCita = Cita::where('id_especialista', $request->id_especialista)
            ->where('fecha', $request->fecha)
            ->where('hora', $horaFormateada)
            ->where('estado','!=', 'Cancelada')
            ->exists();
        
        if ($existeCita) {
            return back()->withInput()->withErrors(['error' => 'Ya existe una cita para ese especialista en la fecha y hora seleccionadas. Por favor, elige otro horario.']);
        }
        
        // 1. Guardamos la cita en una variable ($cita) para poder usar sus datos después
        $cita = Cita::create([
            'id_paciente' => Auth::user()->paciente->id_paciente, // Usamos el ID del paciente logueado
            'id_especialista' => $request->id_especialista,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'Pendiente',
            'motivo' => $request->motivo,
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
            'motivo' => 'required|string|max:255',
        ]);

        // 1. Normalizamos la hora para comparar con el formato de la DB (HH:MM:00)
        $horaFormateada = date('H:i:00', strtotime($request->hora));

        // 2. Buscamos choques, ignorando la cita actual y las canceladas
        $existeCita = Cita::where('id_especialista', $request->id_especialista)
            ->where('fecha', $request->fecha)
            ->where('hora', $horaFormateada) // <-- Usamos la hora normalizada
            ->where('estado', '!=', 'Cancelada')
            ->where('id_cita', '!=', $id) 
            ->exists();

        // 3. Solo si existe un choque, regresamos con error
        if ($existeCita) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'No se puede modificar: ese horario ya está ocupado por otra cita activa.']);
        }

        // 4. Si todo está bien, actualizamos
        $cita = Cita::findOrFail($id);
        $cita->update([
            'id_especialista' => $request->id_especialista,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'motivo' => $request->motivo,
        ]);

        return redirect()->route('citas.index')->with('success', 'La cita se ha modificado correctamente.');
    }

    public function completar($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->update(['estado' => 'Completada']);
        return redirect()->route('citas.index')->with('success', 'La consulta se ha marcado como completada.');
    }

    public function cancelar($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->update(['estado' => 'Cancelada']);
        return redirect()->route('citas.index')->with('success', 'La cita se ha cancelado correctamente.');
    }
}