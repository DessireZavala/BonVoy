<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Historial | BonVoy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Red+Hat+Display:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-600 antialiased bg-slate-50 min-h-screen flex flex-col">

    <header class="w-full bg-white py-4 shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="BonVoy" class="h-16 w-auto object-contain hover:opacity-80 transition">
            </a>

            <div class="flex items-center gap-6">
                <div class="hidden md:flex flex-col items-end">
                    <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Bienvenido</span>
                    <span class="text-bonvoy-navy font-bold">{{ auth()->user()->name }}</span>
                </div>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-5 py-2 rounded-full text-xs font-bold transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="flex-grow py-12 px-6">
        <div class="max-w-6xl mx-auto">
            
            <div class="bg-bonvoy-navy rounded-[2rem] p-8 md:p-12 text-white shadow-xl mb-10 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -mr-20 -mt-20 blur-3xl group-hover:bg-white/10 transition duration-700"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-bonvoy-main/20 rounded-full -ml-10 -mb-10 blur-2xl"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                    <div>
                        <h1 class="font-display text-5xl md:text-6xl tracking-wide mb-2">MI PASAPORTE</h1>
                        <p class="text-blue-100 text-lg max-w-lg">Aquí encontrarás el historial de tus aventuras y los comprobantes de tus próximas experiencias.</p>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/10 flex gap-8">
                        <div>
                            <span class="block text-3xl font-display">{{ $reservas->count() }}</span>
                            <span class="text-xs text-blue-200 uppercase tracking-wider">Viajes Totales</span>
                        </div>
                        <div>
                            <span class="block text-3xl font-display text-bonvoy-light">{{ $reservas->where('fecha_reserva', '>=', now())->count() }}</span>
                            <span class="text-xs text-blue-200 uppercase tracking-wider">Próximos</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-400 uppercase tracking-wider">
                                <th class="py-5 px-8">Destino / Servicio</th>
                                <th class="py-5 px-8">Fecha de Reserva</th>
                                <th class="py-5 px-8">Total Pagado</th>
                                <th class="py-5 px-8">Estado</th>
                                <th class="py-5 px-8 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($reservas as $reserva)
                            <tr class="hover:bg-blue-50/30 transition duration-200 group">
                                <td class="py-5 px-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-xl shadow-inner">
                                            @if(optional($reserva->contenido)->tipo == 'destino') ✈️
                                            @elseif(optional($reserva->contenido)->tipo == 'hospedaje') 🏨
                                            @elseif(optional($reserva->contenido)->tipo == 'pase') 🎫
                                            @else 🗺️ @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-bonvoy-navy text-lg leading-tight">
                                                {{ $reserva->contenido->titulo ?? 'Destino no disponible' }}
                                            </div>
                                            <div class="text-xs text-gray-400 uppercase tracking-wide font-bold mt-0.5">
                                                {{ $reserva->contenido->tipo ?? 'General' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="py-5 px-8">
                                    <div class="text-gray-600 font-medium">
                                        {{ $reserva->created_at->format('d M, Y') }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $reserva->created_at->format('H:i A') }}
                                    </div>
                                </td>

                                <td class="py-5 px-8">
                                    <div class="font-mono font-bold text-bonvoy-teal text-lg">
                                        ${{ number_format($reserva->total, 2) }}
                                    </div>
                                </td>

                                <td class="py-5 px-8">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-600 border border-green-100 uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        {{ $reserva->estado }}
                                    </span>
                                </td>

                                <td class="py-5 px-8 text-right">
                                    <a href="{{ route('reservar.voucher', $reserva->id) }}" class="inline-flex items-center gap-2 text-sm font-bold text-bonvoy-main hover:text-white bg-white hover:bg-bonvoy-main border border-bonvoy-main/30 hover:border-bonvoy-main px-5 py-2.5 rounded-xl transition shadow-sm hover:shadow-md group-hover:scale-105">
                                        <span>Voucher</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <div class="flex flex-col items-center max-w-sm mx-auto">
                                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center text-4xl mb-6 grayscale opacity-30 border border-gray-100">🌍</div>
                                        <h3 class="text-bonvoy-navy font-bold text-xl mb-2">Tu pasaporte está vacío</h3>
                                        <p class="text-gray-400 mb-8 text-center leading-relaxed">Aún no has realizado ninguna reserva. ¡El mundo está esperando por ti!</p>
                                        <a href="{{ route('home') }}" class="bg-bonvoy-main hover:bg-bonvoy-navy text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-bonvoy-main/30 transition transform hover:-translate-y-1">
                                            Explorar Destinos
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t py-8 text-center text-xs text-gray-400 mt-auto">
        <p>&copy; {{ date('Y') }} BonVoy Inc. Todos los derechos reservados.</p>
    </footer>

</body>
</html>