<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

<h2>Panel Administrador - Gestión de Contenido</h2>

<a href="{{ route('admin.contenido.create') }}" class="btn-crear">Crear nuevo destino/pase</a>

<table>
    <thead>
        <tr>
            <th>Título</th>
            <th>Tipo</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contenidos as $c)
        <tr>
            <td>{{ $c->titulo }}</td>
            <td>{{ ucfirst($c->tipo) }}</td>
            <td>${{ number_format($c->precio, 2) }} MXN</td>
            <td>
                <span class="status-{{ $c->activo ? 'active' : 'inactive' }}">
                    {{ $c->activo ? 'Activo' : 'Inactivo' }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.contenido.edit', $c) }}">Editar</a>
                <form action="{{ route('admin.contenido.destroy', $c) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Seguro?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>