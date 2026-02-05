<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Destino</title>
  <link rel="stylesheet" href="css/main.css">
</head>
<body>

<section class="banner-destino">
<h1>{{ $destino->titulo }}</h1>

<span class="badge">{{ ucfirst($destino->tipo) }}</span>

<p>{{ $destino->descripcion }}</p>
<div id="map" style="height: 400px; width: 100%; border-radius: 15px; margin-top: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"></div>

<h3>Precio: ${{ number_format($destino->precio, 2) }} MXN</h3>
<form action="{{ route('reservar.store') }}" method="POST">
    @csrf
    <input type="hidden" name="contenido_id" value="{{ $destino->id }}">
    <a href="{{ route('checkout', $destino->id) }}" class="btn-reservar" style="display:inline-block; background: #fbbf24; padding: 15px 30px; text-decoration: none; color: black; font-weight: bold; border-radius: 8px;">
        Confirmar Reservación
    </a>
</form>
</section>

<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtgwMLKYKZkCOHuaULlzNmRautFPdYRNI&callback=initMap"></script>

<script>
    function initMap() {
        // Coordenadas desde la base de datos (Laravel las inyecta aquí)
        // Si no hay coordenadas, usamos una por defecto (ej. Juan Aldama, Zac.)
        const ubicacion = { 
            lat: {{ $destino->latitud ?? 24.2917 }}, 
            lng: {{ $destino->longitud ?? -103.2417 }} 
        };

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: ubicacion,
            styles: [ /* Puedes agregar estilos oscuros aquí para que combine con NeoTrips */ ]
        });

        // El marcador (Pin)
        new google.maps.Marker({
            position: ubicacion,
            map: map,
            title: "{{ $destino->titulo }}",
            animation: google.maps.Animation.DROP
        });
    }
</script>
</body>
</html>
