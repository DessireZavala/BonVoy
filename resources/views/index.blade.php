<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BonVoy - Viajes y Experiencias</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Red+Hat+Display:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-800 antialiased bg-slate-50 selection:bg-bonvoy-main selection:text-white">

    <div class="min-h-screen relative flex flex-col">

        <header x-data="{ mobileMenu: false }" class="absolute top-0 left-0 w-full z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
                <a href="{{ route('home') }}" class="block hover:opacity-90 transition transform hover:scale-105">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="BonVoy" 
                    class="h-20 w-auto object-contain drop-shadow-2xl relative z-10">
                </a>

                <nav class="hidden md:flex items-center gap-6 text-sm font-bold text-white shadow-black/20 drop-shadow-sm">
                    <a href="{{ route('home') }}" class="hover:text-bonvoy-light transition py-2">INICIO</a>
                    @guest
                        <a href="{{ route('login') }}" class="hover:text-bonvoy-light transition">ENTRAR</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-bonvoy-main border border-transparent hover:bg-bonvoy-teal px-5 py-2 rounded-full text-white transition shadow-lg hover:shadow-bonvoy-main/50">
                                REGISTRARSE
                            </a>
                        @endif
                    @else
                        <a href="{{ route('user.perfil') }}" class="hover:text-bonvoy-light transition uppercase">Mi Historial</a>
                    @auth
                        <a href="{{ route('favorites.index') }}" class="hover:text-bonvoy-light transition flex items-center gap-1 uppercase">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001z" /></svg>
                            Favoritos
                        </a>
                    @endauth
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="bg-yellow-400 text-bonvoy-navy px-3 py-1 rounded-md hover:bg-yellow-300 transition shadow-lg text-xs uppercase tracking-wider">
                                PANEL ADMIN
                            </a>
                        @endif
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-2 hover:text-bonvoy-light transition">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-2xl py-2 text-gray-800 border border-gray-100 transform origin-top-right transition-all z-50" style="display: none;">
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 hover:bg-red-50 text-red-600 text-sm font-bold">Cerrar Sesión</a>
                            </div>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    @endguest
                </nav>

                <button @click="mobileMenu = !mobileMenu" class="md:hidden text-white text-2xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </header>

        <section class="relative h-[85vh] flex items-center justify-center overflow-hidden rounded-b-[3rem] shadow-2xl z-0 pb-20">
            <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?q=80&w=2068" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-bonvoy-navy/70 via-transparent to-bonvoy-navy/50 mix-blend-multiply"></div> 
            
            <div class="relative z-10 flex flex-col items-center justify-center h-full px-6 md:px-12 text-center mt-10">
                <p class="text-bonvoy-light font-bold tracking-[0.3em] uppercase mb-3 animate-pulse text-xs md:text-sm drop-shadow-md">
                    Experiencia Premium
                </p>
                <h1 class="font-display text-6xl md:text-8xl text-white leading-[0.85] drop-shadow-2xl mb-8">
                    TANZANIA<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-bonvoy-light to-white">SAFARI</span>
                </h1>
                
                <form id="search-form" action="{{ route('home') }}" method="GET" class="w-full max-w-2xl bg-white/10 backdrop-blur-md border border-white/20 p-1.5 rounded-full flex gap-2 shadow-2xl relative z-20 group transition-all hover:bg-white/15">
                    <div class="flex-1 bg-white rounded-full flex items-center px-5 transition focus-within:ring-2 focus-within:ring-bonvoy-main h-12 md:h-14">
                        <svg class="w-5 h-5 text-gray-400 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" id="main-search-input" name="search" value="{{ request('search') }}" 
                            class="w-full bg-transparent border-none outline-none text-gray-700 placeholder-gray-400 focus:ring-0 text-base md:text-lg truncate" 
                            placeholder="Busca tu próximo viaje...">
                    </div>
                    <button type="submit" class="bg-bonvoy-main hover:bg-bonvoy-teal text-white font-display text-lg tracking-wide px-6 md:px-10 rounded-full shadow-lg transition transform hover:scale-105 h-12 md:h-14 shrink-0">
                        Buscar
                    </button>
                </form>
            </div>
        </section>

        <div class="relative z-10 -mt-10 md:-mt-12 max-w-3xl mx-auto px-4">
            <div class="bg-white rounded-[2rem] shadow-2xl p-4 md:p-6 flex flex-wrap justify-center md:justify-between items-center border border-gray-100 gap-4 md:gap-8">
                
                <a href="{{ route('vuelos.index') }}" class="group flex flex-col items-center gap-2 cursor-pointer transition hover:-translate-y-1 w-20">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gray-50 rounded-2xl flex items-center justify-center group-hover:bg-bonvoy-main transition duration-300 border border-transparent group-hover:border-bonvoy-main">
                        <img src="{{ asset('assets/img/avionicon.png') }}" class="w-8 h-8 object-contain transition group-hover:brightness-0 group-hover:invert opacity-70 group-hover:opacity-100">
                    </div>
                    <span class="font-bold text-xs md:text-sm text-gray-500 group-hover:text-bonvoy-main transition">Vuelos</span>
                </a>

                <a href="{{ route('home', ['search' => 'hospedaje']) }}" class="group flex flex-col items-center gap-2 cursor-pointer transition hover:-translate-y-1 w-20">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gray-50 rounded-2xl flex items-center justify-center group-hover:bg-bonvoy-main transition duration-300 border border-transparent group-hover:border-bonvoy-main">
                        <img src="{{ asset('assets/img/camaicon.png') }}" class="w-8 h-8 object-contain transition group-hover:brightness-0 group-hover:invert opacity-70 group-hover:opacity-100">
                    </div>
                    <span class="font-bold text-xs md:text-sm text-gray-500 group-hover:text-bonvoy-main transition">Hoteles</span>
                </a>

                <a href="{{ route('home', ['search' => 'paquete']) }}" class="group flex flex-col items-center gap-2 cursor-pointer transition hover:-translate-y-1 w-20">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gray-50 rounded-2xl flex items-center justify-center group-hover:bg-bonvoy-main transition duration-300 border border-transparent group-hover:border-bonvoy-main">
                        <img src="{{ asset('assets/img/paquetesicon.png') }}" class="w-8 h-8 object-contain transition group-hover:brightness-0 group-hover:invert opacity-70 group-hover:opacity-100">
                    </div>
                    <span class="font-bold text-xs md:text-sm text-gray-500 group-hover:text-bonvoy-main transition">Paquetes</span>
                </a>

                <a href="#seccion-pases" class="group flex flex-col items-center gap-2 cursor-pointer transition hover:-translate-y-1 w-20">
                  <div class="w-14 h-14 md:w-16 md:h-16 bg-gray-50 rounded-2xl flex items-center justify-center group-hover:bg-bonvoy-main transition duration-300 border border-transparent group-hover:border-bonvoy-main">
                   <img src="{{ asset('assets/img/pasesicon.png') }}" class="w-8 h-8 object-contain transition group-hover:brightness-0 group-hover:invert opacity-70 group-hover:opacity-100">
                  </div>
                 <span class="font-bold text-xs md:text-sm text-gray-500 group-hover:text-bonvoy-main transition">Tickets</span>
                </a>

            </div>
        </div>
        {{-- ========================================== --}}
{{-- SECCIÓN BONVOY AI (SIMULACIÓN GEMINI) --}}
{{-- ========================================== --}}
<div x-data="{ 
    query: '', 
    response: '', 
    loading: false, 
    showResponse: false,
    recomendar() {
        if(this.query.trim() === '') return;
        this.loading = true;
        this.showResponse = false;
        
        // Simulación de 'pensando' (1.5 segundos)
        setTimeout(() => {
            this.loading = false;
            this.showResponse = true;
            // Aquí simulamos que la IA analiza tus destinos destacados
            const respuestas = [
                'Basado en tus gustos, el 🇯🇵 <b>Vuelo a Japón</b> es la mejor opción hoy por su temporada alta.',
                '¡Gran elección! Para aventura, nada supera al 🦁 <b>Safari en Tanzania</b>. Está en oferta.',
                'Si buscas relax, el 🏖️ <b>Resort en Cancún</b> tiene el mejor clima esta semana.',
                'Para algo mágico, te recomiendo 🏰 <b>Disneyland</b>. ¡Es perfecto para ir en grupo!',
                '¿Buscas cultura? El 🇪🇸 <b>Vuelo a Madrid</b> tiene un precio increíble ahora mismo.'
            ];
            // Escoge una respuesta aleatoria
            this.response = respuestas[Math.floor(Math.random() * respuestas.length)];
        }, 1500);
    }
}" class="max-w-4xl mx-auto px-6 mt-16 mb-8 relative z-30">

    <div class="text-center mb-6">
        <span class="bg-gradient-to-r from-blue-600 via-purple-500 to-pink-500 text-transparent bg-clip-text font-black tracking-widest text-xs uppercase mb-2 block animate-pulse">
            Inteligencia Artificial Beta
        </span>
        <h3 class="font-display text-3xl text-bonvoy-navy">¿Indeciso? <span class="text-purple-500">Deja que la IA elija tu destino</span></h3>
    </div>

    {{-- Input estilo Gemini --}}
    <div class="relative group">
        <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 rounded-full blur opacity-30 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
        
        <div class="relative bg-white rounded-full flex items-center p-2 shadow-xl border border-gray-50">
            <div class="pl-4 pr-2">
                {{-- Icono Sparkle (Destello IA) --}}
                <svg class="w-6 h-6 text-purple-500" fill="url(#gradient-ai)" viewBox="0 0 24 24">
                    <defs>
                        <linearGradient id="gradient-ai" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#ec4899;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z" fill="currentColor"/>
                </svg>
            </div>
            
            <input type="text" x-model="query" 
                @keydown.enter="recomendar()"
                placeholder="Ej. Quiero una aventura exótica o un viaje barato a Europa..." 
                class="flex-grow bg-transparent border-none outline-none text-gray-600 placeholder-gray-400 px-2 py-3 text-sm md:text-base focus:ring-0">
            
            <button @click="recomendar()" 
                class="bg-slate-900 hover:bg-slate-800 text-white rounded-full p-3 transition-transform transform active:scale-95 flex items-center justify-center w-12 h-12">
                
                {{-- Icono Flecha --}}
                <svg x-show="!loading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                
                {{-- Spinner de carga --}}
                <svg x-show="loading" class="animate-spin w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Tarjeta de Respuesta de la IA --}}
    <div x-show="showResponse" 
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         style="display: none;"
         class="mt-6 bg-gradient-to-br from-white to-blue-50 border border-blue-100 rounded-3xl p-6 shadow-lg relative overflow-hidden">
        
        {{-- Adorno de fondo --}}
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-purple-200 rounded-full blur-3xl opacity-30"></div>
        
        <div class="flex gap-4 items-start relative z-10">
            <div class="bg-white p-2 rounded-2xl shadow-sm text-2xl border border-gray-100">✨</div>
            <div>
                <h4 class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 text-sm mb-1 uppercase tracking-wider">BonVoy AI sugiere:</h4>
                <p class="text-slate-700 text-lg leading-relaxed" x-html="response"></p>
                <div class="mt-4 flex gap-2">
                    <a href="#resultados" @click="document.querySelector('section.py-20').scrollIntoView({behavior: 'smooth'})" class="text-xs font-bold text-white bg-slate-900 px-4 py-2 rounded-lg shadow-md hover:bg-slate-700 transition flex items-center gap-2">
                        Ver oferta ahora
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- FIN SECCIÓN AI --}}
        <section class="max-w-7xl mx-auto px-6 py-20 w-full">
            <div class="flex items-end justify-between mb-10 border-b border-gray-200 pb-4">
                <h2 class="font-display text-5xl text-bonvoy-navy">
                    @if(request('search') == 'destino') VUELOS POPULARES
                    @elseif(request('search') == 'hospedaje') HOTELES DESTACADOS
                    @elseif(request('search') == 'actividad') ATRACCIONES TOP
                    @elseif(request('search') == 'paquete') PAQUETES TODO INCLUIDO
                    @else EXPLORA EL MUNDO
                    @endif
                </h2>
                <a href="{{ route('home') }}" class="text-bonvoy-main font-bold cursor-pointer hover:underline">Ver todos</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($contenidos as $item)
                    <div class="group bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                        <div class="h-72 overflow-hidden relative">
                            @if($item->imagenPrincipal)
                                <img src="{{ asset('storage/' . $item->imagenPrincipal->ruta) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            @else
                                <img src="https://images.unsplash.com/photo-1500835595353-b0ad2e58b412" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-bonvoy-navy/80 via-transparent to-transparent opacity-80"></div>
                            @auth
                            <form action="{{ route('favorites.toggle', [$item->id, 'Contenido']) }}" method="POST" class="absolute top-4 left-4 z-20">
                                @csrf
                                <button type="submit" class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-md hover:bg-white transition group/fav">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        class="h-5 w-5 {{ Auth::user()->favorites()->where('favorable_id', $item->id)->exists() ? 'text-red-500' : 'text-gray-400 group-hover/fav:text-red-300' }}" 
                                        fill="{{ Auth::user()->favorites()->where('favorable_id', $item->id)->exists() ? 'currentColor' : 'none' }}" 
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </form>
                            @endauth

                            <div class="absolute top-4 right-4 bg-bonvoy-main text-white px-3 py-1 rounded-full text-xs font-black shadow-lg z-20">
                                {{ number_format($item->rating ?? 0.0, 1) }}
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="bg-white/90 backdrop-blur-sm text-bonvoy-navy px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider flex items-center gap-2 shadow-sm">
                                    @if($item->tipo == 'destino') <img src="{{ asset('assets/img/avionicon.png') }}" class="w-4 h-4 object-contain">
                                    @elseif($item->tipo == 'hospedaje') <img src="{{ asset('assets/img/camaicon.png') }}" class="w-4 h-4 object-contain">
                                    @else <img src="{{ asset('assets/img/paquetesicon.png') }}" class="w-4 h-4 object-contain"> @endif
                                    {{ ucfirst($item->tipo) }}
                                </span>
                            </div>

                            <div class="absolute bottom-4 left-6 text-white">
                                <h3 class="font-display text-3xl">{{ $item->titulo }}</h3>
                            </div>
                        </div>
                        <div class="p-6 flex justify-between items-center">
                            <div>
                                <p class="text-xs text-gray-400 uppercase font-bold">Desde</p>
                                <p class="text-3xl font-bold text-bonvoy-dark">${{ number_format($item->precio, 0) }}</p>
                            </div>
                            <a href="{{ route('destino.show', $item->id) }}" class="bg-bonvoy-light/10 text-bonvoy-main border border-bonvoy-main/20 hover:bg-bonvoy-main hover:text-white px-6 py-3 rounded-xl font-bold transition">Reservar</a>
                        </div>
                    </div>
                @empty
                    @if(request('search') == 'destino' || !request('search'))
                        <div class="group bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl transition">
                            <div class="h-72 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-bonvoy-navy/80 to-transparent opacity-80"></div>
                                <div class="absolute top-4 right-4"><span class="bg-white text-bonvoy-navy px-3 py-1 rounded-full text-xs font-bold">VUELO</span></div>
                                <div class="absolute bottom-4 left-6 text-white"><h3 class="font-display text-3xl">VUELO A PARIS</h3></div>
                            </div>
                            <div class="p-6 flex justify-between items-center">
                                <div><p class="text-3xl font-bold text-bonvoy-dark">$18,000</p></div>
                                <button class="bg-gray-100 text-gray-400 px-4 py-2 rounded-lg text-sm font-bold cursor-not-allowed">Ejemplo</button>
                            </div>
                        </div>
                    @endif

                    @if(request('search') == 'hospedaje' || !request('search'))
                        <div class="group bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl transition">
                            <div class="h-72 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-bonvoy-navy/80 to-transparent opacity-80"></div>
                                <div class="absolute top-4 right-4"><span class="bg-white text-bonvoy-navy px-3 py-1 rounded-full text-xs font-bold">HOTEL</span></div>
                                <div class="absolute bottom-4 left-6 text-white"><h3 class="font-display text-3xl">HOTEL RIVIERA</h3></div>
                            </div>
                            <div class="p-6 flex justify-between items-center">
                                <div><p class="text-3xl font-bold text-bonvoy-dark">$3,500 <span class="text-xs text-gray-400">/noche</span></p></div>
                                <button class="bg-gray-100 text-gray-400 px-4 py-2 rounded-lg text-sm font-bold cursor-not-allowed">Ejemplo</button>
                            </div>
                        </div>
                    @endif

                    @if(request('search') == 'actividad' || !request('search'))
                        <div class="group bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl transition">
                            <div class="h-72 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1513807768511-9279b8c05758" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-bonvoy-navy/80 to-transparent opacity-80"></div>
                                <div class="absolute top-4 right-4"><span class="bg-white text-bonvoy-navy px-3 py-1 rounded-full text-xs font-bold">TICKET</span></div>
                                <div class="absolute bottom-4 left-6 text-white"><h3 class="font-display text-3xl">DISNEYLAND</h3></div>
                            </div>
                            <div class="p-6 flex justify-between items-center">
                                <div><p class="text-3xl font-bold text-bonvoy-dark">$2,800</p></div>
                                <button class="bg-gray-100 text-gray-400 px-4 py-2 rounded-lg text-sm font-bold cursor-not-allowed">Ejemplo</button>
                            </div>
                        </div>
                    @endif

                @endforelse
            </div>
        </section>

        <section id="seccion-pases" class="bg-bonvoy-navy py-24 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
                <div class="absolute top-10 left-10 w-96 h-96 bg-bonvoy-light rounded-full mix-blend-overlay filter blur-[120px] opacity-20"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-bonvoy-main rounded-full mix-blend-overlay filter blur-[120px] opacity-20"></div>
            </div>

            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="text-center mb-16">
                    <span class="text-bonvoy-light font-bold tracking-widest uppercase text-sm">Viaja sin límites</span>
                    <h2 class="font-display text-5xl md:text-6xl text-white mt-2">MEMBRESÍAS <span class="text-transparent bg-clip-text bg-gradient-to-r from-bonvoy-light to-white">NEOPASS</span></h2>
                    <p class="text-gray-300 text-lg max-w-2xl mx-auto mt-4">Elige el pase que se adapte a tu estilo de aventura.</p>
                    
                    {{-- Notificación de éxito --}}
                    @if(session('success'))
                        <div class="mt-6 bg-green-500/20 border border-green-500 text-green-100 px-6 py-3 rounded-2xl inline-block animate-bounce">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 flex flex-col h-auto md:h-[480px]">
                    <div class="mb-4">
                        <h3 class="font-display text-3xl text-gray-700">BÁSICO</h3>
                        <div class="text-4xl font-bold text-bonvoy-navy mt-2">$500 <span class="text-sm text-gray-400 font-normal">/MXN</span></div>
                    </div>
                    <ul class="space-y-3 text-sm text-gray-600 mb-8 flex-1">
                        <li class="flex items-start gap-3"><span class="text-green-500 font-bold">✓</span> Acceso estándar a atracciones</li>
                        <li class="flex items-start gap-3"><span class="text-green-500 font-bold">✓</span> QR digital para acceso</li>
                        <li class="flex items-start gap-3"><span class="text-green-500 font-bold">✓</span> Acceso según disponibilidad</li>
                    </ul>
                    {{-- Formulario Ajustado --}}
                    <form action="{{ route('reserva.agregarPase') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tipo" value="BÁSICO">
                        <input type="hidden" name="precio" value="500">
                        <button type="submit" class="w-full py-3 rounded-xl border-2 border-gray-200 text-gray-600 font-bold hover:border-bonvoy-main hover:text-bonvoy-main transition uppercase tracking-wide text-sm">
                            AGREGAR
                        </button>
                    </form>
                </div>

            <div class="bg-white rounded-3xl p-8 shadow-2xl border-4 border-bonvoy-main relative transform md:scale-110 z-10 flex flex-col h-auto md:h-[520px]">
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-bonvoy-main text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow-lg">Más Popular</div>
                <div class="mb-4 text-center border-b border-gray-100 pb-4">
                    <h3 class="font-display text-4xl text-bonvoy-main">PLUS</h3>
                    <div class="text-5xl font-bold text-bonvoy-navy mt-2">$1,500 <span class="text-sm text-gray-400 font-normal">/MXN</span></div>
                </div>
                <ul class="space-y-3 text-sm text-gray-600 mb-8 flex-1">
                    <li class="flex items-start gap-3"><span class="text-bonvoy-main font-bold">✓</span> <span class="font-bold text-bonvoy-dark">Todo lo del pase Básico</span></li>
                    <li class="flex items-start gap-3"><span class="text-bonvoy-main font-bold">✓</span> Acceso preferencial <strong>sin filas</strong></li>
                    <li class="flex items-start gap-3"><span class="text-bonvoy-main font-bold">✓</span> Reservaciones prioritarias</li>
                    <li class="flex items-start gap-3"><span class="text-bonvoy-main font-bold">✓</span> Descuentos especiales</li>
                </ul>
                {{-- Formulario Ajustado --}}
                <form action="{{ route('reserva.agregarPase') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tipo" value="PLUS">
                    <input type="hidden" name="precio" value="1500">
                    <button type="submit" class="w-full py-4 rounded-xl bg-bonvoy-main text-white font-bold shadow-lg shadow-bonvoy-main/30 hover:bg-bonvoy-teal transition uppercase tracking-wide text-sm">
                        AGREGAR AHORA
                    </button>
                </form>
            </div>

            <div class="bg-slate-50 rounded-3xl p-8 shadow-xl border border-yellow-400/30 flex flex-col h-auto md:h-[480px]">
                <div class="mb-4">
                    <h3 class="font-display text-3xl text-yellow-600">PREMIUM</h3>
                    <div class="text-4xl font-bold text-bonvoy-navy mt-2">$2,500 <span class="text-sm text-gray-400 font-normal">/MXN</span></div>
                </div>
                <ul class="space-y-3 text-sm text-gray-600 mb-8 flex-1">
                    <li class="flex items-start gap-3"><span class="text-yellow-500 font-bold">✓</span> <span class="font-bold text-bonvoy-dark">Todo lo del Pase Plus</span></li>
                    <li class="flex items-start gap-3"><span class="text-yellow-500 font-bold">✓</span> Acceso <strong>VIP garantizado</strong></li>
                    <li class="flex items-start gap-3"><span class="text-yellow-500 font-bold">✓</span> Experiencias exclusivas</li>
                    <li class="flex items-start gap-3"><span class="text-yellow-500 font-bold">✓</span> Atención prioritaria</li>
                </ul>
                {{-- Formulario Ajustado --}}
                <form action="{{ route('reserva.agregarPase') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tipo" value="PREMIUM">
                    <input type="hidden" name="precio" value="2500">
                    <button type="submit" class="w-full py-3 rounded-xl border-2 border-yellow-400 text-yellow-600 font-bold hover:bg-yellow-400 hover:text-white transition uppercase tracking-wide text-sm">
                        AGREGAR
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

    </div>

    <div x-data="{ open: false }" class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
        <div x-show="open" class="w-80 bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100 mb-4 flex flex-col">
            <div class="bg-bonvoy-navy p-4 flex justify-between items-center text-white">
                <span class="font-bold flex items-center gap-2">✈️ Soporte BonVoy</span>
                <button @click="open = false" class="hover:bg-white/20 rounded p-1">&times;</button>
            </div>
            <div class="h-64 bg-slate-50 p-4 overflow-y-auto flex flex-col gap-3" id="chat-messages">
                <div class="self-start bg-white p-3 rounded-lg rounded-tl-none shadow-sm text-sm text-gray-600 border border-gray-200 max-w-[85%]">
                    ¡Hola! ¿En qué podemos ayudarte hoy?
                </div>
            </div>
            <div class="p-3 bg-white border-t border-gray-100 flex gap-2">
                <input type="text" id="chat-input" placeholder="Escribe..." class="flex-1 bg-gray-100 border-none rounded-full px-4 text-sm focus:ring-1 focus:ring-bonvoy-main">
                <button id="send-msg" class="bg-bonvoy-main text-white w-9 h-9 rounded-full flex items-center justify-center hover:bg-bonvoy-teal transition">➤</button>
            </div>
        </div>
        <button @click="open = !open" class="bg-bonvoy-main hover:bg-bonvoy-teal text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center transition transform hover:scale-110">
            <span x-show="!open" class="text-2xl">💬</span>
            <span x-show="open" class="text-2xl">×</span>
        </button>
    </div>

    <script>
        const chatInput = document.getElementById('chat-input');
        const sendBtn = document.getElementById('send-msg');
        const chatMessages = document.getElementById('chat-messages');

        function sendMessage() {
            const text = chatInput.value;
            if (!text) return;
            chatMessages.innerHTML += `<div class="self-end bg-bonvoy-main text-white p-3 rounded-lg rounded-tr-none shadow-md text-sm max-w-[85%]">${text}</div>`;
            chatInput.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;
            setTimeout(() => {
                chatMessages.innerHTML += `<div class="self-start bg-white p-3 rounded-lg rounded-tl-none shadow-sm text-sm text-gray-600 border border-gray-100 max-w-[85%]">Un agente se conectará pronto. Folio: #BNV-${Math.floor(Math.random()*900)}</div>`;
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 1000);
        }
        if(sendBtn) sendBtn.onclick = sendMessage;
        if(chatInput) chatInput.onkeypress = (e) => { if(e.key === 'Enter') sendMessage(); };
    </script>

    <script>
    document.getElementById('search-form').onsubmit = function(e) {
        const query = document.getElementById('main-search-input').value.toLowerCase();
        // Palabras que disparan la sección de vuelos
        const flightKeywords = ['vuelo', 'vuelos', 'avion', 'boletos', 'duffel'];
        
        if (flightKeywords.some(word => query.includes(word))) {
            e.preventDefault(); // Detenemos la búsqueda normal
            window.location.href = "{{ route('vuelos.index') }}"; // Mandamos a vuelos
        }
    };
</script>

</body>
</html>