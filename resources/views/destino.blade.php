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
        [x-cloak] { display: none !important; }
        #map { border-radius: 1rem; }
    </style>
</head>
<body class="font-sans text-bonvoy-dark antialiased bg-bonvoy-gray selection:bg-bonvoy-main selection:text-white">

    <header class="absolute top-0 left-0 w-full z-50 px-6 py-4 flex justify-between items-center bg-gradient-to-b from-bonvoy-navy/90 to-transparent">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo.png') }}" alt="BonVoy" class="h-16 md:h-20 w-auto drop-shadow-lg hover:opacity-90 transition">
        </a>
        <nav class="hidden md:flex items-center gap-6 text-sm font-bold text-white">
            <a href="{{ route('home') }}" class="hover:text-bonvoy-light transition">Explorar</a>
            @auth
                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20">
                    <div class="w-6 h-6 rounded-full bg-bonvoy-main flex items-center justify-center text-xs text-white">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span>{{ Auth::user()->name }}</span>
                </div>
            @endauth
        </nav>
    </header>

    <div class="relative h-[65vh] w-full overflow-hidden rounded-b-[3rem] shadow-2xl">
        <img src="{{ $destino->imagenPrincipal ? asset('storage/' . $destino->imagenPrincipal->ruta) : 'https://images.unsplash.com/photo-1516426122078-c23e76319801?q=80&w=2068' }}" 
             class="absolute inset-0 h-full w-full object-cover" 
             alt="{{ $destino->titulo }}">
        
        <div class="absolute inset-0 bg-gradient-to-t from-bonvoy-navy via-transparent to-transparent opacity-80"></div>

        <div class="absolute bottom-16 left-0 w-full px-6 md:px-12 text-white container mx-auto">
            <span class="bg-bonvoy-light/90 backdrop-blur-md px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider mb-4 inline-block shadow-lg text-white">
                {{ ucfirst($destino->tipo) }}
            </span>
            <h1 class="font-display text-5xl md:text-7xl leading-none drop-shadow-lg mb-2">
                {{ $destino->titulo }}
            </h1>
            <div class="flex items-center gap-2 text-bonvoy-light font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span>Ubicación verificada por BonVoy</span>
            </div>
        </div>
    </div>

    <div x-data="{ activeTab: 'resumen' }" class="max-w-7xl mx-auto px-6 -mt-10 relative z-10 pb-20">
        
        <div class="grid lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white p-2 rounded-full shadow-lg inline-flex items-center border border-gray-100">
                    <button @click="activeTab = 'resumen'" 
                        :class="activeTab === 'resumen' ? 'bg-bonvoy-navy text-white shadow-md' : 'text-gray-500 hover:bg-bonvoy-gray'"
                        class="px-6 py-2 rounded-full font-bold transition-all duration-300 text-sm">
                        RESUMEN
                    </button>
                    <button @click="activeTab = 'ubicacion'" 
                        :class="activeTab === 'ubicacion' ? 'bg-bonvoy-navy text-white shadow-md' : 'text-gray-500 hover:bg-bonvoy-gray'"
                        class="px-6 py-2 rounded-full font-bold transition-all duration-300 text-sm">
                        UBICACIÓN (MAPA)
                    </button>
                </div>

                <div x-show="activeTab === 'resumen'" 
                     x-transition:enter="transition ease-out duration-300"
                     class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                    
                    <h2 class="font-display text-3xl text-bonvoy-dark mb-6">Sobre la experiencia</h2>
                    <p class="text-gray-600 leading-relaxed text-lg mb-8 text-justify">
                        {{ $destino->descripcion }}
                    </p>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex items-center gap-4 p-4 bg-bonvoy-gray rounded-2xl">
                            <div class="text-bonvoy-teal bg-white p-3 rounded-full shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-bonvoy-dark">Duración</h4>
                                <p class="text-sm text-gray-500">Flexible</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-bonvoy-gray rounded-2xl">
                            <div class="text-bonvoy-teal bg-white p-3 rounded-full shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-bonvoy-dark">Confirmación</h4>
                                <p class="text-sm text-gray-500">Inmediata</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'ubicacion'" 
                     x-cloak
                     x-transition:enter="transition ease-out duration-300"
                     class="bg-white rounded-3xl p-2 shadow-xl border border-gray-100 h-[500px]">
                     <div id="map" class="w-full h-full rounded-2xl"></div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-8 space-y-6">
                    
                    <div class="bg-white rounded-3xl p-8 shadow-2xl border border-gray-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-bonvoy-light/20 rounded-full blur-xl"></div>
                        
                        <div class="mb-6">
                            <p class="text-gray-500 text-sm font-bold uppercase tracking-wide">Precio por persona</p>
                            <div class="flex items-baseline gap-1">
                                <span class="text-4xl font-display font-black text-bonvoy-dark">${{ number_format($destino->precio, 2) }}</span>
                                <span class="text-gray-500 font-bold">MXN</span>
                            </div>
                        </div>

                        <form action="{{ route('reservar.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="contenido_id" value="{{ $destino->id }}">
                            
                            <a href="{{ route('checkout', $destino->id) }}" 
                               class="block w-full text-center bg-bonvoy-main hover:bg-bonvoy-teal text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                Confirmar Reservación
                            </a>
                        </form>

                        <p class="text-center text-xs text-gray-400 mt-4 flex items-center justify-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Pago seguro
                        </p>
                    </div>

                    <div class="bg-bonvoy-gray rounded-2xl p-6 border border-gray-200">
                        <h4 class="font-bold text-bonvoy-dark mb-2">¿Necesitas ayuda?</h4>
                        <p class="text-sm text-gray-600 mb-4">Nuestro equipo de Concierge está disponible 24/7.</p>
                        <button class="text-bonvoy-teal font-bold text-sm hover:underline">Contactar Soporte</button>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtgwMLKYKZkCOHuaULlzNmRautFPdYRNI&callback=initMap"></script>

    <script>
        function initMap() {
            const ubicacion = { 
                lat: {{ $destino->latitud ?? 24.2917 }}, 
                lng: {{ $destino->longitud ?? -103.2417 }} 
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: ubicacion,
                styles: [
                    { "featureType": "poi", "stylers": [{ "visibility": "off" }] }
                ]
            });

            new google.maps.Marker({
                position: ubicacion,
                map: map,
                title: "{{ $destino->titulo }}",
                animation: google.maps.Animation.DROP
            });
        }
    </script>
</body>
</html>