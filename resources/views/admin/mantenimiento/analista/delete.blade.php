{{ Form::open(['id' => 'frmDeleteAnalista', 'url' => 'admin/mantenimiento/analista/delete/'. $analista->Id, 'method' => 'DELETE']) }}
{{ csrf_field() }}
    
    <center>
        <a href="{{ route('mantenimiento.analista.edit', $analista->Id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Seguro deseas eliminar al analista?')">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </button>   
    </center>

    

{{ Form::close() }}
    