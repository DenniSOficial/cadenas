{{ Form::open(['url' => $url, 'method' => $method, 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
    {!! Form::token() !!}
    <div class="card-body">
      
      <div class="form-group row">
        <label for="desde" class="col-sm-2 col-form-label">Desde</label>
        <div class="col-sm-4">
          <input type="text" placeholder="yyyy/mm" data-mask="9999/99" class="form-control" id="desde" name="desde"  value="{{ isset($buffer) ? substr($buffer->Desde, 0, 4) . '/' . substr($buffer->Desde, 4, 2)  : '' }}" >
        </div>

        <label for="vigencia" class="col-sm-2 col-form-label">Vigencia</label>
        <div class="col-sm-4">
          <input type="text" placeholder="yyyy/mm" data-mask="9999/99" class="form-control" id="vigencia" name="vigencia"  value="{{ isset($buffer) ? substr($buffer->Vigencia, 0, 4) . '/' . substr($buffer->Vigencia, 4, 2) : '' }}" >
        </div>

      </div>

      <div class="form-group row">
        <label for="material" class="col-sm-2 col-form-label">Material de referencia</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="material" name="material" placeholder="" value="{{ isset($buffer) ? $buffer->MaterialReferencia : '' }}" >
        </div>
      </div>

      <div class="form-group row">
        <label for="marca" class="col-sm-2 col-form-label">Marca</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="marca" name="marca" placeholder="" value="{{ isset($buffer) ? $buffer->Marca : '' }}" >
        </div>

        <label for="lote" class="col-sm-2 col-form-label">Lote</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="lote" name="lote" placeholder="" value="{{ isset($buffer) ? $buffer->Lote : '' }}" >
        </div>

      </div>

      <div class="form-group row">
        <label for="valor_referencia" class="col-sm-2 col-form-label">Valor de referencia: de pH</label>
        <div class="col-sm-2">
          <input type="text" class="form-control" id="valor_referencia" name="valor_referencia" placeholder="" value="{{ isset($buffer) ? $buffer->ValorReferenciapH : '' }}" >
        </div>

        <label for="rango_inicial" class="col-sm-2 col-form-label">Rango de aceptación inicial</label>
        <div class="col-sm-2">
          <input type="text" class="form-control" id="rango_inicial" name="rango_inicial" placeholder="" value="{{ isset($buffer) ? $buffer->RangoAceptacionInicial : '' }}" >
        </div>

        <label for="rango_final" class="col-sm-2 col-form-label">Rango de aceptación final</label>
        <div class="col-sm-2">
          <input type="text" class="form-control" id="rango_final" name="rango_final" placeholder="" value="{{ isset($buffer) ? $buffer->RangoAceptacionFinal : '' }}" >
        </div>
      </div>

      <div class="form-group row">

        <label for="contacto" class="col-sm-2 col-form-label">Tipo</label>
        <div class="col-sm-4">
          <select id="tipo" name="tipo" class="form-control select2bs4" style="width: 100%;">
            <option value="" selected>Seleccione Tipo</option>
            @isset($tipos)
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo['Valor'] }}" {{ isset($buffer) ? $tipo['Valor'] == $buffer->Tipo ? 'selected' : ''  : '' }}>{{ $tipo['Descripcion'] }}</option>
                @endforeach    
            @endisset
            
          </select>
        </div>

        <label for="contacto" class="col-sm-2 col-form-label">Parametro</label>
        <div class="col-sm-4">
          <select id="parametro" name="parametro" class="form-control select2bs4" style="width: 100%;">
            <option value="" selected>Seleccione Parametro</option>
            @isset($parametros)
                @foreach ($parametros as $parametro)
                    <option value="{{ $parametro['Valor'] }}" {{ isset($buffer) ? $parametro['Valor'] == $buffer->Parametro ? 'selected' : ''  : '' }}>{{ $parametro['Descripcion'] }}</option>
                @endforeach    
            @endisset
            
          </select>
        </div>

      </div>
     
    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-info">Guardar</button>
      <a href="{{ route('mantenimiento.buffer.index') }}" class="btn btn-default float-right">Cancelar</a>
    </div>
    
{{ Form::close() }}
