@extends('admin.layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">    
<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

<style>
    th {
        vertical-align: middle !important;
        text-align: center !important;
    }
    td {
        vertical-align: middle !important;
        text-align: center !important;
    }
</style>
@endsection

@section('content')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>N° Cotización {{ $cadena->NumeroCotizacion }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('iluminacion.index') }}">Iluminacion</a></li>
            <li class="breadcrumb-item"><a href="{{ route('iluminacion.show', $cadena->Id) }}">{{ $cadena->NumeroCotizacion }} </a></li>
            <li class="breadcrumb-item active">Informacion de medición</li>
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
              <h3 class="card-title">Código cliente {{ $detalle->CodigoCliente }} </h3>
            </div>

            <div class="card-body">
              @if (isset($current_informacion))
                @if (count($current_informacion) < 5)
                  <a href="{{ route('iluminacion.detalle.informacion-form', ['id' => $detalle->Id, 'info' => 0]) }}" class="btn btn-primary" style="margin-bottom: 1rem;">Registrar</a>    
                @else
                  @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2)
                    {{-- <a href="{{ route('ruido.detalle.informacion-print', ['id' => $detalle->Id, 'periodo' => $periodo]) }}" target="_blank" class="btn btn-success" style="margin-bottom: 1rem;">Imprimir</a>     --}}
                  @endif
                  @if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2 || Auth::guard('admin')->user()->IdRol == 3)
                    {{-- <a href="{{ route('ruido.detalle.informacion.incertidumbre-print', ['id' => $detalle->Id, 'periodo' => $periodo]) }}" target="_blank" class="btn btn-success" style="margin-bottom: 1rem; float:right;">Ver Incertidumbre</a>         --}}
                  @endif
                @endif
              @else 
                <a href="{{ route('iluminacion.detalle.informacion-form', ['id' => $detalle->Id, 'info' => 0]) }}" class="btn btn-primary" style="margin-bottom: 1rem;">Registrar</a>    
              @endif

              {{-- <a href="{{ route('file-download') }}" class="btn btn-secondary" style="margin-bottom: 1rem;">Descargar Plantilla</a>
              <a href="javascript:void(0);" alt="default" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-success" style="margin-bottom: 1rem;">Importar Muestras</a> --}}

              <table id="tblCadenaCustodia" class="table table-bordered table-striped">
                <thead>
                
                <tr>
                    <th>N°</th>
                    <th>Fecha</th>
                    <th>H. Inicio</th>
                    <th>H. Final</th>
                    <th>Nivel Max. (Lux)</th>
                    <th>Nivel Min. (Lux)</th>
                    <th>Nivel Avg (Lux)</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php $nr = 1; ?>
                   @isset($current_informacion)
                   
                        @foreach ($current_informacion as $key => $item)
                          
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->Fecha }}</td>
                                <td>{{ substr($item->HoraInicio, 0, 5) }}</td>
                                <td>{{ substr($item->HoraFin, 0, 5) }}</td>
                                <td>{{ $item->NivelMaxLux }}</td>
                                <td>{{ $item->NivelMinLux }}</td>
                                <td>{{ $item->NivelAvgLux }}</td>
                                <td><a href="{{ route('iluminacion.detalle.informacion-form', ['id' => $detalle->Id, 'info' => $item->Id]) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
                                {{-- <td> @include('admin.ruido.delete', ['cadena' => $cadena]) </td> --}}
                            </tr>
                            <?php $nr++; ?>
                        @endforeach    
                    @endisset
                </tbody>
              </table>
            </div>
                
            <div class="card-footer">
              <a href="{{ route('iluminacion.show', $cadena->Id) }}" class="btn btn-default float-right">Regresar</a>
              </div>
            

        </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Importar registro de muestas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('file-import', $detalle->Id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                        <div class="custom-file text-left">
                            <input type="file" name="file" class="custom-file-input" id="customFile">
                            <input type="hidden" name="periodo" value="">
                            <label class="custom-file-label" for="customFile">Elegir archivo</label>
                        </div>
                    </div>
                    <button class="btn btn-primary">Importar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

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

      var verificacion_inicial = $('#verificacion_inicial').val();
      var verificacion_final = $('#verificacion_final').val();
      
      if (verificacion_inicial === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la verificación del equipo inicial.'
        });
        return false;
      }

      if (verificacion_final === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la verificación del equipo final.'
        });
        return false;
      }

      return true;

    }

  </script>
@endsection