<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher BonVoy #{{ $reserva->id }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Red+Hat+Display:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Red Hat Display', sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        .voucher-wrapper {
            max-width: 950px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .ticket {
            background: white;
            display: flex;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
        }

        .ticket-main {
            flex: 2;
            padding: 40px;
            border-right: 2px dashed #e2e8f0;
            position: relative;
        }

        .ticket-stub {
            flex: 0.8;
            background-color: #f8fafc;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .logo-container {
            margin-bottom: 30px;
        }

        .logo-container img {
            height: 85px;
            width: auto;
            object-fit: contain;
        }

        .ticket-label {
            font-size: 0.65rem;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 4px;
        }

        .ticket-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a3c4d;
            margin-bottom: 20px;
        }

        .dest-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3.5rem;
            color: #126e82;
            line-height: 1;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .grid-info {
            display: grid;
            grid-template-cols: repeat(2, 1fr);
            gap: 20px;
        }

        .status-pill {
            background: #dcfce7;
            color: #15803d;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 900;
            text-transform: uppercase;
            display: inline-block;
            margin-top: 10px;
        }

        .total-price {
            font-size: 2.5rem;
            font-weight: 900;
            color: #1a3c4d;
        }

        .ticket-main::before, .ticket-main::after {
            content: '';
            position: absolute;
            right: -15px;
            width: 30px;
            height: 30px;
            background: #f1f5f9;
            border-radius: 50%;
        }
        .ticket-main::before { top: -15px; }
        .ticket-main::after { bottom: -15px; }

        .btn-action {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        @media (max-width: 768px) {
            .ticket { flex-direction: column; }
            .ticket-main { border-right: none; border-bottom: 2px dashed #e2e8f0; }
            .ticket-main::before, .ticket-main::after { display: none; }
        }

        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .voucher-wrapper { margin: 0; padding: 0; max-width: 100%; }
            .ticket { box-shadow: none; border: 1px solid #000; }
        }
    </style>
</head>
<body>

    <div class="voucher-wrapper">
        
        <div class="ticket">
            <div class="ticket-main">
                <div class="logo-container">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="BonVoy">
                </div>

                <div class="ticket-label">Destino / Experiencia</div>
                <h2 class="dest-title">{{ $reserva->contenido->titulo }}</h2>

                <div class="grid-info">
                    <div>
                        <div class="ticket-label">Pasajero</div>
                        <div class="ticket-value">{{ auth()->user()->name }}</div>
                    </div>
                    <div>
                        <div class="ticket-label">Fecha de Compra</div>
                        <div class="ticket-value">{{ $reserva->created_at->format('d/m/Y') }}</div>
                    </div>
                    <div>
                        <div class="ticket-label">ID Reservación</div>
                        <div class="ticket-value">#BNV-{{ str_pad($reserva->id, 5, '0', STR_PAD_LEFT) }}</div>
                    </div>
                    <div>
                        <div class="ticket-label">Estatus</div>
                        <div class="status-pill">{{ $reserva->estado }}</div>
                    </div>
                </div>
            </div>

            <div class="ticket-stub">
                <div class="ticket-label">Monto Pagado</div>
                <div class="total-price">${{ number_format($reserva->total, 0) }}</div>
                <div class="ticket-label" style="margin-top: -5px;">MXN</div>

                <div style="margin-top: 40px;">
                    <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#1a3c4d" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.2;">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                        <line x1="7" y1="7" x2="7" y2="7"></line>
                        <line x1="17" y1="7" x2="17" y2="7"></line>
                        <line x1="17" y1="17" x2="17" y2="17"></line>
                        <line x1="7" y1="17" x2="7" y2="17"></line>
                    </svg>
                    <p style="font-size: 0.6rem; color: #94a3b8; margin-top: 10px; font-weight: 700;">ESCANEAR EN LLEGADA</p>
                </div>
            </div>
        </div>

        <div class="no-print" style="margin-top: 40px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <a href="{{ route('home') }}" style="color: #94a3b8; font-weight: 700; text-decoration: none; font-size: 0.9rem;" class="hover:text-bonvoy-main transition">
                &larr; Volver al inicio
            </a>

            <div style="display: flex; gap: 15px;">
                
                {{-- BOTÓN GOOGLE CALENDAR --}}
                <a href="{{ $calendarUrl ?? '#' }}" target="_blank" onclick="mostrarAvisoCalendario()" class="btn-action" style="background-color: #ffffff; color: #4285F4; border: 2px solid #4285F4;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Agendar en Google
                </a>

                {{-- BOTÓN IMPRIMIR --}}
                <a href="javascript:window.print()" class="btn-action" style="background-color: #1a3c4d; color: white; border: 2px solid #1a3c4d;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Imprimir Comprobante
                </a>
            </div>
        </div>
    </div>

    {{-- Script para Notificación Flotante (Toast) --}}
    <script>
        function mostrarAvisoCalendario() {
            // Crea el elemento de notificación dinámicamente
            const notificacion = document.createElement('div');
            
            // Estilos Tailwind para alerta bonita
            notificacion.className = 'fixed top-6 right-6 bg-white border-l-4 border-blue-500 text-slate-700 px-6 py-4 rounded-lg shadow-2xl z-50 flex items-center gap-4 transition-all duration-500 transform translate-x-full';
            
            notificacion.innerHTML = `
                <div class="bg-blue-100 text-blue-500 p-2 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <h4 class="font-bold text-sm">¡Redirigiendo a Google!</h4>
                    <p class="text-xs text-gray-500">Confirma guardar el evento en la nueva pestaña.</p>
                </div>
            `;

            document.body.appendChild(notificacion);

            // Animación de entrada
            setTimeout(() => {
                notificacion.classList.remove('translate-x-full');
            }, 100);

            // Desaparecer después de 4 segundos
            setTimeout(() => {
                notificacion.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => notificacion.remove(), 500);
            }, 4000);
        }
    </script>

</body>
</html>