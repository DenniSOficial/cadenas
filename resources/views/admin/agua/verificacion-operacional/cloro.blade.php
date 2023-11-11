@extends('admin.layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">    
<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
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
            <li class="breadcrumb-item"><a href="{{ route('agua.index') }}">Agua</a></li>
            <li class="breadcrumb-item"><a href="{{ route('agua.verificacion-operacional', $cadena->Id) }}">Verificación Operacional </a></li>
            <li class="breadcrumb-item active">Medidor Cloro</li>
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
              <h3 class="card-title">Verificación Operacional de Equipos de Campo - Agua</h3>
            </div>

            {{ Form::open(['url' => route('agua.verificacion-operacional.update', $cadena->Id), 'method' => 'POST', 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
                {!! Form::token() !!}
                <div class="card-body">

                  <input type="hidden" class="form-control" name="id_cadena" id="id_cadena" value="{{ $cadena->Id }}">  
                  <input type="hidden" class="form-control" name="id" id="id" value="{{ isset($cloro) ? $cloro->Id : '0' }}">  
                  <input type="hidden" class="form-control" name="parametro" id="parametro" value="{{ $parametro }}">  

                  <div class="form-group row">
                      {{-- <label class="col-sm-2 col-form-label">Marca Equipo</label>
                      <div class="col-sm-2">
                          <input type="text" class="form-control" name="marca_equipo" id="marca_equipo" value="{{ isset($cloro) ? $cloro->MarcaEquipo : '' }}">
                      </div>
                      <label class="col-sm-2 col-form-label">Slope Optimo</label>
                      <div class="col-sm-2">
                          <input type="text" class="form-control" name="slope_optimo" id="slope_optimo" value="{{ isset($cloro) ? $cloro->SlopeOptimo : '' }}">
                      </div> --}}
                      <label class="col-sm-2 col-form-label">Codigo Equipo</label>
                      <div class="col-sm-2">
                          <input type="text" class="form-control" name="codigo_equipo" id="codigo_equipo" value="{{ isset($cloro) ? $cloro->CodigoEquipo : '' }}">
                      </div>
                  </div>

                  <h5 style="font-weight: bold;">Método: SM 4500B-CI G. (Validado Modificado) / SM 4500B-CI G. Total Clorine</h5> 
                  {{-- <p>Lecturas realizadas a 25° C</p> --}}
                  <hr>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <a class="btn btn-success" data-toggle="modal" data-target="#ajusteModal" style="margin-bottom: 1rem;">Agregar</a>    

                            <a class="btn btn-success" data-toggle="modal" data-target="#controlModal" style="margin-bottom: 1rem; float:right;">Agregar</a>        
                        </div>
                    </div>

                  <div class="row">
                    <div class="col-sm-6">
                        <div class="table-responsive">
                            <table id="tblAjuste" class="table table-bordered" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th colspan="4">Patrón 1</th>
                                    </tr>
                                    <tr>
                                        <th>Marca</th>
                                        <th>Lote</th>
                                        <th>Concentración mg/L</th>
                                        <th>X</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @isset($cloro)
                                      @foreach ($cloro->ajuste as $ajuste)
                                          <tr>
                                            
                                            <td><input type="hidden" name="ajuste_marca[]" value="{{ $ajuste->Marca }}" />{{ $ajuste->Marca }}</td>
                                            <td><input type="hidden" name="ajuste_lote[]" value="{{ $ajuste->Lote }}" />{{ $ajuste->Lote }}</td>
                                            <td><input type="hidden" name="ajuste_valor[]" value="{{ $ajuste->ConcetracionmgL }}" />{{ $ajuste->ConcetracionmgL }}</td>
                                            <td><input type="hidden" name="ajuste_id_buffer[]" value="{{ $ajuste->IdBuffer }}" /><a id="deleteFila" class="btn btn-danger btn-sm  delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                          </tr>
                                      @endforeach
                                  @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="table-responsive">
                            <table id="tblControl" class="table table-bordered" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th colspan="6">Control</th>
                                    </tr>
                                    <tr>
                                        <th>Marca</th>
                                        <th>Lote</th>
                                        <th>Valor Teórico mg/L</th>
                                        <th>Rango de aceptación +/-</th>
                                        <th>Lectura del control mg/L</th>
                                        <th>X</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @isset($cloro)
                                      @foreach ($cloro->control as $control)
                                          <tr>
                                            <td><input type="hidden" name="control_marca[]" value="{{ $control->Marca }}" />{{ $control->Marca }}</td>
                                            <td><input type="hidden" name="control_lote[]" value="{{ $control->Lote }}" />{{ $control->Lote }}</td>
                                            <td><input type="hidden" name="control_valort[]" value="{{ $control->ConcetracionmgL }}" />{{ $control->ConcetracionmgL }}</td>
                                            <td><input type="hidden" name="control_rango[]" value="{{ $control->RangoAceptacion }}" />{{ $control->RangoAceptacion }}</td>
                                            <td><input type="text" name="control_valorc[]" class="form-control" value="{{ $control->LecturaControl }}" /></td>
                                            <td><input type="hidden" name="control_id_buffer[]" value="{{ $control->IdBuffer }}" /><a id="deleteFila" class="btn btn-danger btn-sm  delete" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                          </tr>
                                      @endforeach
                                  @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                  {{-- 
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Slope</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="slope" id="slope" value="{{ isset($cloro) ? $cloro->Slope : '' }}">
                        </div>
                    </div> --}}
                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <a href="{{ route('agua.verificacion-operacional', $cadena->Id) }}" class="btn btn-default float-right">Cancelar</a>
                </div>
                
            {{ Form::close() }}

            <div class="modal fade" id="ajusteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title" id="exampleModalLabel1">Agregar Buffer</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <table id="tblModalAjuste" class="table table-striped table-hover display">
                          <thead>
                              <tr>
                                  <th style="width: 5%;"></th>
                                  <th >Marca</th>
                                  <th >Lote</th>
                                  <th >Concentración mg/L</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($ajustes as $ajuste)
                                <tr>
                                  <td>
                                    <span class="custom-checkbox"> <input type="checkbox" id="checkbox1" name="options[]" value="1"> <label for="checkbox1"></label> </span>
                                  </td>
                                  <td><input type="hidden" value="{{ $ajuste->Id }}"> {{ $ajuste->Marca }}</td>
                                  <td>{{ $ajuste->Lote }}</td>
                                  <td>{{ $ajuste->ValorReferenciapH }}</td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          <button id="addAjuste" type="button" class="btn btn-primary">Agregar</button>
                      </div>
                  </div>
              </div>
            </div>

            <div class="modal fade" id="controlModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title" id="exampleModalLabel1">Agregar Buffer</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <table id="tblModalControl" class="table table-striped table-hover display">
                          <thead>
                              <tr>
                                  <th style="width: 5%;"></th>
                                  <th >Marca</th>
                                  <th >Lote</th>
                                  <th>Rango de aceptación</th>
                                  <th >Concentración mg/L</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($controls as $control)
                                <tr>
                                  <td>
                                    <span class="custom-checkbox"> <input type="checkbox" id="checkbox1" name="options[]" value="1"> <label for="checkbox1"></label> </span>
                                  </td>
                                  <td><input type="hidden" value="{{ $control->Id }}"> {{ $control->Marca }}</td>
                                  <td>{{ $control->Lote }}</td>
                                  <td>{{ $control->RangoAceptacionInicial }} +/- {{ $control->RangoAceptacionFinal }}</td>
                                  <td>{{ $control->ValorReferenciapH }}</td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          <button id="addControl" type="button" class="btn btn-primary">Agregar</button>
                      </div>
                  </div>
              </div>
            </div>


        </div>
        </div>
      </div>
    </div>
  </section>

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

      var codigo_equipo = $('#codigo_equipo').val();
      
      if (codigo_equipo === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar el código del equipo.'
        });
        return false;
      }

      return true;

    }

    $("#addAjuste").click(function() {
      
      var nFilas = $('#tblModalAjuste tbody tr').length;

      if (nFilas === 0) {
        alert('No hay datos para agregar.');
        return;
      }

      var data = $("#tblModalAjuste input[type=checkbox]:checked").parents("tr");
                
      if (data.length === 0) {
        alert('No ha seleccionado ningún buffer, verifique');
        return;
      }

      var totalRows = data.length -1;

      while (totalRows >= 0) {
        
        var marca = $(data[totalRows]).find("td:eq(1)").text();
        var lote = $(data[totalRows]).find("td:eq(2)").text();
        var valor = $(data[totalRows]).find("td:eq(3)").text();
        var id = $(data[totalRows]).find("td:eq(1) input").val();
        var nFilas = $("#tblAjuste tbody tr").length;

        var colMarca = '<td><input type="hidden" name="ajuste_marca[]" value="' + marca + '" />' + marca + '</td>';
        var colLote = '<td><input type="hidden" name="ajuste_lote[]" value="' + lote + '" />' + lote + '</td>';
        var colValor = '<td><input type="hidden" name="ajuste_valor[]" value="' + valor + '" />' + valor + '</td>';
        var colEliminar = '<td><input type="hidden" name="ajuste_id_buffer[]" value="' + id + '" />' + '<a id="deleteFila" class="btn btn-danger btn-sm  delete" data-toggle="modal" ><i class="fa fa-trash" aria-hidden="true"></i></a>' + '</td>';
        
        $('#tblAjuste tbody').append('<tr id="tablerow' + (nFilas + 1) + '">' + colMarca + colLote + colValor + colEliminar + '</tr>');

        totalRows = totalRows - 1;
      }

      $('#ajusteModal').modal('hide');

    });

    $("#tblAjuste").on("click", "#deleteFila", function() {
      $(this).closest("tr").remove();
    });

    $("#addControl").click(function() {
      
      var nFilas = $('#tblModalControl tbody tr').length;

      if (nFilas === 0) {
        alert('No hay datos para agregar.');
        return;
      }

      var data = $("#tblModalControl input[type=checkbox]:checked").parents("tr");
                
      if (data.length === 0) {
        alert('No ha seleccionado ningún buffer, verifique');
        return;
      }

      var totalRows = data.length -1;

      while (totalRows >= 0) {
        
        var marca = $(data[totalRows]).find("td:eq(1)").text();
        var lote = $(data[totalRows]).find("td:eq(2)").text();
        var rango = $(data[totalRows]).find("td:eq(3)").text();
        var valor = $(data[totalRows]).find("td:eq(4)").text();
        var id = $(data[totalRows]).find("td:eq(1) input").val();
        var nFilas = $("#tblControl tbody tr").length;

        var colMarca = '<td><input type="hidden" name="control_marca[]" value="' + marca + '" />' + marca + '</td>';
        var colLote = '<td><input type="hidden" name="control_lote[]" value="' + lote + '" />' + lote + '</td>';
        var colValorTeorico = '<td><input type="hidden" name="control_valort[]" value="' + valor + '" />' + valor + '</td>';
        var colRango = '<td><input type="hidden" name="control_rango[]" value="' + rango + '" />' + rango + '</td>';
        var colValorControl = '<td><input type="text" name="control_valorc[]" class="form-control" /></td>';
        var colEliminar = '<td><input type="hidden" name="control_id_buffer[]" value="' + id + '" />' + '<a id="deleteFila" class="btn btn-danger btn-sm  delete" data-toggle="modal" ><i class="fa fa-trash" aria-hidden="true"></i></a>' + '</td>';
        
        $('#tblControl tbody').append('<tr id="tablerow' + (nFilas + 1) + '">' + colMarca + colLote + colValorTeorico + colRango + colValorControl + colEliminar + '</tr>');

        totalRows = totalRows - 1;
      }

      $('#controlModal').modal('hide');

    });

    $("#tblControl").on("click", "#deleteFila", function() {
      $(this).closest("tr").remove();
    });

  </script>
@endsection