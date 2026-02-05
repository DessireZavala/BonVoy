<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Destino | Panel Admin Bonvoy</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; margin: 0; padding: 20px; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); max-width: 1200px; margin: auto; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        label { display: block; font-weight: 600; margin-bottom: 8px; color: #444; }
        .form-control { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
        textarea.form-control { height: 100px; resize: vertical; }
        #map-admin { height: 450px; width: 100%; border-radius: 10px; border: 2px solid #fbbf24; }
        .btn-update { background: #fbbf24; color: black; padding: 12px 30px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 16px; }
        .btn-cancel { color: #666; text-decoration: none; margin-left: 20px; font-size: 14px; }
        .coords-box { display: flex; gap: 10px; background: #f8f9fa; padding: 10px; border-radius: 8px; border: 1px dashed #ccc; }
    </style>
</head>
<body>

<div class="card">
    <h2 style="margin-top: 0; color: #1a1a1a;">📝 Editar Registro: {{ $contenido->titulo }}</h2>
    <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 25px;">

    <form action="{{ route('admin.contenido.update', $contenido->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid">
            <div>
                <label>Título del Destino</label>
                <input type="text" name="titulo" value="{{ $contenido->titulo }}" class="form-control" required>

                <label>Descripción / Detalles</label>
                <textarea name="descripcion" class="form-control" required>{{ $contenido->descripcion }}</textarea>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div>
                        <label>Precio (MXN)</label>
                        <input type="number" step="0.01" name="precio" value="{{ $contenido->precio }}" class="form-control" required>
                    </div>
                    <div>
                        <label>Tipo</label>
                        <select name="tipo" class="form-control">
                            <option value="destino" {{ $contenido->tipo == 'destino' ? 'selected' : '' }}>Destino</option>
                            <option value="pase" {{ $contenido->tipo == 'pase' ? 'selected' : '' }}>Neopass</option>
                        </select>
                    </div>
                </div>

                <label>Estatus del Registro</label>
                <select name="activo" class="form-control">
                    <option value="1" {{ $contenido->activo == 1 ? 'selected' : '' }}>Activo (Visible)</option>
                    <option value="0" {{ $contenido->activo == 0 ? 'selected' : '' }}>Inactivo (Oculto)</option>
                </select>

                <label>Ubicación Geográfica (Latitud / Longitud)</label>
                <div class="coords-box">
                    <input type="text" name="latitud" id="lat" value="{{ $contenido->latitud }}" class="form-control" style="margin-bottom:0" readonly>
                    <input type="text" name="longitud" id="lng" value="{{ $contenido->longitud }}" class="form-control" style="margin-bottom:0" readonly>
                </div>
                <small style="color: #888;">* Estos campos se actualizan automáticamente usando el mapa.</small>
            </div>

            <div>
                <label>Seleccionar Ubicación Exacta</label>
                <div id="map-admin"></div>
                
                <div style="margin-top: 20px;">
                    <label>Cambiar Imagen (Opcional)</label>
                    <input type="file" name="imagen" class="form-control">
                    @if($contenido->imagen)
                        <small>Imagen actual: <code>{{ $contenido->imagen }}</code></small>
                    @endif
                </div>
            </div>
        </div>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
            <button type="submit" class="btn-update">Guardar Cambios</button>
            <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Cancelar y regresar</a>
        </div>
    </form>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtgwMLKYKZkCOHuaULlzNmRautFPdYRNI&callback=initMap" async defer></script>

<script>
    function initMap() {
        const latInput = document.getElementById('lat');
        const lngInput = document.getElementById('lng');

        const posInicial = { 
            lat: parseFloat("{{ $contenido->latitud ?? 24.2917 }}"), 
            lng: parseFloat("{{ $contenido->longitud ?? -103.2417 }}") 
        };

        const map = new google.maps.Map(document.getElementById('map-admin'), {
            center: posInicial,
            zoom: 15,
            gestureHandling: 'greedy'
        });

        const marker = new google.maps.Marker({
            position: posInicial,
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP
        });

        function updateInputs(lat, lng) {
            latInput.value = lat.toFixed(8);
            lngInput.value = lng.toFixed(8);
        }

        marker.addListener('dragend', function(e) {
            updateInputs(e.latLng.lat(), e.latLng.lng());
        });

        map.addListener('click', function(e) {
            marker.setPosition(e.latLng);
            updateInputs(e.latLng.lat(), e.latLng.lng());
        });
    }
</script>

</body>
</html>