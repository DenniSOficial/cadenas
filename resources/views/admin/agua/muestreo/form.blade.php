{{ Form::open(['url' => $url, 'method' => $method, 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
    {!! Form::token() !!}
    <div class="card-body">
        
        <input type="hidden" name="id_cadena" value="{{ $cadena->Id }}">

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Personal muestreo:</label>
            <div class="col-sm-4">
                <select id="id_analista" name="id_analista" class="form-control select2bs4" style="width: 100%;">
                    <option value="">Seleccione</option>
                    @foreach ($analistas as $principal)
                        <option value="{{ $principal->Id }}" {{ isset($muestreo) ? $muestreo->IdAnalista == $principal->Id ? 'selected' : '' : '' }} >{{ $principal->NombreCompleto . ' ' . $principal->ApellidoPaterno . ' ' . $principal->ApellidoMaterno }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-group row">
            <label for="contacto_campo" class="col-sm-2 col-form-label">Contacto en campo:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="contacto_campo" name="contacto_campo" placeholder="Contacto en campo" value="{{ isset($muestreo) ? $muestreo->ContactoCampo : '' }}">
            </div>
            <label for="contacto_telefono" class="col-sm-2 col-form-label">Celular:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="contacto_telefono" name="contacto_telefono" placeholder="Celular" value="{{ isset($muestreo) ? $muestreo->CelularContacto : '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Lugar Muestreo:</label>
            <div class="col-sm-3">
            <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Departamento" value="{{ isset($muestreo) ? $muestreo->DepartamentoMuestreo : '' }}">
            </div>
            <div class="col-sm-3">
            <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Provincia" value="{{ isset($muestreo) ? $muestreo->ProvinciaMuestreo : '' }}">
            </div>
            <div class="col-sm-3">
            <input type="text" class="form-control" id="distrito" name="distrito" placeholder="Distrito" value="{{ isset($muestreo) ? $muestreo->DistritoMuestreo : '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="fecha_inicio" class="col-sm-2 col-form-label">Fecha Muestreo:</label>
            <div class="col-sm-4">
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ isset($muestreo) ? $muestreo->FechaInicioMuestreo : '' }}">
            </div>
            <label for="fecha_termino" class="col-sm-2 col-form-label"> <center>al</center> </label>
            <div class="col-sm-4">
                <input type="date" class="form-control" id="fecha_termino" name="fecha_termino" value="{{ isset($muestreo) ? $muestreo->FechaTerminoMuestreo : '' }}">
            </div>
        </div>

        <h5>Muestreo realizado según procedimiento PL-009</h5>
        <hr>

        <div class="form-group row">
        <ul>
            @foreach ($muestreos as $fila)
            <li class="list-group-item">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" id="muestreo[{{ $fila->Id }}]" name="muestreo[{{ $fila->Id }}]" type="checkbox" {{ in_array($fila->Id,  explode(';', $muestreo->Muestreos) ) ? 'checked' : '' }}>
                    <label class="cursor-pointer d-block custom-control-label" for="muestreo[{{ $fila->Id }}]" style="font-weight: normal;">{{ $fila->Descripcion }}</label>
                </div>
            </li>  
            @endforeach
        </ul>
        </div>

        <div class="form-group row">
        <div class="col-sm-12">
            <a class="btn btn-success" id="btnAddPuntoMuestreo" style="margin-bottom: 1rem;">Agregar</a>    
        </div>
        </div>

        <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table id="tblPuntoMuestreo" class="table table-bordered" style="text-align: center;">
                    <thead>
                        <tr>
                            <th rowspan="3">Fecha</th>
                            <th colspan="9">Número de puntos de muestreo</th>
                            <th rowspan="3"></th>
                        </tr>
                        <tr>
                            <th rowspan="2">Agua</th>
                            <th colspan="3">Calidad de Aire</th>
                            <th rowspan="2">Suelos</th>
                            <th colspan="2">Emisiones</th>
                            <th rowspan="2">Otros</th>
                            <th rowspan="2">Observaciones</th>
                        </tr>
                        <tr>
                        <th>Aires</th>
                        <th>Ruido</th>
                        <th>Metereológia</th>
                        <th>Gaseosas</th>
                        <th>Isocinético</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($muestreo)
                            @foreach ($muestreo->puntos as $punto)
                                <tr>
                                    <td> <input type="date" name="fechaPuntoMuestreo[]" class="form-control" value="{{ $punto->Fecha }}"> </td>
                                    <td> <input type="number" name="aguaPuntoMuestreo[]" class="form-control" value="{{ $punto->Agua }}"> </td>
                                    <td> <input type="number" name="airePuntoMuestreo[]" class="form-control" value="{{ $punto->Aire }}"> </td>
                                    <td> <input type="number" name="ruidoPuntoMuestreo[]" class="form-control" value="{{ $punto->Ruido }}"> </td>
                                    <td> <input type="number" name="metereologiaPuntoMuestreo[]" class="form-control" value="{{ $punto->Metereologia }}"> </td>
                                    <td> <input type="number" name="sueloPuntoMuestreo[]" class="form-control" value="{{ $punto->Suelo }}"> </td>
                                    <td> <input type="number" name="gaseosaPuntoMuestreo[]" class="form-control" value="{{ $punto->Gaseosa }}"> </td>
                                    <td> <input type="number" name="isocineticoPuntoMuestreo[]" class="form-control" value="{{ $punto->Isocinetico }}"> </td>
                                    <td> <input type="number" name="otrosPuntoMuestreo[]" class="form-control" value="{{ $punto->Otro }}"> </td>
                                    <td> <input type="text" name="observacionPuntoMuestreo[]" class="form-control" value="{{ $punto->Observaciones }}"> </td>
                                    <td> <a id="deleteFilaPuntoMuestreo" class="btn btn-danger btn-sm  delete" data-toggle="modal" ><i class="fa fa-trash" aria-hidden="true"></i></a> </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
        </div>

        {{-- <h5>Documentos asociados</h5>
        <hr> --}}
        
        <div class="form-group row">
        <ul>
            @foreach ($taguas as $agua)
            <li class="list-group-item">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" id="agua[{{ $agua->Id }}]" name="agua[{{ $agua->Id }}]" type="checkbox" {{ in_array($agua->Id, explode(';', $muestreo->Tipos)) ? 'checked' : '' }}>
                    <label class="cursor-pointer d-block custom-control-label" for="agua[{{ $agua->Id }}]" style="font-weight: normal;">{{ $agua->Descripcion }}</label>
                </div>
            </li>  
            @endforeach
        </ul>
        </div>

        <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Se tomo muestra dirimente:</label>
        <div class="col-sm-4">
            <input type="checkbox" class="form-control" id="muestra_dirimente" name="muestra_dirimente" value="" {{ isset($muestreo) ? ($muestreo->MuestraDirimente == 1 ? 'checked' : '') : ''; }}>
        </div>
        <label for="" class="col-sm-2 col-form-label">Matriz de la muestra dirimente:</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="matriz_muestra_dirimente" name="matriz_muestra_dirimente" value="{{ isset($muestreo) ? $muestreo->MatrizMuestraDirimente : ''; }}">
        </div>
        </div>

        <h5>Documentos asociados</h5>
        <hr>

        <div class="form-group row">
        <ul>
            @foreach ($documentos as $documento)
            <li class="list-group-item">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" id="documento[{{ $documento->Id }}]" name="documento[{{ $documento->Id }}]" type="checkbox" {{ in_array($documento->Id, explode(';', $muestreo->DocumentosAsociados)) ? 'checked' : '' }}>
                    <label class="cursor-pointer d-block custom-control-label" for="documento[{{ $documento->Id }}]" style="font-weight: normal;">{{ $documento->Abreviatura }}</label>
                </div>
            </li>  
            @endforeach
        </ul>
        </div>

        <div class="form-group row">
        <div class="col-sm-12">
            <a class="btn btn-success" id="btnAddEquipoMuestreo" style="margin-bottom: 1rem;">Agregar</a>    
        </div>
        </div>

        <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table id="tblEquipoMuestreo" class="table table-bordered" style="text-align: center;">
                    <thead>
                        <tr>
                        <th>Equipo</th>
                        <th>Código de Laboratorio</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @isset($muestreo)
                        @foreach ($muestreo->equipos as $equipo)
                            <tr>
                                <td> <input type="text" name="EquipoMuestreo[]" class="form-control" value="{{ $equipo->Equipo }}"> </td>
                                <td> <input type="text" name="CodigoMuestreo[]" class="form-control" value="{{ $equipo->CodigoLaboratorio }}"> </td>
                                <td> <a id="deleteFilaEquipoMuestreo" class="btn btn-danger btn-sm  delete" data-toggle="modal" ><i class="fa fa-trash" aria-hidden="true"></i></a> </td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>
        </div>
        </div>

        <h5>Duplicados a considerar en la matriz de:</h5>
        <hr>

        <div class="form-group row">
        <ul>
            @foreach ($matrices as $matriz)
            <li class="list-group-item">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" id="matriz[{{ $matriz->Id }}]" name="matriz[{{ $matriz->Id }}]" type="checkbox" {{ in_array($matriz->Id, explode(';', $muestreo->Procedimientos)) ? 'checked' : '' }}>
                    <label class="cursor-pointer d-block custom-control-label" for="matriz[{{ $matriz->Id }}]" style="font-weight: normal;">{{ $matriz->Descripcion }}</label>
                </div>
            </li>  
            @endforeach
        </ul>
        </div>

        <div class="form-group row">
        <div class="col-sm-12">
            <a class="btn btn-success" id="btnAddParametroDuplicado" style="margin-bottom: 1rem;">Agregar</a>    
        </div>
        </div>

        <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table id="tblParametroDuplicado" class="table table-bordered" style="text-align: center;">
                    <thead>
                        <tr>
                        <th>Matriz</th>
                        <th>Párametro a considerarse para el duplicado</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @isset($muestreo)
                        @foreach ($muestreo->parametros as $parametro)
                            <tr>
                                <td> <input type="text" name="MatrizMuestreo[]" class="form-control" value="{{ $parametro->Matriz }}"> </td>
                                <td> <input type="text" name="ParametroMuestreo[]" class="form-control" value="{{ $parametro->Parametro }}"> </td>
                                <td> <a id="deleteFilaParametro" class="btn btn-danger btn-sm  delete" data-toggle="modal" ><i class="fa fa-trash" aria-hidden="true"></i></a> </td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>
        </div>
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-info">Guardar</button>
        <a href="{{ route('agua.plan-muestreo', $cadena->Id) }}" class="btn btn-default float-right">Cancelar</a>
      </div>
{{ Form::close() }}