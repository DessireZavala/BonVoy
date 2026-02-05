<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Voucher de Pago | Bonvoy</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        .voucher-card { max-width: 600px; margin: 30px auto; border: 2px dashed #fbbf24; padding: 20px; border-radius: 10px; background: #fff; }
        .header-voucher { border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 20px; text-align: center; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .btn-print { background: #1a1a1a; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; }
        @media print { .btn-print, .no-print { display: none; } }
    </style>
</head>
<body style="background: #f4f4f4;">

    <div class="voucher-card">
        <div class="header-voucher">
            <h2>BONVOY - COMPROBANTE DE PAGO</h2>
            <p>ID de Reservación: #00{{ $reserva->id }}</p>
        </div>

        <div class="info-row">
            <span><strong>Cliente:</strong></span>
            <span>{{ auth()->user()->name }}</span>
        </div>
        <div class="info-row">
            <span><strong>Destino/Servicio:</strong></span>
            <span>{{ $reserva->contenido->titulo }}</span>
        </div>
        <div class="info-row">
            <span><strong>Fecha de Pago:</strong></span>
            <span>{{ $reserva->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="info-row">
            <span><strong>Estado:</strong></span>
            <span style="color: green; font-weight: bold;">{{ $reserva->estado }}</span>
        </div>
        
        <hr>
        
        <div class="info-row" style="font-size: 1.2em;">
            <span><strong>Total Pagado:</strong></span>
            <strong>${{ number_format($reserva->total, 2) }} MXN</strong>
        </div>

        <div style="text-align: center; margin-top: 30px;" class="no-print">
            <a href="javascript:window.print()" class="btn-print">Imprimir Voucher</a>
            <a href="{{ route('home') }}" style="margin-left: 10px; color: #666;">Volver al Inicio</a>
        </div>
    </div>

</body>
</html>