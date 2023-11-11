<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>VERIFICACIÓN OPERACIONAL DE EQUIPOS DE CAMPO-AGUA</title>

    <style>
       
       /* @page { margin: 10; } */

       body {
            font-size: 9px;
       }

       table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
            table-layout: fixed;
        }
        table.cabecera td {
            border: 1px solid black;
            text-align: center
        }
        table.cabecera {
            margin-bottom: 1rem;
        }
        table.footer {
            border: 1px solid black;
        }
        td.texto-vertical {
            //writing-mode: vertical-lr;
            //transform: rotate(180deg);
        }
        span {
            font-weight: bold;
        }
        td {
            height: 9px;
        }
        .rowspan {
            border-left-width: 10px;
        }
        .tituloCabecera {
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }
        .titulo {
            font-weight: bold;
            
        }
        .tituloGrande{
            font-weight: bold;
            font-size: 14px;
        }
        .separador {
            height: 10px;
        }

        .headt td {
            height: 15px;
        }

        .headfo td {
            height: 11px;
            padding-bottom: 0.3rem;
            padding-top: 0.3rem;
        }

        .texto-izquierda {
            text-align: left;
        }

        .texto-derecha {
            text-align: right !important;
        }

        .sin-border {
            border: none !important;
        }

        hr {
            border: 1px dotted black;
            width: 95%;
            margin-bottom: 0;
        }

        .letra-chica {
            font-size: 7.5px;
            text-align: left !important;
        }

        .saltopagina{
            page-break-after:always;
        }

        .fondo-titulo {
            background-color: rgb(204, 204, 255)
        }

    </style>
</head>

