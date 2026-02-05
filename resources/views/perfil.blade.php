<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil | Bonvoy</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        .perfil-container { max-width: 900px; margin: 50px auto; padding: 20px; font-family: sans-serif; }
        .user-header { background: #1a1a1a; color: white; padding: 30px; border-radius: 15px; margin-bottom: 30px; }
        .history-table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .history-table th { background: #fbbf24; color: black; padding: 15px; text-align: left; }
        .history-table td { padding: 15px; border-bottom: 1px solid #eee; }
        .status-pill { padding: 5px 12px; border-radius: 20px; font-size: 0.85em; font-weight: bold; background: #dcfce7; color: #166534; }
        .btn-voucher { color: #2563eb; text-decoration: none; font-weight: bold; }
        .btn-voucher:hover { text-decoration: underline; }
    </style>
</head>
<body style="background: #f9fafb;">

    <div class="perfil-container">
        <div class="user-header">
            <h1>Hola, {{ auth()->user()->name }}</h1>
            <p>Bienvenido a tu panel de viajero en Bonvoy</p>
            <a href="{{ route('home') }}" style="color: #fbbf24; text-decoration: none;">← Volver a buscar destinos</a>
        </div>

        <h2>Mi Historial de Reservaciones</h2>

        <table class="history-table">
            <thead>
                <tr>
                    <th>Destino</th>
                    <th>Fecha de Compra</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Comprobante</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservas as $reserva)
                <tr>
                    <td>
                        <strong>{{ $reserva->contenido->titulo ?? 'Destino no encontrado' }}</strong>
                    </td>
                    <td>{{ $reserva->created_at->format('d/m/Y') }}</td>
                    <td>${{ number_format($reserva->total, 2) }} MXN</td>
                    <td>
                        <span class="status-pill">{{ $reserva->estado }}</span>
                    </td>
                    <td>
                        <a href="{{ route('reservar.voucher', $reserva->id) }}" class="btn-voucher">
                            Ver Voucher 📄
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #666;">
                        Aún no tienes reservaciones registradas. <br>
                        <a href="{{ route('home') }}" style="color: #2563eb;">¡Empieza a planear tu viaje aquí!</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>