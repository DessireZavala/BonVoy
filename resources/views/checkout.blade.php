<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout Seguro | BonVoy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Red+Hat+Display:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-pattern {
            background-color: #f8fafc;
            background-image: radial-gradient(#cbd5e1 0.5px, transparent 0.5px);
            background-size: 24px 24px;
        }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; margin: 0; 
        }
        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
        @keyframes shine { 100% { left: 125%; } }
        .animate-shine { animation: shine 0.8s infinite; }
    </style>
</head>
<body class="font-sans text-bonvoy-dark antialiased bg-pattern min-h-screen flex flex-col">

    <header class="w-full glass-header py-4 shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('home') }}" class="transition hover:opacity-80">
                <img src="{{ asset('assets/img/logo.png') }}" alt="BonVoy" class="h-16 w-auto">
            </a>

            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-widest">
                    <span class="text-bonvoy-main text-lg">●</span> Datos
                    <span class="mx-2">──</span>
                    <span class="text-bonvoy-main text-lg">●</span> Pago
                    <span class="mx-2">──</span>
                    <span class="text-gray-300">○</span> Confirmación
                </div>
                <div class="bg-green-50 text-green-700 px-4 py-2 rounded-full border border-green-100 flex items-center gap-2 text-xs font-bold shadow-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    SSL SECURE
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-start justify-center py-12 px-6">
        <div class="w-full max-w-6xl grid lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-4 order-2 lg:order-1">
                <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/50 border border-gray-100 sticky top-28">
                    <h3 class="text-xl font-bold text-bonvoy-navy mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 118 0m-4 10v2a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2m4 0V5a2 2 0 114 0v2m-6 4h6m-6 4h6"></path></svg>
                        Tu Reserva
                    </h3>
                    
                    <div class="flex gap-4 mb-8 bg-gray-50 p-4 rounded-2xl">
                        <img src="{{ $destino->imagenPrincipal ? asset('storage/' . $destino->imagenPrincipal->ruta) : 'https://images.unsplash.com/photo-1516426122078-c23e76319801?q=80&w=200' }}" 
                             class="w-20 h-20 rounded-xl object-cover shadow-md" alt="Destino">
                        <div class="flex flex-col justify-center">
                            <h4 class="font-bold text-bonvoy-dark leading-tight text-lg">{{ $destino->titulo }}</h4>
                            <span class="text-xs text-bonvoy-teal font-bold uppercase tracking-wider">{{ ucfirst($destino->tipo) }}</span>
                        </div>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-gray-500 font-medium">
                            <span>Subtotal (Destino)</span>
                            <span>${{ number_format($destino->precio, 2) }}</span>
                        </div>

                        {{-- MOSTRAR PASES DESDE LA SESIÓN --}}
                        @if(session('carrito_pases'))
                            <div class="pt-2 space-y-2 border-t border-gray-100">
                                <p class="text-[10px] font-black text-bonvoy-teal uppercase tracking-widest">Membresías Neopass</p>
                                @foreach(session('carrito_pases') as $pase)
                                    <div class="flex justify-between text-gray-500 text-sm">
                                        <span class="italic">{{ $pase['tipo'] }}</span>
                                        <span>${{ number_format($pase['precio'], 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="flex justify-between text-gray-500 font-medium italic">
                            <span>Cargo por servicio</span>
                            <span class="text-green-600">¡Gratis!</span>
                        </div>

                        <div class="border-t border-dashed pt-4 flex justify-between items-center">
                            <span class="font-bold text-bonvoy-navy">Total Final</span>
                            @php
                                $totalPases = collect(session('carrito_pases', []))->sum('precio');
                                $granTotal = $destino->precio + $totalPases;
                            @endphp
                            <span class="text-2xl font-black text-bonvoy-main">${{ number_format($granTotal, 2) }}</span>
                        </div>
                    </div>

                    <div class="bg-bonvoy-navy/5 p-4 rounded-2xl border border-bonvoy-navy/10">
                        <div class="flex gap-3">
                            <div class="bg-bonvoy-main text-white p-1 rounded-full h-fit mt-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg>
                            </div>
                            <p class="text-xs text-bonvoy-navy/80 leading-relaxed">
                                <span class="font-bold">Garantía BonVoy:</span> Cancelación flexible y soporte premium incluido.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 order-1 lg:order-2">
                <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-300/40 border border-gray-100 overflow-hidden">
                    
                    <div class="bg-gradient-to-r from-bonvoy-navy to-slate-800 p-10 text-white relative">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-bonvoy-main/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                        <h2 class="font-display text-4xl tracking-tight relative z-10 mb-2">Checkout Seguro</h2>
                        <p class="text-white/60 text-lg font-light relative z-10">Estás a un paso de tu próxima gran aventura.</p>
                    </div>

                    <div class="p-10">
                        <form action="{{ route('pago.procesar') }}" method="POST" class="space-y-10">
                            @csrf
                            <input type="hidden" name="contenido_id" value="{{ $destino->id }}">
                            <input type="hidden" name="precio_total" value="{{ $granTotal }}">

                            {{-- Enviar pases al controlador --}}
                            @if(session('carrito_pases'))
                                @foreach(session('carrito_pases') as $pase)
                                    <input type="hidden" name="pases_adicionales[]" value="{{ $pase['tipo'] }}">
                                @endforeach
                            @endif

                            <section>
                                <h3 class="text-bonvoy-dark font-bold text-lg mb-6 flex items-center gap-3">
                                    <span class="bg-bonvoy-main text-white w-8 h-8 rounded-xl flex items-center justify-center shadow-lg shadow-bonvoy-main/30">1</span>
                                    Información del Viajero
                                </h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-1">
                                        <label class="text-xs font-black text-slate-400 uppercase ml-1">Nombre Completo</label>
                                        <input type="text" name="nombre" placeholder="Nombre como en pasaporte" required
                                               class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 text-gray-700 focus:outline-none focus:border-bonvoy-main focus:bg-white transition-all">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-xs font-black text-slate-400 uppercase ml-1">Correo Electrónico</label>
                                        <input type="email" value="{{ auth()->user()->email }}" readonly
                                               class="w-full bg-slate-100 border-2 border-slate-100 rounded-2xl px-5 py-4 text-slate-400 cursor-not-allowed font-medium">
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h3 class="text-bonvoy-dark font-bold text-lg mb-6 flex items-center gap-3">
                                    <span class="bg-bonvoy-main text-white w-8 h-8 rounded-xl flex items-center justify-center shadow-lg shadow-bonvoy-main/30">2</span>
                                    Detalles del Pago
                                </h3>

                                <div class="max-w-md mx-auto mb-10 group perspective">
                                    <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-bonvoy-navy text-white p-8 rounded-[2rem] shadow-2xl relative overflow-hidden transition-transform duration-500 transform-gpu group-hover:rotate-1">
                                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                                        <div class="flex justify-between items-start mb-12">
                                            <div class="w-12 h-10 bg-gradient-to-br from-yellow-200 to-yellow-500 rounded-lg opacity-80 shadow-inner"></div>
                                            <div class="text-right italic font-black text-xl opacity-40 uppercase tracking-tighter">BonVoy Card</div>
                                        </div>
                                        <div class="text-2xl font-mono tracking-[0.3em] mb-8 drop-shadow-md">•••• •••• •••• ••••</div>
                                        <div class="flex justify-between items-end">
                                            <div>
                                                <div class="text-[0.6rem] uppercase opacity-50 font-bold mb-1 tracking-widest">Titular</div>
                                                <div class="font-mono text-sm uppercase">{{ auth()->user()->name }}</div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-[0.6rem] uppercase opacity-50 font-bold mb-1 tracking-widest">Expira</div>
                                                <div class="font-mono text-sm uppercase">MM/YY</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-6">
                                    <div class="space-y-1">
                                        <label class="text-xs font-black text-slate-400 uppercase ml-1">Número de Tarjeta</label>
                                        <div class="relative">
                                            <input type="text" placeholder="0000 0000 0000 0000" maxlength="19" required
                                                class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl pl-14 pr-5 py-4 text-gray-700 focus:outline-none focus:border-bonvoy-main focus:bg-white transition-all font-mono tracking-wider">
                                            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-300">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-6">
                                        <div class="space-y-1">
                                            <label class="text-xs font-black text-slate-400 uppercase ml-1">Vencimiento</label>
                                            <input type="text" placeholder="MM / YY" maxlength="5" required
                                                class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 text-center text-gray-700 focus:outline-none focus:border-bonvoy-main focus:bg-white transition-all font-mono">
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-black text-slate-400 uppercase ml-1">CVC / CVV</label>
                                            <div class="relative">
                                                <input type="text" placeholder="123" maxlength="4" required
                                                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 text-center text-gray-700 focus:outline-none focus:border-bonvoy-main focus:bg-white transition-all font-mono">
                                                <div class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <div class="pt-6">
                                <button type="submit" 
                                    class="group relative w-full bg-bonvoy-main text-white font-black py-5 rounded-[1.5rem] shadow-xl shadow-bonvoy-main/40 hover:shadow-2xl hover:shadow-bonvoy-main/50 transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                                    <div class="absolute inset-0 w-1/4 h-full bg-white/20 -skew-x-12 -translate-x-full group-hover:animate-shine"></div>
                                    <span class="relative flex items-center justify-center gap-3 text-xl uppercase tracking-tighter">
                                        Confirmar Pago ${{ number_format($granTotal, 2) }}
                                    </span>
                                </button>
                                
                                <p class="text-center text-[0.65rem] text-slate-400 mt-6 leading-relaxed px-10">
                                    Al completar tu pago, confirmas que has leído y aceptas nuestros <a href="#" class="text-bonvoy-main font-bold hover:underline">Términos de Servicio</a>.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-10 text-center space-y-4">
        <div class="flex justify-center items-center gap-6 opacity-30 grayscale hover:grayscale-0 transition duration-500">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-4" alt="Visa">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-6" alt="Mastercard">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-5" alt="Paypal">
        </div>
        <p class="text-[0.6rem] text-slate-400 font-bold uppercase tracking-[0.2em]">&copy; {{ date('Y') }} BonVoy by NeoTrips • Global Travel Solutions</p>
    </footer>

</body>
</html>