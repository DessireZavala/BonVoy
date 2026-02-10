<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis Favoritos - BonVoy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-10">
            <h1 class="text-4xl font-display text-bonvoy-navy uppercase tracking-tight">Mis Favoritos</h1>
            <a href="{{ route('home') }}" class="text-bonvoy-main font-bold hover:underline">← Volver a explorar</a>
        </div>

        @if($favorites->isEmpty())
            <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-gray-100">
                <p class="text-gray-400 text-lg mb-6">Aún no tienes destinos guardados.</p>
                <a href="{{ route('home') }}" class="bg-bonvoy-main text-white px-8 py-3 rounded-xl font-bold hover:bg-bonvoy-teal transition">Buscar viajes</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($favorites as $favorite)
                    @php $item = $favorite->favorable; @endphp
                    @if($item)
                    <div class="group bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl transition duration-300">
                        <div class="h-64 overflow-hidden relative">
                            <img src="{{ $item->imagenPrincipal ? asset('storage/' . $item->imagenPrincipal->ruta) : 'https://images.unsplash.com/photo-1500835595353-b0ad2e58b412' }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            
                            <form action="{{ route('favorites.toggle', [$item->id, 'Contenido']) }}" method="POST" class="absolute top-4 right-4">
                                @csrf
                                <button type="submit" class="bg-white/90 p-2 rounded-full text-red-500 shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div class="p-6">
                            <h3 class="font-display text-2xl text-bonvoy-navy mb-2">{{ $item->titulo }}</h3>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-bonvoy-main">${{ number_format($item->precio, 0) }}</span>
                                <a href="{{ route('destino.show', $item->id) }}" class="text-sm font-bold text-gray-400 hover:text-bonvoy-main transition">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>