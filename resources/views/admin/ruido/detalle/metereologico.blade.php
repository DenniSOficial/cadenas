@extends('admin.layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">    
<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('content')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>N° Cotización {{ $medicion->NumeroCotizacion }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ruido.index') }}">Ruido</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ruido.show', $medicion->IdCadenaCustodiaRuido) }}">{{ $medicion->NumeroCotizacion }} </a></li>
            <li class="breadcrumb-item active">Metereológico</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Código cliente {{ $medicion->CodigoCliente }} / Periodo {{ $periodo}}</h3>
            </div>

            {{ Form::open(['url' => route('ruido.detalle.metereologico.store', $metereologico), 'method' => 'POST', 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
                {!! Form::token() !!}
                <div class="card-body">

                    <input type="hidden" class="form-control" name="id_cadena" id="id_cadena" value="{{ $medicion->IdCadenaCustodiaRuido }}">  
                    <input type="hidden" class="form-control" name="id_medicion" id="id_medicion" value="{{ $medicion->Id }}">
                    <input type="hidden" class="form-control" name="periodo" id="periodo" value="{{ $periodo }}">

                    <h5>Antes de la medición</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="inicio" class="col-sm-3 col-form-label">Inicio</label>
                        <div class="col-sm-2">
                            <input type="time" class="form-control" name="inicio" id="inicio" value="{{ isset($current_metereologico) ? $current_metereologico->Inicio : '' }}">
                        </div>
                        <label for="final" class="col-sm-3 col-form-label">Final</label>
                        <div class="col-sm-2">
                            <input type="time" class="form-control" name="final" id="final" value="{{ isset($current_metereologico) ? $current_metereologico->Final : '' }}">
                        </div>
                    </div>

                    <h5>Velocidad de viento (m/s)</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="velocidad_viento_antes" class="col-sm-3 col-form-label">Antes de medición</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="velocidad_viento_antes" id="velocidad_viento_antes" value="{{ isset($current_metereologico) ? $current_metereologico->VelocidadVientoAntesMedicion : '' }}">
                        </div>
                        <label for="velocidad_viento_durante" class="col-sm-3 col-form-label">Durante la medición</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="velocidad_viento_durante" id="velocidad_viento_durante" value="{{ isset($current_metereologico) ? $current_metereologico->VelocidadVientoDuranteMedicion : '' }}">
                        </div>
                    </div>

                    <h5>Dirección del viento</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="direccion_viento_antes" class="col-sm-3 col-form-label">Antes de medición</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="direccion_viento_antes" id="direccion_viento_antes" value="{{ isset($current_metereologico) ? $current_metereologico->DireccionVientoAntesMedicion : '' }}">
                        </div>
                        <label for="direccion_viento_durante" class="col-sm-3 col-form-label">Durante la medición</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="direccion_viento_durante" id="direccion_viento_durante" value="{{ isset($current_metereologico) ? $current_metereologico->DireccionVientoDuranteMedicion : '' }}">
                        </div>
                    </div>

                    <h5>Temperatura ambiental (°C)</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="temperatura_ambiental_antes" class="col-sm-3 col-form-label">Antes de medición</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="temperatura_ambiental_antes" id="temperatura_ambiental_antes" value="{{ isset($current_metereologico) ? $current_metereologico->TemperaturaAmbientalAntesMedicion : '' }}">
                        </div>
                        <label for="temperatura_ambiental_durante" class="col-sm-3 col-form-label">Durante la medición</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="temperatura_ambiental_durante" id="temperatura_ambiental_durante" value="{{ isset($current_metereologico) ? $current_metereologico->TemperaturaAmbientalDuranteMedicion : '' }}">
                        </div>
                    </div>

                    <h5>Presión atmosférica (mbar)</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="presion_atmosferica_antes" class="col-sm-3 col-form-label">Antes de medición</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="presion_atmosferica_antes" id="presion_atmosferica_antes" value="{{ isset($current_metereologico) ? $current_metereologico->PresionAtmosfericaAntesMedicion : '' }}">
                        </div>
                        <label for="presion_atmosferica_durante" class="col-sm-3 col-form-label">Durante la medición</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="presion_atmosferica_durante" id="presion_atmosferica_durante" value="{{ isset($current_metereologico) ? $current_metereologico->PresionAtmosfericaDuranteMedicion : '' }}">
                        </div>
                    </div>

                    <h5>Humedad relativa (%)</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="humedad_relativa_antes" class="col-sm-3 col-form-label">Antes de medición</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="humedad_relativa_antes" id="humedad_relativa_antes" value="{{ isset($current_metereologico) ? $current_metereologico->HumedadRelativaAntesMedicion : '' }}">
                        </div>
                        <label for="humedad_relativa_durante" class="col-sm-3 col-form-label">Durante la medición</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="humedad_relativa_durante" id="humedad_relativa_durante" value="{{ isset($current_metereologico) ? $current_metereologico->HumedadRelativaDuranteMedicion : '' }}">
                        </div>
                    </div>
                
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <a href="{{ route('ruido.show', $medicion->IdCadenaCustodiaRuido) }}" class="btn btn-default float-right">Cancelar</a>
                </div>
                
            {{ Form::close() }}

        </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('js')
    
  <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

  <script type = "text/javascript">

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    function escapeHtml(text) {
      var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
      };
       return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    function validateForm() {

      var velocidad_viento_antes = $('#velocidad_viento_antes').val();
      var velocidad_viento_durante = $('#velocidad_viento_durante').val();
      var direccion_viento_antes = $('#direccion_viento_antes').val();
      var direccion_viento_durante = $('#direccion_viento_durante').val();
      var temperatura_ambienta_antes = $('#temperatura_ambienta_antes').val();
      var temperatura_ambiental_durante = $('#temperatura_ambiental_durante').val();
      var presion_atmosferica_antes = $('#presion_atmosferica_antes').val();
      var presion_atmosferica_durante = $('#presion_atmosferica_durante').val();
      var humedad_relativa_antes = $('#humedad_relativa_antes').val();
      var humedad_relativa_durante = $('#humedad_relativa_durante').val();

      if (velocidad_viento_antes === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la velocidad del viento antes de la medición.'
        });
        return false;
      }

      if (velocidad_viento_durante === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la velocidad del viento durante de la medición.'
        });
        return false;
      }

      if (direccion_viento_antes === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la dirección del viento antes de la medición.'
        });
        return false;
      }

      if (direccion_viento_durante === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la dirección del viento antes de la medición.'
        });
        return false;
      }

      if (temperatura_ambienta_antes === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la velocidad del viento antes de la medición.'
        });
        return false;
      }

      if (temperatura_ambiental_durante === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la velocidad del viento antes de la medición.'
        });
        return false;
      }

      if (presion_atmosferica_antes === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la velocidad del viento antes de la medición.'
        });
        return false;
      }

      if (presion_atmosferica_durante === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la velocidad del viento antes de la medición.'
        });
        return false;
      }

      if (humedad_relativa_antes === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la velocidad del viento antes de la medición.'
        });
        return false;
      }

      if (humedad_relativa_durante === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la velocidad del viento antes de la medición.'
        });
        return false;
      }

      return true;

    }

  </script>
@endsection