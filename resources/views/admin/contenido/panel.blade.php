<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Administrativo | BonVoy</title>

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
                <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 hidden md:block">Gestión</p>
                
                <a href="#" class="flex items-center gap-4 px-4 py-3 bg-white/10 text-white rounded-lg border-l-4 border-bonvoy-light transition">
                    <svg class="w-6 h-6 text-bonvoy-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <span class="font-bold text-sm hidden md:block tracking-wide">Contenidos</span>
                </a>
                
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-4 px-4 py-3 text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <span class="font-medium text-sm hidden md:block">Ver Sitio Web</span>
                </a>

                <div class="pt-8 mt-8 border-t border-white/10">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-4 px-4 py-3 text-red-300 hover:bg-red-500/10 hover:text-red-200 rounded-lg transition group">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span class="font-bold text-sm hidden md:block">Cerrar Sesión</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <main class="flex-1 h-screen overflow-y-auto bg-slate-50 relative">
            
            <header class="bg-white sticky top-0 z-10 shadow-sm border-b border-gray-100 px-8 py-4 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-bonvoy-navy uppercase tracking-wide">Panel de Control</h2>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-500">Hola, <strong>{{ Auth::user()->name }}</strong></span>
                    <div class="h-8 w-8 bg-bonvoy-main rounded-full flex items-center justify-center text-white font-bold text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="p-8 max-w-7xl mx-auto space-y-8">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white border-l-4 border-bonvoy-main rounded-xl p-6 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 font-bold uppercase text-xs tracking-wider mb-1">Ingresos Totales</p>
                            <h3 class="font-display text-4xl text-bonvoy-navy">${{ number_format($reservas->sum('total'), 0) }}</h3>
                        </div>
                        <div class="bg-blue-50 p-3 rounded-full text-bonvoy-main">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>

                    <div class="bg-white border-l-4 border-bonvoy-teal rounded-xl p-6 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 font-bold uppercase text-xs tracking-wider mb-1">Reservas Activas</p>
                            <h3 class="font-display text-4xl text-bonvoy-navy">{{ $reservas->count() }}</h3>
                        </div>
                        <div class="bg-cyan-50 p-3 rounded-full text-bonvoy-teal">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>

                    <div class="bg-white border-l-4 border-bonvoy-navy rounded-xl p-6 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 font-bold uppercase text-xs tracking-wider mb-1">Total Destinos</p>
                            <h3 class="font-display text-4xl text-bonvoy-navy">{{ $contenidos->count() }}</h3>
                        </div>
                        <div class="bg-slate-100 p-3 rounded-full text-bonvoy-navy">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-between items-end md:items-center gap-4 pt-4 border-t border-gray-200">
                    <div>
                        <h3 class="font-display text-2xl text-bonvoy-navy">Inventario</h3>
                        <p class="text-gray-500 text-sm">Administra la oferta comercial.</p>
                    </div>
                    <a href="{{ route('admin.contenido.create') }}" class="bg-bonvoy-main hover:bg-bonvoy-teal text-white px-5 py-2.5 rounded-lg font-bold shadow-md flex items-center gap-2 transition text-sm uppercase tracking-wide">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Crear Nuevo
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200 text-left">
                                    <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Imagen</th>
                                    <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Título</th>
                                    <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Categoría</th>
                                    <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Precio</th>
                                    <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="py-4 px-6 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($contenidos as $c)
                                <tr class="hover:bg-gray-50 transition duration-150 group">
                                    
                                    <td class="py-3 px-6">
                                        <div class="w-16 h-12 rounded bg-gray-100 overflow-hidden border border-gray-200">
                                            @if($c->imagen)
                                                <img src="{{ asset('storage/'.$c->imagen) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-300 text-xs">N/A</div>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="py-3 px-6">
                                        <div class="font-bold text-bonvoy-navy text-sm">{{ $c->titulo }}</div>
                                    </td>
                                    
                                    <td class="py-3 px-6">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200 uppercase">
                                            {{ $c->tipo }}
                                        </span>
                                    </td>

                                    <td class="py-3 px-6">
                                        <div class="text-bonvoy-main font-bold font-mono text-sm">
                                            ${{ number_format($c->precio, 2) }}
                                        </div>
                                    </td>

                                    <td class="py-3 px-6">
                                        @if($c->activo)
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                Activo
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-500 border border-gray-200">
                                                Oculto
                                            </span>
                                        @endif
                                    </td>

                                    <td class="py-3 px-6 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.contenido.edit', $c) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase tracking-wide px-2 py-1 rounded hover:bg-blue-50 transition">
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.contenido.destroy', $c) }}" method="POST" class="inline-block">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('¿Eliminar?')" class="text-red-500 hover:text-red-700 font-bold text-xs uppercase tracking-wide px-2 py-1 rounded hover:bg-red-50 transition">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>