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
          <h1>Verificación Operacional de Equipos</h1>
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
                <a href="{{ route('agua.verificacion-operacional.print', $cadena->Id) }}" target="_blank" class="btn btn-success" style="margin-bottom: 1rem; float:right;">Imprimir Informe</a>
              <table id="tblCadenaCustodiaDetalle" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Potenciómetro</th>
                  <th>Conductímetro</th>
                  <th>Oxímetro</th>
                  <th>Medidor de Cloro</th>
                  <th>Turbiedad</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <center>
                                @if ($verificacion->FlagPotenciometro == 0)
                                    <a href="{{ route('agua.verificacion-operacional.form', [$cadena->Id, 'Potenciometro']) }}" class="btn btn-primary btn-sm" title="Editar"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                @else
                                    <a href="{{ route('agua.verificacion-operacional.form', [$cadena->Id, 'Potenciometro']) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                @endif
                            </center>
                        </td>
                        <td>
                            <center>
                              @if ($verificacion->FlagConductimetro == 0)
                                <a href="{{ route('agua.verificacion-operacional.form', [$cadena->Id, 'Conductimetro']) }}" class="btn btn-primary btn-sm" title="Editar"><i class="fa fa-plus" aria-hidden="true"></i></a>
                              @else
                                  <a href="{{ route('agua.verificacion-operacional.form', [$cadena->Id, 'Conductimetro']) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                              @endif
                            </center>
                        </td>
                        <td>
                            <center>
                              @if ($verificacion->FlagOximetro == 0)
                                <a href="{{ route('agua.verificacion-operacional.form', [$cadena->Id, 'Oximetro']) }}" class="btn btn-primary btn-sm" title="Editar"><i class="fa fa-plus" aria-hidden="true"></i></a>
                              @else
                                  <a href="{{ route('agua.verificacion-operacional.form', [$cadena->Id, 'Oximetro']) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                              @endif
                            </center>
                        </td>
                        <td>
                            <center>
                              @if ($verificacion->FlagMedidorCloro == 0)
                                <a href="{{ route('agua.verificacion-operacional.form', [$cadena->Id, 'MedidorCloro']) }}" class="btn btn-primary btn-sm" title="Editar"><i class="fa fa-plus" aria-hidden="true"></i></a>
                              @else
                                  <a href="{{ route('agua.verificacion-operacional.form', [$cadena->Id, 'MedidorCloro']) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                              @endif
                            </center>
                        </td>
                        <td>
                            <center>
                              @if ($verificacion->FlagTurbiedad == 0)
                                <a href="{{ route('agua.verificacion-operacional.form', [$cadena->Id, 'Turbiedad']) }}" class="btn btn-primary btn-sm" title="Editar"><i class="fa fa-plus" aria-hidden="true"></i></a>
                              @else
                                  <a href="{{ route('agua.verificacion-operacional.form', [$cadena->Id, 'Turbiedad']) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a>
                              @endif
                            </center>
                        </td>
                    </tr>       
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