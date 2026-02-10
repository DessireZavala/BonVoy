<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout Seguro | BonVoy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Red+Hat+Display:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-pattern {
            background-color: #f8fafc;
            background-image: radial-gradient(#cbd5e1 0.5px, transparent 0.5px);
            background-size: 24px 24px;
        }
        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
        @keyframes shine { 100% { left: 125%; } }
        .animate-shine { animation: shine 0.8s infinite; }
    </style>
</head>
<body class="font-sans text-bonvoy-dark antialiased bg-pattern min-h-screen flex flex-col"
      x-data="{ 
        precioUnidad: {{ $destino->precio }},
        adultos: 1,
        niños: 0,
        get total() {
            return (parseInt(this.adultos) * this.precioUnidad) + (parseInt(this.niños) * (this.precioUnidad * 0.5));
        }
      }">

    <header class="w-full glass-header py-4 shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="BonVoy" class="h-16 w-auto transition hover:opacity-80">
            </a>
            <div class="bg-green-50 text-green-700 px-4 py-2 rounded-full border border-green-100 flex items-center gap-2 text-xs font-bold shadow-sm uppercase tracking-tighter">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                Conexión Segura SSL
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-start justify-center py-12 px-6">
        <div class="w-full max-w-6xl grid lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-4 order-2 lg:order-1">
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 sticky top-28">
                    <h3 class="text-xl font-bold text-bonvoy-navy mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Resumen de Viaje
                    </h3>
                    
                    <div class="flex gap-4 mb-8 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <img src="{{ $destino->imagenPrincipal ? asset('storage/' . $destino->imagenPrincipal->ruta) : 'https://images.unsplash.com/photo-1516426122078-c23e76319801?q=80&w=200' }}" 
                             class="w-20 h-20 rounded-xl object-cover shadow-sm" alt="Destino">
                        <div>
                            <h4 class="font-bold text-bonvoy-dark leading-tight">{{ $destino->titulo }}</h4>
                            <span class="text-[10px] text-bonvoy-teal font-black uppercase tracking-widest">{{ $destino->tipo }}</span>
                        </div>
                    </div>

                    <div class="space-y-4 mb-8 border-t border-dashed pt-6 text-sm">
                        <div class="flex justify-between text-gray-500">
                            <span x-text="'Adultos (x' + adultos + ')'"></span>
                            <span class="font-bold text-gray-700" x-text="'$' + (adultos * precioUnidad).toLocaleString()"></span>
                        </div>
                        <div class="flex justify-between text-gray-500" x-show="niños > 0">
                            <span x-text="'Niños (x' + niños + ')'"></span>
                            <span class="font-bold text-gray-700" x-text="'$' + (niños * (precioUnidad * 0.5)).toLocaleString()"></span>
                        </div>
                        <div class="border-t pt-4 flex justify-between items-center">
                            <span class="font-bold text-bonvoy-navy text-lg">Total Final</span>
                            <span class="text-2xl font-black text-bonvoy-main" x-text="'$' + total.toLocaleString()"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 order-1 lg:order-2">
                <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-bonvoy-navy to-slate-800 p-10 text-white">
                        <h2 class="font-display text-4xl tracking-wide mb-2">Checkout</h2>
                        <p class="text-white/60 font-light">Completa tu reservación de forma segura.</p>
                    </div>

                    <div class="p-10">
                        <form action="{{ route('pago.procesar') }}" method="POST" class="space-y-10">
                            @csrf
                            <input type="hidden" name="contenido_id" value="{{ $destino->id }}">
                            <input type="hidden" name="precio_total" :value="total">

                            <section>
                                <h3 class="text-bonvoy-dark font-bold text-lg mb-6 flex items-center gap-3">
                                    <span class="bg-bonvoy-main text-white w-8 h-8 rounded-xl flex items-center justify-center text-xs shadow-lg">1</span>
                                    Número de Pasajeros
                                </h3>
                                <div class="grid grid-cols-2 gap-4 bg-slate-50 p-6 rounded-3xl border border-slate-100">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Adultos</label>
                                        <select id="adultos" name="adultos" x-model="adultos" class="w-full rounded-xl border-gray-200 focus:ring-bonvoy-main focus:border-bonvoy-main transition py-3">
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Niños (0-17)</label>
                                        <select id="ninos" name="ninos" x-model="niños" class="w-full rounded-xl border-gray-200 focus:ring-bonvoy-main focus:border-bonvoy-main transition py-3">
                                            @for ($i = 0; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h3 class="text-bonvoy-dark font-bold text-lg mb-6 flex items-center gap-3">
                                    <span class="bg-bonvoy-main text-white w-8 h-8 rounded-xl flex items-center justify-center text-xs shadow-lg">2</span>
                                    Información Personal
                                </h3>
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-1">
                                        <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Nombre Completo</label>
                                        <input type="text" name="nombre" placeholder="Como aparece en tu ID" required
                                               class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3.5 focus:border-bonvoy-main focus:bg-white outline-none transition">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Email</label>
                                        <input type="email" value="{{ auth()->user()->email }}" readonly
                                               class="w-full bg-slate-100 border border-slate-200 rounded-2xl px-5 py-3.5 text-slate-400 cursor-not-allowed">
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h3 class="text-bonvoy-dark font-bold text-lg mb-6 flex items-center gap-3">
                                    <span class="bg-bonvoy-main text-white w-8 h-8 rounded-xl flex items-center justify-center text-xs shadow-lg">3</span>
                                    Detalles de Tarjeta
                                </h3>
                                
                                <div class="bg-slate-900 text-white p-8 rounded-[2rem] shadow-xl relative overflow-hidden mb-8 border border-white/5">
                                    <div class="flex justify-between items-start mb-12">
                                        <div class="text-[10px] opacity-40 tracking-[0.3em] font-black">BONVOY PLATINUM</div>
                                        <div class="w-10 h-8 bg-yellow-400/20 rounded-md"></div>
                                    </div>
                                    <div class="text-2xl font-mono tracking-[0.2em] mb-6">•••• •••• •••• ••••</div>
                                    <div class="flex justify-between text-[10px] font-mono opacity-50 uppercase">
                                        <span>{{ auth()->user()->name }}</span>
                                        <span>MM / YY</span>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div class="relative">
                                        <input type="text" placeholder="0000 0000 0000 0000" maxlength="19" required
                                               class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-14 pr-5 py-3.5 font-mono focus:border-bonvoy-main outline-none">
                                        <svg class="w-6 h-6 absolute left-5 top-1/2 -translate-y-1/2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="text" placeholder="MM / YY" maxlength="5" required
                                               class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3.5 text-center font-mono focus:border-bonvoy-main outline-none">
                                        <input type="text" placeholder="CVC" maxlength="4" required
                                               class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-3.5 text-center font-mono focus:border-bonvoy-main outline-none">
                                    </div>
                                </div>
                            </section>

                            <button type="submit" 
                                class="group relative w-full bg-bonvoy-main text-white font-black py-5 rounded-2xl shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                                <div class="absolute inset-0 w-1/4 h-full bg-white/20 -skew-x-12 -translate-x-full group-hover:animate-shine"></div>
                                <span class="relative flex items-center justify-center gap-3 text-xl uppercase tracking-tighter">
                                    Finalizar Pago <span x-text="'$' + total.toLocaleString()"></span> MXN
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-10 text-center opacity-40">
        <p class="text-[0.6rem] font-bold uppercase tracking-[0.3em]">&copy; {{ date('Y') }} BonVoy by NeoTrips • Payments Powered by Stripe</p>
    </footer>

</body>
</html>