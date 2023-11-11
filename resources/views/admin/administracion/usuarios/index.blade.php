@extends('admin.layout.app')

@section('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Ruido</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Administración</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Cadena de Custodia de Monitoreo de Ruido</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{ route('administracion.usuario.create') }}" class="btn btn-primary">Registrar</a>
              <table id="tblCadenaCustodia" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N°</th>
                  <th>USUARIO</th>
                  <th>ROL</th>
                  <th>NOMBRE COMPLETO</th>
                  <th>PASSWORD</th>
                  <th>ESTADO</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php $nr = 1; ?>
                  @foreach ($usuarios as $usuario)
                      <tr>
                          <td>{{ $nr }}</td>
                          <td>{{ $usuario->Usuario }}</td>
                          <td>{{ $usuario->rol->DescripcionRol }}</td>
                          <td>{{ $usuario->NombreCompleto }}</td>
                          <td>{{ $usuario->Password }}</td>
                          <td>
                            @switch($usuario->IdEstado)
                                @case(1)
                                    Activo
                                    @break
                                @case(2)
                                    Desactivo
                                    @break
                                @default
                                    
                            @endswitch
                          </td>
                          <td> @include('admin.administracion.usuarios.delete', ['usuario' => $usuario]) </td>
                      </tr>
                      <?php $nr++; ?>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('js')
    
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
{{-- <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> --}}
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>


<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>

<script>

    $(function () {
      $("#tblCadenaCustodia").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
      });
     
    });


  </script>

  <script type="text/javascript">

    $('.show_confirm').click(function(event) {

          var form =  $(this).closest("frmDeleteCadena");
          console.log('form:::', form);
          event.preventDefault();

          Swal.fire({
            title: 'Sistemas Análiticos Generales',
            text: "¿Está seguro de eliminar la cadena?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, elimínalo!'
          }).then((result) => {
            console.log('result:::', result);
            if (result.isConfirmed) {
                $('form#frmDeleteUsuario').submit();
            }
          });
      });
      
  </script>

@endsection