{{ Form::open(['id' => 'frmDeleteCadenaDetalle', 'url' => 'admin/iluminacion/detalle/delete/'.$codigo->Id, 'method' => 'DELETE']) }}
    <center>
        {{-- <a href="{{ route('ruido.show', $codigo->Id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a> --}}
        <a href="{{ route('iluminacion.detalle.edit', $codigo->Id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
        {{-- <a href="{{ route('ruido.print', $codigo->Id) }}" class="btn btn-success btn-sm"><i class="fa fa-print" aria-hidden="true"></i></a> --}}
        <button type="submit" class="btn btn-danger btn-sm show_confirm" title="Eliminar">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
    </center>
{{ Form::close() }}