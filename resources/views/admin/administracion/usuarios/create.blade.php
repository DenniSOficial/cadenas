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
          <h1>Nuevo Usuario</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Administración</a></li>
            <li class="breadcrumb-item"><a href="{{ route('administracion.usuario.index') }}">Usuarios</a></li>
            <li class="breadcrumb-item active">Nueva Usuario</li>
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
              <h3 class="card-title">Crear Nuevo Usuario</h3>
            </div>
            @include('admin.administracion.usuarios.form', ['url' => 'admin/administracion/usuario/store', 'method' => 'POST'])
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

      var rol = $('#id_rol').val();
      var nombres = $("#nombres").val();
      var usuario = $("#usuario").val();
      var clave = $("#password").val();

      console.log('rol:::', rol);
      console.log('nombres:::', nombres);
      console.log('usuario:::', usuario);
      console.log('clave:::', clave);

      if (rol === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de seleccionar un rol.'
        });
        return false;
      }

      if (nombres === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe ingresar un nombre completo del usuario.'
        });
        return false;
      }

      if (usuario === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe ingresar el nombre de usuario.'
        });
        return false;
      }

      if (clave === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe ingresar el password del usuario.'
        });
        return false;
      }

      return true;

    }

  </script>
@endsection