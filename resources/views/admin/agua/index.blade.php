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
          <h1>Aguas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Agua</li>
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
              <h3 class="card-title">Cadena de Custodia de Monitoreo de Aguas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{ route('agua.create') }}" class="btn btn-primary">Registrar</a>
              <table id="tblCadenaCustodia" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N°</th>
                  <th>N° Cotización</th>
                  <th>N° Informe</th>
                  <th>Cliente</th>
                  <th>Fecha creación</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php $nr = 1; ?>
                  @foreach ($cadenas as $cadena)
                      <tr>
                          <td>{{ $nr }}</td>
                          <td>{{ $cadena->NumeroCotizacion }}</td>
                          <td>{{ $cadena->NumeroInforme }}</td>
                          <td>{{ $cadena->NombreCliente }}</td>
                          <td>{{ date("d-m-Y - H:i", strtotime($cadena->FechaCreacion))  }}</td>
                          <td> @include('admin.agua.delete', ['cadena' => $cadena]) </td>
                      </tr>
                      <?php $nr++; ?>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
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

  {{-- <script type="text/javascript">

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
                $('form#frmDeleteCadena').submit();
            }
          });
      });
      
  </script> --}}

@endsection