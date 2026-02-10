<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pago Seguro | BonVoy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Red+Hat+Display:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-pattern { background-color: #f8fafc; background-image: radial-gradient(#cbd5e1 0.5px, transparent 0.5px); background-size: 24px 24px; }
        .glass-header { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
    </style>
</head>

@php
    $adultos = request('adultos', 1);
    $ninos = request('ninos', 0);
    $total = ($adultos * $destino->precio) + ($ninos * ($destino->precio * 0.5));
@endphp

<body class="font-sans text-bonvoy-dark antialiased bg-pattern min-h-screen flex flex-col">

    <header class="w-full glass-header py-4 shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" alt="BonVoy" class="h-16 w-auto"></a>
            <div class="text-green-600 text-[0.6rem] font-black uppercase tracking-widest bg-green-50 px-4 py-2 rounded-full border border-green-100">Pago Encriptado</div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center py-12 px-6">
        <div class="w-full max-w-6xl grid lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-5">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-gray-100">
                    <h3 class="font-display text-2xl text-bonvoy-navy mb-8">Resumen Final</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-400">Viaje:</span>
                            <span class="font-bold text-bonvoy-navy">{{ $destino->titulo }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-400">Pasajeros:</span>
                            <span class="font-bold text-bonvoy-navy">{{$adultos}} Ad. / {{$ninos}} Niñ.</span>
                        </div>
                        <div class="pt-4 border-t border-dashed flex justify-between items-end">
                            <span class="text-xs font-black text-bonvoy-main">Total a Pagar</span>
                            <span class="text-4xl font-black text-bonvoy-navy tracking-tighter">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="bg-white rounded-[3rem] shadow-2xl border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-bonvoy-navy to-slate-800 p-10 text-white">
                        <h2 class="font-display text-4xl mb-2">Método de Pago</h2>
                        <p class="text-white/60 text-sm">Ingresa los datos de tu tarjeta bancaria.</p>
                    </div>

                    <div class="p-10">
                        <div class="max-w-sm mx-auto mb-10 bg-gradient-to-br from-slate-900 to-bonvoy-navy text-white p-8 rounded-[2rem] shadow-2xl relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
                            <div class="flex justify-between mb-12">
                                <div class="w-12 h-10 bg-yellow-400/20 rounded-lg border border-yellow-400/30"></div>
                                <div class="text-[0.6rem] font-black italic opacity-40 tracking-widest">BONVOY CARD</div>
                            </div>
                            <div class="text-2xl font-mono tracking-[0.25em] mb-8">•••• •••• •••• ••••</div>
                            <div class="flex justify-between font-mono text-[0.6rem] uppercase tracking-widest">
                                <span>{{ auth()->user()->name ?? 'TITULAR DE LA TARJETA' }}</span>
                                <span>MM / YY</span>
                            </div>
                        </div>

                        <form action="{{ route('pago.procesar') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="contenido_id" value="{{ $destino->id }}">
                            <input type="hidden" name="precio_total" value="{{ $total }}">

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="text-[0.65rem] font-black text-slate-400 uppercase ml-2">Nombre del Titular</label>
                                    <input type="text" name="nombre_titular" value="{{ auth()->user()->name ?? '' }}" required
                                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-bonvoy-main outline-none font-bold text-bonvoy-navy">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[0.65rem] font-black text-slate-400 uppercase ml-2">Email de Contacto</label>
                                    <input type="email" value="{{ auth()->user()->email ?? '' }}" readonly
                                        class="w-full bg-slate-100 border-2 border-slate-100 rounded-2xl px-6 py-4 text-slate-400 font-bold outline-none cursor-not-allowed">
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label class="text-[0.65rem] font-black text-slate-400 uppercase ml-2">Número de Tarjeta</label>
                                    <input type="text" placeholder="0000 0000 0000 0000" maxlength="19" required 
                                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 font-mono text-lg focus:border-bonvoy-main outline-none">
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label class="text-[0.65rem] font-black text-slate-400 uppercase ml-2">Expiración</label>
                                        <input type="text" placeholder="MM / YY" maxlength="5" required 
                                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-center font-bold focus:border-bonvoy-main outline-none">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[0.65rem] font-black text-slate-400 uppercase ml-2">CVC</label>
                                        <input type="text" placeholder="•••" maxlength="4" required 
                                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 text-center font-bold focus:border-bonvoy-main outline-none">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-bonvoy-main text-white font-black py-6 rounded-3xl shadow-xl hover:bg-bonvoy-navy transition-all text-xl uppercase tracking-tighter">
                                Confirmar Pago ${{ number_format($total, 2) }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>