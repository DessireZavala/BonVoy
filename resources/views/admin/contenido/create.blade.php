<h1>Crear contenido</h1>

<form method="POST" action="{{ route('admin.contenido.store') }}">
@csrf

<input name="titulo" placeholder="Título"><br>

<select name="tipo">
    <option value="destino">Destino</option>
    <option value="hospedaje">Hospedaje</option>
    <option value="actividad">Actividad</option>
    <option value="paquete">Paquete</option>
    <option value="pase">Pase</option>
</select><br>

<textarea name="descripcion"></textarea><br>

<input name="precio" placeholder="Precio"><br>
<div class="form-group">
    <label>Latitud</label>
    <input type="number" step="any" name="latitud" class="form-control" value="{{ $contenido->latitud ?? '' }}" placeholder="Ej: 24.2917">
</div>

<div class="form-group">
    <label>Longitud</label>
    <input type="number" step="any" name="longitud" class="form-control" value="{{ $contenido->longitud ?? '' }}" placeholder="Ej: -103.2417">
</div>
<label>
    <input type="checkbox" name="activo" value="1" checked> Activo
</label><br>

<button>Guardar</button>
</form>
