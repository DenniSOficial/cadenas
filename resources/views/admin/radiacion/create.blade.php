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
          <h1>Nueva Cadena</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Nueva cadena</li>
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
              <h3 class="card-title">Crear Cadena de Custodia</h3>
            </div>
            @include('admin.radiacion.form', ['url' => 'admin/radiacion/store', 'method' => 'POST'])
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('js')
    
  <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>

  <script type = "text/javascript">

$(".select2").select2();
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    $("#searchCotizacion").click(function(){
    
      var nro = $('#nro_cotizacion').val();
      console.log('nro:::', nro);

      if (nro === '') {
        //alert('Debe de ingresar el nro de cotizacion');
        Swal.fire({
          icon: 'error',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar el N° de cotización.',
        });
        return;
      }

      limpiarControles();

      var url_ = $('.urlBuscarCotizacion').data('url');
      console.log('url_:::', url_);
      var data_ = {
        nro: nro
      };
              
      $.ajax({
        url: url_,
        type: 'POST',
        headers: {'X-CSRF-Token': $("input[name=_token]").val()},
        dataType: 'json',
        data: data_,
        success: function(response) {
          console.log('response:::', response);
          if (response.message == 'Ok') {
            var cliente = response.data['cliente'];
            var contactos = response.data['contactos'];
            $('#id_cliente').val(cliente.nIdCliente);
            $('#cliente').val(cliente.cNombreClie);
            $("#id_contacto").empty().append("<option value=''> Seleccione Contacto </option>");
            contactos.forEach(element => {
              console.log('element:::', element);
              $("#id_contacto").append("<option value='" + element.nIdContacto + "' data-nombre='" + escapeHtml(element.Contacto) + "' data-email='" + element.cEmail + "' data-telefono='" + element.ctelefono1 + "' >" + element.Contacto + "</option>");
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Sistemas Análiticos Generales',
              text: response.message
            });
          }
        },
        error: function(err) {
          console.log('err:::', err);
        }
      });

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

      var cotizacion = $('#nro_cotizacion').val();
      var contacto = $("#id_contacto").val();
      var normativa = $("#normativa").val();

      if (cotizacion === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar una cotización.'
        });
        return false;
      }

      if (contacto === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe seleccionar una persona de contacto.'
        });
        return false;
      }

      if (normativa === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe seleccionar la normativa.'
        });
        return false;
      }

      return true;

    }

  </script>
@endsection