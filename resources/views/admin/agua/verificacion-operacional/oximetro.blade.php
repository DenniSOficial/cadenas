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
            <li class="breadcrumb-item"><a href="{{ route('agua.verificacion-operacional', $cadena->Id) }}">Verificación Operacional</a></li>
            <li class="breadcrumb-item active">Oximetro</li>
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
              <h3 class="card-title">Verificación Operacional de Equipos de Campo - Agua (Oximetro)</h3>
            </div>

            {{ Form::open(['url' => route('agua.verificacion-operacional.update', $cadena->Id), 'method' => 'POST', 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
                {!! Form::token() !!}
                <div class="card-body">

                    <input type="hidden" class="form-control" name="id_cadena" id="id_cadena" value="{{ $cadena->Id }}">  
                    <input type="hidden" class="form-control" name="id" id="id" value="{{ isset($oximetro) ? $oximetro->Id : '0' }}">  
                    <input type="hidden" class="form-control" name="parametro" id="parametro" value="{{ $parametro }}">  

                    <h5 style="font-weight: bold;">Método: SM 4500 H+ B</h5> 
                    <p>Lecturas realizadas a 25° C</p>
                    <hr>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Código Bureta</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="codigo_bureta_sm" id="codigo_bureta_sm" value="{{ isset($oximetro) ? $oximetro->CodigoBuretaSM : '' }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Codigo Equipo</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="codigo_equipo_sm" id="codigo_equipo_sm" value="{{ isset($oximetro) ? $oximetro->CodigoEquipoSM : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Buffer</label>
                        <div class="col-sm-4">
                            <select id="id_buffer_sm" name="id_buffer_sm" class="form-control select2bs4" style="width: 100%;">
                                <option value="">Seleccione Buffer</option>
                                @foreach ($controls as $control)
                                    <option value="{{ $control->Id }}" data-lote="{{ $control->Lote }}" {{ isset($oximetro) ?  $control->Id == $oximetro->IdBufferSM ? 'selected' : '' : ''  }}>{{ $control->Marca . ' - ' . $control->Lote }}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Lectura de OD (Solución Nula A ó B o C) mg/L</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="lectura_od_sm" id="lectura_od_sm" value="{{ isset($oximetro) ? $oximetro->LecturaODSM : '' }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Lectura con sensor mg/L</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="lectura_sensor_sm" id="lectura_sensor_sm" value="{{ isset($oximetro) ? $oximetro->LecturaSensorSM : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Lectura Volumétrica(1) mg/L</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="lectura_volumetrica_sm" id="lectura_volumetrica_sm" value="{{ isset($oximetro) ? $oximetro->LecturaVolumetricaSM : '' }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Factor Tiosulfato de Sodio</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="factor_tiosulfato_sm" id="factor_tiosulfato_sm" value="{{ isset($oximetro) ? $oximetro->FactorTiosulfatoSodioSM : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Normalidad Corregida del Tiosulfato de sodio</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="normalidad_corregida_sm" id="normalidad_corregida_sm" value="{{ isset($oximetro) ? $oximetro->NormalidadCorregidaTiosulfatoSM : '' }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Diferencia Optima (≤ 0.5 mg/L)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="diferencia_optima_sm" id="diferencia_optima_sm" value="{{ isset($oximetro) ? $oximetro->DiferenciaOptimaSM : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Verificado por: Lab.</label>
                        <div class="col-sm-4">
                            <select id="laboratorio_sm" name="laboratorio_sm" class="form-control select2bs4" style="width: 100%;">
                                <option value="">Seleccione</option>
                                @foreach ($laboratorios as $laboratorio)
                                    <option value="{{ $laboratorio->Id }}" {{ isset($oximetro) ? $laboratorio->Id == $oximetro->IdLaboratorioSM ? 'selected' : '' : '' }} >{{ $laboratorio->Nombre . ' ' . $laboratorio->Apellidos }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Obs.</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="obs_sm" id="obs_sm" value="{{ isset($oximetro) ? $oximetro->ObservacionesSM : '' }}">
                        </div>
                    </div>

                    <h5 style="font-weight: bold;">Método: NTP 214.046:2013</h5> 
                    <p>Lecturas realizadas a 25° C</p>
                    <hr>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Código Bureta</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="codigo_bureta_ntp" id="codigo_bureta_ntp" value="{{ isset($oximetro) ? $oximetro->CodigoBuretaNTP : '' }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Codigo Equipo</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="codigo_equipo_ntp" id="codigo_equipo_ntp" value="{{ isset($oximetro) ? $oximetro->CodigoEquipoNTP : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Buffer</label>
                        <div class="col-sm-4">
                            <select id="id_buffer_ntp" name="id_buffer_ntp" class="form-control select2bs4" style="width: 100%;">
                                <option value="">Seleccione Buffer</option>
                                @foreach ($controls as $control)
                                    <option value="{{ $control->Id }}" data-lote="{{ $control->Lote }}" {{ isset($oximetro) ?  $control->Id == $oximetro->IdBufferNTP ? 'selected' : '' : ''  }}>{{ $control->Marca . ' - ' . $control->Lote }}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Lectura de OD (Solución Nula A ó B o C) mg/L</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="lectura_od_ntp" id="lectura_od_ntp" value="{{ isset($oximetro) ? $oximetro->LecturaODNTP : '' }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Lectura con sensor mg/L</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="lectura_sensor_ntp" id="lectura_sensor_ntp" value="{{ isset($oximetro) ? $oximetro->LecturaSensorNTP : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Lectura Volumétrica(1) mg/L</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="lectura_volumetrica_ntp" id="lectura_volumetrica_ntp" value="{{ isset($oximetro) ? $oximetro->LecturaVolumetricaNTP : '' }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Factor Tiosulfato de Sodio</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="factor_tiosulfato_ntp" id="factor_tiosulfato_ntp" value="{{ isset($oximetro) ? $oximetro->FactorTiosulfatoSodioNTP : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Normalidad Corregida del Tiosulfato de sodio</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="normalidad_corregida_ntp" id="normalidad_corregida_ntp" value="{{ isset($oximetro) ? $oximetro->NormalidadCorregidaTiosulfatoNTP : '' }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Diferencia Optima (≤ 0.5 mg/L)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="diferencia_optima_ntp" id="diferencia_optima_ntp" value="{{ isset($oximetro) ? $oximetro->DiferenciaOptimaNTP : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Verificado por: Lab.</label>
                        <div class="col-sm-4">
                            <select id="laboratorio_ntp" name="laboratorio_ntp" class="form-control select2bs4" style="width: 100%;">
                                <option value="">Seleccione</option>
                                @foreach ($laboratorios as $laboratorio)
                                    <option value="{{ $laboratorio->Id }}" {{ isset($oximetro) ? $laboratorio->Id == $oximetro->IdLaboratorioNTP ? 'selected' : '' : '' }} >{{ $laboratorio->Nombre . ' ' . $laboratorio->Apellidos }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Obs.</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="obs_ntp" id="obs_ntp" value="{{ isset($oximetro) ? $oximetro->ObservacionesNTP : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">C ODm (concentración de OD medido)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="concentracion_medido_od_ntp" id="concentracion_medido_od_ntp" value="{{ isset($oximetro) ? $oximetro->ConcentracionODMedidoNTP : '' }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Temperatura del agua (°C)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="temperatura_agua_ntp" id="temperatura_agua_ntp" value="{{ isset($oximetro) ? $oximetro->TemperaturaAguaNTP : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Presion barometrica del lugar (mm bar)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="presion_barometrica_ntp" id="presion_barometrica_ntp" value="{{ isset($oximetro) ? $oximetro->PresionBarometricaNTP : '' }}">
                        </div>
                        <label class="col-sm-2 col-form-label">C ODt (concentración de OD teorica )</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="concentracion_od_teorica_ntp" id="concentracion_od_teorica_ntp" value="{{ isset($oximetro) ? $oximetro->ConcentracionODTeoricaNTP : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Rango 97 %  C Odt</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="rango97_ntp" id="rango97_ntp" value="{{ isset($oximetro) ? $oximetro->Rango97NTP : '' }}">
                        </div>
                        <label class="col-sm-2 col-form-label">Rango 104 % C Odt</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="rango104_ntp" id="rango104_ntp" value="{{ isset($oximetro) ? $oximetro->Rango104NTP : '' }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">C</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="c_ntp" id="c_ntp" value="{{ isset($oximetro) ? $oximetro->CNTP : '' }}">
                        </div>
                        <label class="col-sm-2 col-form-label">NC</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="nc_ntp" id="nc_ntp" value="{{ isset($oximetro) ? $oximetro->NCNTP : '' }}">
                        </div>
                    </div>
                                        
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <a href="{{ route('agua.verificacion-operacional', $cadena->Id) }}" class="btn btn-default float-right">Cancelar</a>
                </div>
                
            {{ Form::close() }}

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

      var marca_equipo = $('#marca_equipo').val();
      var slope_optimo = $('#slope_optimo').val();
      var codigo_equipo = $('#codigo_equipo').val();
      var slope = $('#slope').val();
      
      if (marca_equipo === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la marca del equipo.'
        });
        return false;
      }

      if (slope_optimo === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar el slope óptimo.'
        });
        return false;
      }

      if (codigo_equipo === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar el código del equipo.'
        });
        return false;
      }

      if (slope === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar el slope.'
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
        var valor = $(data[totalRows]).find("td:eq(3)").text();
        var id = $(data[totalRows]).find("td:eq(1) input").val();
        var nFilas = $("#tblControl tbody tr").length;

        var colMarca = '<td><input type="hidden" name="control_marca[]" value="' + marca + '" />' + marca + '</td>';
        var colLote = '<td><input type="hidden" name="control_lote[]" value="' + lote + '" />' + lote + '</td>';
        var colValorTeorico = '<td><input type="hidden" name="control_valort[]" value="' + valor + '" />' + valor + '</td>';
        var colValorControl = '<td><input type="text" name="control_valorc[]" class="form-control" /></td>';
        var colEliminar = '<td><input type="hidden" name="control_id_buffer[]" value="' + id + '" />' + '<a id="deleteFila" class="btn btn-danger btn-sm  delete" data-toggle="modal" ><i class="fa fa-trash" aria-hidden="true"></i></a>' + '</td>';
        
        $('#tblControl tbody').append('<tr id="tablerow' + (nFilas + 1) + '">' + colMarca + colLote + colValorTeorico + colValorControl + colEliminar + '</tr>');

        totalRows = totalRows - 1;
      }

      $('#controlModal').modal('hide');

    });

    $("#tblControl").on("click", "#deleteFila", function() {
      $(this).closest("tr").remove();
    });

  </script>
@endsection