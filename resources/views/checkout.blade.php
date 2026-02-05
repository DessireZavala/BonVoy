<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bonvoy | Pago Seguro</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        .checkout-box { max-width: 500px; margin: 50px auto; padding: 30px; border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1); font-family: sans-serif; }
        .card-sim { background: #1a1a1a; color: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        .btn-pagar { background: #fbbf24; color: black; border: none; width: 100%; padding: 15px; font-weight: bold; cursor: pointer; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="checkout-box">
        <h2>Finalizar Reservación</h2>
        <p>Destino: <strong>{{ $destino->titulo }}</strong></p>
        
        <div class="card-sim">
            <small>Total a pagar</small>
            <h2>${{ number_format($destino->precio, 2) }} MXN</h2>
        </div>

        <form action="{{ route('pago.procesar') }}" method="POST">
            @csrf
            <input type="hidden" name="contenido_id" value="{{ $destino->id }}">

            <label>Datos del Cliente</label>
            <input type="text" placeholder="Nombre completo" required>
            <input type="email" placeholder="Correo electrónico" value="{{ auth()->user()->email }}" readonly>

            <label>Información de Tarjeta (Simulada)</label>
            <input type="text" placeholder="0000 0000 0000 0000" maxlength="16" required>
            <div style="display: flex; gap: 10px;">
                <input type="text" placeholder="MM/AA" required>
                <input type="text" placeholder="CVC" required>
            </div>

            <input type="hidden" name="precio_total" value="{{ $destino->precio }}"> <button type="submit" class="btn-pagar">PROCESAR PAGO AHORA</button>
        </form>
    </div>
</body>
</html>