<?php $currentdetalle = 0; ?>
<?php $indice = 0; ?>


    <header>
        <table class="header">
            <tr>
                <td rowspan="3" style="width: 20%;">
                    <img src="{{ public_path() . '\assets\img\logo-sag-azul.png'; }}" alt="" style="height: 50px;">
                </td>
                <td rowspan="3" class="tituloCabecera">VERIFICACIÓN OPERACIONAL DE EQUIPOS DE CAMPO-AGUA</td>
                <td style="width: 10%;" class="texto-derecha">FM-042</td>
            </tr>
            <tr>
                <td class="texto-derecha">Versión: 06</td>
            </tr>
            <tr>
                <td class="texto-derecha">F.E.: 12/2021</td>
            </tr>
        </table>
    </header>

    <body>
        
        <table class="cabecera">
            <tbody>
                <!-- CABECERA -->
                <tr>
                    <td colspan="6" class="titulo sin-border">Analista de Campo</td>
                    <td colspan="18" class="sin-border">{{ $cadena->Analista }}</td>
                    <td colspan="2" class="titulo sin-border">Fecha</td>
                    <td colspan="7" class="sin-border"></td>
                </tr>
                <tr>
                    <td colspan="2" class="titulo sin-border">Cliente</td>
                    <td colspan="15" class="sin-border">{{ $cadena->NombreCliente }}</td>
                    <td colspan="4" class="titulo sin-border">Cotización</td>
                    <td colspan="12" class="sin-border">{{ $cadena->NumeroCotizacion }}</td>
                </tr>
                <!-- PH -->
                <tr>
                    <td colspan="33" class="titulo fondo-titulo">Ajuste y Verificación del Potenciometro </td>
                </tr>
                <tr>
                    <td colspan="9" class="titulo sin-border" style="border-left: 1px solid black !important; border-right: 1px solid black !important;">Ejemplo:</td>
                    <td class="sin-border" colspan="24" style="border-right: 1px solid black !important;"></td>
                </tr>
                <tr>
                    <td colspan="2" class="sin-border" style="border-left: 1px solid black !important; border-bottom: 1px solid black !important;">HANNA</td>
                    <td colspan="4" class="sin-border" style="border-bottom: 1px solid black !important;">Slope Óptimo</td>
                    <td colspan="3" class="sin-border" style="border-right: 1px solid black !important; border-bottom: 1px solid black !important;">Store Good</td>
                    <td colspan="2" class="sin-border"></td>
                    <td colspan="2" class="sin-border">{{ isset($cadena->potenciometro) ? $cadena->potenciometro->MarcaEquipo : '' }}</td>
                    <td colspan="4" class="titulo sin-border">Slope Optimo</td>
                    <td colspan="3" class="sin-border">{{ isset($cadena->potenciometro) ? $cadena->potenciometro->SlopeOptimo : '' }}</td>
                    <td colspan="3" class="sin-border"></td>
                    <td colspan="5" class="titulo sin-border">Codigo de Equipo</td>
                    <td colspan="5" class="sin-border" style="border-right: 1px solid black !important;">{{ isset($cadena->potenciometro) ? $cadena->potenciometro->CodigoEquipo : '' }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="titulo sin-border texto-izquierda" style="border-left: 1px solid black !important;">Método: SM 4500 H+ B</td>
                    <td colspan="27" class="sin-border" style="border-right: 1px solid black !important;">Lecturas realizadas a 25° C</td>
                </tr>
                <tr>
                    <td colspan="9" class="titulo">Patrón 1</td>
                    <td colspan="9" class="titulo">Patrón 2</td>
                    <td colspan="3" rowspan="2" class="titulo">Slope</td>
                    <td colspan="12" class="titulo">Control</td>
                </tr>
                <tr>
                    <td colspan="3" class="titulo">Marca</td>
                    <td colspan="3" class="titulo">Lote</td>
                    <td colspan="3" class="titulo">Valor pH Teórico</td>
                    <td colspan="3" class="titulo">Marca</td>
                    <td colspan="3" class="titulo">Lote</td>
                    <td colspan="3" class="titulo">Valor pH Teórico</td>
                    <td colspan="3" class="titulo">Marca</td>
                    <td colspan="3" class="titulo">Lote</td>
                    <td colspan="3" class="titulo">Valor pH Teórico</td>
                    <td colspan="3" class="titulo">Lectura pH Control</td>
                </tr>
                @php
                    $count_ajuste = isset($cadena->potenciometro) ? count($cadena->potenciometro->ajuste) : 0;
                    $count_control = isset($cadena->potenciometro) ? count($cadena->potenciometro->control) : 0;
                    $first = 0;
                    $repetir_min = 3;
                    if ($count_ajuste >= $count_control) {
                        $repetir = $count_ajuste;
                    } else {
                        $repetir = $count_control;
                    }
                    if ($repetir < $repetir_min) {
                        $repetir = $repetir_min;
                    }
                @endphp
                @for ($i = 0; $i < $repetir; $i++)
                    <tr>
                        @if ($count_ajuste > $i)
                            <td colspan="3">{{ $cadena->potenciometro->ajuste[$i]->Marca }}</td>
                            <td colspan="3">{{ $cadena->potenciometro->ajuste[$i]->Lote }}</td>
                            <td colspan="3">{{ $cadena->potenciometro->ajuste[$i]->ValorpHTeorico }}</td>
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                        @else
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                        @endif
                        
                        @if ($first == 0)
                            <td colspan="3" rowspan="{{ $repetir }}">-57.7</td>    
                            @php
                                $first = 1;
                            @endphp
                        @endif

                        @if ($count_control > $i)
                            <td colspan="3">{{ $cadena->potenciometro->control[$i]->Marca }}</td>
                            <td colspan="3">{{ $cadena->potenciometro->control[$i]->Lote }}</td>
                            <td colspan="3">{{ $cadena->potenciometro->control[$i]->ValorpHTeorico }}</td>
                            <td colspan="3">{{ $cadena->potenciometro->control[$i]->LecturaControl }}</td>
                        @else
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                        @endif
                    </tr>
                @endfor
                <tr>
                    <td colspan="33"></td>
                </tr>
                <!-- CONDUCTIMETRO -->
                <tr>
                    <td colspan="33" class="titulo fondo-titulo">Ajuste y Verificación del Conductimetro </td>
                </tr>
                <tr>
                    <td colspan="6" class="sin-border titulo" style="border-left: 1px solid black !important;">Método: SM 4500 H+ B</td>
                    <td colspan="17" class="sin-border">Lecturas realizadas a 25° C</td>
                    <td colspan="5" class="titulo sin-border">Codigo de Equipo</td>
                    <td colspan="5" class="sin-border" style="border-right: 1px solid black !important;">ELAB-414</td>
                </tr>
                <tr>
                    <td colspan="16" class="titulo">Patrón</td>
                    <td colspan="17" class="titulo">Control</td>
                </tr>
                <tr>
                    <td colspan="3" rowspan="2" class="titulo">Marca</td>
                    <td colspan="3" rowspan="2" class="titulo">Lote</td>
                    <td colspan="5" rowspan="2" class="titulo">Concentración µS/cm (Teórico)</td>
                    <td colspan="5" rowspan="2" class="titulo">Constante de celda ( 1/cm)</td>
                    <td colspan="4" rowspan="2" class="titulo">Marca</td>
                    <td colspan="3" rowspan="2" class="titulo">Lote</td>
                    <td colspan="4" rowspan="2" class="titulo">Valor Teórico</td>
                    <td colspan="6" class="titulo">Concentración</td>
                </tr>
                <tr>
                    <td colspan="3" class="titulo">µS/cm </td>
                    <td colspan="3" class="titulo">mS/cm </td>
                </tr>
                @php
                    $count_ajuste = isset($cadena->conductimetro) ? count($cadena->conductimetro->ajuste) : 0;
                    $count_control = isset($cadena->conductimetro) ? count($cadena->conductimetro->control) : 0;
                    $repetir = 0;
                    $repetir_min = 3;

                    if ($count_ajuste >= $count_control) {
                        $repetir = $count_ajuste;
                    } else {
                        $repetir = $count_control;
                    }

                    if ($repetir < $repetir_min) {
                        $repetir = $repetir_min;
                    }
                    //dd($repetir);
                @endphp
                @for ($i = 0; $i < $repetir; $i++)
                    <tr>
                        @if ($count_ajuste > $i)
                            <td colspan="3">{{ $cadena->conductimetro->ajuste[$i]->Marca }}</td>
                            <td colspan="3">{{ $cadena->conductimetro->ajuste[$i]->Lote }}</td>
                            <td colspan="5">{{ $cadena->conductimetro->ajuste[$i]->ConcentracionuSTeorico }}</td>
                            <td colspan="5">{{ $cadena->conductimetro->ajuste[$i]->ConstanteCelda }}</td>
                        @else
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="5">---</td>
                            <td colspan="5">---</td>
                        @endif
                        @if ($count_control > $i)
                            <td colspan="4">{{ $cadena->conductimetro->control[$i]->Marca }}</td>
                            <td colspan="3">{{ $cadena->conductimetro->control[$i]->Lote }}</td>
                            <td colspan="4">{{ $cadena->conductimetro->control[$i]->ConcentracionuSTeorico }}</td>
                            <td colspan="3">{{ $cadena->conductimetro->control[$i]->ConcentracionuS }}</td>
                            <td colspan="3">{{ $cadena->conductimetro->control[$i]->ConcentracionmS }}</td>
                        @else
                            <td colspan="4">---</td>
                            <td colspan="3">---</td>
                            <td colspan="4">---</td>
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                        @endif
                        
                    </tr>    
                @endfor
                <!-- OXIMETRO -->
                <tr>
                    <td colspan="33" class="titulo fondo-titulo">Verificación del Oximetro </td>
                </tr>
                <tr>
                    <td colspan="6" class="sin-border titulo" style="border-left: 1px solid black !important;">Método: SM 4500-O G</td>
                    <td colspan="5" class="sin-border">Lecturas realizadas a 25° C</td>
                    <td colspan="3" class="sin-border"></td>
                    <td colspan="4" class="sin-border titulo">Código de Bureta</td>
                    <td colspan="4" class="sin-border">{{ isset($cadena->oximetro) ? $cadena->oximetro->CodigoBuretaSM : '' }}</td>
                    <td colspan="2" class="sin-border"></td>
                    <td colspan="4" class="titulo sin-border">Codigo de Equipo</td>
                    <td colspan="5" class="sin-border" style="border-right: 1px solid black !important;">{{ isset($cadena->oximetro) ? $cadena->oximetro->CodigoEquipoSM : '' }}</td>
                </tr>
                <tr>
                    <td colspan="3" rowspan="2" class="titulo">Marca</td>
                    <td colspan="3" rowspan="2" class="titulo">Lote</td>
                    <td colspan="4" rowspan="2" class="titulo">Lectura de OD (Solución Nula A ó B o C) mg/L</td>
                    <td colspan="23" class="titulo">Comparación de lectura con método volumétrico</td>
                </tr>
                <tr>
                    <td colspan="3" class="titulo">Lectura con sensor mg/L</td>
                    <td colspan="4" class="titulo">Lectura Volumétrica(1) mg/L</td>
                    <td colspan="3" class="titulo">Factor Tiosulfato de Sodio</td>
                    <td colspan="4" class="titulo">Normalidad Corregida del Tiosulfato de sodio</td>
                    <td colspan="3" class="titulo">Diferencia Optima (≤ 0.5 mg/L)</td>
                    <td colspan="3" class="titulo">Verificado por: Lab.L</td>
                    <td colspan="3" class="titulo">Obs.</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="3"></td>
                    <td colspan="4">{{ isset($cadena->oximetro) ? $cadena->oximetro->LecturaODSM : '' }}</td>
                    <td colspan="3">{{ isset($cadena->oximetro) ? $cadena->oximetro->LecturaSensorSM : '' }}</td>
                    <td colspan="4">{{ isset($cadena->oximetro) ? $cadena->oximetro->LecturaVolumetricaSM : '' }}</td>
                    <td colspan="3">{{ isset($cadena->oximetro) ? $cadena->oximetro->FactorTiosulfatoSodioSM : '' }}</td>
                    <td colspan="4">{{ isset($cadena->oximetro) ? $cadena->oximetro->NormalidadCorregidaTiosulfatoSM : '' }}</td>
                    <td colspan="3">{{ isset($cadena->oximetro) ? $cadena->oximetro->DiferenciaOptimaSM : '' }}</td>
                    <td colspan="3">{{ isset($cadena->oximetro) ? $cadena->oximetro->IdLaboratorioSM : '' }}</td>
                    <td colspan="3">{{ isset($cadena->oximetro) ? $cadena->oximetro->ObservacionesSM : '' }}</td>
                </tr>
                <tr>
                    <td colspan="33" class="sin-border" style="border-left: 1px solid black !important; border-right: 1px solid black !important;"></td>
                </tr>
                <tr>
                    <td colspan="6" class="sin-border titulo" style="border-left: 1px solid black !important;">Método: NTP 214.046:2013</td>
                    <td colspan="5" class="sin-border">Lecturas realizadas a 25° C</td>
                    <td colspan="3" class="sin-border"></td>
                    <td colspan="4" class="sin-border titulo">Código de Bureta</td>
                    <td colspan="4" class="sin-border">{{ isset($cadena->oximetro) ? $cadena->oximetro->CodigoBuretaNTP : '' }}</td>
                    <td colspan="2" class="sin-border"></td>
                    <td colspan="4" class="titulo sin-border">Codigo de Equipo</td>
                    <td colspan="5" class="sin-border" style="border-right: 1px solid black !important;">{{ isset($cadena->oximetro) ? $cadena->oximetro->CodigoEquipoNTP : '' }}</td>
                </tr>
                <tr>
                    <td colspan="3" rowspan="2" class="titulo">Marca</td>
                    <td colspan="3" rowspan="2" class="titulo">Lote</td>
                    <td colspan="4" rowspan="2" class="titulo">Lectura de OD (Solución Nula A ó B o C) mg/L</td>
                    <td colspan="23" class="titulo">Comparación de lectura con método volumétrico</td>
                </tr>
                <tr>
                    <td colspan="3" class="titulo">Lectura con sensor mg/L</td>
                    <td colspan="4" class="titulo">Lectura Volumétrica(1) mg/L</td>
                    <td colspan="3" class="titulo">Factor Tiosulfato de Sodio</td>
                    <td colspan="4" class="titulo">Normalidad Corregida del Tiosulfato de sodio</td>
                    <td colspan="3" class="titulo">Diferencia Optima (≤ 0.5 mg/L)</td>
                    <td colspan="3" class="titulo">Verificado por: Lab.L</td>
                    <td colspan="3" class="titulo">Obs.</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="3"></td>
                    <td colspan="4">{{ isset($cadena->oximetro) ? $cadena->oximetro->LecturaODNTP : '' }}</td>
                    <td colspan="3">{{ isset($cadena->oximetro) ? $cadena->oximetro->LecturaSensorNTP : '' }}</td>
                    <td colspan="4">{{ isset($cadena->oximetro) ? $cadena->oximetro->LecturaVolumetricaNTP : '' }}</td>
                    <td colspan="3">{{ isset($cadena->oximetro) ? $cadena->oximetro->FactorTiosulfatoSodioNTP : '' }}</td>
                    <td colspan="4">{{ isset($cadena->oximetro) ? $cadena->oximetro->NormalidadCorregidaTiosulfatoNTP : '' }}</td>
                    <td colspan="3">{{ isset($cadena->oximetro) ? $cadena->oximetro->DiferenciaOptimaNTP : '' }}</td>
                    <td colspan="3">{{ isset($cadena->oximetro) ? $cadena->oximetro->IdLaboratorioNTP : '' }}</td>
                    <td colspan="3">{{ isset($cadena->oximetro) ? $cadena->oximetro->ObservacionesNTP : '' }}</td>
                </tr>
                <tr>
                    <td colspan="33" class="sin-border" style="border-left: 1px solid black !important; border-right: 1px solid black !important;">verificación de la calibración del sensor con aire saturado con agua*</td>
                </tr>
                <tr>
                    <td colspan="5" rowspan="2" class="titulo">C ODm (concentración de OD medido)</td>
                    <td colspan="3" rowspan="2" class="titulo">temperatura del agua (°C)</td>
                    <td colspan="4" rowspan="2" class="titulo">Presion barometrica del lugar (mm bar)</td>
                    <td colspan="5" rowspan="2" class="titulo">C ODt (concentración de OD teorica )</td>
                    <td colspan="6" class="titulo">Rango</td>
                    <td colspan="2" rowspan="2" class="titulo">C</td>
                    <td colspan="2" rowspan="2" class="titulo">NC</td>
                    <td colspan="6" class="sin-border" style="border-right: 1px solid black !important;"></td>
                </tr>
                <tr>
                    <td colspan="3" class="titulo">97 %  C Odt</td>
                    <td colspan="3" class="titulo">104 % C Odt</td>
                    <td colspan="6" class="sin-border" style="border-right: 1px solid black !important;"></td>
                </tr>
                <tr>
                    <td colspan="5">{{ isset($cadena->oximetro) ? $cadena->oximetro->ConcentracionODMedidoNTP : '' }}</td>
                    <td colspan="3">{{ isset($cadena->oximetro) ? $cadena->oximetro->TemperaturaAguaNTP : '' }}</td>
                    <td colspan="4">{{ isset($cadena->oximetro) ? $cadena->oximetro->PresionBarometricaNTP : '' }}</td>
                    <td colspan="5">{{ isset($cadena->oximetro) ? $cadena->oximetro->ConcentracionODTeoricaNTP : '' }}</td>
                    <td colspan="3">{{ isset($cadena->oximetro) ? $cadena->oximetro->Rango97NTP : '' }}</td>
                    <td colspan="3">{{ isset($cadena->oximetro) ? $cadena->oximetro->Rango104NTP : '' }}</td>
                    <td colspan="2">{{ isset($cadena->oximetro) ? $cadena->oximetro->CNTP : '' }}</td>
                    <td colspan="2">{{ isset($cadena->oximetro) ? $cadena->oximetro->NCNTP : '' }}</td>
                    <td colspan="6" class="sin-border" style="border-right: 1px solid black !important;"></td>
                </tr>
                <tr>
                    <td colspan="33" class="sin-border"  style="border-left: 1px solid black !important; border-right: 1px solid black !important;">(*) agua reactiva : con un maximo de conductividad específica de 5 uS/cm</td>
                </tr>
                <!-- CLORO -->
                <tr>
                    <td colspan="33" class="titulo fondo-titulo">Verificación del Medidor de Cloro </td>
                </tr>
                <tr>
                    <td colspan="17" class="titulo sin-border" style="border-left: 1px solid black !important;"> Método: SM 4500B-Cl  G. (Validado Modificado). / SM 4500B-Cl  G. Total Chlorine</td>
                    <td colspan="7" class="sin-border"></td>
                    <td colspan="4" class="titulo sin-border">Codigo de Equipo</td>
                    <td colspan="5" class="sin-border" style="border-right: 1px solid black !important;">{{ $cadena->cloro->CodigoEquipo }}</td>
                </tr>
                @php
                    $count_ajuste = isset($cadena->cloro) ? count($cadena->cloro->ajuste) : 0;
                    $count_control = isset($cadena->cloro) ? count($cadena->cloro->control) : 0;
                    $repetir = 0;
                    $repetir_min = 3;

                    if ($count_ajuste >= $count_control) {
                        $repetir = $count_ajuste;
                    } else {
                        $repetir = $count_control;
                    }

                    if ($repetir < $repetir_min) {
                        $repetir = $repetir_min;
                    }
                    
                @endphp
                <tr>
                    <td colspan="9" class="titulo">Patrón 1</td>
                    <td colspan="6" rowspan="{{ $repetir + 2 }}"></td>
                    <td colspan="18" class="titulo">Control</td>
                </tr>
                <tr>
                    <td colspan="3" class="titulo">Marca</td>
                    <td colspan="3" class="titulo">Lote</td>
                    <td colspan="3" class="titulo">Concentración mg/L</td>
                    <td colspan="3" class="titulo">Marca</td>
                    <td colspan="3" class="titulo">Lote</td>
                    <td colspan="3" class="titulo">Valor teórico mg/L</td>
                    <td colspan="4" class="titulo">Rango de aceptación  +/-</td>
                    <td colspan="5" class="titulo">Lectura del control mg/L</td>
                </tr>

                @for ($i = 0; $i < $repetir; $i++)
                    <tr>
                        @if ($count_ajuste > $i)
                            <td colspan="3">{{ $cadena->cloro->ajuste[$i]->Marca }}</td>
                            <td colspan="3">{{ $cadena->cloro->ajuste[$i]->Lote }}</td>
                            <td colspan="3">{{ $cadena->cloro->ajuste[$i]->ConcetracionmgL }}</td>
                        @else
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            {{-- <td colspan="5">---</td> --}}
                        @endif
                        @if ($count_control > $i)
                            <td colspan="3">{{ $cadena->cloro->control[$i]->Marca }}</td>
                            <td colspan="3">{{ $cadena->cloro->control[$i]->Lote }}</td>
                            <td colspan="3">{{ $cadena->cloro->control[$i]->ConcetracionmgL }}</td>
                            <td colspan="4">{{ $cadena->cloro->control[$i]->RangoAceptacion }}</td>
                            <td colspan="5">{{ $cadena->cloro->control[$i]->LecturaControl }}</td>
                        @else
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="4">---</td>
                            <td colspan="5">---</td>
                        @endif
                        
                    </tr>    
                @endfor

                <tr>
                    <td colspan="33"></td>
                </tr>
                <!-- TURBIEDAD -->
                <tr>
                    <td colspan="33" class="titulo fondo-titulo">Verificación del Medidor de Turbiedad </td>
                </tr>
                <tr>
                    <td colspan="17" class="sin-border titulo" style="border-left: 1px solid black !important;">Método: SM 2130 B</td>
                    <td colspan="7" class="sin-border"></td>
                    <td colspan="4" class="titulo sin-border">Codigo de Equipo</td>
                    <td colspan="5" class="sin-border" style="border-right: 1px solid black !important;">{{ $cadena->turbiedad->CodigoEquipo }}</td>
                </tr>
                
                @php
                    $count_ajuste = isset($cadena->turbiedad) ? count($cadena->turbiedad->ajuste) : 0;
                    $count_control = isset($cadena->turbiedad) ? count($cadena->turbiedad->control) : 0;
                    $repetir = 0;
                    $repetir_min = 3;

                    if ($count_ajuste >= $count_control) {
                        $repetir = $count_ajuste;
                    } else {
                        $repetir = $count_control;
                    }

                    if ($repetir < $repetir_min) {
                        $repetir = $repetir_min;
                    }
                    
                @endphp
                
                <tr>
                    <td colspan="9" class="titulo">Patrón 1</td>
                    <td colspan="6" rowspan="{{ $repetir + 2 }}"></td>
                    <td colspan="18" class="titulo">Control</td>
                </tr>

                <tr>
                    <td colspan="3" class="titulo">Marca</td>
                    <td colspan="3" class="titulo">Lote</td>
                    <td colspan="3" class="titulo">Valor de Turbiedad</td>
                    <td colspan="3" class="titulo">Marca</td>
                    <td colspan="3" class="titulo">Lote</td>
                    <td colspan="3" class="titulo">Valor teórico NTU</td>
                    <td colspan="4" class="titulo">Rango de aceptación  +/-</td>
                    <td colspan="5" class="titulo">Lectura del control NTU</td>
                </tr>

                @for ($i = 0; $i < $repetir; $i++)
                    <tr>
                        @if ($count_ajuste > $i)
                            <td colspan="3">{{ $cadena->turbiedad->ajuste[$i]->Marca }}</td>
                            <td colspan="3">{{ $cadena->turbiedad->ajuste[$i]->Lote }}</td>
                            <td colspan="3">{{ $cadena->turbiedad->ajuste[$i]->ValorTeorico }}</td>
                        @else
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            {{-- <td colspan="5">---</td> --}}
                        @endif
                        @if ($count_control > $i)
                            <td colspan="3">{{ $cadena->turbiedad->control[$i]->Marca }}</td>
                            <td colspan="3">{{ $cadena->turbiedad->control[$i]->Lote }}</td>
                            <td colspan="3">{{ $cadena->turbiedad->control[$i]->ValorTeorico }}</td>
                            <td colspan="4">{{ $cadena->turbiedad->control[$i]->RangoAceptacion }}</td>
                            <td colspan="5">{{ $cadena->turbiedad->control[$i]->LecturaControl }}</td>
                        @else
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="3">---</td>
                            <td colspan="4">---</td>
                            <td colspan="5">---</td>
                        @endif
                        
                    </tr>    
                @endfor
                
                <!-- Observaciones -->
                <tr>
                    <td colspan="33" class="sin-border"></td>
                </tr>
                <tr>
                    <td colspan="33" class="letra-chica sin-border">SM: Standard Methods for the Examination of Water and Waster -APHA-AWWA-WEF,23rd Edition. 2017</td>
                </tr>
                <tr>
                    <td colspan="33" class="letra-chica sin-border">NTP 214.046.       : Norma Técnica Peruana. Determinación de oxígeno disuelto en agua. Método de sonda instrumental. Sensor basado en luminiscencia</td>
                </tr>
                <tr>
                    <td colspan="33" class="letra-chica titulo sin-border">SM 4500B-Cl  G. (Validado Modificado)       : Referencia SM 4500-Cl G. Chlorine (Residual). DPD Colorimetric Method.</td>
                </tr>
                <tr>
                    <td colspan="33" class="letra-chica sin-border">Solución nula OD:</td>
                </tr>
                <tr>
                    <td colspan="33" class="letra-chica sin-border">(A) 5g de sulfito de sodio aforar a 100mL de agua y añadir 2gotas de solución saturada de cloruro de cobalto o en su defecto algún material de referencia certificado adecuado. </td>
                </tr>
                <tr>
                    <td colspan="33" class="letra-chica sin-border">Solución saturada de cloruro de cobalto: 4.5g de CoCl2 en 10mL de agua. </td>
                </tr>
                <tr>
                    <td colspan="33" class="letra-chica sin-border">(B)  Preparación de acuerdo a lo descrito por el proveedor en las instrucciones del envase.</td>
                </tr>
                <tr>
                    <td colspan="33" class="letra-chica sin-border">(´C)  Disolver aprox 252.08 g de silfito de sodio (NA2SO3) en un litro de agua reactiva para obtener solución 2 M.                         </td>
                </tr>
                <tr>
                    <td colspan="33" class="letra-chica sin-border">Alternativamente agregar aprox 50 g de sulfito de sodio anhidro (Na2SO3) en un litro de agua reactiva para obtener solución 0.4 M.</td>
                </tr>
                <tr>
                    <td colspan="33" class="letra-chica sin-border">Lectura: Sumergir el sensor de OD en la solución (A ó B)</td>
                </tr>
                <tr>
                    <td colspan="33" class="letra-chica sin-border" style="background-color: rgba(197, 24, 24, 0.171) !important; ">(1) Lectura volumétrica realizada por el analista químico autorizado(registrar fecha y código de equipo). El volumen gastado es equivalente a la concentración de OD; de haber excepciones colocar el volumen gastado en Observaciones.</td>
                </tr>
            </tbody>
        </table>

    </body>

    

    
    


</html>