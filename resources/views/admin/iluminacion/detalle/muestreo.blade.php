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
                        <li class="breadcrumb-item"><a href="{{ route('iluminacion.index') }}">Iluminacion</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('iluminacion.show', $detalle->IdCadenaCustodiaIluminacion) }}">{{ $cadena->NumeroCotizacion }}
                            </a></li>
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

                        {{ Form::open(['url' => route('iluminacion.detalle.muestreo.store', $muestreo), 'method' => 'POST', 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true, 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";', 'onsubmit' => 'return validateForm();']) }}
                        {!! Form::token() !!}
                        <div class="card-body">

                            <input type="hidden" class="form-control" name="id_cadena" id="id_cadena"
                                value="{{ $cadena->Id }}">
                            <input type="hidden" class="form-control" name="id_detalle" id="id_detalle"
                                value="{{ $detalle->Id }}">

                            <h5>Descripción del punto de muestreo / Estación de muestreo.</h5>
                            <hr>
                            <div class="form-group row">
                                <div class="input-group col-sm-12">
                                    <textarea name="descripcion_muestreo" class="form-control" id="descripcion_muestreo" cols="10" rows="5">{{ isset($current_muestreo) ? $current_muestreo->DescripcionPuntoMuestreo : '' }}</textarea>
                                </div>
                            </div>

                            <h5>Geoferencia</h5>
                            <hr>
                            <div class="form-group row">
                                <label for="geoferencia_este" class="col-sm-2 col-form-label">Este</label>
                                <div class="input-group col-sm-2">
                                    <input type="text" class="form-control" id="geoferencia_este"
                                        name="geoferencia_este"
                                        value="{{ isset($current_muestreo) ? $current_muestreo->GeoferenciaEste : '' }}"
                                        data-inputmask="'mask': ['9 999 999']" data-mask="" inputmode="text">
                                </div>
                                <label for="geoferencia_norte" class="col-sm-2 col-form-label">Norte</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="geoferencia_norte"
                                        id="geoferencia_norte"
                                        value="{{ isset($current_muestreo) ? $current_muestreo->GeoferenciaNorte : '' }}"
                                        data-inputmask="'mask': ['9 999 999']" data-mask="" inputmode="text">
                                </div>
                                <label for="equipo_luxometro" class="col-sm-2 col-form-label">Equipo Luxometro</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="equipo_luxometro" id="equipo_luxometro"
                                        value="{{ isset($current_muestreo) ? $current_muestreo->EquipoLuxometro : '' }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="altitud" class="col-sm-2 col-form-label">Altitud (m.s.n.m.)</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="altitud" id="altitud"
                                        value="{{ isset($current_muestreo) ? $current_muestreo->Altitud : '' }}">
                                </div>
                                <label for="temperatura" class="col-sm-2 col-form-label">Temperatura Ambiente Prom.</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" name="temperatura" id="temperatura"
                                        value="{{ isset($current_muestreo) ? $current_muestreo->TemperaturaAmbientePromedio : '' }}">
                                </div>
                                <label for="presion" class="col-sm-2 col-form-label">Presion Ambiental Prom.</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" name="presion" id="presion"
                                        value="{{ isset($current_muestreo) ? $current_muestreo->PresionAmbientalPromedio : '' }}">
                                </div>
                            </div>

                            <h5>Observaciones</h5>
                            <hr>
                            <div class="form-group row">
                                <div class="input-group col-sm-12">
                                    <textarea name="observaciones" class="form-control" id="observaciones" cols="10" rows="5">{{ isset($current_muestreo) ? $current_muestreo->Observaciones : '' }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="puesto_tipo" class="col-sm-2 col-form-label">Puesto Tipo</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="puesto_tipo"
                                        id="puesto_tipo"
                                        value="{{ isset($current_muestreo) ? $current_muestreo->PuestoTipo : '' }}">
                                </div>
                                <label for="tipo_fuente" class="col-sm-2 col-form-label">Tipo Fuente Luminica</label>
                                <div class="col-sm-2">
                                    <select id="tipo_fuente" name="tipo_fuente"
                                        class="form-control select2bs4" style="width: 100%;">
                                        <option value="">Seleccione</option>
                                        @foreach ($fuentes as $fuente)
                                            <option value="{{ $fuente }}"
                                                {{ isset($current_muestreo) ? ($fuente == $current_muestreo->TipoFuenteLuminica ? 'selected' : '') : '' }}>
                                                {{ $fuente }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="iluminacion" class="col-sm-2 col-form-label">Iluminacion</label>
                                <div class="col-sm-2">
                                    <select id="iluminacion" name="iluminacion"
                                        class="form-control select2bs4" style="width: 100%;">
                                        <option value="">Seleccione</option>
                                        @foreach ($iluminaciones as $iluminacion)
                                            <option value="{{ $iluminacion }}"
                                                {{ isset($current_muestreo) ? ($iluminacion == $current_muestreo->Iluminacion ? 'selected' : '') : '' }}>
                                                {{ $iluminacion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tarea_visual" class="col-sm-2 col-form-label">Tarea Visual</label>
                                <div class="col-sm-10">
                                    <select id="tarea_visual" name="tarea_visual"
                                        class="form-control select2bs4" style="width: 100%;">
                                        <option value="">Seleccione</option>
                                        @foreach ($tareas as $tarea)
                                            <option value="{{ $tarea->Id }}"
                                                {{ isset($current_muestreo) ? ($tarea->Id == $current_muestreo->IdTareaVisual ? 'selected' : '') : '' }}>
                                                {{ $tarea->TareaVisual }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Guardar</button>
                            <a href="{{ route('iluminacion.show', $cadena->Id) }}"
                                class="btn btn-default float-right">Cancelar</a>
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

    <script type="text/javascript">
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
            return text.replace(/[&<>"']/g, function(m) {
                return map[m];
            });
        }

        function validateForm() {

            var descripcion_muestreo = $('#descripcion_muestreo').val();
            //var observaciones_tecnicas = $('#observaciones_tecnicas').val();
            var geoferencia_este = $('#geoferencia_este').val();
            var geoferencia_norte = $('#geoferencia_norte').val();
            var tipo_fuente = $('#tipo_fuente').val();
            var iluminacion = $('#iluminacion').val();
            var tarea_visual = $('#tarea_visual').val();

            if (descripcion_muestreo === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sistemas Análiticos Generales',
                    text: 'Debe de ingresar la descripción del punto de muestreo.'
                });
                return false;
            }

            if (geoferencia_este === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sistemas Análiticos Generales',
                    text: 'Debe de ingresar geoferencia este.'
                });
                return false;
            }

            if (geoferencia_norte === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sistemas Análiticos Generales',
                    text: 'Debe de ingresar geoferencia norte.'
                });
                return false;
            }

            if (tipo_fuente === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sistemas Análiticos Generales',
                    text: 'Debe de seleccionar el tipo de fuente.'
                });
                return false;
            }

            if (iluminacion === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sistemas Análiticos Generales',
                    text: 'Debe de seleccionar el tipo de iluminación.'
                });
                return false;
            }

            if (tarea_visual === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sistemas Análiticos Generales',
                    text: 'Debe de seleccionar la tarea visual.'
                });
                return false;
            }

            return true;

        }
    </script>
@endsection
