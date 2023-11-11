@extends('admin.layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">    
@endsection

@section('content')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Nuevo Buffer</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Mantenimiento</a></li>
            <li class="breadcrumb-item active">Nuevo Buffer</li>
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
              <h3 class="card-title">Crear Buffer</h3>
            </div>
                @include('admin.mantenimiento.buffer.form', ['url' => 'admin/mantenimiento/buffer/store', 'method' => 'POST']) 
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('js')
    
  <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('js/mask.js') }}"></script>

  <script type = "text/javascript">

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    function limpiarControles() {
      $('#id_cliente').val('');
      $('#cliente').val('');
      $('#contacto').val('');
      $('#email').val('');
      $('#telefono_cliente').val('');
      $('#lugar').val('');
      $('#empresa').val('');
      $('#planta').val('');
      $('#proyecto').val('');
    }

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

      var desde = $('#desde').val();
      var vigencia = $("#vigencia").val();
      var material = $("#material").val();
      var marca = $("#marca").val();
      var lote = $("#lote").val();
      var valor_referencia = $("#valor_referencia").val();
      var rango_inicial = $("#rango_inicial").val();
      var rango_final = $("#rango_final").val();
      var tipo = $("#tipo").val();
      var parametro = $("#parametro").val();

      if (desde === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar el desde.'
        });
        return false;
      }

      if (vigencia === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe ingresar la vigencia.'
        });
        return false;
      }

      if (material === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe ingresar el material de referencia.'
        });
        return false;
      }

      if (marca === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe ingresar la marca.'
        });
        return false;
      }

      if (lote === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe ingresar el lote.'
        });
        return false;
      }

      if (valor_referencia === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe ingresar el valor de referencia.'
        });
        return false;
      }

      if (rango_inicial === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe ingresar el rango inicial.'
        });
        return false;
      }

      if (rango_final === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe ingresar el rango final.'
        });
        return false;
      }

      if (tipo === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe seleccionar el tipo.'
        });
        return false;
      }

      if (parametro === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe seleccionar el parametro.'
        });
        return false;
      }

      return true;

    }

  </script>
@endsection