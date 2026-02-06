<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Contenido | BonVoy Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Red+Hat+Display:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        function initMap() {
            const latInput = document.getElementById('lat');
            const lngInput = document.getElementById('lng');

            const posInicial = { 
                lat: parseFloat("{{ $contenido->latitud ?? 24.2917 }}"), 
                lng: parseFloat("{{ $contenido->longitud ?? -103.2417 }}") 
            };

            const map = new google.maps.Map(document.getElementById('map-admin'), {
                center: posInicial,
                zoom: 15,
                gestureHandling: 'greedy',
                streetViewControl: false,
                mapTypeControl: false
            });

            const marker = new google.maps.Marker({
                position: posInicial,
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                title: "Arrastra para ajustar ubicación"
            });

            function updateInputs(lat, lng) {
                latInput.value = lat.toFixed(8);
                lngInput.value = lng.toFixed(8);
            }

            marker.addListener('dragend', function(e) {
                updateInputs(e.latLng.lat(), e.latLng.lng());
            });

            map.addListener('click', function(e) {
                marker.setPosition(e.latLng);
                updateInputs(e.latLng.lat(), e.latLng.lng());
            });
        }
    </script>
</head>
<body class="font-sans text-slate-600 bg-slate-50 antialiased selection:bg-bonvoy-main selection:text-white">

    <div class="min-h-screen flex flex-row overflow-hidden">

        <aside class="w-20 md:w-72 bg-bonvoy-navy text-white flex-shrink-0 flex flex-col transition-all duration-300 shadow-xl z-20">
            
            <div class="h-28 flex items-center justify-center border-b border-white/10 bg-bonvoy-navy">
                <img src="{{ asset('assets/img/logo.png') }}" alt="BonVoy Admin" class="h-14 md:h-16 w-auto object-contain brightness-0 invert opacity-90 hover:opacity-100 transition duration-300">
            </div>
            
            <nav class="flex-1 overflow-y-auto py-8 px-4 space-y-2">
                <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 hidden md:block">Navegación</p>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-3 text-gray-400 hover:bg-white/10 hover:text-white rounded-lg transition group">
                    <svg class="w-6 h-6 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
                    <span class="font-bold text-sm hidden md:block tracking-wide">Volver al Panel</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 h-screen overflow-y-auto bg-slate-50 relative p-6 md:p-10">
            
            <div class="max-w-5xl mx-auto">
                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 border-b border-gray-200 pb-4 gap-4">
                    <div>
                        <h1 class="font-display text-4xl text-bonvoy-navy">Editar Contenido</h1>
                        <p class="text-gray-500 text-sm">Editando registro: <span class="font-bold text-bonvoy-main">{{ $contenido->titulo }}</span></p>
                    </div>
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide border border-yellow-200 shadow-sm">
                        Modo Edición
                    </span>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                    
                    <form action="{{ route('admin.contenido.update', $contenido->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                            
                            <div class="space-y-6">
                                
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Título del Destino</label>
                                    <input type="text" name="titulo" value="{{ $contenido->titulo }}" required
                                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-bonvoy-main transition font-bold text-gray-800 text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Descripción / Detalles</label>
                                    <textarea name="descripcion" required rows="5"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-bonvoy-main transition text-sm">{{ $contenido->descripcion }}</textarea>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Precio (MXN)</label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-3.5 text-gray-500 font-bold">$</span>
                                            <input type="number" step="0.01" name="precio" value="{{ $contenido->precio }}" required
                                                class="w-full bg-gray-50 border border-gray-200 rounded-lg pl-8 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-bonvoy-main transition font-mono font-bold text-gray-600 text-sm">
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Tipo</label>
                                        <div class="relative">
                                            <select name="tipo" 
                                                style="-webkit-appearance: none; -moz-appearance: none; appearance: none;"
                                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-bonvoy-main transition cursor-pointer text-sm">
                                                <option value="destino" {{ $contenido->tipo == 'destino' ? 'selected' : '' }}>✈️ Destino</option>
                                                <option value="hospedaje" {{ $contenido->tipo == 'hospedaje' ? 'selected' : '' }}>🏨 Hospedaje</option>
                                                <option value="actividad" {{ $contenido->tipo == 'actividad' ? 'selected' : '' }}>🎨 Actividad</option>
                                                <option value="paquete" {{ $contenido->tipo == 'paquete' ? 'selected' : '' }}>📦 Paquete</option>
                                                <option value="pase" {{ $contenido->tipo == 'pase' ? 'selected' : '' }}>🎫 Neopass</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Estatus del Registro</label>
                                    <div class="relative">
                                        <select name="activo" 
                                            style="-webkit-appearance: none; -moz-appearance: none; appearance: none;"
                                            class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-bonvoy-main transition cursor-pointer text-sm">
                                            <option value="1" {{ $contenido->activo == 1 ? 'selected' : '' }}>🟢 Activo (Visible)</option>
                                            <option value="0" {{ $contenido->activo == 0 ? 'selected' : '' }}>🔴 Inactivo (Oculto)</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">Coordenadas (Automáticas)</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="text" name="latitud" id="lat" value="{{ $contenido->latitud }}" readonly 
                                            class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-xs text-gray-500 cursor-not-allowed font-mono">
                                        <input type="text" name="longitud" id="lng" value="{{ $contenido->longitud }}" readonly 
                                            class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-xs text-gray-500 cursor-not-allowed font-mono">
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Ubicación Exacta</label>
                                    <div id="map-admin" class="w-full h-80 rounded-xl border border-gray-300 shadow-inner bg-gray-100"></div>
                                </div>

                                <div class="bg-blue-50/50 p-6 rounded-lg border border-blue-100">
                                    <label class="block text-sm font-bold text-gray-700 mb-3">Imagen Destacada</label>
                                    
                                    <div class="flex items-center gap-4">
                                        @if($contenido->imagen)
                                            <div class="w-20 h-20 bg-gray-200 rounded-lg overflow-hidden shrink-0 border border-gray-300 shadow-sm relative group">
                                                <img src="{{ asset('storage/'.$contenido->imagen) }}" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-black/50 flex items-center justify-center text-white text-xs opacity-0 group-hover:opacity-100 transition">Actual</div>
                                            </div>
                                        @endif
                                        
                                        <div class="flex-1">
                                            <input type="file" name="imagen" class="block w-full text-sm text-gray-500
                                                file:mr-4 file:py-2.5 file:px-4
                                                file:rounded-lg file:border-0
                                                file:text-xs file:font-bold
                                                file:bg-bonvoy-main file:text-white
                                                hover:file:bg-bonvoy-teal
                                                file:cursor-pointer transition
                                            "/>
                                            <p class="text-xs text-gray-400 mt-2">Sube una nueva imagen para reemplazar la actual.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-100 flex flex-col md:flex-row gap-4 justify-end">
                            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 rounded-lg border border-gray-200 text-gray-600 font-bold hover:bg-gray-50 transition text-center text-sm uppercase tracking-wide">
                                Cancelar
                            </a>
                            <button type="submit" class="px-8 py-3 bg-bonvoy-main hover:bg-bonvoy-teal text-white font-bold rounded-lg shadow-md transition transform hover:scale-[1.02] uppercase tracking-wide text-sm">
                                Guardar Cambios
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtgwMLKYKZkCOHuaULlzNmRautFPdYRNI&callback=initMap" async defer></script>

</body>
</html>