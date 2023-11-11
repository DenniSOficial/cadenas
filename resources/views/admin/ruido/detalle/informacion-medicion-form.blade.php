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

            {{ Form::open(['url' => route('ruido.detalle.informacion-form.store', $informacion), 'method' => 'POST', 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
                {!! Form::token() !!}
                <div class="card-body">

                  <input type="hidden" class="form-control" name="id_cadena" id="id_cadena" value="{{ $medicion->IdCadenaCustodiaRuido }}">  
                  <input type="hidden" class="form-control" name="id_medicion" id="id_detalle" value="{{ $medicion->Id }}">
                  <input type="hidden" class="form-control" name="periodo" id="id_detalle" value="{{ $periodo }}">
                  <input type="hidden" class="form-control" name="numero_muestra" id="numero_muestra" value="{{ isset($current_informacion) ? $current_informacion->NumeroMuestra : 'L' . $medicion->NumeroMuestra }}">

                  <h5>N° muestra: {{ isset($current_informacion) ? $current_informacion->NumeroMuestra : 'L' . $medicion->NumeroMuestra }}</h5>
                  <hr>

                  <div class="form-group row">
                      <label class="col-sm-3 col-form-label"></label>
                      <label class="col-sm-3 col-form-label text-center">LA Máx</label>
                      <label class="col-sm-3 col-form-label text-center">NLA Mín</label>
                      <label class="col-sm-3 col-form-label text-center">LA eq</label>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nivel de Ruido Total</label>
                      <div class="col-sm-3">
                          <input type="number" class="form-control" name="rtlamax" id="rtlamax" value="{{ isset($current_informacion) ? $current_informacion->RTLAMax : '' }}">
                      </div>
                      <div class="col-sm-3">
                          <input type="number" class="form-control" name="rtlamin" id="rtlamin" value="{{ isset($current_informacion) ? $current_informacion->RTLAMin : '' }}">
                      </div>
                      <div class="col-sm-3">
                          <input type="number" class="form-control" name="rtlaeq" id="rtlaeq" value="{{ isset($current_informacion) ? $current_informacion->RTLAEq : '' }}">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-3 col-form-label"></label>
                      <label class="col-sm-3 col-form-label text-center">L 50</label>
                      <label class="col-sm-3 col-form-label text-center">L 90</label>
                      <label class="col-sm-3 col-form-label text-center">L 95</label>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nivel percentil  LN,T</label>
                      <div class="col-sm-3">
                          <input type="number" class="form-control" name="npl50" id="npl50" value="{{ isset($current_informacion) ? $current_informacion->NPL50 : '' }}">
                      </div>
                      <div class="col-sm-3">
                          <input type="number" class="form-control" name="npl90" id="npl90" value="{{ isset($current_informacion) ? $current_informacion->NPL90 : '' }}">
                      </div>
                      <div class="col-sm-3">
                          <input type="number" class="form-control" name="npl95" id="npl95" value="{{ isset($current_informacion) ? $current_informacion->NPL95 : '' }}">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-3 col-form-label"></label>
                      <label class="col-sm-3 col-form-label text-center">LA eq (Res)</label>
                  </div>
                  <div class="form-group row">
                      <label for="rrlaeq" class="col-sm-3 col-form-label">Nivel del ruido residual</label>
                      <div class="col-sm-3">
                          <input type="number" class="form-control" name="rrlaeq" id="rrlaeq" value="{{ isset($current_informacion) ? $current_informacion->RRLAEq : '' }}">
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