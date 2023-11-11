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
          <h1>Detalle Cadena Custodia</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('agua.index') }}">Agua</a></li>
            <li class="breadcrumb-item active">Detalle</li>
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
              <h3 class="card-title">N° Cotización {{ $cadena->NumeroCotizacion }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{ route('agua.detalle.create', $cadena->Id) }}" class="btn btn-primary" style="margin-bottom: 1rem;">Agregar</a>
                <a href="{{ route('agua.detalle.print-registro-campo', $cadena->Id) }}" target="_blank" class="btn btn-success" style="margin-bottom: 1rem; float:right;">Imprimir Registro de Campo</a>
              <table id="tblCadenaCustodiaDetalle" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N°</th>
                  <th>Cod. Cliente</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Tipo Matriz</th>
                  <th>Cod. Laboratorio</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php $nr = 1; ?>
                  @foreach ($codigos as $codigo)
                      <tr>
                          <td style="vertical-align: middle;">{{ $nr }}</td>
                          <td style="vertical-align: middle;">{{ $codigo->CodigoCliente }}</td>
                          <td style="vertical-align: middle;">{{ $codigo->Fecha }}</td>
                          <td style="vertical-align: middle;">{{ substr($codigo->Hora, 0, 5) }}</td>
                          <td style="vertical-align: middle;">{{ $codigo->TipoMatriz }}</td>
                          <td style="vertical-align: middle;">{{ $codigo->CodigoLaboratorio }}</td>
                          <td style="vertical-align: middle;"> 
                            @include('admin.agua.detalle.delete', ['codigo' => $codigo]) 
                          </td>
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

@endsection