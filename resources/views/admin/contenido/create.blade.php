<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Contenido | BonVoy Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Red+Hat+Display:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            
            <div class="max-w-4xl mx-auto">
                
                <div class="mb-8 border-b border-gray-200 pb-4">
                    <h1 class="font-display text-4xl text-bonvoy-navy">Crear Nuevo Contenido</h1>
                    <p class="text-gray-500">Rellena los detalles del nuevo destino o servicio.</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                    <form method="POST" action="{{ route('admin.contenido.store') }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf

                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Título del Contenido</label>
                                <input type="text" name="titulo" placeholder="Ej: Tour a las Pirámides" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-bonvoy-main transition text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Tipo</label>
                                <div class="relative">
                                    <select name="tipo" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 appearance-none focus:outline-none focus:ring-2 focus:ring-bonvoy-main transition cursor-pointer text-sm">
                                        <option value="destino">✈️ Destino</option>
                                        <option value="hospedaje">🏨 Hospedaje</option>
                                        <option value="actividad">🎨 Actividad</option>
                                        <option value="paquete">📦 Paquete</option>
                                        <option value="pase">🎫 Pase</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Precio (MXN)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-gray-500 font-bold">$</span>
                                <input type="number" name="precio" placeholder="0.00" step="0.01" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg pl-8 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-bonvoy-main transition text-sm font-mono font-bold text-gray-600">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Descripción Detallada</label>
                            <textarea name="descripcion" rows="4" placeholder="Describe la experiencia, inclusiones, horarios..." required
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-bonvoy-main transition text-sm"></textarea>
                        </div>
                        
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                             <label class="block text-sm font-bold text-gray-700 mb-2">Imagen de Portada</label>
                             <input type="file" name="imagen" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2.5 file:px-4
                                file:rounded-lg file:border-0
                                file:text-xs file:font-bold
                                file:bg-bonvoy-main file:text-white
                                hover:file:bg-bonvoy-teal
                                file:cursor-pointer transition
                              "/>
                        </div>

                        <div class="bg-blue-50/50 p-6 rounded-lg border border-blue-100">
                            <h3 class="text-bonvoy-teal font-bold mb-4 flex items-center gap-2 text-sm uppercase tracking-wide">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Ubicación (Opcional)
                            </h3>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Latitud</label>
                                    <input type="number" step="any" name="latitud" placeholder="Ej: 24.2917"
                                        class="w-full bg-white border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-bonvoy-main transition text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Longitud</label>
                                    <input type="number" step="any" name="longitud" placeholder="Ej: -103.2417"
                                        class="w-full bg-white border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-bonvoy-main transition text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 bg-gray-50 p-4 rounded-lg border border-gray-200 w-fit">
                            <div class="relative flex items-center">
                                <input type="checkbox" name="activo" value="1" id="activoCheck" checked
                                    class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-gray-300 transition-all checked:border-bonvoy-main checked:bg-bonvoy-main">
                                <svg class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 peer-checked:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </div>
                            <label for="activoCheck" class="text-sm font-bold text-gray-700 cursor-pointer select-none">
                                Visible al público
                            </label>
                        </div>

                        <div class="pt-6 border-t border-gray-100 flex gap-4 justify-end">
                            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 rounded-lg border border-gray-200 text-gray-600 font-bold hover:bg-gray-50 transition text-center flex items-center text-sm uppercase tracking-wide">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-bonvoy-main hover:bg-bonvoy-teal text-white font-bold py-3 px-8 rounded-lg shadow-md transition transform hover:scale-[1.02] uppercase tracking-wide text-sm">
                                Guardar Contenido
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>