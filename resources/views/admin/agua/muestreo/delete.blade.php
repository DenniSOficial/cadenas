{{ Form::open(['id' => 'frmDeleteMuestreo', 'url' => 'admin/agua/muestreo/delete/'. $muestreo->Id, 'method' => 'DELETE']) }}
{{ csrf_field() }}

    <center>
        <a href="{{ route('agua.muestreo.edit', [$muestreo->IdCadenaCustodiaAgua, $muestreo->Id]) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
        <a href="{{ route('agua.muestreo.print', [$muestreo->IdCadenaCustodiaAgua, $muestreo->Id]) }}" target="_blank" class="btn btn-success btn-sm" title="Editar"><i class="fa fa-print" aria-hidden="true"></i></a>
        @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2) 
            <button type="submit" class="btn btn-danger btn-sm show_confirm" title="Eliminar" onclick="return confirm('¿Seguro deseas eliminar el muestreo?')">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>    
        @endif
    </center>

{{ Form::close() }}