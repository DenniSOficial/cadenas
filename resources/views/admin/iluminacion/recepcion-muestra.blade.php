@extends('admin.layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Cadena</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Editar cadena</li>
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
                            <h3 class="card-title">Editar Cadena de Custodia</h3>
                        </div>


                        {{ Form::open(['url' => 'admin/iluminacion/recepcion-muestra-update/' . $cadena->Id, 'method' => 'POST', 'class' => ['form-horizontal formAjax'], 'id' => 'formCadenaCusodia', 'novalidate' => true, 'autocomplete' => 'off', 'onkeydown' => 'return event.key != "Enter";', 'onsubmit' => 'return validateForm();']) }}
                        {!! Form::token() !!}
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="nro_cotizacion" class="col-sm-2 col-form-label">N° Cotización</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" class="form-control" id="nro_cotizacion" name="nro_cotizacion"
                                        placeholder="N° Cotización" oninput="this.value = this.value.toUpperCase()"
                                        value="{{ isset($cadena) ? $cadena->NumeroCotizacion : '' }}" readonly>
                                </div>
                                <label for="nro_informe" class="col-sm-2 col-form-label">N° Informe</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="nro_informe" name="nro_informe"
                                        placeholder="N° Informe" value="{{ isset($cadena) ? $cadena->NumeroInforme : '' }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cliente" class="col-sm-2 col-form-label">Cliente</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="id_cliente" id="id_cliente"
                                        value="{{ isset($cadena) ? $cadena->IdCliente : '' }}">
                                    <input type="text" class="form-control" id="cliente" name="cliente"
                                        placeholder="Cliente" value="{{ isset($cadena) ? $cadena->NombreCliente : '' }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fecha_muestra" class="col-sm-2 col-form-label">Fecha Recepción de
                                    Muestra</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" id="fecha_muestra_1" name="fecha_muestra_1"
                                        value="{{ isset($cadena) ? $cadena->FechaRecepcionMuestraIni : '' }}">
                                </div>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" id="fecha_muestra_2" name="fecha_muestra_2"
                                        value="{{ isset($cadena) ? $cadena->FechaRecepcionMuestraFin : '' }}">
                                </div>
                                <label for="hora_muestra" class="col-sm-2 col-form-label">Hora de Recepción de
                                    Muestra</label>
                                <div class="col-sm-4">
                                    <input type="time" class="form-control" name="hora_muestra" id="hora_muestra"
                                        value="{{ isset($cadena) ? substr($cadena->HoraRecepcionMuestra, 0, 5) : '' }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fecha_medicion" class="col-sm-2 col-form-label">Fecha de Muestreo o
                                    Medición</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" name="fecha_medicion_1" id="fecha_medicion_1"
                                        value="{{ isset($cadena) ? $cadena->FechaMuestreoMedicionIni : '' }}">
                                </div>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" name="fecha_medicion_2" id="fecha_medicion_2"
                                        value="{{ isset($cadena) ? $cadena->FechaMuestreoMedicionFin : '' }}">
                                </div>
                                <label for="fecha_elaboracion" class="col-sm-2 col-form-label">Fecha de Elaboración</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" name="fecha_elaboracion"
                                        id="fecha_elaboracion"
                                        value="{{ isset($cadena) ? $cadena->FechaElaboracion : '' }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="prioridad" name="prioridad"
                                            {{ isset($cadena) && $cadena->PrioridadAlta == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="prioridad">Prioridad Alta</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <h5>Códigos Cliente</h5>
                                <hr>
                                <table id="tblCadenaCustodiaDetalle" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Cod. Cliente</th>
                                            <th>Cod. Laboratorio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nr = 1; ?>
                                        @foreach ($detalles as $detalle)
                                            <tr>
                                                <td style="vertical-align: middle;"><input type="hidden"
                                                        name="id_detalle[]" value="{{ $detalle->Id }}">
                                                    {{ $nr }}</td>
                                                <td style="vertical-align: middle;">{{ $detalle->CodigoCliente }}</td>
                                                <td style="vertical-align: middle;"><input type="text"
                                                        name="laboratorio[]" class="form-control"
                                                        value="{{ $detalle->CodigoLaboratorio }}"></td>
                                            </tr>
                                            <?php $nr++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
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
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script type="text/javascript">
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
            return text.replace(/[&<>"']/g, function(m) {
                return map[m];
            });
        }

        function validateForm() {

            var recepcion = $('#fecha_muestra_1').val();
            var hora = $('#hora_muestra').val();
            var medicion = $("#fecha_medicion_1").val();
            var elaboracion = $("#fecha_elaboracion").val();
            
            if (recepcion === '' || hora === '' || medicion === '' || elaboracion === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sistemas Análiticos Generales',
                    text: 'Falta ingresar valores, Verifique.'
                });
                return false;
            }

            return true;

        }
    </script>
@endsection
