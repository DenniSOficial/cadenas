@extends('admin.layout.app')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">    
@endsection

@section('content')
    
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Editar Plan de Muestreo</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('agua.index') }}">Agua</a></li>
            <li class="breadcrumb-item active">Muestreo</li>
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
            @include('admin.agua.muestreo.form', ['url' => 'admin/agua/muestreo/' . $muestreo->IdCadenaCustodiaAgua .'/update/' . $muestreo->Id , 'method' => 'POST'])
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
    
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script type = "text/javascript">

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $('#btnAddPuntoMuestreo').click(function() {
  
          var nFilas = $('#tblPuntoMuestreo tbody tr').length;

          var colFecha = '<td> <input type="date" name="fechaPuntoMuestreo[]" class="form-control"> </td>';
          var colAgua = '<td> <input type="number" name="aguaPuntoMuestreo[]" class="form-control"> </td>';
          var colAire = '<td> <input type="number" name="airePuntoMuestreo[]" class="form-control"> </td>';
          var colRuido = '<td> <input type="number" name="ruidoPuntoMuestreo[]" class="form-control"> </td>';
          var colMetereologia = '<td> <input type="number" name="metereologiaPuntoMuestreo[]" class="form-control"> </td>';
          var colSuelo = '<td> <input type="number" name="sueloPuntoMuestreo[]" class="form-control"> </td>';
          var colGaseosa = '<td> <input type="number" name="gaseosaPuntoMuestreo[]" class="form-control"> </td>';
          var colIsocinetico = '<td> <input type="number" name="isocineticoPuntoMuestreo[]" class="form-control"> </td>';
          var colOtros = '<td> <input type="number" name="otrosPuntoMuestreo[]" class="form-control"> </td>';
          var colObservacion = '<td> <input type="text" name="observacionPuntoMuestreo[]" class="form-control"> </td>';
          var colEliminar = '<td> <a id="deleteFilaPuntoMuestreo" class="btn btn-danger btn-sm  delete" data-toggle="modal" ><i class="fa fa-trash" aria-hidden="true"></i></a> </td>';

          $('#tblPuntoMuestreo tbody').append('<tr id="tablerow' + (nFilas + 1) + '">' + colFecha + colAgua + colAire + colRuido + colMetereologia + colSuelo + colGaseosa + colIsocinetico + colOtros + colObservacion + colEliminar + '</tr>');

        });
        
        $("#tblPuntoMuestreo").on("click", "#deleteFilaPuntoMuestreo", function() {
          $(this).closest("tr").remove();
        });

        $('#btnAddEquipoMuestreo').click(function() {

          var nFilas = $('#tblEquipoMuestreo tbody tr').length;

          var colEquipo = '<td> <input type="text" name="EquipoMuestreo[]" class="form-control"> </td>';
          var colCodigo = '<td> <input type="text" name="CodigoMuestreo[]" class="form-control"> </td>';
          var colEliminar = '<td> <a id="deleteFilaEquipoMuestreo" class="btn btn-danger btn-sm  delete" data-toggle="modal" ><i class="fa fa-trash" aria-hidden="true"></i></a> </td>';

          $('#tblEquipoMuestreo tbody').append('<tr id="tablerow' + (nFilas + 1) + '">' + colEquipo + colCodigo + colEliminar + '</tr>');
        });

        $("#tblEquipoMuestreo").on("click", "#deleteFilaEquipoMuestreo", function() {
          $(this).closest("tr").remove();
        });

        $('#btnAddParametroDuplicado').click(function() {

          var nFilas = $('#tblParametroDuplicado tbody tr').length;

          var colMatriz = '<td> <input type="text" name="MatrizMuestreo[]" class="form-control"> </td>';
          var colParametro = '<td> <input type="text" name="ParametroMuestreo[]" class="form-control"> </td>';
          var colEliminar = '<td> <a id="deleteFilaParametro" class="btn btn-danger btn-sm  delete" data-toggle="modal" ><i class="fa fa-trash" aria-hidden="true"></i></a> </td>';

          $('#tblParametroDuplicado tbody').append('<tr id="tablerow' + (nFilas + 1) + '">' + colMatriz + colParametro + colEliminar + '</tr>');
        });

        $("#tblParametroDuplicado").on("click", "#deleteFilaParametro", function() {
          $(this).closest("tr").remove();
        });
    </script>
@endsection