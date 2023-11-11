{{ Form::open(['url' => $url, 'method' => $method, 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();', 'files'=>'true' ]) }}
    {!! Form::token() !!}
    <div class="card-body">
      
      <div class="form-group row">
        <label for="documento" class="col-sm-2 col-form-label">DNI</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="documento" name="documento" placeholder="DNI" value="{{ isset($analista) ? $analista->Documento : '' }}" >
        </div>
      </div>

      <div class="form-group row">
        <label for="apaterno" class="col-sm-2 col-form-label">Ap. Paterno</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="apaterno" name="apaterno" placeholder="Apellido Paterno" value="{{ isset($analista) ? $analista->ApellidoPaterno : '' }}" >
        </div>
        <label for="amaterno" class="col-sm-2 col-form-label">Ap. Materno</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="amaterno" name="amaterno" placeholder="Apellido Materno" value="{{ isset($analista) ? $analista->ApellidoMaterno : '' }}" >
        </div>
      </div>

      <div class="form-group row">
        <label for="nombres" class="col-sm-2 col-form-label">Nombres</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" value="{{ isset($analista) ? $analista->NombreCompleto : '' }}" >
        </div>
      </div>

      @if (isset($analista))
        <div class="form-group row">
          <label for="firma" class="col-sm-2 col-form-label">Firma</label>
          <div class="col-sm-10">
              <input type="file" class="form-control" id="firma" name="firma" >
          </div>
        </div>    
      @endif
            
    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-info">Guardar</button>
      <a href="{{ route('mantenimiento.analista.index') }}" class="btn btn-default float-right">Cancelar</a>
    </div>
    
{{ Form::close() }}
