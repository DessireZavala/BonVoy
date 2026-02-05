<?php

use Illuminate\Support\Facades\Route;
use App\Models\Contenido;
use App\Models\Reserva;
use App\Http\Controllers\ContenidoController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // <-- IMPORTANTE: Agregamos esta línea


// 1. Ruta para ver el formulario de pago (Simulación)
Route::get('/checkout/{id}', function ($id) {
    $destino = Contenido::findOrFail($id);
    return view('checkout', compact('destino'));
})->middleware('auth')->name('checkout');

Route::post('/finalizar-pago', function (Request $request) {
    // Guardamos la reserva usando los datos que vienen del formulario
    $reserva = \App\Models\Reserva::create([
        'user_id'       => auth()->id(),
        'contenido_id'  => $request->contenido_id,
        'total'         => $request->precio_total, // <--- Cambiado de $request->total a precio_total
        'estado'        => 'Pagado',
        'fecha_reserva' => now(),
    ]);

    // Redirigimos al voucher
    return redirect()->route('reservar.voucher', $reserva->id);
})->middleware('auth')->name('pago.procesar');

// 3. Ruta para ver el voucher
Route::get('/voucher/{id}', function ($id) {
    // Traemos la reserva con la información del destino (contenido)
    $reserva = \App\Models\Reserva::with('contenido')->findOrFail($id);
    return view('voucher', compact('reserva'));
})->middleware('auth')->name('reservar.voucher');

Route::middleware('auth')->group(function () {
    // Esta es la ruta que falta:
    Route::post('/reservar', function (Request $request) {
        // Validamos que llegue el ID del contenido
        $request->validate([
            'contenido_id' => 'required|exists:contenido,id'
        ]);

        // Creamos la reserva en la base de datos
        Reserva::create([
            'user_id' => auth()->id(),
            'contenido_id' => $request->contenido_id,
            'fecha_reserva' => now(),
        ]);

        return redirect()->route('home')->with('success', '¡Tu reservación se ha realizado con éxito!');
    })->name('reservar.store');
});

// --- AUTENTICACIÓN Y SOCIALITE ---
Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Auth::routes();

// --- VISTA PÚBLICA (Para los Clientes) ---

// Fusionamos las dos rutas '/' en una sola que maneja la búsqueda
Route::get('/', function (Request $request) {
    $query = $request->input('search'); 

    $contenidos = Contenido::where('activo', true)
        ->when($query, function ($q) use ($query) {
            // Buscamos por título o por tipo (destino, hospedaje, etc.)
            return $q->where('titulo', 'LIKE', "%{$query}%")
                     ->orWhere('tipo', 'LIKE', "%{$query}%");
        })
        ->get();

    return view('index', compact('contenidos'));
})->name('home');

Route::get('/destino/{id}', function ($id) {
    $destino = Contenido::findOrFail($id);
    return view('destino', compact('destino'));
})->name('destino.show');

// --- RUTA PARA EL USUARIO ---
Route::get('/perfil', function () {
    // 1. Obtenemos las reservas del usuario autenticado con su contenido
    // Esto evita que la variable esté "indefinida" en la vista
    $reservas = auth()->user()->reservas()->with('contenido')->get();

    // 2. Pasamos la variable $reservas a la vista perfil.blade.php
    return view('perfil', compact('reservas')); 
})->middleware('auth')->name('user.perfil');

// --- PANEL PRIVADO (Para el Admin) ---
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    
    Route::get('/admin/dashboard', function () {
        $reservas = Reserva::with('user')->get();
        $contenidos = Contenido::all(); 
        return view('admin.contenido.panel', compact('reservas', 'contenidos'));
    })->name('admin.dashboard');

    Route::resource('admin/contenido', ContenidoController::class)->names('admin.contenido');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('app_home');