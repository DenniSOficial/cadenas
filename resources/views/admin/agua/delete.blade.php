{{ Form::open(['id' => 'frmDeleteCadena', 'url' => 'admin/agua/delete/'.$cadena->Id, 'method' => 'DELETE']) }}
    {{ csrf_field() }}
    <center>
        <a href="{{ route('agua.show', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Ver"><i class="fa fa-eye" aria-hidden="true"></i></a>
        <a href="{{ route('agua.edit', $cadena->Id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
        <a href="{{ route('agua.verificacion-operacional', $cadena->Id) }}" class="btn btn-success btn-sm" title="Verificación Operacional"><i class="fa fa-check-square" aria-hidden="true"></i></a>
        <a href="{{ route('agua.plan-muestreo', $cadena->Id) }}" class="btn btn-secondary btn-sm" title="Plan de muestreo"><i class="fa fa-list" aria-hidden="true"></i></a>
        <button type="submit" class="btn btn-danger btn-sm show_confirm" title="Eliminar" onclick="return confirm('¿Seguro deseas eliminar la cadena?')">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
    </center>
{{ Form::close() }}