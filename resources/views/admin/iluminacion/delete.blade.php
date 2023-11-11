{{ Form::open(['id' => 'frmDeleteCadena', 'url' => 'admin/iluminacion/delete/'. $cadena->Id, 'method' => 'DELETE']) }}
{{ csrf_field() }}
    
    <center>

        {{-- @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2) 
            <a href="{{ route('iluminacion.duplicar', $cadena->Id) }}" class="btn btn-secondary btn-sm" title="Duplicar"><i class="fa fa-copy" aria-hidden="true"></i></a>
        @endif --}}

        @if ($cadena->IdEstadoCadenaCustodia == 1)
            <a href="{{ route('iluminacion.show', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Ver"><i class="fa fa-eye" aria-hidden="true"></i></a>
            <a href="{{ route('iluminacion.edit', $cadena->Id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
            {{-- <a href="{{ route('iluminacion.recepcion-muestra', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Recepción Muestra"><i class="fa fa-flask" aria-hidden="true"></i></a> --}}
            <a href="{{ route('iluminacion.print', $cadena->Id) }}" target="_blank" class="btn btn-success btn-sm" title="Imprimir"><i class="fa fa-print" aria-hidden="true"></i></a>
            @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2) 
                <a href="{{ route('iluminacion.informe', $cadena->Id) }}" class="btn btn-success btn-sm" title="Informe"><i class="fa fa-indent" aria-hidden="true"></i></a>
                @if ($cadena->NumeroInforme != '')
                    {{-- <a href="{{ route('iluminacion.unir', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Unir"><i class="fa fa-random" aria-hidden="true"></i></a>     --}}
                @endif
            @endif
            @if (Auth::guard('admin')->user()->IdRol != 4 ) 
                <a href="{{ route('iluminacion.cambiar-estado-cadena', [$cadena->Id, 2]) }}" class="btn btn-secondary btn-sm" title="Completado"><i class="fa fa-check" aria-hidden="true"></i></a>
            @endif
            <button type="submit" class="btn btn-danger btn-sm show_confirm" title="Eliminar" onclick="return confirm('¿Seguro deseas eliminar la cadena?')">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>    
        @elseif($cadena->IdEstadoCadenaCustodia == 2)
            @if (Auth::guard('admin')->user()->IdRol != 3 ) 
                <a href="{{ route('iluminacion.show', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Ver"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="{{ route('iluminacion.edit', $cadena->Id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                <a href="{{ route('iluminacion.recepcion-muestra', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Recepción Muestra"><i class="fa fa-flask" aria-hidden="true"></i></a>
                <a href="{{ route('iluminacion.print', $cadena->Id) }}" target="_blank" class="btn btn-success btn-sm" title="Imprimir"><i class="fa fa-print" aria-hidden="true"></i></a>
                @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2) 
                    <a href="{{ route('iluminacion.informe', $cadena->Id) }}" class="btn btn-success btn-sm" title="Informe"><i class="fa fa-indent" aria-hidden="true"></i></a>
                    @if ($cadena->NumeroInforme != '')
                        {{-- <a href="{{ route('iluminacion.unir', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Unir"><i class="fa fa-random" aria-hidden="true"></i></a>     --}}
                    @endif
                @endif
                <a href="{{ route('iluminacion.cambiar-estado-cadena', [$cadena->Id, 3]) }}" class="btn btn-secondary btn-sm" title="Completado"><i class="fa fa-check" aria-hidden="true"></i></a>
            @endif
            @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2) 
                <button type="submit" class="btn btn-danger btn-sm show_confirm" title="Eliminar" onclick="return confirm('¿Seguro deseas eliminar la cadena?')">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>    
            @endif
        @elseif ($cadena->IdEstadoCadenaCustodia == 3)
            @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2) 
                <a href="{{ route('iluminacion.show', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Ver"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="{{ route('iluminacion.edit', $cadena->Id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                <a href="{{ route('iluminacion.recepcion-muestra', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Recepción Muestra"><i class="fa fa-flask" aria-hidden="true"></i></a>
                <a href="{{ route('iluminacion.print', $cadena->Id) }}" target="_blank" class="btn btn-success btn-sm" title="Imprimir"><i class="fa fa-print" aria-hidden="true"></i></a>
                @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2) 
                    <a href="{{ route('iluminacion.informe', $cadena->Id) }}" class="btn btn-success btn-sm" title="Informe"><i class="fa fa-indent" aria-hidden="true"></i></a>
                    @if ($cadena->NumeroInforme != '')
                        {{-- <a href="{{ route('iluminacion.unir', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Unir"><i class="fa fa-random" aria-hidden="true"></i></a>     --}}
                    @endif
                @endif
                <a href="{{ route('iluminacion.cambiar-estado-cadena', [$cadena->Id, 4]) }}" class="btn btn-secondary btn-sm" title="Completado"><i class="fa fa-check" aria-hidden="true"></i></a>
                <a href="{{ route('iluminacion.cambiar-estado-cadena', [$cadena->Id, 5]) }}" class="btn btn-secondary btn-sm" title="Rechazar"><i class="fa fa-times" aria-hidden="true"></i></a>
                <button type="submit" class="btn btn-danger btn-sm show_confirm" title="Eliminar" onclick="return confirm('¿Seguro deseas eliminar la cadena?')">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>    
            @endif
        @elseif ($cadena->IdEstadoCadenaCustodia == 4)
            @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2 ) 
                <a href="{{ route('iluminacion.show', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Ver"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="{{ route('iluminacion.edit', $cadena->Id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                <a href="{{ route('iluminacion.recepcion-muestra', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Recepción Muestra"><i class="fa fa-flask" aria-hidden="true"></i></a>
            @endif
            <a href="{{ route('iluminacion.print', $cadena->Id) }}" target="_blank" class="btn btn-success btn-sm" title="Imprimir"><i class="fa fa-print" aria-hidden="true"></i></a>
            @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2) 
                <a href="{{ route('iluminacion.informe', $cadena->Id) }}" class="btn btn-success btn-sm" title="Informe"><i class="fa fa-indent" aria-hidden="true"></i></a>
                @if ($cadena->NumeroInforme != '')
                    {{-- <a href="{{ route('iluminacion.unir', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Unir"><i class="fa fa-random" aria-hidden="true"></i></a>     --}}
                @endif
            @endif
            @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2 ) 
                <button type="submit" class="btn btn-danger btn-sm show_confirm" title="Eliminar" onclick="return confirm('¿Seguro deseas eliminar la cadena?')">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>    
            @endif
        @elseif ($cadena->IdEstadoCadenaCustodia == 5)
            @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2 || Auth::guard('admin')->user()->IdRol == 3) 
                <a href="{{ route('iluminacion.show', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Ver"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="{{ route('iluminacion.edit', $cadena->Id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>

                @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2) 
                    <a href="{{ route('iluminacion.recepcion-muestra', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Recepción Muestra"><i class="fa fa-flask" aria-hidden="true"></i></a>
                @endif
                
                <a href="{{ route('iluminacion.print', $cadena->Id) }}" target="_blank" class="btn btn-success btn-sm" title="Imprimir"><i class="fa fa-print" aria-hidden="true"></i></a>
                @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2) 
                    <a href="{{ route('iluminacion.informe', $cadena->Id) }}" class="btn btn-success btn-sm" title="Informe"><i class="fa fa-indent" aria-hidden="true"></i></a>
                    @if ($cadena->NumeroInforme != '')
                        {{-- <a href="{{ route('iluminacion.unir', $cadena->Id) }}" class="btn btn-primary btn-sm" title="Unir"><i class="fa fa-random" aria-hidden="true"></i></a>     --}}
                    @endif
                @endif
                <a href="{{ route('iluminacion.cambiar-estado-cadena', [$cadena->Id, 3]) }}" class="btn btn-secondary btn-sm" title="Completado"><i class="fa fa-check" aria-hidden="true"></i></a>
                <button type="submit" class="btn btn-danger btn-sm show_confirm" title="Eliminar" onclick="return confirm('¿Seguro deseas eliminar la cadena?')">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>    
             @endif
        @endif
        
    </center>
{{ Form::close() }}
