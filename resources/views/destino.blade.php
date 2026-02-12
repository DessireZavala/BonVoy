
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $destino->titulo }} | BonVoy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Red+Hat+Display:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-pattern { background-color: #f8fafc; background-image: radial-gradient(#cbd5e1 0.5px, transparent 0.5px); background-size: 24px 24px; }
        .glass-header { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
        @keyframes shine { 100% { left: 125%; } }
        .animate-shine { animation: shine 0.8s; }
        .map-container { filter: grayscale(0.2) contrast(1.1); border-radius: 2rem; overflow: hidden; }
    </style>
</head>
<body class="font-sans text-bonvoy-dark antialiased bg-pattern min-h-screen flex flex-col"
    x-data="{ 
        precioUnidad: {{ $destino->precio }},
        adultos: 1,
        ninos: 0,
        get total() { return (this.adultos * this.precioUnidad) + (this.ninos * (this.precioUnidad * 0.5)); }
    }">

    <header class="w-full glass-header py-4 shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="BonVoy" class="h-16 w-auto"></a>
        </div>
    </header>

    <main class="flex-grow py-12 px-6">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-7 space-y-10">
                <div class="rounded-[3rem] overflow-hidden shadow-2xl h-[500px] bg-slate-200 relative group">
                    <img src="{{ $destino->imagenPrincipal ? asset('storage/' . $destino->imagenPrincipal->ruta) : 'https://images.unsplash.com/photo-1516426122078-c23e76319801' }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                </div>
                
                <div class="px-2">
                    <span class="bg-bonvoy-main text-white text-[0.65rem] font-black px-4 py-1.5 rounded-full uppercase tracking-[0.2em] mb-4 inline-block shadow-lg shadow-bonvoy-main/20">
                        {{ $destino->tipo }}
                    </span>
                    <h1 class="font-display text-7xl text-bonvoy-navy mb-6 tracking-tighter">{{ $destino->titulo }}</h1>
                    <p class="text-slate-500 text-xl leading-relaxed font-light mb-10">
                        {{ $destino->descripcion }}
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 bg-bonvoy-navy rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-display text-2xl text-bonvoy-navy tracking-tight">Ubicación del Destino</h3>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Explora los alrededores</p>
                            </div>
                        </div>

                        <div class="map-container h-[400px] shadow-xl border border-white">
                            <iframe 
                                width="100%" 
                                height="100%" 
                                frameborder="0" 
                                style="border:0"
                                src="https://www.google.com/maps/embed/v1/place?key=TU_API_KEY_AQUI&q={{ urlencode($destino->titulo) }}" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="bg-white rounded-[3rem] p-10 shadow-2xl border border-gray-100 sticky top-28 overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-full -mr-16 -mt-16"></div>
                    
                    <h3 class="text-3xl font-display text-bonvoy-navy mb-8 relative">Reserva tu lugar</h3>
                    
                    <form action="{{ route('checkout', ['id' => $destino->id]) }}" method="GET" class="space-y-8 relative">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-[0.6rem] font-black text-slate-400 uppercase ml-3 tracking-widest">Adultos</label>
                                <select name="adultos" x-model="adultos" class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-6 py-4 focus:border-bonvoy-main outline-none font-bold text-bonvoy-navy transition-all">
                                    @for($i=1; $i<=10; $i++) <option value="{{$i}}">{{$i}}</option> @endfor
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[0.6rem] font-black text-slate-400 uppercase ml-3 tracking-widest">Niños</label>
                                <select name="ninos" x-model="ninos" class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-6 py-4 focus:border-bonvoy-main outline-none font-bold text-bonvoy-navy transition-all">
                                    @for($i=0; $i<=10; $i++) <option value="{{$i}}">{{$i}}</option> @endfor
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[0.6rem] font-black text-slate-400 uppercase ml-3 tracking-widest">Fecha de Salida</label>
                            <input type="date" name="fecha" required 
                                   class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-6 py-4 focus:border-bonvoy-main outline-none font-bold text-bonvoy-navy transition-all">
                        </div>

                        <div class="bg-bonvoy-navy rounded-[2.5rem] p-8 text-white space-y-1 shadow-2xl shadow-bonvoy-navy/20">
                            <span class="block text-[0.6rem] font-black text-bonvoy-main uppercase tracking-[0.3em] text-center">Total Estimado</span>
                            <div class="text-5xl font-display text-center tracking-tighter" x-text="'$' + total.toLocaleString()"></div>
                        </div>

                        <button type="submit" class="group relative w-full bg-bonvoy-main text-white font-black py-6 rounded-3xl shadow-xl overflow-hidden transform hover:-translate-y-1 transition-all duration-300">
                            <div class="absolute inset-0 w-1/4 h-full bg-white/20 -skew-x-12 -translate-x-full group-hover:animate-shine"></div>
                            <span class="relative text-xl uppercase tracking-tighter">Reservar Ahora</span>
                        </button>
                    </form>
                    
                    <div class="mt-8 flex items-center justify-center gap-2 opacity-30">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"/></svg>
                        <span class="text-[0.6rem] font-bold uppercase tracking-widest">Transacción 100% Segura</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-12 text-center">
        <p class="text-[0.65rem] font-black text-slate-300 uppercase tracking-[0.4em]">&copy; {{ date('Y') }} BonVoy by NeoTrips</p>
    </footer>

</body>
</html>