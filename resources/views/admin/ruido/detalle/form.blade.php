{{ Form::open(['url' => $url, 'method' => $method, 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
    {!! Form::token() !!}
    <div class="card-body">
        <input type="hidden" class="form-control" name="id_cadena" id="id_cadena" value="{{ $cadena->Id }}">
        <input type="hidden" class="form-control" name="ubicacion_microfono_valor" id="ubicacion_microfono_valor" value="{{ isset($detalle) ? $detalle->UbicacionMicrofonoValor : '' }}">

      <div class="form-group row">
          <label for="codigo_cliente" class="col-sm-2 col-form-label">Cod. cliente</label>
          <div class="input-group col-sm-4">
              <input type="text" class="form-control" id="codigo_cliente" name="codigo_cliente" placeholder="Código cliente" oninput="this.value = this.value.toUpperCase()" value="{{ isset($detalle) ? $detalle->CodigoCliente : '' }}">
          </div>
          <label for="codigo_laboratorio" class="col-sm-2 col-form-label">Cod. laboratorio</label>
            <div class="col-sm-4">
            <input type="text" class="form-control" name="codigo_laboratorio" id="codigo_laboratorio" placeholder="Código laboratorio" value="{{ isset($detalle) ? $detalle->CodigoLaboratorio : '' }}">
            </div>
      </div>

      <div class="form-group row">
          <label for="nombre_cliente" class="col-sm-2 col-form-label">Nombre cliente</label>
          <div class="input-group col-sm-10">
              <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder="Nombre cliente" oninput="this.value = this.value.toUpperCase()" value="{{ isset($detalle) ? $detalle->NombreCliente : $cadena->ContactoCliente }}">
          </div>
      </div>

      <div class="form-group row">
        <label for="zona_aplicacion" class="col-sm-2 col-form-label">Zona de aplicación</label>
        <div class="input-group col-sm-4">
            <input type="text" class="form-control" id="zona_aplicacion" name="zona_aplicacion" placeholder="Nombre cliente" value="{{ isset($detalle) ? $detalle->ZonaAplicacion : 'Ruido Industrial' }}">
        </div>
    </div>
      
      <div class="form-group row">
        <label for="cliente" class="col-sm-2 col-form-label">Periodo</label>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-2">
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" id="flag_diurno" name="flag_diurno" {{ isset($detalle) && $detalle->FlagCadenaCustodiaRuidoDatosMedicionDiurno == '1' ? 'checked' : '' }}>
                      <label for="flag_diurno" style="font-weight: normal;">
                        Diurno
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" id="flag_nocturno" name="flag_nocturno" {{ isset($detalle) && $detalle->FlagCadenaCustodiaRuidoDatosMedicionNocturno == '1' ? 'checked' : '' }}>
                      <label for="flag_nocturno" style="font-weight: normal;">
                        Nocturno
                      </label>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div>

      <h5>Ruido Continuo</h5>
      <div class="form-group row">
        <label for="rc_total" class="col-sm-2 col-form-label">Ruido Total</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="rc_total" name="rc_total" value="{{ isset($detalle) ? $detalle->RuidoContinuoTotal : '' }}">
        </div>
        <label for="rc_residual" class="col-sm-2 col-form-label">Ruido Residual</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="rc_residual" name="rc_residual" value="{{ isset($detalle) ? $detalle->RuidoContinuoResidual : '' }}">
        </div>
      </div>

      <div class="form-group row">
        <label for="altura_fuente" class="col-sm-2 col-form-label">Altura de la fuente (hs) (m)</label>
        <div class="col-sm-4">
          <input type="number" class="form-control" id="altura_fuente" name="altura_fuente" value="{{ isset($detalle) ? $detalle->AlturaFuente : '' }}">
        </div>
        <label for="altura_microfono" class="col-sm-2 col-form-label">Altura del micrófono (hr) (m)</label>
        <div class="col-sm-4">
          <input type="number" class="form-control" name="altura_microfono" id="altura_microfono" value="{{ isset($detalle) ? $detalle->AlturaMicrofono : '1.5' }}" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label for="distancia_fuente" class="col-sm-2 col-form-label">Distancia desde la fuente (D) (m)</label>
        <div class="col-sm-4">
          <input type="number" class="form-control" id="distancia_fuente" name="distancia_fuente" value="{{ isset($detalle) ? $detalle->DistanciaFuente : '' }}">
        </div>
        <label for="drhshr" class="col-sm-2 col-form-label">D/R curv (hs-hr)/(D) (Campo)</label>
        <div class="col-sm-4">
          <input type="number" class="form-control" name="drhshr" id="drhshr" value="{{ isset($detalle) ? $detalle->DRHsHr : '' }}" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label for="drideal" class="col-sm-2 col-form-label">D/R curv (Ideal) (>= 1)</label>
        <div class="col-sm-4">
          <input type="number" class="form-control" id="drideal" name="drideal" value="{{ isset($detalle) ? $detalle->DRIdeal : '0.1' }}" readonly>
        </div>
        <label for="ubicacion_microfono" class="col-sm-2 col-form-label">Ubicación del micrófono</label>
        <div class="col-sm-4">
          <select id="ubicacion_microfono" name="ubicacion_microfono" class="form-control select2bs4" style="width: 100%;">
              <option value="">Seleccione</option>
              @foreach ($ubicaciones as $ubicacion)
                  <option value="{{ $ubicacion['Nombre'] }}" data-valor="{{ $ubicacion['Valor'] }}" {{ isset($detalle) ? $ubicacion['Nombre'] == $detalle->UbicacionMicrofono ? 'selected' : '' : '' }} >{{ $ubicacion['Nombre'] }}</option>
              @endforeach
            </select>
        </div>
      </div>
      

    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-info">Guardar</button>
      <a href="{{ route('ruido.show', $cadena->Id) }}" class="btn btn-default float-right">Cancelar</a>
    </div>
    
{{ Form::close() }}

<span class="urlBuscarCotizacion d-none" data-url="{{ route('ruido.search.cotizacion.ajax') }}"></span>