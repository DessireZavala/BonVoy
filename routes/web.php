<?php

use Illuminate\Support\Facades\Route;
use App\Models\Contenido;
use App\Models\Reserva;
use App\Http\Controllers\ContenidoController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\VueloController;

// --- RUTAS DE PROCESAMIENTO ---
// Fíjate que el {id} esté presente en la URL
Route::get('/checkout/{id}', function ($id) {
    $destino = \App\Models\Contenido::findOrFail($id);
    return view('checkout', compact('destino'));
})->name('checkout');

Route::post('/finalizar-pago', function (Request $request) {
    $reserva = \App\Models\Reserva::create([
        'user_id'       => auth()->id(),
        'contenido_id'  => $request->contenido_id,
        'total'         => $request->precio_total,
        'estado'        => 'confirmada',
        'fecha_reserva' => now(),
    ]);
    return redirect()->route('reservar.voucher', $reserva->id);
})->middleware('auth')->name('pago.procesar');

Route::get('/voucher/{id}', function ($id) {
    $reserva = \App\Models\Reserva::with('contenido')->findOrFail($id);
    return view('voucher', compact('reserva'));
})->middleware('auth')->name('reservar.voucher');

Route::middleware('auth')->group(function () {
    Route::post('/reservar', function (Request $request) {
        $request->validate(['contenido_id' => 'required|exists:contenido,id']);
        Reserva::create([
            'user_id' => auth()->id(),
            'contenido_id' => $request->contenido_id,
            'fecha_reserva' => now(),
        ]);
        // Redirigimos a la raíz con mensaje de éxito
        return redirect()->route('home')->with('success', '¡Tu reservación se ha realizado con éxito!');
    })->name('reservar.store');
});

// --- AUTENTICACIÓN ---
Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
Auth::routes();

// --- VISTA PRINCIPAL (INDEX) ---
Route::get('/', function (Request $request) {
    $query = $request->input('search'); 
    $contenidos = Contenido::where('activo', true)
        ->when($query, function ($q) use ($query) {
            return $q->where('titulo', 'LIKE', "%{$query}%")
                     ->orWhere('tipo', 'LIKE', "%{$query}%");
        })
        ->get();

    return view('index', compact('contenidos'));
})->name('home');

// --- PERFIL Y ADMIN ---
Route::get('/perfil', function () {
    $reservas = auth()->user()->reservas()->with('contenido')->get();
    return view('perfil', compact('reservas')); 
})->middleware('auth')->name('user.perfil');

Route::get('/destino/{id}', function ($id) {
    $destino = Contenido::findOrFail($id);
    return view('destino', compact('destino'));
})->name('destino.show');

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        $reservas = Reserva::with('user')->get();
        $contenidos = Contenido::all(); 
        return view('admin.contenido.panel', compact('reservas', 'contenidos'));
    })->name('admin.dashboard');
    Route::resource('admin/contenido', ContenidoController::class)->names('admin.contenido');
});

// NOTA: Se eliminó la ruta /home y la referencia al HomeController para evitar confusiones.



Route::get('/vuelos', [VueloController::class, 'index'])->name('vuelos.index');
Route::get('/vuelos/{id}', [VueloController::class, 'show'])->name('checkout.vuelo');

// Ruta para los Términos y Condiciones
Route::get('/terminos', function () {
    return view('legal.terminos');
})->name('terms');

Route::get('/politica-de-privacidad', function () {
    return view('legal.privacidad');
})->name('privacy');

// Rutas de Favoritos (Solo para usuarios logueados)
Route::middleware(['auth'])->group(function () {
    Route::get('/favoritos', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favoritos/{id}/{type}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});

use App\Http\Controllers\ReservaController;

// Esta es la ruta que procesa el formulario POST
Route::post('/reservar/pase', [ReservaController::class, 'agregarPase'])->name('reserva.agregarPase');

// app/Models/Contenido.php



// Esta ruta recibe el ID (2 o 6 que pusimos en el código) y carga la vista de checkout que ya tienes
Route::get('/checkout/vuelo/{id}', [ReservaController::class, 'mostrarCheckoutVuelo'])->name('checkout.vuelo');

