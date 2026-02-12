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

    public function agregarPase(Request $request)
    {
        // 1. Validamos que los datos lleguen correctamente
        $request->validate([
            'tipo' => 'required|string',
            'precio' => 'required|numeric',
        ]);

        // 2. Obtenemos lo que ya hay en el carrito (o un array vacío si no hay nada)
        $carrito = session()->get('carrito_pases', []);

        // 3. Creamos el nuevo elemento
        $nuevoPase = [
            'id' => uniqid(), // Generamos un ID único temporal
            'tipo' => $request->tipo,
            'precio' => $request->precio,
            'fecha_agregado' => now()->format('d-m-Y H:i')
        ];

        // 4. Lo añadimos al array y guardamos en la sesión
        $carrito[] = $nuevoPase;
        session()->put('carrito_pases', $carrito);

        // 5. Redirigimos de vuelta con un mensaje de éxito
        return back()->with('success', '¡Pase ' . $request->tipo . ' añadido a tu reservación!');
    }

        public function mostrarCheckoutVuelo($id)
    {
        // Buscamos el contenido real en la BD
        $destino = \App\Models\Contenido::findOrFail($id);
        
        // Retornamos la vista 'checkout' que ya tienes diseñada
        return view('checkout', compact('destino'));
    }
}



