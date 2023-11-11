{{ Form::open(['id' => 'frmDeleteCadena', 'url' => 'admin/ruido/delete/'. $buffer->Id, 'method' => 'DELETE']) }}
{{ csrf_field() }}
<center>
    <a href="{{ route('mantenimiento.buffer.edit', $buffer->Id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
</center>
{{ Form::close() }}
