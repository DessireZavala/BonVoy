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


       public function mostrarVoucher($id)
{
    // 1. Buscar reserva
    $reserva = \App\Models\Reserva::with('contenido')->findOrFail($id);

    // 2. CALCULAR EL LINK DE CALENDARIO (Esta es la parte que te falta o está fallando)
    $fechaInicio = $reserva->created_at->addDays(15)->format('Ymd\THis');
    $fechaFin = $reserva->created_at->addDays(18)->format('Ymd\THis');
    
    $titulo = urlencode("✈️ Viaje BonVoy: " . $reserva->contenido->titulo);
    $detalles = urlencode("Reserva: #BNV-" . $reserva->id);
    $ubicacion = urlencode("Aeropuerto CDMX");

    $calendarUrl = "https://www.google.com/calendar/render?action=TEMPLATE&text={$titulo}&dates={$fechaInicio}/{$fechaFin}&details={$detalles}&location={$ubicacion}&sf=true&output=xml";

    // 3. ENVIAR LA VARIABLE A LA VISTA (¡CRUCIAL!)
    // Fíjate que diga 'calendarUrl' dentro del compact
    return view('voucher', compact('reserva', 'calendarUrl'));
}
}
