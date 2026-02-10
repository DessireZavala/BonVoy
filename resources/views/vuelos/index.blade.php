<!DOCTYPE html>
<html>
<head>
    <title>BonVoy - Vuelos Disponibles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 p-10">
    <h1 class="text-3xl font-bold mb-6">Vuelos Encontrados</h1>
    
    <div class="grid gap-4">
        @foreach($vuelos as $vuelo)
            <div class="bg-white p-6 rounded-xl shadow-md flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <img src="{{ $vuelo['logo'] }}" class="w-12 h-12 object-contain">
                    <div>
                        <h2 class="font-bold text-xl">{{ $vuelo['aerolinea'] }}</h2>
                        <p class="text-gray-500">{{ $vuelo['tipo'] }} | {{ $vuelo['clase'] }}</p>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold">{{ $vuelo['salida'] }} - {{ $vuelo['llegada'] }}</p>
                    <p class="text-sm text-gray-400">Duración: {{ $vuelo['duracion'] }}</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-black text-blue-600">${{ number_format($vuelo['precio'], 2) }}</p>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg mt-2">Seleccionar</button>
                </div>
            </div>
        @endforeach
    </div>

    <a href="{{ route('home') }}" class="mt-8 inline-block text-blue-500 underline">Volver al inicio</a>
</body>
</html>