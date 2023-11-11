{{ Form::open(['url' => $url, 'method' => $method, 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCustodia', 'novalidate' => true, 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";', 'onsubmit' => 'return validateForm();']) }}
{!! Form::token() !!}

<div class="card-body">
    <input type="hidden" class="form-control" name="id_cadena" id="id_cadena" value="{{ $cadena->Id }}">
    <input type="hidden" class="form-control" name="flag_dmuestreo" id="flag_dmuestreo" value="{{ isset($detalle) ? $detalle->FlagCadenaCustodiaIluminacionDatosMuestreo : '0' }}">
    <input type="hidden" class="form-control" name="id_dmuestreo" id="id_dmuestreo" value="{{ isset($detalle) ? $detalle->IdCadenaCustodiaIluminacionDatosMuestreo : '0' }}">

    <div class="form-group row">
        <label for="codigo_cliente" class="col-sm-2 col-form-label">Cod. cliente</label>
        <div class="input-group col-sm-4">
            <input type="text" class="form-control" id="codigo_cliente" name="codigo_cliente"
                placeholder="Código cliente" oninput="this.value = this.value.toUpperCase()"
                value="{{ isset($detalle) ? $detalle->CodigoCliente : '' }}">
        </div>
        <label for="codigo_laboratorio" class="col-sm-2 col-form-label">Cod. laboratorio</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="codigo_laboratorio" id="codigo_laboratorio"
                placeholder="Código laboratorio" value="{{ isset($detalle) ? $detalle->CodigoLaboratorio : '' }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="nombre_cliente" class="col-sm-2 col-form-label">Nombre cliente</label>
        <div class="input-group col-sm-10">
            <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente"
                placeholder="Nombre cliente" oninput="this.value = this.value.toUpperCase()"
                value="{{ isset($detalle) ? $detalle->NombreCliente : $cadena->ContactoCliente }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="cliente" class="col-sm-2 col-form-label">Iluminación</label>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" id="iluminacion_interior" name="iluminacion_interior"
                                {{ isset($detalle) && $detalle->IluminacionInterior == '1' ? 'checked' : '' }}>
                            <label for="iluminacion_interior" style="font-weight: normal;">
                                Interiores
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" id="iluminacion_exterior" name="iluminacion_exterior"
                                {{ isset($detalle) && $detalle->IluminacionExterior == '1' ? 'checked' : '' }}>
                            <label for="iluminacion_exterior" style="font-weight: normal;">
                                Exteriores
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h5>Muestreo</h5>
    <div class="form-group row">
        <label for="finicio_muestreo" class="col-sm-2 col-form-label">Fecha Inicio</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" id="finicio_muestreo" name="finicio_muestreo"
                value="{{ isset($detalle) ? $detalle->FechaInicioMuestreo : '' }}">
        </div>
        <label for="hinicio_muestreo" class="col-sm-2 col-form-label">Hora Inicio</label>
        <div class="col-sm-4">
            <input type="time" class="form-control" id="hinicio_muestreo" name="hinicio_muestreo"
                value="{{ isset($detalle) ? date('H:i', strtotime($detalle->HoraInicioMuestreo)) : '' }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="ffin_muestreo" class="col-sm-2 col-form-label">Fecha Fin</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" id="ffin_muestreo" name="ffin_muestreo"
                value="{{ isset($detalle) ? $detalle->FechaFinMuestreo : '' }}">
        </div>
        <label for="hfin_muestreo" class="col-sm-2 col-form-label">Hora Fin</label>
        <div class="col-sm-4">
            <input type="time" class="form-control" name="hfin_muestreo" id="hfin_muestreo"
                value="{{ isset($detalle) ? date('H:i', strtotime($detalle->HoraFinMuestreo)) : '' }}">
        </div>
    </div>

</div>
<div class="card-footer">
    <button type="submit" class="btn btn-info">Guardar</button>
    <a href="{{ route('iluminacion.show', $cadena->Id) }}" class="btn btn-default float-right">Cancelar</a>
</div>

{{ Form::close() }}

