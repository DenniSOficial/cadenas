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
            
            {{ Form::open(['url' => route('ruido.unir.update', $cadena->Id), 'method' => 'POST', 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
                {!! Form::token() !!}
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h5>Códigos agregados</h5>
                        <hr>
                        <table id="tblCadenaCustodiaDetalle" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                            <th>N°</th>
                            <th>Cod. Cliente</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $nr = 1; ?>
                            @foreach ($codigos as $codigo)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $nr }}</td>
                                    <td style="vertical-align: middle;">{{ $codigo->CodigoCliente }}</td>
                                </tr>
                                <?php $nr++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-6">
                        <h5>Códigos para agregar</h5>
                        <hr>
                        <table id="tblCadenaCustodiaDetalleNuevos" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                            <th>N°</th>
                            <th>Cod. Cliente</th>
                            <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $nr = 1; ?>
                            @foreach ($nuevos as $nuevo)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $nuevo->Id }}</td>
                                    <td style="vertical-align: middle;"> <input type="hidden" name="id_detalle[]" value="{{ $nuevo->IdCadenaCustodiaRuidoDetalle }}"> {{ $nuevo->CodigoCliente }}</td>
                                    <td><center><a id="deleteFila" class="btn btn-danger btn-sm  delete"><i class="fa fa-trash" aria-hidden="true"></i></a></center></td>
                                </tr>
                                <?php $nr++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Guardar</button>
                <a href="{{ route('ruido.index') }}" class="btn btn-default float-right">Cancelar</a>
            </div>
            {{ Form::close() }}
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

<script type = "text/javascript">
    $("#tblCadenaCustodiaDetalleNuevos").on("click", "#deleteFila", function() {
      $(this).closest("tr").remove();
    });
</script>
@endsection