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
                        <li class="breadcrumb-item"><a href="{{ route('iluminacion.index') }}">Iluminacion</a></li>
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
                            <a href="{{ route('iluminacion.detalle.create', $cadena->Id) }}" class="btn btn-primary"
                                style="margin-bottom: 1rem;">Agregar</a>
                            @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2)
                                <a href="{{ route('iluminacion.detalle.print.informe-valor', $cadena->Id) }}"
                                    target="_blank" class="btn btn-success"
                                    style="margin-bottom: 1rem; float:right;">Imprimir Informe</a>
                                <a href="{{ route('iluminacion.detalle.registro-medicion-print', $cadena->Id) }}"
                                        target="_blank" class="btn btn-success"
                                        style="margin-bottom: 1rem; margin-right: 1rem; float:right;">Imprimir Registro Digital de Medición</a>
                            @endif
                            <table id="tblCadenaCustodiaDetalle" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Cod. Cliente</th>
                                        <th>Iluminacion Interior</th>
                                        <th>Iluminacion Exterior</th>
                                        <th>Datos Muestreo</th>
                                        <th>Información Medicion</th>
                                        <th>Cod. Laboratorio</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nr = 1; ?>
                                    @if (isset($codigos))
                                        @foreach ($codigos as $codigo)
                                            <tr>
                                                <td style="vertical-align: middle;">{{ $nr }}</td>
                                                <td style="vertical-align: middle;">
                                                    {{ $codigo->CodigoCliente }}</td>
                                                <td> <center> <b>{{ ($codigo->IluminacionInterior == '1' ? 'SI' : 'NO') }}</b></center></td>
                                                <td> <center> <b>{{ ($codigo->IluminacionExterior == '1' ? 'SI' : 'NO') }}</b></center></td>
                                                <td style="vertical-align: middle;">
                                                    <center>
                                                        @if ($codigo->FlagCadenaCustodiaIluminacionDatosMuestreo == '0')
                                                            <a href="{{ route('iluminacion.detalle.muestreo', ['id' => $codigo->Id, 'muestreo' => $codigo->IdCadenaCustodiaIluminacionDatosMuestreo]) }}"
                                                                class="btn btn-warning btn-xs">Pendiente</a>
                                                        @else
                                                            <a href="{{ route('iluminacion.detalle.muestreo', ['id' => $codigo->Id, 'muestreo' => $codigo->IdCadenaCustodiaIluminacionDatosMuestreo]) }}"
                                                                class="btn btn-primary btn-xs">Completado</a>
                                                        @endif
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        @if ($codigo->TotalMedicion != '5')
                                                            <a href="{{ route('iluminacion.detalle.informacion-medicion', [ 'id' => $codigo->Id]) }}" class="btn btn-warning btn-xs">{{ $codigo->TotalMedicion }}</a>
                                                        @else
                                                            <a href="{{ route('iluminacion.detalle.informacion-medicion', [ 'id' => $codigo->Id]) }}" class="btn btn-primary btn-xs">{{ $codigo->TotalMedicion }}</a>    
                                                        @endif
                                                    </center>
                                                </td>
                                                <td>{{ $codigo->CodigoLaboratorio }}</td>
                                                <td style="vertical-align: middle;">
                                                    @include('admin.iluminacion.detalle.delete', [
                                                        'codigo' => $codigo,
                                                    ])
                                                </td>
                                            </tr>
                                            <?php $nr++; ?>
                                        @endforeach
                                    @endif
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

    {{--   <script type="text/javascript">

    $('.show_confirm').click(function(event) {

          var form =  $(this).closest("frmDeleteCadenaDetalle");
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
                $('form#frmDeleteCadenaDetalle').submit();
            }
          });
      });
      
  </script> --}}
@endsection
