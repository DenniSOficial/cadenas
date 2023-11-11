{{ Form::open(['url' => $url, 'method' => $method, 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
    {!! Form::token() !!}
    <div class="card-body">
      
      <div class="form-group row">
        <label for="ensayo" class="col-sm-2 col-form-label">Ensayo</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="ensayo" name="ensayo" placeholder="Ensayo" value="{{ isset($metodologia) ? $metodologia->Ensayo : '' }}" >
        </div>
      </div>

      <div class="form-group row">
        <label for="metodologia" class="col-sm-2 col-form-label">Metodología</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="metodologia" id="metodologia" cols="10" rows="5">{{ isset($metodologia) ? $metodologia->Metodo : '' }}</textarea>
        </div>
      </div>

      <div class="form-group row">
        <label for="contacto" class="col-sm-2 col-form-label">Unidades</label>
        <div class="col-sm-10">
          <select id="unidad" name="unidad" class="form-control select2bs4" style="width: 100%;">
            <option value="" selected>Seleccione Unidad</option>
            @foreach ($unidades as $unidad)
              <option value="{{ $unidad->coduni }}" {{ isset($metodologia) ? $unidad->coduni == $metodologia->IdUnidad ? 'selected' : ''  : '' }}>{{ $unidad->abruni }}</option>
            @endforeach
          </select>
        </div>
      </div>
     

    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-info">Guardar</button>
      <a href="{{ route('mantenimiento.metodologia-ensayo.index') }}" class="btn btn-default float-right">Cancelar</a>
    </div>
    
{{ Form::close() }}
