{{ Form::open(['url' => $url, 'method' => $method, 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
    {!! Form::token() !!}
    <div class="card-body">
        <input type="hidden" class="form-control" name="id_cadena" id="id_cadena" value="{{ $cadena->Id }}">
        
      <div class="form-group row">
          <label for="codigo_cliente" class="col-sm-2 col-form-label">Cod. punto</label>
          <div class="input-group col-sm-4">
              <input type="text" class="form-control" id="codigo_cliente" name="codigo_cliente" placeholder="Código punto" oninput="this.value = this.value.toUpperCase()" value="{{ isset($detalle) ? $detalle->CodigoCliente : '' }}">
          </div>
      </div>

      <div class="form-group row">
          <label for="fecha" class="col-sm-2 col-form-label">Fecha Muestreo</label>
          <div class="input-group col-sm-4">
              <input type="date" class="form-control" id="fecha" name="fecha" value="{{ isset($detalle) ? $detalle->Fecha : '' }}">
          </div>
          <label for="hora" class="col-sm-2 col-form-label">Hora Muestreo</label>
          <div class="input-group col-sm-4">
              <input type="time" class="form-control" id="hora" name="hora" value="{{ isset($detalle) ? substr($detalle->Hora, 0, 5) : '' }}">
          </div>
      </div>

      <div class="form-group row">
        <label for="tipo_matriz" class="col-sm-2 col-form-label">Tipo de Matriz</label>
        <div class="input-group col-sm-4">
            <input type="text" class="form-control" id="tipo_matriz" name="tipo_matriz" value="{{ isset($detalle) ? $detalle->TipoMatriz : 'Agua Superficial' }}">
        </div>
      </div>

      <h5>Coordenadas</h5>
      <hr>
      <div class="form-group row">
        <label for="este" class="col-sm-2 col-form-label">Este</label>
        <div class="input-group col-sm-2">
            <input type="text" class="form-control" data-inputmask="'mask': ['9 999 999']" data-mask="" id="este" name="este" value="{{ isset($detalle) ? $detalle->Este : '' }}">
        </div>

        <label for="Norte" class="col-sm-2 col-form-label">Norte</label>
        <div class="input-group col-sm-2">
            <input type="text" class="form-control" data-inputmask="'mask': ['9 999 999']" data-mask="" id="Norte" name="norte" value="{{ isset($detalle) ? $detalle->Norte : '' }}">
        </div>

        <label for="altitud" class="col-sm-2 col-form-label">Altitud</label>
        <div class="input-group col-sm-2">
            <input type="text" class="form-control" id="altitud" name="altitud" value="{{ isset($detalle) ? $detalle->Altitud : '' }}">
        </div>
      </div>

      <div class="form-group row">
        <label for="descripcion_punto" class="col-sm-2 col-form-label">Descripción del punto</label>
        <textarea class="form-control col-sm-10" name="descripcion_punto" id="descripcion_punto" cols="30" rows="3">{{ isset($detalle) ? $detalle->DescripcionPunto : '' }}</textarea>
      </div>

      <h5>Parámetros In Situ</h5>
      <hr>
  
      @foreach ($parametros as $parametro)
        @php
            $found_key = array_search($parametro->Id, array_column($mis_parametros, 'IdParametroInSitu'));
            
        @endphp
        <div class="form-group row">
          <div class="custom-control col-sm-12 form-control-lg custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="parametro[{{ $parametro->Id }}]" name="parametro[{{ $parametro->Id }}]" {{ isset($detalle) ?  (count($mis_parametros) > 0 ? ($mis_parametros[$found_key]->Flag == '1' ? 'checked' : '' ) : '')     : '' }}>
            <label class="custom-control-label" for="parametro[{{ $parametro->Id }}]">{{ $parametro->DescripcionParametro }}</label>
          </div>
          <label for="lectura[{{ $parametro->Id }}]" class="col-sm-2 col-form-label">Lectura</label>
          <div class="input-group col-sm-4">
              <input type="text" class="form-control" id="lectura[{{ $parametro->Id }}]" name="lectura[{{ $parametro->Id }}]" placeholder="Lectura" value="{{ isset($detalle) ? (count($mis_parametros) > 0 ? $mis_parametros[$found_key]->Lectura : '')   : '' }}">
          </div>
          <label for="duplicado[{{ $parametro->Id }}]" class="col-sm-2 col-form-label">Duplicado</label>
          <div class="input-group col-sm-4">
              <input type="text" class="form-control" id="duplicado[{{ $parametro->Id }}]" name="duplicado[{{ $parametro->Id }}]" placeholder="Duplicado" value="{{ isset($detalle) ? (count($mis_parametros) > 0 ? $mis_parametros[$found_key]->Duplicado : '')  : '' }}">
          </div>
        </div>
      @endforeach

      <h5 class="m-t-20">Análisis de Laboratorio</h5>
      <hr>
      <div class="form-group row">
        <select class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Selecciona" name="analisis[]">
          @foreach ($analisis as $analisi)
              @php
                $found_key = array_search($analisi->Id, array_column($mis_analisis, 'IdAnalisisLaboratorio'));
                //dd($found_key);
              @endphp
              <option value="{{ $analisi->Id }}" {{ $analisi->Id == $mis_analisis[$found_key]->IdAnalisisLaboratorio ? 'selected' : '' }}>{{ $analisi->DescripcionAnalisis }}</option>
          @endforeach
        </select>
      </div>

    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-info">Guardar</button>
      <a href="{{ route('agua.show', $cadena->Id) }}" class="btn btn-default float-right">Cancelar</a>
    </div>
    
{{ Form::close() }}

<span class="urlBuscarCotizacion d-none" data-url="{{ route('ruido.search.cotizacion.ajax') }}"></span>