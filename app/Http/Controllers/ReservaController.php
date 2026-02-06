<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\ContenidoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function store(Request $request)
    {
        Reserva::create([
            'user_id' => Auth::id(),
            'contenido_id' => $request->contenido_id,
            'total' => $request->total ?? 0,
            'estado' => 'confirmada',
            'fecha_reserva' => now(),
        ]);

        return redirect()->route('home')->with('success', 'Reserva realizada');
    }
}

