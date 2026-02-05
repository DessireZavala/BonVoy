<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonvoy | Inicio</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

    <header class="main-header">
        <div class="logo">NeoTravel</div>
        <nav>
            <a href="{{ route('home') }}">Inicio</a>
            
            @guest
                <a href="{{ url('auth/google') }}" style="color: #4285F4; font-weight: bold;">Entrar con Google</a>
            @endguest

            @auth
                <a href="{{ route('user.perfil') }}">Mi Historial</a>

                @if(Auth::user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" style="background: #fbbf24; color: black; padding: 5px 10px; border-radius: 4px;">Panel Admin</a>
                @endif

                <a href="#" id="open-chat" style="color: #fbbf24; font-weight: bold;">💬 Soporte</a>

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #ef4444;">
                    Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endauth
        </nav>
    </header>

    <section class="hero">
        <h1>TANZANIA<br><span>SAFARI</span></h1>
        <form action="{{ route('home') }}" method="GET">
            <input type="text" name="search" placeholder="Busca tu próximo viaje..." value="{{ request('search') }}">
            <button type="submit">Buscar</button>
        </form>
    </section>

    <section class="home-section">
        <h2>Destinos Populares</h2>
        <div class="activity-grid">
            @forelse($contenidos->where('tipo', 'destino') as $item)
            <div class="activity-card">
                @if($item->imagenPrincipal)
                    <img src="{{ asset('storage/' . $item->imagenPrincipal->ruta) }}" alt="{{ $item->titulo }}" style="width:100%; border-radius:10px;">
                @else
                    <img src="https://images.unsplash.com/photo-1500835595353-b0ad2e58b412?q=80&w=600" alt="Bonvoy" style="width:100%; border-radius:10px;">
                @endif
                
                <h3>{{ $item->titulo }}</h3>
                <p>${{ number_format($item->precio, 2) }} MXN</p>
                <a href="{{ route('destino.show', $item->id) }}" class="btn">Reservar</a>
            </div>
            @empty
                <p>No hay destinos disponibles por ahora.</p>
            @endforelse
        </div>
    </section>

    <section class="home-section neopass">
        <h2>NEOPASS</h2>
        <div class="neopass-cards">
            @foreach($contenidos->where('tipo', 'pase') as $pase)
                <div class="neopass-card">
                    <h3>{{ $pase->titulo }}</h3>
                    <p class="precio">${{ number_format($pase->precio, 2) }} MXN</p>
                    <button>Agregar</button>
                </div>
            @endforeach
        </div>
    </section>

    <div id="chat-widget" class="chat-hidden">
        <div class="chat-header">
            <span>Soporte Bonvoy ✈️</span>
            <button id="close-chat">×</button>
        </div>
        <div class="chat-body" id="chat-messages">
            <div class="msg bot">
                @auth
                    ¡Hola, {{ auth()->user()->name }}! ¿En qué podemos ayudarte?
                @else
                    ¡Hola! Inicia sesión para recibir ayuda personalizada.
                @endauth
            </div>
        </div>
        <div class="chat-footer">
            <input type="text" id="chat-input" placeholder="Escribe un mensaje...">
            <button id="send-msg">➤</button>
        </div>
    </div>

    <style>
        #chat-widget {
            position: fixed; bottom: 20px; right: 20px; width: 300px;
            background: white; border-radius: 15px; box-shadow: 0 5px 25px rgba(0,0,0,0.2);
            display: flex; flex-direction: column; z-index: 9999; transition: 0.3s;
        }
        .chat-hidden { transform: translateY(120%); opacity: 0; pointer-events: none; }
        .chat-header { background: #1a1a1a; color: #fbbf24; padding: 15px; border-radius: 15px 15px 0 0; display: flex; justify-content: space-between; font-weight: bold; }
        .chat-header button { background: none; border: none; color: white; font-size: 20px; cursor: pointer; }
        .chat-body { height: 300px; padding: 15px; overflow-y: auto; display: flex; flex-direction: column; gap: 10px; background: #f9f9f9; }
        .msg { padding: 8px 12px; border-radius: 10px; font-size: 0.9em; max-width: 80%; }
        .bot { background: #eee; align-self: flex-start; }
        .user { background: #fbbf24; color: black; align-self: flex-end; }
        .chat-footer { padding: 10px; display: flex; border-top: 1px solid #eee; }
        .chat-footer input { flex: 1; border: none; padding: 5px; outline: none; }
        .chat-footer button { background: none; border: none; cursor: pointer; font-size: 1.2em; }
    </style>

    <script>
        const chatWidget = document.getElementById('chat-widget');
        const openChat = document.getElementById('open-chat');
        const closeChat = document.getElementById('close-chat');
        const chatInput = document.getElementById('chat-input');
        const sendBtn = document.getElementById('send-msg');
        const chatMessages = document.getElementById('chat-messages');

        // Solo activar si el botón existe (cuando hay sesión)
        if (openChat) {
            openChat.onclick = (e) => { 
                e.preventDefault(); 
                chatWidget.classList.toggle('chat-hidden'); 
            };
        }

        closeChat.onclick = () => { chatWidget.classList.add('chat-hidden'); };

        function sendMessage() {
            const text = chatInput.value;
            if (!text) return;

            chatMessages.innerHTML += `<div class="msg user">${text}</div>`;
            chatInput.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;

            setTimeout(() => {
                chatMessages.innerHTML += `<div class="msg bot">Un agente de NeoTrips se conectará pronto. Folio: #BNV-${Math.floor(Math.random()*900)}</div>`;
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 1000);
        }

        sendBtn.onclick = sendMessage;
        chatInput.onkeypress = (e) => { if(e.key === 'Enter') sendMessage(); };
    </script>

</body>
</html>