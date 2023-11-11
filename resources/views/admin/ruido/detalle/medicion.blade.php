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
          <h1>N° Cotización {{ $detalle->NumeroCotizacion }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ruido.index') }}">Ruido</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ruido.show', $detalle->IdCadenaCustodiaRuido) }}">{{ $detalle->NumeroCotizacion }} </a></li>
            <li class="breadcrumb-item active">Medición</li>
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
              <h3 class="card-title">Código cliente {{ $detalle->CodigoCliente }} / Periodo {{ $periodo}}</h3>
            </div>

            {{ Form::open(['url' => route('ruido.detalle.medicion.store', $medicion), 'method' => 'POST', 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
                {!! Form::token() !!}
                <div class="card-body">

                    <input type="hidden" class="form-control" name="id_cadena" id="id_cadena" value="{{ $detalle->IdCadenaCustodiaRuido }}">  
                    <input type="hidden" class="form-control" name="id_detalle" id="id_detalle" value="{{ $detalle->Id }}">
                    <input type="hidden" class="form-control" name="id_metereologicos" id="id_metereologicos" value="{{ isset($current_medicion) ? $current_medicion->IdCadenaCustodiaRuidoDatosMetereologicos : 0 }}">
                    <input type="hidden" class="form-control" name="id_verificacion" id="id_verificacion" value="{{ isset($current_medicion) ? $current_medicion->IdCadenaCustodiaRuidoVerificacionEquipo : 0 }}">
                    <input type="hidden" class="form-control" name="periodo" id="periodo" value="{{ $periodo }}">

                    <h5>Ruido total</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="rt_fecha" class="col-sm-2 col-form-label">Fecha</label>
                        <div class="input-group col-sm-2">
                            <input type="date" class="form-control" id="rt_fecha_1" name="rt_fecha_1" value="{{ isset($current_medicion) ? $current_medicion->RuidoTotalFecha : '' }}">
                        </div>
                        <div class="input-group col-sm-2">
                          <input type="date" class="form-control" id="rt_fecha_2" name="rt_fecha_2" value="{{ isset($current_medicion) ? $current_medicion->RuidoTotalFecha_2 : '' }}">
                        </div>
                        <label for="rt_inicio" class="col-sm-2 col-form-label">Hora inicio</label>
                        <div class="col-sm-1">
                            <input type="time" class="form-control" name="rt_inicio" id="rt_inicio" value="{{ isset($current_medicion) ? $current_medicion->RuidoTotalHInicio : '' }}">
                        </div>
                        <label for="rt_final" class="col-sm-2 col-form-label">Hora final</label>
                        <div class="col-sm-1">
                            <input type="time" class="form-control" name="rt_final" id="rt_final" value="{{ isset($current_medicion) ? $current_medicion->RuidoTotalHFinal : '' }}">
                        </div>
                    </div>

                    <h5>Ruido residual</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="rs_fecha" class="col-sm-2 col-form-label">Fecha</label>
                        <div class="input-group col-sm-2">
                            <input type="date" class="form-control" id="rs_fecha_1" name="rs_fecha_1" value="{{ isset($current_medicion) ? $current_medicion->RuidoResidualFecha : '' }}">
                        </div>
                        <div class="input-group col-sm-2">
                          <input type="date" class="form-control" id="rs_fecha_2" name="rs_fecha_2" value="{{ isset($current_medicion) ? $current_medicion->RuidoResidualFecha_2 : '' }}">
                        </div>
                        <label for="rs_inicio" class="col-sm-2 col-form-label">Hora inicio</label>
                        <div class="col-sm-1">
                            <input type="time" class="form-control" name="rs_inicio" id="rs_inicio" value="{{ isset($current_medicion) ? $current_medicion->RuidoResidualHInicio : '' }}">
                        </div>
                        <label for="rs_final" class="col-sm-2 col-form-label">Hora final</label>
                        <div class="col-sm-1">
                            <input type="time" class="form-control" name="rs_final" id="rs_final" value="{{ isset($current_medicion) ? $current_medicion->RuidoResidualHFinal : '' }}">
                        </div>
                    </div>

                    <h5>Descripción detallada del lugar de medición, que incluya la cubierta y condición del suelo, y las  ubicaciones, incluyendo la altura por encima del suelo y de la fuente </h5>
                    <hr>
                    <div class="form-group row">
                      <div class="input-group col-sm-12">
                          <textarea name="descripcion_lugar" class="form-control" id="descripcion_lugar" cols="10" rows="5" onkeyup="saltolineaDescripcionLugar(event);">{{ isset($current_medicion) ? $current_medicion->DescripcionLugarMedicion : '' }}</textarea>
                      </div>
                    </div>

                    <h5>Descripción de las condiciones de operación: </h5>
                    <hr>
                    <div class="form-group row">
                      <div class="input-group col-sm-12">
                          <textarea name="descripcion_condiciones" class="form-control" id="descripcion_condiciones" cols="10" rows="5" onkeyup="saltolineaDescripcionCondiciones(event);">{{ isset($current_medicion) ? $current_medicion->DescripcionCondiciones : '' }}</textarea>
                      </div>
                    </div>
                
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <a href="{{ route('ruido.show', $detalle->IdCadenaCustodiaRuido) }}" class="btn btn-default float-right">Cancelar</a>
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

      var rt_fecha = $('#rt_fecha').val();
      var rt_inicio = $('#rt_inicio').val();
      var rt_final = $('#rt_final').val();
      var rs_fecha = $('#rs_fecha').val();
      var rs_inicio = $('#rs_inicio').val();
      var rs_final = $('#rs_final').val();

      if (rt_fecha === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la fecha de ruido total.'
        });
        return false;
      }

      if (rt_inicio === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la hora de inicio de ruido total.'
        });
        return false;
      }

      if (rt_final === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la hora final de ruido total.'
        });
        return false;
      }

      if (rs_fecha === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la fecha de ruido total.'
        });
        return false;
      }

      if (rs_inicio === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la hora de inicio de ruido total.'
        });
        return false;
      }

      if (rs_final === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la hora final de ruido total.'
        });
        return false;
      }

      return true;

    }

    var letras=0;

    function saltolineaDescripcionLugar(e) {	   
      tecla = (document.all) ? e.keyCode : e.which;
      if(tecla==13){
        document.getElementById("descripcion_lugar").value+='\n';
      }
      return true;
    }

    function saltolineaDescripcionCondiciones(e) {	      
      tecla = (document.all) ? e.keyCode : e.which;
      if(tecla==13){
        document.getElementById("descripcion_condiciones").value+='\n';
      }
      return true;
    }

  </script>
@endsection