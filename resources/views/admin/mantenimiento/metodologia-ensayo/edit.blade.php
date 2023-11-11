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
          <h1>Editar Metodología de Ensayo</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Mantenimiento</a></li>
            <li class="breadcrumb-item active">Editar Metodología de Ensayo</li>
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
              <h3 class="card-title">Editar Metodología de Ensayo</h3>
            </div>
                @include('admin.mantenimiento.metodologia-ensayo.form', ['url' => 'admin/mantenimiento/metodologia-ensayo/update/' . $metodologia->Id, 'method' => 'POST']) 
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

    $('#id_contacto').on('change', function() {
      
      var id_contacto = $("#id_contacto").val();
      var nombre = $("option:selected", this).attr("data-nombre");
      var email = $("option:selected", this).attr("data-email");
      var telefono = $("option:selected", this).attr("data-telefono");
      
      $('#contacto').val(nombre);
      $('#email').val(email);
      $('#telefono_cliente').val(telefono);

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

      var ensayo = $('#ensayo').val();
      var metodologia = $("#metodologia").val();
      var unidad = $("#unidad").val();

      if (ensayo === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar el ensayo.'
        });
        return false;
      }

      if (metodologia === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe ingresar la metodología.'
        });
        return false;
      }

      if (unidad === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe seleccionar la unidad.'
        });
        return false;
      }

      return true;

    }

  </script>
@endsection