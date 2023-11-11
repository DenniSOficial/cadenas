{{ Form::open(['url' => $url, 'method' => $method, 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
    {!! Form::token() !!}
    <div class="card-body">
      
      <div class="form-group row">
        <label for="id_rol" class="col-sm-2 col-form-label">Rol</label>
        <div class="col-sm-10">
          <select id="id_rol" name="id_rol" class="form-control select2bs4" style="width: 100%;">
            <option value="" selected>Seleccione Rol</option>
            @foreach ($roles as $rol)
              <option value="{{ $rol->IdRol }}"  {{ $rol->IdRol == $usuario->IdRol ? 'selected' : '' }}>{{ $rol->DescripcionRol }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label for="nombres" class="col-sm-2 col-form-label">Nombre Completo</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese nombre completo" value="{{ isset($usuario) ? $usuario->NombreCompleto : '' }}">
        </div>
      </div>

      <div class="form-group row">
        <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese usuario" value="{{ isset($usuario) ? $usuario->Usuario : '' }}" style="text-transform: uppercase;">
        </div>
      </div>

      <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="password" name="password" placeholder="Ingrese password" value="{{ isset($usuario) ? $usuario->Password : '' }}">
        </div>
      </div>

    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-info">Guardar</button>
      <a href="{{ route('ruido.index') }}" class="btn btn-default float-right">Cancelar</a>
    </div>
    
{{ Form::close() }}
