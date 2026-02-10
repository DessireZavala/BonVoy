<?php

namespace App\Http\Controllers;

use App\Mail\ReservaConfirmada;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReservaController extends Controller
{
    public function store(Request $request)
    {
        // Crear la reserva
        $reserva = Reserva::create([
            'user_id' => Auth::id(),
            'contenido_id' => $request->contenido_id,
            'total' => $request->total ?? 0,
            'estado' => 'confirmada',
            'fecha_reserva' => now(),
        ]);

        // Enviar correo de confirmación
        Mail::to(Auth::user()->email)
            ->send(new ReservaConfirmada($reserva));

        return redirect()
            ->route('home')
            ->with('success', 'Reserva realizada. Revisa tu correo 📧');
    }
}
