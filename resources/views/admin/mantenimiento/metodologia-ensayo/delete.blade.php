{{ Form::open(['id' => 'frmDeleteMetodologia', 'url' => 'admin/mantenimiento/metodologia-ensayo/delete/'.$metodologia->Id, 'method' => 'DELETE']) }}
    <center>
        <a href="{{ route('mantenimiento.metodologia-ensayo.edit', $metodologia->Id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
        <button type="submit" class="btn btn-danger btn-sm show_confirm" title="Eliminar">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
    </center>
{{ Form::close() }}