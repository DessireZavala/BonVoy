<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BonVoy - Experiencias Únicas</title>

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
                
                <a href="{{ route('home') }}" class="font-display text-4xl text-white tracking-widest drop-shadow-md hover:text-bonvoy-light transition">
                    BONVOY
                </a>

                <nav class="hidden md:flex items-center gap-6 text-sm font-bold text-white shadow-black/20 drop-shadow-sm">
                    <a href="{{ route('home') }}" class="hover:text-bonvoy-light transition py-2">INICIO</a>
                    
                    @guest
                        <a href="{{ url('auth/google') }}" class="flex items-center gap-2 bg-white text-gray-800 px-4 py-2 rounded-full hover:bg-gray-100 transition shadow-lg group">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-4 h-4" alt="G">
                            <span>Google</span>
                        </a>
                        
                        <div class="h-4 w-px bg-white/40 mx-2"></div> <a href="{{ route('login') }}" class="hover:text-bonvoy-light transition">ENTRAR</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-bonvoy-main border border-transparent hover:bg-bonvoy-teal px-5 py-2 rounded-full text-white transition shadow-lg hover:shadow-bonvoy-main/50">
                                REGISTRARSE
                            </a>
                        @endif
                    @else
                        <a href="{{ route('user.perfil') }}" class="hover:text-bonvoy-light transition">MI HISTORIAL</a>

                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="bg-yellow-400 text-bonvoy-navy px-3 py-1 rounded-md hover:bg-yellow-300 transition shadow-lg text-xs uppercase tracking-wider">
                                Panel Admin
                            </a>
                        @endif

                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-2 hover:text-bonvoy-light transition">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-2xl py-2 text-gray-800 border border-gray-100 transform origin-top-right transition-all z-50" style="display: none;">
                                <a href="#" id="open-chat-link" @click="open = false" class="block px-4 py-2 hover:bg-gray-50 text-sm">💬 Soporte</a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 hover:bg-red-50 text-red-600 text-sm font-bold">
                                    Cerrar Sesión
                                </a>
                            </div>
                        </div>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </nav>

                <button @click="mobileMenu = !mobileMenu" class="md:hidden text-white text-2xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>

            <div x-show="mobileMenu" class="md:hidden bg-bonvoy-navy/95 backdrop-blur-xl absolute top-full left-0 w-full border-t border-white/10 shadow-2xl z-40">
                <div class="flex flex-col p-6 gap-4 text-white text-center">
                    @guest
                        <a href="{{ route('login') }}" class="py-2 border-b border-white/10">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="py-2 font-bold text-bonvoy-light">Registrarse</a>
                    @else
                        <span class="text-gray-400 text-sm">Hola, {{ Auth::user()->name }}</span>
                        <a href="{{ route('user.perfil') }}" class="py-2">Mi Historial</a>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="py-2 text-red-400">Cerrar Sesión</a>
                    @endguest
                </div>
            </div>
        </header>

        <div class="relative h-[85vh] w-full overflow-hidden rounded-b-[3rem] md:rounded-b-[4rem] shadow-2xl z-0">
            <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?q=80&w=2068" 
                 class="absolute inset-0 h-full w-full object-cover animate-fade-in" 
                 alt="Tanzania Safari">
            
            <div class="absolute inset-0 bg-gradient-to-b from-bonvoy-navy/80 via-transparent to-bonvoy-navy/60"></div>

            <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-4 pt-16">
                <p class="text-bonvoy-light font-bold tracking-[0.3em] uppercase mb-4 text-sm md:text-base animate-slide-down">Experiencia Premium</p>
                <h1 class="font-display text-7xl md:text-9xl text-white leading-[0.85] drop-shadow-2xl mb-12">
                    TANZANIA <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-bonvoy-light to-white">SAFARI</span>
                </h1>

                <form action="{{ route('home') }}" method="GET" class="w-full max-w-3xl bg-white/10 backdrop-blur-md border border-white/20 p-2 rounded-full flex gap-2 shadow-2xl relative z-20">
                    <div class="flex-1 bg-white rounded-full flex items-center px-6 transition focus-within:ring-2 focus-within:ring-bonvoy-main">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Busca tu próximo viaje..." 
                            class="w-full bg-transparent border-none outline-none text-gray-700 placeholder-gray-400 focus:ring-0 text-lg h-12">
                    </div>
                    <button type="submit" class="bg-bonvoy-main hover:bg-bonvoy-teal text-white font-display text-xl tracking-wide px-10 rounded-full shadow-lg transition transform hover:scale-105">
                        BUSCAR
                    </button>
                </form>
            </div>
        </div>

        <section class="max-w-7xl mx-auto px-6 py-24 w-full">
            <div class="flex items-end justify-between mb-10 border-b border-gray-200 pb-4">
                <div>
                    <span class="text-bonvoy-main font-bold tracking-widest uppercase text-sm">Explora el mundo</span>
                    <h2 class="font-display text-5xl text-bonvoy-navy mt-2">DESTINOS POPULARES</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($contenidos->where('tipo', 'destino') as $item)
                <div class="group bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="h-72 overflow-hidden relative">
                        @if($item->imagenPrincipal)
                            <img src="{{ asset('storage/' . $item->imagenPrincipal->ruta) }}" alt="{{ $item->titulo }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        @else
                            <img src="https://images.unsplash.com/photo-1500835595353-b0ad2e58b412" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-bonvoy-navy/80 via-transparent to-transparent opacity-80"></div>
                        
                        <div class="absolute bottom-4 left-6 text-white">
                            <h3 class="font-display text-3xl">{{ $item->titulo }}</h3>
                            <p class="text-bonvoy-light font-bold text-sm">Vuelo + Hotel</p>
                        </div>
                    </div>
                    <div class="p-6 flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold">Precio por persona</p>
                            <p class="text-3xl font-bold text-bonvoy-dark">${{ number_format($item->precio, 0) }}</p>
                        </div>
                        <a href="{{ route('destino.show', $item->id) }}" class="bg-bonvoy-light/10 text-bonvoy-main border border-bonvoy-main/20 hover:bg-bonvoy-main hover:text-white px-6 py-3 rounded-xl font-bold transition">
                            Ver Detalles
                        </a>
                    </div>
                </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-400 text-xl font-display">No hay destinos cargados aún.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="bg-bonvoy-navy py-24 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-bonvoy-light rounded-full mix-blend-overlay filter blur-[100px] opacity-20 -mr-40 -mt-40"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-bonvoy-teal rounded-full mix-blend-overlay filter blur-[100px] opacity-20 -ml-40 -mb-40"></div>

            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="text-center mb-16">
                    <h2 class="font-display text-6xl text-white mb-4">MEMBRESÍAS <span class="text-bonvoy-light">NEOPASS</span></h2>
                    <p class="text-gray-300 text-lg max-w-2xl mx-auto">Viaja más inteligente con nuestros pases de acceso exclusivo.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($contenidos->where('tipo', 'pase') as $pase)
                        <div class="relative bg-white/5 border border-white/10 backdrop-blur-sm rounded-[2rem] p-8 hover:bg-white/10 transition duration-300 group flex flex-col">
                            <div class="mb-4">
                                <span class="bg-bonvoy-light/20 text-bonvoy-light px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider">Membresía</span>
                            </div>
                            <h3 class="font-display text-4xl text-white mb-2">{{ $pase->titulo }}</h3>
                            <div class="text-5xl font-bold text-white mb-6">${{ number_format($pase->precio, 0) }} <span class="text-sm font-normal text-gray-400">MXN</span></div>
                            
                            <ul class="text-gray-300 text-sm space-y-3 mb-8 flex-1">
                                <li class="flex items-center gap-2"><span class="text-bonvoy-light">✓</span> Acceso prioritario</li>
                                <li class="flex items-center gap-2"><span class="text-bonvoy-light">✓</span> Descuentos exclusivos</li>
                            </ul>

                            <button class="w-full py-4 rounded-xl bg-gradient-to-r from-bonvoy-main to-bonvoy-teal text-white font-bold tracking-widest text-sm uppercase shadow-lg group-hover:shadow-bonvoy-main/50 transition">
                                AGREGAR
                            </button>
                        </div>
                    @endforeach

                    @if($contenidos->where('tipo', 'pase')->isEmpty())
                        <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8 opacity-50">
                            <h3 class="font-display text-4xl text-white">BÁSICO</h3>
                            <div class="text-5xl font-bold text-white mb-6">$500</div>
                            <button class="w-full py-4 rounded-xl border border-white/20 text-white">Ejemplo</button>
                        </div>
                    @endif
                </div>
            </div>
        </section>

    </div>

    <div x-data="{ open: false }" class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-10 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-10 scale-95"
             class="bg-white w-80 md:w-96 rounded-2xl shadow-2xl overflow-hidden border border-gray-100 mb-4 flex flex-col">
            
            <div class="bg-bonvoy-navy p-4 flex justify-between items-center text-white">
                <span class="font-bold flex items-center gap-2">✈️ Soporte BonVoy</span>
                <button @click="open = false" class="hover:bg-white/20 rounded p-1">&times;</button>
            </div>
            
            <div class="h-80 bg-slate-50 p-4 overflow-y-auto flex flex-col gap-3" id="chat-messages">
                <div class="self-start bg-white p-3 rounded-xl rounded-tl-none shadow-sm text-sm text-gray-600 border border-gray-100 max-w-[85%]">
                    @auth
                        ¡Hola, {{ auth()->user()->name }}! ¿En qué podemos ayudarte hoy?
                    @else
                        ¡Hola! Inicia sesión para recibir ayuda personalizada de nuestros agentes.
                    @endauth
                </div>
            </div>
            
            <div class="p-3 bg-white border-t border-gray-100 flex gap-2">
                <input type="text" id="chat-input" placeholder="Escribe tu duda..." class="flex-1 bg-gray-100 border-none rounded-full px-4 text-sm focus:ring-1 focus:ring-bonvoy-main focus:bg-white transition">
                <button id="send-msg" class="bg-bonvoy-main text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-bonvoy-teal transition shadow-md">➤</button>
            </div>
        </div>

        <button @click="open = !open" 
            class="bg-bonvoy-main hover:bg-bonvoy-teal text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center transition transform hover:scale-110 border-2 border-white">
            <svg x-show="!open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
            <svg x-show="open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <script>
        const chatInput = document.getElementById('chat-input');
        const sendBtn = document.getElementById('send-msg');
        const chatMessages = document.getElementById('chat-messages');

        // Abrir chat desde el menú de usuario
        document.getElementById('open-chat-link')?.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector('[x-data]').__x.$data.open = true; // Truco para abrir Alpine desde fuera
        });

        function sendMessage() {
            const text = chatInput.value;
            if (!text) return;

            // Mensaje Usuario
            chatMessages.innerHTML += `<div class="self-end bg-bonvoy-main text-white p-3 rounded-xl rounded-tr-none shadow-md text-sm max-w-[85%] animate-fade-in">${text}</div>`;
            chatInput.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Respuesta Bot
            setTimeout(() => {
                chatMessages.innerHTML += `<div class="self-start bg-white p-3 rounded-xl rounded-tl-none shadow-sm text-sm text-gray-600 border border-gray-100 max-w-[85%] animate-fade-in">Un agente de NeoTrips se conectará pronto. Folio: #BNV-${Math.floor(Math.random()*900)}</div>`;
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 1000);
        }

        sendBtn.onclick = sendMessage;
        chatInput.onkeypress = (e) => { if(e.key === 'Enter') sendMessage(); };
    </script>

    <style>
        @keyframes fade-in { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fade-in 0.3s ease-out forwards; }
    </style>

</body>
</html>