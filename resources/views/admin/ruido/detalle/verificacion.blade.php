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
            <li class="breadcrumb-item active">Verificación del equipo</li>
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

            {{ Form::open(['url' => route('ruido.detalle.verificacion.store', $verificacion), 'method' => 'POST', 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
                {!! Form::token() !!}
                <div class="card-body">

                    <input type="hidden" class="form-control" name="id_cadena" id="id_cadena" value="{{ $medicion->IdCadenaCustodiaRuido }}">  
                    <input type="hidden" class="form-control" name="id_medicion" id="id_detalle" value="{{ $medicion->Id }}">
                    <input type="hidden" class="form-control" name="periodo" id="periodo" value="{{ $periodo }}">

                    <h5>Verificación del equipo</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="verificacion_inicial" class="col-sm-3 col-form-label">Inicial</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="verificacion_inicial" id="verificacion_inicial" value="{{ isset($current_verificacion) ? $current_verificacion->Inicial : '' }}">
                        </div>
                        <label for="verificacion_final" class="col-sm-3 col-form-label">Final</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="verificacion_final" id="verificacion_final" value="{{ isset($current_verificacion) ? $current_verificacion->Final : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="valor_referencia" class="col-sm-3 col-form-label">Valor de Referencia dB</label>
                      <div class="col-sm-2">
                          <input type="text" class="form-control" name="valor_referencia" id="valor_referencia" value="{{ isset($current_verificacion) ? $current_verificacion->ValorReferencia : '' }}">
                      </div>
                      <label for="tolerancia" class="col-sm-3 col-form-label">Tolerancia dB</label>
                      <div class="col-sm-2">
                          <input type="text" class="form-control" name="tolerancia" id="tolerancia" value="{{ isset($current_verificacion) ? $current_verificacion->Tolerancia : '0.5' }}" >
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="estado" class="col-sm-3 col-form-label">Estado</label>
                      <div class="col-sm-2">
                          <input type="text" class="form-control" name="estado" id="estado" value="{{ isset($current_verificacion) ? $current_verificacion->Estado : '' }}" readonly>
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

      var verificacion_inicial = $('#verificacion_inicial').val();
      var verificacion_final = $('#verificacion_final').val();
      
      if (verificacion_inicial === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la verificación del equipo inicial.'
        });
        return false;
      }

      if (verificacion_final === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la verificación del equipo final.'
        });
        return false;
      }

      console.log('verificacion_inicial:::', parseFloat(verificacion_inicial));
      console.log('verificacion_final:::', parseFloat(verificacion_final));

      var diferencia = Math.abs(parseFloat(verificacion_inicial) - parseFloat(verificacion_final));
      console.log('diferencia:::', diferencia);

      if (parseFloat(diferencia) > parseFloat(0.5)) {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'La tolerancia no deve ser mayo a 0.5 dB, verifique.'
        });
        return false;
      }

      return true;

    }

    $('#verificacion_inicial').on('input', function() {
      
      var inicio;
      var final;
      var tolerancia;
      var estado;
      
      if ($('#verificacion_inicial').val() === '') {
        inicio = 0;
      } else {
        inicio = $('#verificacion_inicial').val();
      }

      if ($('#verificacion_final').val() === '') {
        final = 0;
      } else {
        final = $('#verificacion_final').val();
      }

      if ($('#tolerancia').val() === '') {
        tolerancia = 0;
      } else {
        tolerancia = $('#tolerancia').val();
      }
      
      console.log('inicio:::', inicio);
      console.log('final:::', final);
      console.log('tolerancia:::', tolerancia);

      if ((parseFloat(final) - parseFloat(inicio)) <= parseFloat(tolerancia)) {
        estado = 'CONFORME';
      } else {
        estado = 'NO CONFORME';
      }

      $('#estado').val(estado);

    });

    $('#verificacion_final').on('input', function() {
      
      var inicio;
      var final;
      var tolerancia;
      var estado;
      
      if ($('#verificacion_inicial').val() === '') {
        inicio = 0;
      } else {
        inicio = $('#verificacion_inicial').val();
      }

      if ($('#verificacion_final').val() === '') {
        final = 0;
      } else {
        final = $('#verificacion_final').val();
      }

      if ($('#tolerancia').val() === '') {
        tolerancia = 0;
      } else {
        tolerancia = $('#tolerancia').val();
      }
      
      console.log('inicio:::', inicio);
      console.log('final:::', final);
      console.log('tolerancia:::', tolerancia);

      if ((parseFloat(final) - parseFloat(inicio)) <= parseFloat(tolerancia)) {
        estado = 'CONFORME';
      } else {
        estado = 'NO CONFORME';
      }

      $('#estado').val(estado);
     
    });

    $('#tolerancia').on('input', function() {
      
      var inicio;
      var final;
      var tolerancia;
      var estado;
      
      if ($('#verificacion_inicial').val() === '') {
        inicio = 0;
      } else {
        inicio = $('#verificacion_inicial').val();
      }

      if ($('#verificacion_final').val() === '') {
        final = 0;
      } else {
        final = $('#verificacion_final').val();
      }

      if ($('#tolerancia').val() === '') {
        tolerancia = 0;
      } else {
        tolerancia = $('#tolerancia').val();
      }
      
      console.log('inicio:::', inicio);
      console.log('final:::', final);
      console.log('tolerancia:::', tolerancia);

      if ((parseFloat(final) - parseFloat(inicio)) <= parseFloat(tolerancia)) {
        estado = 'CONFORME';
      } else {
        estado = 'NO CONFORME';
      }

      $('#estado').val(estado);

    });

  </script>
@endsection