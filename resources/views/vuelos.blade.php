<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buscador de Vuelos | BonVoy & Duffel</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Red+Hat+Display:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-900" x-data="{ filter: 'cheap' }">

    <header class="bg-white border-b border-slate-200 py-4 px-6 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <img src="{{ asset('assets/img/logo.png') }}" class="h-12 w-auto" alt="BonVoy">
            <div class="hidden md:flex items-center gap-6 text-sm font-bold uppercase tracking-widest text-slate-500">
                <a href="#" class="text-bonvoy-main border-b-2 border-bonvoy-main">Vuelos</a>
                <a href="#" class="hover:text-bonvoy-dark">Hoteles</a>
                <a href="#" class="hover:text-bonvoy-dark">Seguros</a>
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto py-10 px-6">
        
        <div class="bg-bonvoy-navy rounded-[2rem] p-8 shadow-2xl mb-10 text-white">
            <div class="grid md:grid-cols-4 gap-4 items-end">
                <div class="col-span-1">
                    <label class="text-[10px] font-black uppercase opacity-50 ml-2">Origen</label>
                    <div class="bg-white/10 rounded-xl p-3 border border-white/10">CDMX (MEX)</div>
                </div>
                <div class="col-span-1">
                    <label class="text-[10px] font-black uppercase opacity-50 ml-2">Destino</label>
                    <div class="bg-white/10 rounded-xl p-3 border border-white/10">Cancún (CUN)</div>
                </div>
                <div class="col-span-1">
                    <label class="text-[10px] font-black uppercase opacity-50 ml-2">Fecha</label>
                    <div class="bg-white/10 rounded-xl p-3 border border-white/10">15 de Marzo</div>
                </div>
                <button class="bg-bonvoy-main hover:bg-bonvoy-teal text-white font-black py-3 rounded-xl transition uppercase tracking-widest">
                    Nueva Búsqueda
                </button>
            </div>
        </div>

        <div class="flex gap-2 mb-8 bg-slate-200/50 p-1.5 rounded-2xl w-fit">
            <button @click="filter = 'cheap'" :class="filter === 'cheap' ? 'bg-white shadow-sm' : ''" class="px-6 py-2 rounded-xl text-xs font-bold transition">MÁS BARATO</button>
            <button @click="filter = 'fast'" :class="filter === 'fast' ? 'bg-white shadow-sm' : ''" class="px-6 py-2 rounded-xl text-xs font-bold transition">MÁS RÁPIDO</button>
        </div>

        <div class="space-y-4">
            @foreach($vuelos as $vuelo)
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200 hover:border-bonvoy-main transition-colors group">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    
                    <div class="flex items-center gap-4 w-48">
                        <img src="{{ $vuelo['logo'] }}" class="w-10 h-10 rounded-lg object-contain" alt="Logo">
                        <span class="font-bold text-slate-700">{{ $vuelo['aerolinea'] }}</span>
                    </div>

                    <div class="flex-grow flex items-center justify-between w-full">
                        <div class="text-center">
                            <div class="text-xl font-black">{{ $vuelo['salida'] }}</div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase">MEX</div>
                        </div>

                        <div class="flex-grow px-8 flex flex-col items-center">
                            <span class="text-[10px] text-slate-400 font-bold mb-1">{{ $vuelo['duracion'] }}</span>
                            <div class="w-full h-[2px] bg-slate-100 relative">
                                <div class="absolute w-2 h-2 bg-bonvoy-main rounded-full -top-[3px] left-0"></div>
                                <div class="absolute w-2 h-2 bg-bonvoy-main rounded-full -top-[3px] right-0"></div>
                                @if($vuelo['tipo'] !== 'Directo')
                                    <div class="absolute w-1.5 h-1.5 bg-orange-400 rounded-full -top-[2px] left-1/2"></div>
                                @endif
                            </div>
                            <span class="text-[10px] font-black mt-1 {{ $vuelo['tipo'] === 'Directo' ? 'text-bonvoy-teal' : 'text-orange-400' }}">
                                {{ $vuelo['tipo'] }}
                            </span>
                        </div>

                        <div class="text-center">
                            <div class="text-xl font-black">{{ $vuelo['llegada'] }}</div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase">CUN</div>
                        </div>
                    </div>

                    <div class="flex flex-col items-end border-l border-slate-100 pl-8 w-44">
                        <div class="text-2xl font-black text-bonvoy-navy">${{ number_format($vuelo['precio']) }}</div>
                        <div class="text-[10px] text-slate-400 font-bold mb-4">PESOS MXN</div>
                        <a href="{{ route('checkout.vuelo', $vuelo['id']) }}?precio={{ $vuelo['precio'] }}" 
                           class="bg-bonvoy-main hover:bg-bonvoy-navy text-white text-[10px] font-black px-6 py-2 rounded-full transition-all uppercase tracking-widest shadow-lg shadow-bonvoy-main/20">
                            Seleccionar
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center items-center gap-4 opacity-30">
            <span class="text-[10px] font-bold tracking-[0.3em] uppercase">Powered by Duffel Engine</span>
            <div class="h-px w-20 bg-slate-400"></div>
            <span class="text-[10px] font-bold tracking-[0.3em] uppercase">BonVoy Flight System</span>
        </div>
    </main>

</body>
</html>