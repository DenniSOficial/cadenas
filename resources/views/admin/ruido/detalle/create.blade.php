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
            <li class="breadcrumb-item"><a href="{{ route('ruido.index') }}">Ruido</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ruido.show', $cadena->Id) }}">{{ $cadena->NumeroCotizacion }} </a></li>
            <li class="breadcrumb-item active">Agregar cliente</li>
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
              <h3 class="card-title">Agregar cliente</h3>
            </div>
            @include('admin.ruido.detalle.form', ['url' => 'admin/ruido/detalle/' . $cadena->Id . '/store', 'method' => 'POST'])
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

      var cod_cliente = $('#codigo_cliente').val();
      var diurno = $("#flag_diurno").is(":checked");
      var nocturno = $("#flag_nocturno").is(":checked");
              
      if (cod_cliente === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar el código de cliente.'
        });
        return false;
      }

      if (diurno === false && nocturno === false) {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe seleccionar al menos un periodo.'
        });
        return false;
      }

      return true;

    }

    $('#altura_fuente').on('input', function() {
      
      var hs;
      var hr;
      var D;
      var DR;
      
      if ($('#altura_fuente').val() === '') {
        hs = 0;
      } else {
        hs = $('#altura_fuente').val();
      }

      if ($('#altura_microfono').val() === '') {
        hr = 0;
      } else {
        hr = $('#altura_microfono').val();
      }

      if ($('#distancia_fuente').val() === '') {
        D = 0;
      } else {
        D = $('#distancia_fuente').val();
      }

      DR = (hs - hr) / D;
      
      if ($.isNumeric(DR)) {
        $('#drhshr').val(round(DR, 1));
      } else {
        $('#drhshr').val(0);
      }

    });

    $('#altura_microfono').on('input', function() {
      
      var hs;
      var hr;
      var D;
      var DR;
      
      if ($('#altura_fuente').val() === '') {
        hs = 0;
      } else {
        hs = $('#altura_fuente').val();
      }

      if ($('#altura_microfono').val() === '') {
        hr = 0;
      } else {
        hr = $('#altura_microfono').val();
      }

      if ($('#distancia_fuente').val() === '') {
        D = 0;
      } else {
        D = $('#distancia_fuente').val();
      }

      DR = (hs - hr) / D;
      
      if ($.isNumeric(DR)) {
        $('#drhshr').val(round(DR, 1));
      } else {
        $('#drhshr').val(0);
      }

    });

    $('#distancia_fuente').on('input', function() {
      
      var hs;
      var hr;
      var D;
      var DR;
      
      if ($('#altura_fuente').val() === '') {
        hs = 0;
      } else {
        hs = $('#altura_fuente').val();
      }

      if ($('#altura_microfono').val() === '') {
        hr = 0;
      } else {
        hr = $('#altura_microfono').val();
      }

      if ($('#distancia_fuente').val() === '') {
        D = 0;
      } else {
        D = $('#distancia_fuente').val();
      }

      DR = (hs - hr) / D;
      
      if ($.isNumeric(DR)) {
        $('#drhshr').val(round(DR, 1));
      } else {
        $('#drhshr').val(0);
      }

    });

    $('#ubicacion_microfono').on('change', function() {
      
      //var id_contacto = $("#id_contacto").val();
      var valor = $("option:selected", this).attr("data-valor");
      console.log('valor:::', valor)
      $('#ubicacion_microfono_valor').val(valor);
      
    });

    function round(value, precision) {
      var multiplier = Math.pow(10, precision || 0);
      return Math.round(value * multiplier) / multiplier;
    }

  </script>
@endsection