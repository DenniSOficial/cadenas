<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>REGISTRO DIGITAL DE MEDICIÓN DE ILUMINACIÓN</title>

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
            text-align: center;
        }
        table.cabecera {
            margin-bottom: 1rem;
        }
        table.header td {

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
            height: 10px;
        }
        .rowspan {
            border-left-width: 10px;
        }
        .tituloCabecera {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }
        .titulo {
            font-weight: bold;
            text-align: left !important;
            padding-left: .5rem;
        }
        .tituloGrande {
            font-weight: bold;
            font-size: 14px;
        }
        .separador {
            height: 10px;
        }

        .headt td {
            height: 10px;
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
            text-align: right;
        }

        .texto-centrado {
            text-align: center !important;
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
        }

        .saltopagina{
            page-break-after:always;
        }

        .color-celeste {
            background-color: #DCE6F1;
        }

    </style>

</head>

<?php $currentdetalle = 0; ?>
<?php $indice = 0; ?>
<?php $total_detalle = count($detalles); ?>

<?php $registros_x_hoja = 3; ?>
<?php $cant_registro_actual = 1 ?>

    <?php foreach ($detalles as $key => $detalle) { ?>
        
        <?php if ($cant_registro_actual == 1) { ?>

            <header>
                <table class="header">
                    <tr>
                        <td rowspan="3" style="width: 20%;">
                            <img src="{{ public_path() . '\assets\img\logo-sag-azul.png'; }}" alt="" style="height: 50px;">
                        </td>
                        <td rowspan="3" class="tituloCabecera">REGISTRO DIGITAL DE MEDICIÓN DE ILUMINACIÓN</td>
                        <td style="width: 10%;" class="texto-derecha">FM-080</td>
                    </tr>
                    <tr>
                        <td class="texto-derecha">Versión: 00</td>
                    </tr>
                    <tr>
                        <td class="texto-derecha">F.E.: 01/2019</td>
                    </tr>
                </table>
            </header>

            <body>
                <table class="cabecera">
                    <tbody>
                        <tr>
                            
                            <td colspan="3" class="titulo color-celeste">Cliente </td>
                            <td colspan="10" class="color-celeste">{{ $cabecera->NombreCliente }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="titulo color-celeste">Lugar</td>
                            <td colspan="10" class="color-celeste">{{ $cabecera->Lugar }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="titulo color-celeste">Analista de salud ocupacional</td>
                            <td colspan="10" class="color-celeste">{{ $cabecera->NombreCompletoAnalista1 }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="titulo">Equipo Luxometro</td>
                            <td colspan="6">{{ $detalle->datos_muestreo->EquipoLuxometroDetalle }}</td>
                            <td colspan="2" class="titulo">Código equipo</td>
                            <td colspan="2">{{ $detalle->datos_muestreo->EquipoLuxometro }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="titulo">Descripción Procedencia</td>
                            <td colspan="10">{{ $cabecera->Analista1 }}</td>
                        </tr>
                        <tr>
                            <td colspan="13" class="titulo sin-border">Verificación operacional del equipo luxómetro</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="titulo sin-border"></td>
                            <td colspan="2" class="titulo texto-centrado">Nivel Mínimo (Lux)</td>
                            <td colspan="2" class="titulo texto-centrado">Nivel Medio (Lux)</td>
                            <td colspan="2" class="titulo texto-centrado">Nivel Máximo (Lux)</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="titulo">Nivel de iluminación de cabina de referencia</td>
                            <td colspan="2" class="titulo"></td>
                            <td colspan="2" class="titulo"></td>
                            <td colspan="2" class="titulo"></td>
                        </tr>
                        <tr>
                            <td colspan="13" class="separador sin-border"></td>
                        </tr>
                        <tr>
                            <td colspan="13" class="titulo sin-border">DESCRIPCIÓN DE LA ACTIVIDAD DEL TRABAJADOR EXPUESTO</td>
                        </tr>
                        <tr>
                            <td class="titulo texto-centrado color-celeste">Punto de Muestreo</td>
                            <td class="titulo texto-centrado color-celeste">Fecha</td>
                            <td class="titulo texto-centrado color-celeste">Hora de inicio</td>
                            <td class="titulo texto-centrado color-celeste">Hora final</td>
                            <td colspan="2" class="titulo texto-centrado color-celeste">Sección / Puesto / Puesto Tipo</td>
                            <td colspan="2" class="titulo texto-centrado color-celeste">Tipo de Fuente Luminica</td>
                            <td colspan="2" class="titulo texto-centrado color-celeste">Iluminación: General / Localizada / Mixta</td>
                            <td class="titulo texto-centrado color-celeste">Nivel Max (Lux)</td>
                            <td class="titulo texto-centrado color-celeste">Nivel Min (Lux)</td>
                            <td class="titulo texto-centrado color-celeste">Nivel AVG (Lux)</td>
                        </tr>
                        <?php 
                            $arraymax = [];
                            $arraymin = [];
                            $arrayavg = [];
                        ?>
                        <tr>
                            <td rowspan="5">{{ $detalle->CodigoCliente }}</td>
                            <td>{{ date('d/m/Y', strtotime($detalle->datos_informacion[0]->Fecha)) }}</td>
                            <td>{{ substr($detalle->datos_informacion[0]->HoraInicio, 0, 5) }}</td>
                            <td>{{ substr($detalle->datos_informacion[0]->HoraFin, 0, 5) }}</td>
                            <td rowspan="5" colspan="2">{{ $detalle->datos_muestreo->PuestoTipo }}</td>
                            <td rowspan="5" colspan="2">{{ $detalle->datos_muestreo->TipoFuenteLuminica }}</td>
                            <td rowspan="5"rowspan="5" colspan="2">{{ $detalle->datos_muestreo->Iluminacion }}</td>
                            <td>{{ $detalle->datos_informacion[0]->NivelMaxLux }}</td>
                            <td>{{ $detalle->datos_informacion[0]->NivelMinLux }}</td>
                            <td>{{ $detalle->datos_informacion[0]->NivelAvgLux }}</td>
                            <?php 
                                array_push($arraymax, $detalle->datos_informacion[0]->NivelMaxLux);
                                array_push($arraymin, $detalle->datos_informacion[0]->NivelMinLux);
                                array_push($arrayavg, $detalle->datos_informacion[0]->NivelAvgLux);
                            ?>
                        </tr>
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($detalle->datos_informacion[1]->Fecha)) }}</td>
                            <td>{{ substr($detalle->datos_informacion[1]->HoraInicio, 0, 5) }}</td>
                            <td>{{ substr($detalle->datos_informacion[1]->HoraFin, 0, 5) }}</td>
                            <td>{{ $detalle->datos_informacion[1]->NivelMaxLux }}</td>
                            <td>{{ $detalle->datos_informacion[1]->NivelMinLux }}</td>
                            <td>{{ $detalle->datos_informacion[1]->NivelAvgLux }}</td>
                            <?php 
                                array_push($arraymax, $detalle->datos_informacion[1]->NivelMaxLux);
                                array_push($arraymin, $detalle->datos_informacion[1]->NivelMinLux);
                                array_push($arrayavg, $detalle->datos_informacion[1]->NivelAvgLux);
                            ?>
                        </tr>
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($detalle->datos_informacion[2]->Fecha)) }}</td>
                            <td>{{ substr($detalle->datos_informacion[2]->HoraInicio, 0, 5) }}</td>
                            <td>{{ substr($detalle->datos_informacion[2]->HoraFin, 0, 5) }}</td>
                            <td>{{ $detalle->datos_informacion[2]->NivelMaxLux }}</td>
                            <td>{{ $detalle->datos_informacion[2]->NivelMinLux }}</td>
                            <td>{{ $detalle->datos_informacion[2]->NivelAvgLux }}</td>
                            <?php 
                                array_push($arraymax, $detalle->datos_informacion[2]->NivelMaxLux);
                                array_push($arraymin, $detalle->datos_informacion[2]->NivelMinLux);
                                array_push($arrayavg, $detalle->datos_informacion[2]->NivelAvgLux);
                            ?>
                        </tr>
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($detalle->datos_informacion[3]->Fecha)) }}</td>
                            <td>{{ substr($detalle->datos_informacion[3]->HoraInicio, 0, 5) }}</td>
                            <td>{{ substr($detalle->datos_informacion[3]->HoraFin, 0, 5) }}</td>
                            <td>{{ $detalle->datos_informacion[3]->NivelMaxLux }}</td>
                            <td>{{ $detalle->datos_informacion[3]->NivelMinLux }}</td>
                            <td>{{ $detalle->datos_informacion[3]->NivelAvgLux }}</td>
                            <?php 
                                array_push($arraymax, $detalle->datos_informacion[3]->NivelMaxLux);
                                array_push($arraymin, $detalle->datos_informacion[3]->NivelMinLux);
                                array_push($arrayavg, $detalle->datos_informacion[3]->NivelAvgLux);
                            ?>
                        </tr>
                        <tr>
                            <td>{{ date('d/m/Y', strtotime($detalle->datos_informacion[4]->Fecha)) }}</td>
                            <td>{{ substr($detalle->datos_informacion[4]->HoraInicio, 0, 5) }}</td>
                            <td>{{ substr($detalle->datos_informacion[4]->HoraFin, 0, 5) }}</td>
                            <td>{{ $detalle->datos_informacion[4]->NivelMaxLux }}</td>
                            <td>{{ $detalle->datos_informacion[4]->NivelMinLux }}</td>
                            <td>{{ $detalle->datos_informacion[4]->NivelAvgLux }}</td>
                            <?php 
                                array_push($arraymax, $detalle->datos_informacion[4]->NivelMaxLux);
                                array_push($arraymin, $detalle->datos_informacion[4]->NivelMinLux);
                                array_push($arrayavg, $detalle->datos_informacion[4]->NivelAvgLux);
                            ?>
                        </tr>
                        <tr>
                            <td colspan="10"></td>
                            <td class="titulo texto-centrado color-celeste">Nivel Max (Lux)</td>
                            <td class="titulo texto-centrado color-celeste">Nivel Min (Lux)</td>
                            <td class="titulo texto-centrado color-celeste">Nivel AVG (Lux)</td>
                        </tr>
                        <tr>
                            <td colspan="10" class="titulo">Categorización para la evaluación de los niveles mínimos de Iluminación que deben observarse en  el  lugar de  trabajo: RM-375-2008-TR.</td>
                            <td>{!! max($arraymax) !!}</td>
                            <td>{!! min($arraymin) !!}</td>
                            <td>{!! round(array_sum($arrayavg) / count($arrayavg)) !!}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="titulo">Tarea Visual:</td>
                            <td colspan="11">{{ $detalle->datos_muestreo->TareaVisual }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="titulo">Del puesto del trabajo:</td>
                            <td colspan="11">{{ $detalle->datos_muestreo->PuestroTrabajo }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="titulo">Área de trabajo (Lux):</td>
                            <td colspan="8">{{ $detalle->datos_muestreo->AreaTrabajo }}</td>
                            <td colspan="2" class="titulo color-celeste texto-centrado">CONFORMIDAD</td>
                            <td>{!! (round(array_sum($arrayavg) / count($arrayavg))) >= $detalle->datos_muestreo->AreaTrabajo ? 'CONFORME' : 'NO CONFORME'  !!}</td>
                        </tr>
                        <tr>
                            <td colspan="13" class="separador sin-border"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="titulo">OBSERVACIONES POR ESTACIÓN:</td>
                            <td colspan="11">{{ $detalle->datos_muestreo->Observaciones }}</td>
                        </tr>
                        
        <?php } else { ?>

            <tr>
                <td colspan="13" class="separador sin-border"></td>
            </tr>
            <tr>
                <td colspan="13" class="titulo sin-border">DESCRIPCIÓN DE LA ACTIVIDAD DEL TRABAJADOR EXPUESTO</td>
            </tr>
            <tr>
                <td class="titulo texto-centrado color-celeste">Punto de Muestreo</td>
                <td class="titulo texto-centrado color-celeste">Fecha</td>
                <td class="titulo texto-centrado color-celeste">Hora de inicio</td>
                <td class="titulo texto-centrado color-celeste">Hora final</td>
                <td colspan="2" class="titulo texto-centrado color-celeste">Sección / Puesto / Puesto Tipo</td>
                <td colspan="2" class="titulo texto-centrado color-celeste">Tipo de Fuente Luminica</td>
                <td colspan="2" class="titulo texto-centrado color-celeste">Iluminación: General / Localizada / Mixta</td>
                <td class="titulo texto-centrado color-celeste">Nivel Max (Lux)</td>
                <td class="titulo texto-centrado color-celeste">Nivel Min (Lux)</td>
                <td class="titulo texto-centrado color-celeste">Nivel AVG (Lux)</td>
            </tr>
            <?php 
                $arraymax = [];
                $arraymin = [];
                $arrayavg = [];
            ?>
            <tr>
                <td rowspan="5">{{ $detalle->CodigoCliente }}</td>
                <td>{{ date('d/m/Y', strtotime($detalle->datos_informacion[0]->Fecha)) }}</td>
                <td>{{ substr($detalle->datos_informacion[0]->HoraInicio, 0, 5) }}</td>
                <td>{{ substr($detalle->datos_informacion[0]->HoraFin, 0, 5) }}</td>
                <td rowspan="5" colspan="2">{{ $detalle->datos_muestreo->PuestoTipo }}</td>
                <td rowspan="5" colspan="2">{{ $detalle->datos_muestreo->TipoFuenteLuminica }}</td>
                <td rowspan="5"rowspan="5" colspan="2">{{ $detalle->datos_muestreo->Iluminacion }}</td>
                <td>{{ $detalle->datos_informacion[0]->NivelMaxLux }}</td>
                <td>{{ $detalle->datos_informacion[0]->NivelMinLux }}</td>
                <td>{{ $detalle->datos_informacion[0]->NivelAvgLux }}</td>
                <?php 
                    array_push($arraymax, $detalle->datos_informacion[0]->NivelMaxLux);
                    array_push($arraymin, $detalle->datos_informacion[0]->NivelMinLux);
                    array_push($arrayavg, $detalle->datos_informacion[0]->NivelAvgLux);
                ?>
            </tr>
            <tr>
                <td>{{ date('d/m/Y', strtotime($detalle->datos_informacion[1]->Fecha)) }}</td>
                <td>{{ substr($detalle->datos_informacion[1]->HoraInicio, 0, 5) }}</td>
                <td>{{ substr($detalle->datos_informacion[1]->HoraFin, 0, 5) }}</td>
                <td>{{ $detalle->datos_informacion[1]->NivelMaxLux }}</td>
                <td>{{ $detalle->datos_informacion[1]->NivelMinLux }}</td>
                <td>{{ $detalle->datos_informacion[1]->NivelAvgLux }}</td>
                <?php 
                    array_push($arraymax, $detalle->datos_informacion[1]->NivelMaxLux);
                    array_push($arraymin, $detalle->datos_informacion[1]->NivelMinLux);
                    array_push($arrayavg, $detalle->datos_informacion[1]->NivelAvgLux);
                ?>
            </tr>
            <tr>
                <td>{{ date('d/m/Y', strtotime($detalle->datos_informacion[2]->Fecha)) }}</td>
                <td>{{ substr($detalle->datos_informacion[2]->HoraInicio, 0, 5) }}</td>
                <td>{{ substr($detalle->datos_informacion[2]->HoraFin, 0, 5) }}</td>
                <td>{{ $detalle->datos_informacion[2]->NivelMaxLux }}</td>
                <td>{{ $detalle->datos_informacion[2]->NivelMinLux }}</td>
                <td>{{ $detalle->datos_informacion[2]->NivelAvgLux }}</td>
                <?php 
                    array_push($arraymax, $detalle->datos_informacion[2]->NivelMaxLux);
                    array_push($arraymin, $detalle->datos_informacion[2]->NivelMinLux);
                    array_push($arrayavg, $detalle->datos_informacion[2]->NivelAvgLux);
                ?>
            </tr>
            <tr>
                <td>{{ date('d/m/Y', strtotime($detalle->datos_informacion[3]->Fecha)) }}</td>
                <td>{{ substr($detalle->datos_informacion[3]->HoraInicio, 0, 5) }}</td>
                <td>{{ substr($detalle->datos_informacion[3]->HoraFin, 0, 5) }}</td>
                <td>{{ $detalle->datos_informacion[3]->NivelMaxLux }}</td>
                <td>{{ $detalle->datos_informacion[3]->NivelMinLux }}</td>
                <td>{{ $detalle->datos_informacion[3]->NivelAvgLux }}</td>
                <?php 
                    array_push($arraymax, $detalle->datos_informacion[3]->NivelMaxLux);
                    array_push($arraymin, $detalle->datos_informacion[3]->NivelMinLux);
                    array_push($arrayavg, $detalle->datos_informacion[3]->NivelAvgLux);
                ?>
            </tr>
            <tr>
                <td>{{ date('d/m/Y', strtotime($detalle->datos_informacion[4]->Fecha)) }}</td>
                <td>{{ substr($detalle->datos_informacion[4]->HoraInicio, 0, 5) }}</td>
                <td>{{ substr($detalle->datos_informacion[4]->HoraFin, 0, 5) }}</td>
                <td>{{ $detalle->datos_informacion[4]->NivelMaxLux }}</td>
                <td>{{ $detalle->datos_informacion[4]->NivelMinLux }}</td>
                <td>{{ $detalle->datos_informacion[4]->NivelAvgLux }}</td>
                <?php 
                    array_push($arraymax, $detalle->datos_informacion[4]->NivelMaxLux);
                    array_push($arraymin, $detalle->datos_informacion[4]->NivelMinLux);
                    array_push($arrayavg, $detalle->datos_informacion[4]->NivelAvgLux);
                ?>
            </tr>
            <tr>
                <td colspan="10"></td>
                <td class="titulo texto-centrado color-celeste">Nivel Max (Lux)</td>
                <td class="titulo texto-centrado color-celeste">Nivel Min (Lux)</td>
                <td class="titulo texto-centrado color-celeste">Nivel AVG (Lux)</td>
            </tr>
            <tr>
                <td colspan="10" class="titulo">Categorización para la evaluación de los niveles mínimos de Iluminación que deben observarse en  el  lugar de  trabajo: RM-375-2008-TR.</td>
                <td>{!! max($arraymax) !!}</td>
                <td>{!! min($arraymin) !!}</td>
                <td>{!! round(array_sum($arrayavg) / count($arrayavg)) !!}</td>
            </tr>
            <tr>
                <td colspan="2" class="titulo">Tarea Visual:</td>
                <td colspan="11">{{ $detalle->datos_muestreo->TareaVisual }}</td>
            </tr>
            <tr>
                <td colspan="2" class="titulo">Del puesto del trabajo:</td>
                <td colspan="11">{{ $detalle->datos_muestreo->PuestroTrabajo }}</td>
            </tr>
            <tr>
                <td colspan="2" class="titulo">Área de trabajo (Lux):</td>
                <td colspan="8">{{ $detalle->datos_muestreo->AreaTrabajo }}</td>
                <td colspan="2" class="titulo color-celeste texto-centrado">CONFORMIDAD</td>
                <td>{!! (round(array_sum($arrayavg) / count($arrayavg))) >= $detalle->datos_muestreo->AreaTrabajo ? 'CONFORME' : 'NO CONFORME'  !!}</td>
            </tr>
            <tr>
                <td colspan="13" class="separador sin-border"></td>
            </tr>
            <tr>
                <td colspan="2" class="titulo">OBSERVACIONES POR ESTACIÓN:</td>
                <td colspan="11">{{ $detalle->datos_muestreo->Observaciones }}</td>
            </tr>

        <?php } ?>

        <?php if ($cant_registro_actual == $registros_x_hoja) { ?>
                    </tbody> 
                </table>
            </body>
        <?php } ?>
        <?php $cant_registro_actual += 1; ?>

        <?php if ($cant_registro_actual > $registros_x_hoja) { ?>
            <?php $cant_registro_actual = 1; ?>
            <?php if ($key + 1 !== count($detalles)) { ?>
                <div style="page-break-after:always;"></div>
            <?php } ?>
        <?php } ?>

    <?php } ?>

</html>