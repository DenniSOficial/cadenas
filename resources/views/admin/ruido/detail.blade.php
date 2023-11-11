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
            <li class="breadcrumb-item"><a href="{{ route('ruido.index', $cadena->Id) }}">Ruido</a></li>
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
                <a href="{{ route('ruido.detalle.create', $cadena->Id) }}" class="btn btn-primary" style="margin-bottom: 1rem;">Agregar</a>
                @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2)
                <a href="{{ route('ruido.detalle.print.informe-valor', $cadena->Id) }}" target="_blank" class="btn btn-success" style="margin-bottom: 1rem; float:right;">Imprimir Informe</a>
                @endif
              <table id="tblCadenaCustodiaDetalle" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N°</th>
                  <th>Cod. Cliente</th>
                  <th>Periodo</th>
                  <th>Datos Medición</th>
                  <th>Datos Muestreo</th>
                  <th>Datos Cond. Metereológicas</th>
                  <th>Verificación Equipo</th>
                  <th>Información Medicion</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php $nr = 1; ?>
                  @foreach ($codigos as $codigo)
                      <tr>
                          <td rowspan="2" style="vertical-align: middle;">{{ $nr }}</td>
                          <td rowspan="2" style="vertical-align: middle;">{{ $codigo->CodigoCliente }}</td>
                          <td><b>Diurno</b></td>
                          @if ($codigo->FlagCadenaCustodiaRuidoDatosMedicionDiurno == '0')
                            <td> <center>-</center> </td>
                            <td rowspan="2" style="vertical-align: middle;">
                              <center>
                              @if($codigo->FlagCadenaCustodiaRuidoDatosMuestreo == '0')
                                <a href="{{ route('ruido.detalle.muestreo', ['id' => $codigo->Id, 'muestreo' => $codigo->IdCadenaCustodiaRuidoDatosMuestreo]) }}" class="btn btn-warning btn-xs">Pendiente</a>
                              @else
                                <a href="{{ route('ruido.detalle.muestreo', ['id' => $codigo->Id, 'muestreo' => $codigo->IdCadenaCustodiaRuidoDatosMuestreo]) }}" class="btn btn-primary btn-xs">Completado</a>
                              @endif
                              </center>
                            </td>
                            <td> <center>-</center> </td>
                            <td> <center>-</center> </td>
                            <td> <center>-</center> </td>
                          @else
                            <td>
                              <center>
                              @if ($codigo->IdCadenaCustodiaRuidoDatosMedicionDiurno == '0')
                                <a href="{{ route('ruido.detalle.medicion', [ 'id' => $codigo->Id, 'medicion' => $codigo->IdCadenaCustodiaRuidoDatosMedicionDiurno, 'periodo' => 'Diurno']) }}" class="btn btn-warning btn-xs">Pendiente</a>
                              @else
                                <a href="{{ route('ruido.detalle.medicion', [ 'id' => $codigo->Id, 'medicion' => $codigo->IdCadenaCustodiaRuidoDatosMedicionDiurno, 'periodo' => 'Diurno']) }}" class="btn btn-primary btn-xs">Completado</a>
                              @endif
                              </center>
                            </td>
                            <td rowspan="2" style="vertical-align: middle;">
                              <center>
                              @if($codigo->FlagCadenaCustodiaRuidoDatosMuestreo == '0')
                                <a href="{{ route('ruido.detalle.muestreo', ['id' => $codigo->Id, 'muestreo' => $codigo->IdCadenaCustodiaRuidoDatosMuestreo]) }}" class="btn btn-warning btn-xs">Pendiente</a>
                              @else
                                <a href="{{ route('ruido.detalle.muestreo', ['id' => $codigo->Id, 'muestreo' => $codigo->IdCadenaCustodiaRuidoDatosMuestreo]) }}" class="btn btn-primary btn-xs">Completado</a>
                              @endif
                              </center>
                            </td>
                            <td>
                              <center>
                                @if ($codigo->IdCadenaCustodiaRuidoDatosMedicionDiurno == '0')
                                  <span class="badge bg-warning">Pendiente</span>
                                @else
                                  @if($codigo->IdCadenaCustodiaRuidoDatosMetereologicosDiurno == '0')
                                  <a href="{{ route('ruido.detalle.metereologico', [ 'id' => $codigo->Id, 'metereologico' => $codigo->IdCadenaCustodiaRuidoDatosMetereologicosDiurno, 'periodo' => 'Diurno']) }}" class="btn btn-warning btn-xs">Pendiente</a>
                                  @else
                                  <a href="{{ route('ruido.detalle.metereologico', [ 'id' => $codigo->Id, 'metereologico' => $codigo->IdCadenaCustodiaRuidoDatosMetereologicosDiurno, 'periodo' => 'Diurno']) }}" class="btn btn-primary btn-xs">Completado</a>
                                  @endif
                                @endif
                              </center>
                            </td>
                            <td>
                              <center>
                                @if ($codigo->IdCadenaCustodiaRuidoDatosMedicionDiurno == '0')
                                  <span class="badge bg-warning">Pendiente</span>
                                @else
                                  @if($codigo->IdCadenaCustodiaRuidoVerificacionEquipoDiurno == '0')
                                  <a href="{{ route('ruido.detalle.verificacion', [ 'id' => $codigo->Id, 'verificacion' => $codigo->IdCadenaCustodiaRuidoVerificacionEquipoDiurno, 'periodo' => 'Diurno']) }}" class="btn btn-warning btn-xs">Pendiente</a>
                                  @else
                                  <a href="{{ route('ruido.detalle.verificacion', [ 'id' => $codigo->Id, 'verificacion' => $codigo->IdCadenaCustodiaRuidoVerificacionEquipoDiurno, 'periodo' => 'Diurno']) }}" class="btn btn-primary btn-xs">Completado</a>
                                  @endif
                                @endif
                              </center>
                            </td>
                            <td>
                              <center>
                                @if ($codigo->IdCadenaCustodiaRuidoDatosMedicionDiurno == '0')
                                  <span class="badge bg-warning">Pendiente</span>
                                @else
                                  @if($codigo->TotalCadenaCustodiaRuidoInformacionMedicionDiurno != '10')
                                  <a href="{{ route('ruido.detalle.informacion-medicion', [ 'id' => $codigo->IdCadenaCustodiaRuidoDatosMedicionDiurno, 'periodo' => 'Diurno']) }}" class="btn btn-warning btn-xs">{{ $codigo->TotalCadenaCustodiaRuidoInformacionMedicionDiurno }}</a>
                                  @else
                                  <a href="{{ route('ruido.detalle.informacion-medicion', [ 'id' => $codigo->IdCadenaCustodiaRuidoDatosMedicionDiurno, 'periodo' => 'Diurno']) }}" class="btn btn-primary btn-xs">{{ $codigo->TotalCadenaCustodiaRuidoInformacionMedicionDiurno }}</a>
                                  @endif
                                @endif
                              </center>
                            </td>
                          @endif
                          <td rowspan="2" style="vertical-align: middle;"> 
                            @include('admin.ruido.detalle.delete', ['codigo' => $codigo]) 
                          </td>
                      </tr>
                      <tr>
                        <td><b>Nocturno</b></td>
                        @if ($codigo->FlagCadenaCustodiaRuidoDatosMedicionNocturno == '0')
                          <td> <center>-</center> </td>
                          <td> <center>-</center> </td>
                          <td> <center>-</center> </td>
                          <td> <center>-</center> </td>
                        @else
                          <td>
                            <center>
                            @if ($codigo->IdCadenaCustodiaRuidoDatosMedicionNocturno == '0')
                            <a href="{{ route('ruido.detalle.medicion', [ 'id' => $codigo->Id, 'medicion' => $codigo->IdCadenaCustodiaRuidoDatosMedicionNocturno, 'periodo' => 'Nocturno']) }}" class="btn btn-warning btn-xs">Pendiente</a>
                            @else
                            <a href="{{ route('ruido.detalle.medicion', [ 'id' => $codigo->Id, 'medicion' => $codigo->IdCadenaCustodiaRuidoDatosMedicionNocturno, 'periodo' => 'Nocturno']) }}" class="btn btn-primary btn-xs">Completado</a>
                            @endif
                            </center>
                          </td>
                          <td>
                            <center>
                              @if ($codigo->IdCadenaCustodiaRuidoDatosMedicionNocturno == '0')
                                <span class="badge bg-warning">Pendiente</span>
                              @else
                                @if($codigo->IdCadenaCustodiaRuidoDatosMetereologicosNocturno == '0')
                                <a href="{{ route('ruido.detalle.metereologico', [ 'id' => $codigo->Id, 'metereologico' => $codigo->IdCadenaCustodiaRuidoDatosMetereologicosNocturno, 'periodo' => 'Nocturno']) }}" class="btn btn-warning btn-xs">Pendiente</a>
                                @else
                                <a href="{{ route('ruido.detalle.metereologico', [ 'id' => $codigo->Id, 'metereologico' => $codigo->IdCadenaCustodiaRuidoDatosMetereologicosNocturno, 'periodo' => 'Nocturno']) }}" class="btn btn-primary btn-xs">Completado</a>
                                @endif
                              @endif
                            </center>
                          </td>
                          <td>
                            <center>
                              @if ($codigo->IdCadenaCustodiaRuidoDatosMedicionNocturno == '0')
                                <span class="badge bg-warning">Pendiente</span>
                              @else
                                @if($codigo->IdCadenaCustodiaRuidoVerificacionEquipoNocturno == '0')
                                <a href="{{ route('ruido.detalle.verificacion', [ 'id' => $codigo->Id, 'verificacion' => $codigo->IdCadenaCustodiaRuidoVerificacionEquipoNocturno, 'periodo' => 'Nocturno']) }}" class="btn btn-warning btn-xs">Pendiente</a>
                                @else
                                <a href="{{ route('ruido.detalle.verificacion', [ 'id' => $codigo->Id, 'verificacion' => $codigo->IdCadenaCustodiaRuidoVerificacionEquipoNocturno, 'periodo' => 'Nocturno']) }}" class="btn btn-primary btn-xs">Completado</a>
                                @endif
                              @endif
                            </center>
                          </td>
                          <td>
                            <center>
                              @if ($codigo->IdCadenaCustodiaRuidoDatosMedicionNocturno == '0')
                                <span class="badge bg-warning">Pendiente</span>
                              @else
                                @if($codigo->TotalCadenaCustodiaRuidoInformacionMedicionNocturno != '10' )
                                <a href="{{ route('ruido.detalle.informacion-medicion', [ 'id' => $codigo->IdCadenaCustodiaRuidoDatosMedicionNocturno, 'periodo' => 'Nocturno']) }}" class="btn btn-warning btn-xs">{{ $codigo->TotalCadenaCustodiaRuidoInformacionMedicionNocturno }}</a>
                                @else
                                <a href="{{ route('ruido.detalle.informacion-medicion', [ 'id' => $codigo->IdCadenaCustodiaRuidoDatosMedicionNocturno, 'periodo' => 'Nocturno']) }}" class="btn btn-primary btn-xs">{{ $codigo->TotalCadenaCustodiaRuidoInformacionMedicionNocturno }}</a>
                                @endif
                              @endif
                            </center>
                          </td>
                        @endif
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