<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout | BonVoy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Red+Hat+Display:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Ocultar flechas en inputs numéricos */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; margin: 0; 
        }
    </style>
</head>
<body class="font-sans text-bonvoy-dark antialiased bg-bonvoy-gray min-h-screen flex flex-col">

    <header class="w-full bg-white py-4 shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="BonVoy" class="h-20 w-auto">
            </a>

            <div class="text-bonvoy-navy font-bold text-sm flex items-center gap-2 bg-gray-50 px-3 py-1 rounded-full border border-gray-100">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <span class="opacity-90 hidden md:inline">Pago 100% Seguro</span>
                <span class="opacity-90 md:hidden">Seguro</span>
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center py-12 px-6">
        <div class="w-full max-w-5xl grid lg:grid-cols-5 gap-8">
            
            <div class="lg:col-span-2 order-2 lg:order-1">
                <div class="bg-white rounded-3xl p-6 shadow-lg border border-gray-100 sticky top-6">
                    <h3 class="text-lg font-bold text-bonvoy-navy mb-4 border-b pb-2">Resumen de tu viaje</h3>
                    
                    <div class="flex gap-4 mb-4">
                        <img src="{{ $destino->imagenPrincipal ? asset('storage/' . $destino->imagenPrincipal->ruta) : 'https://images.unsplash.com/photo-1516426122078-c23e76319801?q=80&w=200' }}" 
                             class="w-20 h-20 rounded-xl object-cover shadow-sm" alt="Destino">
                        <div>
                            <h4 class="font-bold text-bonvoy-dark leading-tight">{{ $destino->titulo }}</h4>
                            <span class="text-xs text-bonvoy-teal font-semibold uppercase">{{ ucfirst($destino->tipo) }}</span>
                        </div>
                    </div>

                    <div class="space-y-3 text-sm text-gray-600 mb-6">
                        <div class="flex justify-between">
                            <span>Precio base</span>
                            <span>${{ number_format($destino->precio, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Impuestos y tasas</span>
                            <span>$0.00</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between items-center font-bold text-bonvoy-navy text-lg">
                            <span>Total a pagar</span>
                            <span>${{ number_format($destino->precio, 2) }}</span>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-3 rounded-lg flex items-start gap-3 text-xs text-blue-800">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p>No se te cobrará nada hasta que completes este paso. Cancelación gratuita disponible según términos.</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3 order-1 lg:order-2">
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                    
                    <div class="bg-bonvoy-navy p-6 text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10 blur-2xl"></div>
                        
                        <h2 class="font-display text-2xl tracking-wide relative z-10">Finalizar Reservación</h2>
                        <p class="text-white/70 text-sm relative z-10">Completa tus datos para asegurar tu lugar.</p>
                    </div>

                    <div class="p-8">
                        <form action="{{ route('pago.procesar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="contenido_id" value="{{ $destino->id }}">
                            <input type="hidden" name="precio_total" value="{{ $destino->precio }}">

                            <div class="mb-8">
                                <h3 class="text-bonvoy-dark font-bold mb-4 flex items-center gap-2">
                                    <span class="bg-bonvoy-light/20 text-bonvoy-main w-6 h-6 rounded-full flex items-center justify-center text-xs">1</span>
                                    Información de Contacto
                                </h3>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nombre Completo</label>
                                        <input type="text" name="nombre" placeholder="Como aparece en tu ID" required
                                               class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-bonvoy-main/50 focus:border-bonvoy-main transition">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Correo Electrónico</label>
                                        <input type="email" value="{{ auth()->user()->email }}" readonly
                                               class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-gray-500 cursor-not-allowed">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-8">
                                <h3 class="text-bonvoy-dark font-bold mb-4 flex items-center gap-2">
                                    <span class="bg-bonvoy-light/20 text-bonvoy-main w-6 h-6 rounded-full flex items-center justify-center text-xs">2</span>
                                    Método de Pago
                                </h3>

                                <div class="bg-gradient-to-br from-gray-800 to-black text-white p-6 rounded-2xl mb-6 shadow-lg relative overflow-hidden group hover:scale-[1.01] transition-transform duration-300">
                                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                                    <div class="flex justify-between items-start mb-8">
                                        <div class="text-xs opacity-75 tracking-widest">TARJETA DE CRÉDITO</div>
                                        <svg class="w-10 h-6 text-white/80" fill="currentColor" viewBox="0 0 24 24"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/></svg>
                                    </div>
                                    <div class="text-2xl font-mono tracking-widest mb-4">•••• •••• •••• ••••</div>
                                    <div class="flex justify-between text-xs font-mono uppercase">
                                        <div>
                                            <span class="block opacity-50 text-[0.6rem]">Titular</span>
                                            <span>{{ auth()->user()->name }}</span>
                                        </div>
                                        <div>
                                            <span class="block opacity-50 text-[0.6rem]">Expira</span>
                                            <span>MM/AA</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Número de Tarjeta</label>
                                        <div class="relative">
                                            <input type="text" placeholder="0000 0000 0000 0000" maxlength="19" required
                                                class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-12 pr-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-bonvoy-main/50 focus:border-bonvoy-main transition font-mono">
                                            <svg class="w-6 h-6 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Vencimiento</label>
                                            <input type="text" placeholder="MM / AA" maxlength="5" required
                                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-center text-gray-700 focus:outline-none focus:ring-2 focus:ring-bonvoy-main/50 focus:border-bonvoy-main transition">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">CVC / CVV</label>
                                            <div class="relative">
                                                <input type="text" placeholder="123" maxlength="4" required
                                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-center text-gray-700 focus:outline-none focus:ring-2 focus:ring-bonvoy-main/50 focus:border-bonvoy-main transition">
                                                <svg class="w-4 h-4 text-gray-400 absolute right-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" 
                                class="w-full bg-bonvoy-main hover:bg-bonvoy-teal text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 text-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Pagar ${{ number_format($destino->precio, 2) }} MXN
                            </button>
                            
                            <p class="text-center text-xs text-gray-400 mt-4">
                                Al hacer clic en "Pagar", aceptas nuestros <a href="#" class="text-bonvoy-main hover:underline">Términos y Condiciones</a>.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t py-6 text-center text-xs text-gray-500 mt-auto">
        <p>&copy; {{ date('Y') }} BonVoy Inc. Todos los derechos reservados.</p>
    </footer>

</body>
</html>