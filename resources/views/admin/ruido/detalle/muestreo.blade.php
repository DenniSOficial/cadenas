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
          <h1>N° Cotización {{ $detalle->NumeroCotizacion }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ruido.index') }}">Ruido</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ruido.show', $detalle->IdCadenaCustodiaRuido) }}">{{ $detalle->NumeroCotizacion }} </a></li>
            <li class="breadcrumb-item active">Muestreo</li>
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

            {{ Form::open(['url' => route('ruido.detalle.muestreo.store', $muestreo), 'method' => 'POST', 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true , 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";' , 'onsubmit' => 'return validateForm();' ]) }}
                {!! Form::token() !!}
                <div class="card-body">

                    <input type="hidden" class="form-control" name="id_cadena" id="id_cadena" value="{{ $detalle->IdCadenaCustodiaRuido }}">  
                    <input type="hidden" class="form-control" name="id_detalle" id="id_detalle" value="{{ $detalle->Id }}">

                    <h5>Descripción del punto de muestreo</h5>
                    <h6>Informar si el punto es designadopor el cliente</h6>
                    <hr>
                    <div class="form-group row">
                        <div class="input-group col-sm-12">
                            <textarea name="descripcion_muestreo" class="form-control" id="descripcion_muestreo" cols="10" rows="5">{{ isset($current_muestreo) ? $current_muestreo->DescripcionPuntoMuestreo : '' }}</textarea>
                        </div>
                    </div>

                    <h5>Observaciones técnicas detalladas</h5>
                    <hr>
                    <div class="form-group row">
                        <div class="input-group col-sm-12">
                            <textarea name="observaciones_tecnicas" class="form-control" id="observaciones_tecnicas" cols="10" rows="5">{{ isset($current_muestreo) ? $current_muestreo->ObservacionesTecnicasDetalladas : '' }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rs_fecha" class="col-sm-2 col-form-label">Código de medidor de clima (ELAB)</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="medidor_clima" id="medidor_clima" value="{{ isset($current_muestreo) ? $current_muestreo->CodigoMedidorClima : '' }}">
                            {{-- <select id="medidor_clima" name="medidor_clima" class="form-control select2bs4" style="width: 100%;">
                                <option value="">Seleccione</option>
                                @foreach ($medidores as $medidor)
                                    <option value="{{ $medidor->Codigo }}" {{ isset($current_muestreo) ? $medidor->Codigo == $current_muestreo->CodigoMedidorClima ? 'selected' : '' : '' }} >{{ $medidor->Codigo }}</option>
                                @endforeach
                              </select> --}}
                        </div>
                        <label for="rs_inicio" class="col-sm-2 col-form-label">Código de equipo calibrador (ELAB)</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" name="equipo_calibrador" id="equipo_calibrador" value="{{ isset($current_muestreo) ? $current_muestreo->CodigoEquipoCalibrador : '' }}">
                           {{--  <select id="equipo_calibrador" name="equipo_calibrador" class="form-control select2bs4" style="width: 100%;">
                                <option value="">Seleccione</option>
                                @foreach ($calibradores as $calibrador)
                                    <option value="{{ $calibrador->Codigo }}" {{ isset($current_muestreo) ? $calibrador->Codigo == $current_muestreo->CodigoEquipoCalibrador ? 'selected' : '' : '' }} >{{ $calibrador->Codigo }}</option>
                                @endforeach
                              </select> --}}
                        </div>
                        <label for="rs_final" class="col-sm-2 col-form-label">Código de equipo sonómetro (ELAB)</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" name="equipo_sonometro" id="equipo_sonometro" value="{{ isset($current_muestreo) ? $current_muestreo->CodigoEquipoSonometro : '' }}">
                            {{-- <select id="equipo_sonometro" name="equipo_sonometro" class="form-control select2bs4" style="width: 100%;">
                                <option value="">Seleccione</option>
                                @foreach ($sonometros as $sonometro)
                                    <option value="{{ $sonometro->Codigo }}" {{ isset($current_muestreo) ? $sonometro->Codigo == $current_muestreo->CodigoEquipoSonometro ? 'selected' : '' : '' }} >{{ $sonometro->Codigo }}</option>
                                @endforeach
                              </select> --}}
                        </div>
                    </div>

                    <h5>Geoferencia (UTM)</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="geoferencia_utm_este" class="col-sm-2 col-form-label">Este</label>
                        <div class="input-group col-sm-2">
                            {{-- <input type="text" class="form-control" id="geoferencia_utm_este" name="geoferencia_utm_este" value="{{ isset($current_muestreo) ? $current_muestreo->GeoferenciaUtmEste : '' }}"> --}}
                            <input type="text" class="form-control" id="geoferencia_utm_este" name="geoferencia_utm_este" value="{{ isset($current_muestreo) ? $current_muestreo->GeoferenciaUtmEste : '' }}" data-inputmask="'mask': ['9 999 999']" data-mask="" inputmode="text">
                        </div>
                        <label for="geoferencia_utm_norte" class="col-sm-2 col-form-label">Norte</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" name="geoferencia_utm_norte" id="geoferencia_utm_norte" value="{{ isset($current_muestreo) ? $current_muestreo->GeoferenciaUtmNorte : '' }}" data-inputmask="'mask': ['9 999 999']" data-mask="" inputmode="text">
                        </div>
                        <label for="altitud" class="col-sm-2 col-form-label">Altitud (m.s.n.m.)</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" name="altitud" id="altitud" value="{{ isset($current_muestreo) ? $current_muestreo->Altitud : '' }}">
                        </div>
                    </div>

                    <h5>Geoferencias</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="rs_fecha" class="col-sm-2 col-form-label">Sistema</label>
                        <div class="col-sm-2">
                            <select id="geoferencia_sistema" name="geoferencia_sistema" class="form-control select2bs4" style="width: 100%;">
                                <option value="">Seleccione</option>
                                @foreach ($sistemas as $sistema)
                                    <option value="{{ $sistema }}" {{ isset($current_muestreo) ? $sistema == $current_muestreo->GeoferenciaSistema ? 'selected' : '' : '' }} >{{ $sistema }}</option>
                                @endforeach
                              </select>
                        </div>
                        <label for="rs_inicio" class="col-sm-2 col-form-label">Zona</label>
                        <div class="col-sm-2">
                            <select id="geoferencia_zona" name="geoferencia_zona" class="form-control select2bs4" style="width: 100%;">
                                <option value="">Seleccione</option>
                                @foreach ($zonas as $zona)
                                    <option value="{{ $zona }}" {{ isset($current_muestreo) ? $zona == $current_muestreo->GeoferenciaZona ? 'selected' : '' : '' }} >{{ $zona }}</option>
                                @endforeach
                              </select>
                        </div>
                        <label for="rs_final" class="col-sm-2 col-form-label">Banda</label>
                        <div class="col-sm-2">
                            <select id="geoferencia_banda" name="geoferencia_banda" class="form-control select2bs4" style="width: 100%;">
                                <option value="">Seleccione</option>
                                @foreach ($bandas as $banda)
                                    <option value="{{ $banda }}" {{ isset($current_muestreo) ? ($banda == $current_muestreo->GeoferenciaBanda ? 'selected' : ''): ($banda == 'UMT' ? 'selected' : '') }} >{{ $banda }}</option>
                                @endforeach
                              </select>
                        </div>
                    </div>
                
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <a href="{{ route('ruido.show', $detalle->IdCadenaCustodiaRuido) }}" class="btn btn-default float-right">Cancelar</a>
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
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

  <script type = "text/javascript">

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    //Money Euro
    $('[data-mask]').inputmask()

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

      var descripcion_muestreo = $('#descripcion_muestreo').val();
      var observaciones_tecnicas = $('#observaciones_tecnicas').val();
      //var medidor_clima = $('#medidor_clima').val();
      //var equipo_calibrador = $('#equipo_calibrador').val();
      //var equipo_sonometro = $('#equipo_sonometro').val();
      var geoferencia_utm_este = $('#geoferencia_utm_este').val();
      var geoferencia_utm_norte = $('#geoferencia_utm_norte').val();
      var altitud = $('#altitud').val();
      var geoferencia_sistema = $('#geoferencia_sistema').val();
      var geoferencia_zona = $('#geoferencia_zona').val();
      var geoferencia_banda = $('#geoferencia_banda').val();

      if (descripcion_muestreo === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la descripción del punto de muestreo.'
        });
        return false;
      }

      if (rt_inicio === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la hora de inicio de ruido total.'
        });
        return false;
      }

      if (rt_final === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la hora final de ruido total.'
        });
        return false;
      }

      if (rs_fecha === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la fecha de ruido total.'
        });
        return false;
      }

      if (rs_inicio === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la hora de inicio de ruido total.'
        });
        return false;
      }

      if (rs_final === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Sistemas Análiticos Generales',
          text: 'Debe de ingresar la hora final de ruido total.'
        });
        return false;
      }

      return true;

    }

  </script>
@endsection