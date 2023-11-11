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
          <h1>N° Cotización {{ $cadena->NumeroCotizacion }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('iluminacion.index') }}">Iluminacion</a></li>
            <li class="breadcrumb-item"><a href="{{ route('iluminacion.show', $cadena->Id) }}">{{ $cadena->NumeroCotizacion }} </a></li>
            <li class="breadcrumb-item active">Informacion de Medicion</li>
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
              <h3 class="card-title">Código cliente {{ $detalle->CodigoCliente }} </h3>
            </div>

            {{ Form::open(['url' => route('iluminacion.detalle.informacion-form.store'), 'method' => 'POST', 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
                {!! Form::token() !!}
                <div class="card-body">

                  <input type="hidden" class="form-control" name="id_cadena" id="id_cadena" value="{{ $cadena->Id }}">  
                  <input type="hidden" class="form-control" name="id_detalle" id="id_detalle" value="{{ $detalle->Id }}">
                  <input type="hidden" class="form-control" name="id_medicion" id="id_medicion" value="{{ $info }}">

                  <hr>

                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Fecha:</label>
                      <div class="col-sm-2">
                          <input type="date" class="form-control" name="fecha" id="fecha" value="{{ isset($current_informacion) ? $current_informacion->Fecha : '' }}">
                      </div>
                      <label class="col-sm-2 col-form-label">H. Inicio:</label>
                      <div class="col-sm-2">
                          <input type="time" class="form-control" name="hinicio" id="hinicio" value="{{ isset($current_informacion) ? substr($current_informacion->HoraInicio, 0, 5) : '' }}">
                      </div>
                      <label class="col-sm-2 col-form-label">H. Fin:</label>
                      <div class="col-sm-2">
                          <input type="time" class="form-control" name="hfin" id="hfin" value="{{ isset($current_informacion) ? substr($current_informacion->HoraFin,0 ,5) : '' }}">
                      </div>
                  </div>
                  
                  <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Nivel Max Lux</label>
                      <div class="col-sm-2">
                          <input type="number" class="form-control" name="max_lux" id="max_lux" value="{{ isset($current_informacion) ? $current_informacion->NivelMaxLux : '' }}">
                      </div>
                      <label class="col-sm-2 col-form-label">Nivel Min Lux</label>
                      <div class="col-sm-2">
                          <input type="number" class="form-control" name="min_lux" id="min_lux" value="{{ isset($current_informacion) ? $current_informacion->NivelMinLux : '' }}">
                      </div>
                      <label class="col-sm-2 col-form-label">Nivel Avg Lux</label>
                      <div class="col-sm-2">
                          <input type="number" class="form-control" name="avg_lux" id="avg_lux" value="{{ isset($current_informacion) ? $current_informacion->NivelAvgLux : '' }}">
                      </div>
                  </div>

                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <a href="{{ route('iluminacion.detalle.informacion-medicion', $detalle->Id) }}" class="btn btn-default float-right">Cancelar</a>
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

      var fecha = $('#fecha').val();
      var hinicio = $('#hinicio').val();
      var hfin = $('#hfin').val();
      var maxlux = $('#max_lux').val();
      var minlux = $('#min_lux').val();
      var avglux = $('#avg_lux').val();
      
      if (fecha === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la fecha.'
        });
        return false;
      }

      if (hinicio === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la Hora de inicio.'
        });
        return false;
      }

      if (hfin === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la hora de fin.'
        });
        return false;
      }

      if (maxlux === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar el valo maximo de Lux.'
        });
        return false;
      }

      if (minlux === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar el valor minimo de Lux.'
        });
        return false;
      }

      if (avglux === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar el valor promedio de Lux.'
        });
        return false;
      }

      return true;

    }


  </script>
@endsection