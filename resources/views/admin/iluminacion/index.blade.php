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
          <h1>Iluminación</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Iluminación</li>
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
              <h3 class="card-title">Cadena de Custodia de Monitoreo de Iluminación</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{ route('iluminacion.create') }}" class="btn btn-primary">Registrar</a>
              <table id="tblCadenaCustodia" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N°</th>
                  <th>N° Cotización</th>
                  <th>N° Informe</th>
                  <th>Cliente</th>
                  <th>Estado</th>
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
                          <td class="{{ ($cadena->PrioridadAlta == 1 ? 'font-weight-bold' : '') }}">{{ $cadena->NumeroInforme }}</td>
                          <td>{{ $cadena->NombreCliente }}</td>
                          <td>
                            @switch($cadena->IdEstadoCadenaCustodia)
                                @case(1)
                                    <p class="text-warning">{{ $cadena->DescripcionEstadoCadena }}</p>
                                    @break
                                @case(2)
                                    <p class="text-primary">{{ $cadena->DescripcionEstadoCadena }}</p>
                                    @break
                                @case(3)
                                    <p class="text-secondary">{{ $cadena->DescripcionEstadoCadena }}</p>
                                    @break
                                @case(4)
                                    <p class="text-success">{{ $cadena->DescripcionEstadoCadena }}</p>
                                    @break
                                @case(5)
                                    <p class="text-secondary">{{ $cadena->DescripcionEstadoCadena }}</p>
                                    @break
                                @default
                            @endswitch
                          </td>
                          <td>{{ date("d-m-Y - H:i", strtotime($cadena->FechaCreacion))  }}</td>
                          <td> @include('admin.iluminacion.delete', ['cadena' => $cadena]) </td>
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

@endsection