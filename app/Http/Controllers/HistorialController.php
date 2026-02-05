<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HistorialController extends Controller
{
    public function historial($id)
    {
        // buscar usuario con sus reservas
        $usuario = User::with('reservas')->findOrFail($id);

        return response()->json([
            'usuario' => $usuario->name,
            'reservas' => $usuario->reservas
        ]);
    }
}
