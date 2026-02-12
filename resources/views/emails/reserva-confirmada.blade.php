<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmación de reserva</title>
</head>
<body style="font-family: Arial;">
    <h2>¡Gracias por reservar con Bonvoy ✈️!</h2>

    <p>Hola {{ $reserva->nombre }},</p>

    <p>Tu reservación ha sido confirmada con éxito.</p>

    <ul>
        <li><strong>Destino:</strong> {{ $reserva->destino }}</li>
        <li><strong>Fecha:</strong> {{ $reserva->fecha }}</li>
        <li><strong>Personas:</strong> {{ $reserva->personas }}</li>
        <li><strong>Total:</strong> ${{ number_format($reserva->total, 2) }} MXN</li>
    </ul>

    <p>Nos vemos pronto 🌴</p>
    <p><strong>Equipo Bonvoy</strong></p>
</body>
</html>
