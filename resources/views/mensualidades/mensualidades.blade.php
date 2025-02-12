@if ($mensualidades->isEmpty())
    <p class="text-center text-muted">No hay mensualidades asignadas.</p>
@else
    @foreach ($mensualidades as $mensualidad)
        <div class="d-flex justify-content-between align-items-center border p-2 mb-2">
            <span><strong>Inicio:</strong> {{ $mensualidad->fecha_inicio }} | <strong>Fin:</strong> {{ $mensualidad->fecha_fin }}</span>
            <button class="btn btn-warning btn-sm edit-mensualidad" 
                data-id="{{ $mensualidad->id_mensualidad }}"
                data-inicio="{{ $mensualidad->fecha_inicio }}"
                data-fin="{{ $mensualidad->fecha_fin }}">Editar</button>
            <form action="{{ route('mensualidad.destroy', $mensualidad->id_mensualidad) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </div>
    @endforeach
@endif
