{{ Form::open(['url' => $url, 'method' => $method, 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
    {!! Form::token() !!}
    <div class="card-body">
      
      <div class="form-group row">
          <label for="nro_cotizacion" class="col-sm-2 col-form-label">N° Cotización</label>
          <div class="input-group col-sm-4">
              <input type="text" class="form-control" id="nro_cotizacion" name="nro_cotizacion" placeholder="N° Cotización" oninput="this.value = this.value.toUpperCase()" value="{{ isset($cadena) ? $cadena->NumeroCotizacion : '' }}">
              <div class="input-group-prepend">
                <a id="searchCotizacion" class="btn btn-secondary"><i class="fas fa-search"></i></a>
              </div>
          </div>
          <label for="nro_informe" class="col-sm-2 col-form-label">N° Informe</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="nro_informe" name="nro_informe" placeholder="N° Informe" value="{{ isset($cadena) ? $cadena->NumeroInforme : '' }}">
        </div>
      </div>

      <div class="form-group row">
        <label for="cliente" class="col-sm-2 col-form-label">Cliente</label>
        <div class="col-sm-10">
          <input type="hidden" name="id_cliente" id="id_cliente" value="{{ isset($cadena) ? $cadena->IdCliente : '' }}">
          <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Cliente" value="{{ isset($cadena) ? $cadena->NombreCliente : '' }}" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label for="contacto" class="col-sm-2 col-form-label">Contacto</label>
        <div class="col-sm-10">
          <select id="id_contacto" name="id_contacto" class="form-control select2bs4" style="width: 100%;">
            <option value="" selected>Seleccione Contacto</option>
            @foreach ($contactos as $contacto)
              <option value="{{ $contacto->nIdContacto }}" data-nombre="{{ $contacto->Contacto }}" data-email="{{ $contacto->cEmail }}" data-telefono="{{ $contacto->ctelefono1 }}" {{ $contacto->nIdContacto == $cadena->IdContacto ? 'selected' : '' }}>{{ $contacto->Contacto }}</option>
            @endforeach
          </select>
          <input type="hidden" class="form-control" id="contacto" name="contacto" value="{{ isset($cadena) ? $cadena->ContactoCliente : '' }}">
        </div>
      </div>

      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="email" name="email" placeholder="Email cliente" value="{{ isset($cadena) ? $cadena->EmailCliente : '' }}">
        </div>
        <label for="telefono_cliente" class="col-sm-2 col-form-label">Telefono</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="telefono_cliente" id="telefono_cliente" placeholder="Telefono cliente" value="{{ isset($cadena) ? $cadena->TelefonoCliente : '' }}">
        </div>
      </div>

      <div class="form-group row">
        <label for="lugar" class="col-sm-2 col-form-label">Lugar</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Ingrese lugar" value="{{ isset($cadena) ? $cadena->Lugar : '' }}">
        </div>
      </div>

      <div class="form-group row">
        <label for="empresa" class="col-sm-2 col-form-label">Empresa</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Ingrese empresa" value="{{ isset($cadena) ? $cadena->Empresa : '' }}">
        </div>
      </div>

      <div class="form-group row">
        <label for="planta" class="col-sm-2 col-form-label">Planta</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="planta" name="planta" placeholder="Ingrese planta" value="{{ isset($cadena) ? $cadena->Planta : '' }}">
        </div>
      </div>

      <div class="form-group row">
        <label for="proyecto" class="col-sm-2 col-form-label">Proyecto</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="proyecto" name="proyecto" placeholder="Ingrese proyecto" value="{{ isset($cadena) ? $cadena->Proyecto : '' }}">
        </div>
      </div>

      <div class="form-group row">
        <div class="offset-sm-2 col-sm-4">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="muestreo_sag" name="muestreo_sag" {{ isset($cadena) && $cadena->MuestreadoSag == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="muestreo_sag">Muestreado por SAG</label>
          </div>
        </div>
        <div class="offset-sm-2 col-sm-4">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="muestreo_cliente" name="muestreo_cliente" {{ isset($cadena) && $cadena->MuestreadoCliente == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="muestreo_cliente">Muestreado por Cliente</label>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="observaciones" class="col-sm-2 col-form-label">Observaciones de Muestreo:</label>
        <div class="col-sm-10">
            <textarea name="observaciones" class="form-control" id="observaciones" cols="10" rows="5">{{ isset($cadena) ? $cadena->Observaciones : '' }}</textarea>
        </div>
      </div>

      <h5>Metodologías</h5>
      <hr>

      <div class="form-group row">
        <ul class="list-group">

          @foreach ($metodologias as $metodo)
            <li class="list-group-item">
              <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" id="metodo[{{ $metodo->Id }}]" name="metodo[{{ $metodo->Id }}]" type="checkbox" {{ in_array($metodo->Id, $mis_metodos) ? 'checked' : '' }}>
                  <label class="cursor-pointer d-block custom-control-label" for="metodo[{{ $metodo->Id }}]" style="font-weight: normal;">{{ $metodo->Descripcion }}</label>
              </div>
            </li>    
          @endforeach
          
        </ul>
      </div>
      
        <h5>Responsables</h5>
        <hr>
      
        <div class="form-group row">
          <label for="analista" class="col-sm-2 col-form-label">Analista:</label>
          <div class="col-sm-10">
              <select id="analista" name="analista" class="form-control select2bs4" style="width: 100%;">
                  <option value="">Seleccione</option>
                  @foreach ($analistas as $principal)
                      <option value="{{ $principal->Id }}" {{ isset($cadena) ? $cadena->Analista == $principal->Id ? 'selected' : '' : '' }} >{{ $principal->NombreCompleto . ' ' . $principal->ApellidoPaterno . ' ' . $principal->ApellidoMaterno }}</option>
                  @endforeach
                </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="supervisor" class="col-sm-2 col-form-label">Supervisor Campo:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="supervisor" name="supervisor" placeholder="Ingrese nombre del supervisor de campo" value="{{ isset($cadena) ? $cadena->SupervisorCampo : '' }}">
          </div>
        </div>

        <div class="form-group row">
          <label for="laboratorio" class="col-sm-2 col-form-label">Laboratorio:</label>
          <div class="col-sm-10">
              <select id="laboratorio" name="laboratorio" class="form-control select2bs4" style="width: 100%;">
                  <option value="">Seleccione</option>
                  @foreach ($laboratorios as $laboratorio)
                      <option value="{{ $laboratorio->Id }}" {{ isset($cadena) ? $laboratorio->Id == $cadena->Laboratorio ? 'selected' : '' : '' }} >{{ $laboratorio->Nombre . ' ' . $laboratorio->Apellidos }}</option>
                  @endforeach
                </select>
          </div>
        </div>

    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-info">Guardar</button>
      <a href="{{ route('agua.index') }}" class="btn btn-default float-right">Cancelar</a>
    </div>
    
{{ Form::close() }}

<span class="urlBuscarCotizacion d-none" data-url="{{ route('ruido.search.cotizacion.ajax') }}"></span>