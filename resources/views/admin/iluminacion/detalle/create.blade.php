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
            <li class="breadcrumb-item"><a href="{{ route('iluminacion.index') }}">Ruido</a></li>
            <li class="breadcrumb-item"><a href="{{ route('iluminacion.show', $cadena->Id) }}">{{ $cadena->NumeroCotizacion }} </a></li>
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
            @include('admin.iluminacion.detalle.form', ['url' => 'admin/iluminacion/detalle/' . $cadena->Id . '/store', 'method' => 'POST'])
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
        var interior = $("#iluminacion_interior").is(":checked");
        var exterior = $("#iluminacion_exterior").is(":checked");
        var finicio_muestreo = $('#finicio_muestreo').val();
        var hinicio_muestreo = $('#hinicio_muestreo').val();
        var ffin_muestreo = $('#ffin_muestreo').val();
        var hfin_muestreo = $('#hfin_muestreo').val();

        if (cod_cliente === '') {
            Swal.fire({
            icon: 'warning',
            title: 'Sistemas Análiticos Generales',
            text: 'Debe de ingresar el código de cliente.'
            });
            return false;
        }

        if (interior === false && exterior === false) {
            Swal.fire({
            icon: 'warning',
            title: 'Sistemas Análiticos Generales',
            text: 'Debe seleccionar al menos una iluminacion.'
            });
            return false;
        }

        if (finicio_muestreo === '') {
            Swal.fire({
            icon: 'warning',
            title: 'Sistemas Análiticos Generales',
            text: 'Debe de ingresar el código de cliente.'
            });
            return false;
        }

        if (hinicio_muestreo === '') {
            Swal.fire({
            icon: 'warning',
            title: 'Sistemas Análiticos Generales',
            text: 'Debe de ingresar el código de cliente.'
            });
            return false;
        }

        if (ffin_muestreo === '') {
            Swal.fire({
            icon: 'warning',
            title: 'Sistemas Análiticos Generales',
            text: 'Debe de ingresar el código de cliente.'
            });
            return false;
        }

        if (hfin_muestreo === '') {
            Swal.fire({
            icon: 'warning',
            title: 'Sistemas Análiticos Generales',
            text: 'Debe de ingresar el código de cliente.'
            });
            return false;
        }

        return true;

    }

  </script>
@endsection