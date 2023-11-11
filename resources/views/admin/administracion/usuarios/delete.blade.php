<center>
    <a href="{{ route('administracion.usuario.edit', $usuario->IdUsuario) }}" class="btn btn-warning btn-sm" title="Editar Usuario"><i class="fa fa-edit" aria-hidden="true"></i></a>
    <a class="btn btn-danger btn-sm" href="{{ route('administracion.usuario.delete', $usuario->IdUsuario) }}" id="delete" title="Editar Usuario"><i class="fa fa-trash" aria-hidden="true"></i></a>
</center>
