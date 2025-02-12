@if ($mensualidades->isEmpty()) 
    <!-- If there are no monthly fees assigned, display this message -->
    <p class="text-center text-muted">No monthly fees assigned.</p>
@else
    @foreach ($mensualidades as $mensualidad)
        <!-- Loop through each monthly fee and display its details -->
        <div class="d-flex justify-content-between align-items-center border p-2 mb-2">
            <!-- Display the start and end dates of the monthly fee -->
            <span><strong>Start:</strong> {{ $mensualidad->fecha_inicio }} | <strong>End:</strong> {{ $mensualidad->fecha_fin }}</span>
            
            <!-- Button to edit the monthly fee, passing the necessary data as attributes -->
            <button class="btn btn-warning btn-sm edit-mensualidad" 
                data-id="{{ $mensualidad->id_mensualidad }}"
                data-inicio="{{ $mensualidad->fecha_inicio }}"
                data-fin="{{ $mensualidad->fecha_fin }}">Edit</button>
            
            <!-- Form to delete the monthly fee -->
            <form action="{{ route('mensualidad.destroy', $mensualidad->id_mensualidad) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <!-- Button to confirm deletion -->
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    @endforeach
@endif
