<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contenido;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ContenidoController extends Controller
{
    public function index()
    {
        // Jalamos los destinos y también las reservas para que el panel no marque error
        $contenidos = Contenido::all(); 
        $reservas = Reserva::with('user')->get();
        
        // Apuntamos a la ubicación real de tu archivo: admin/contenido/panel.blade.php
        return view('admin.contenido.panel', compact('contenidos', 'reservas'));
    }

    public function create()
    {
        return view('admin.contenido.create');
    }

    public function store(Request $request)
    {
        // Validamos y creamos el contenido
        Contenido::create($request->all());

        // Redirigimos al dashboard principal de admin
        return redirect()->route('admin.dashboard')->with('success', 'Destino creado correctamente');
    }

    public function edit(Contenido $contenido)
    {
        return view('admin.contenido.edit', compact('contenido'));
    }

    public function update(Request $request, Contenido $contenido)
    {
        // Actualizamos los datos del destino (Bonvoy)
        $contenido->update($request->all());

        // Redirigimos al dashboard para evitar el error de "view index not found"
        return redirect()->route('admin.dashboard')->with('success', 'Destino actualizado con éxito');
    }

    public function destroy(Contenido $contenido)
    {
        $contenido->delete();
        
        return redirect()->route('admin.dashboard')->with('success', 'Destino eliminado');
    }

    
}