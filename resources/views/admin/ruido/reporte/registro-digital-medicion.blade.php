<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>REGISTRO DIGITAL DE MEDICIÓN DE RUIDO AMBIENTAL</title>

    <style>
       
       /* @page { margin: 10; } */

       body {
            font-size: 11px;
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
            height: 16px;
        }
        .rowspan {
            border-left-width: 10px;
        }
        .tituloCabecera {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
        .titulo {
            font-weight: bold;
            //text-align: center;
        }
        .tituloGrande {
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
            text-align: right;
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

    </style>
</head>

<?php $currentdetalle = 0; ?>
<?php $indice = 0; ?>


    <header>
        <table class="header">
            <tr>
                <td rowspan="4" style="width: 20%;">
                    <img src="{{ public_path() . '\assets\img\logo-sag-azul.png'; }}" alt="" style="height: 50px;">
                </td>
                <td rowspan="4" class="tituloCabecera">REGISTRO DIGITAL DE MEDICIÓN DE RUIDO AMBIENTAL</td>
                <td style="width: 10%;" class="texto-derecha">FM-094</td>
            </tr>
            <tr>
                <td class="texto-derecha">Versión: 03</td>
            </tr>
            <tr>
                <td class="texto-derecha">F.E.: 09/2022</td>
            </tr>
            <tr>
                <td class="texto-derecha">Página 1 de 1</td>
            </tr>
        </table>
    </header>

    <body>
        <table class="cabecera">
            <tbody>
                <tr>
                    <td colspan="6" class="tituloGrande">INFORME DE ENSAYO Nº </td>
                    <td colspan="8">{{ $cabecera->NumeroInforme }}</td>
                </tr>
                <tr>
                    <td colspan="14" class="titulo">INFORME DE ENSAYO Nº {{ $cabecera->NumeroInforme }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="titulo">CLIENTE:</td>
                    <td colspan="8">{{ $cabecera->Cliente }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="titulo">NOMBRE DEL CLIENTE:</td>
                    <td colspan="8">{{ $cabecera->NombreCliente }}</td>
                </tr>
                <tr>
                    <td colspan="14" class="tituloGrande">MEDICIÓN DE RUIDO AMBIENTAL - PERÍODO {{ $cabecera->Periodo }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="titulo">ESTACIÓN DE MONITOREO:</td>
                    <td colspan="8">{{ $cabecera->CodigoCliente }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="titulo">Descripción del punto de Monitoreo</td>
                    <td colspan="8">{{ $cabecera->DescripcionPuntoMuestreo }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="titulo">Fecha de Medición</td>
                    <td colspan="8">{{ $cabecera->FechaMedicion }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="titulo">Hora de Medición</td>
                    <td colspan="8">{{ $cabecera->HoraMedicion }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="titulo">Zona de aplicación</td>
                    <td colspan="8">{{ $cabecera->ZonaAplicacion }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="titulo">Código de laboratorio</td>
                    <td colspan="8">{{ $cabecera->CodigoLaboratorio }}</td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="2" class="titulo">Coordenadas: {{ $cabecera->GeoferenciaSistema }} {{ $cabecera->GeoferenciaBanda }} {{ $cabecera->GeoferenciaZona }}</td>
                    <td rowspan="3" colspan="2"><span>E:</span> {{ $cabecera->GeoferenciaUtmEste }}</td>
                    <td rowspan="3" colspan="2"><span>N:</span> {{ $cabecera->GeoferenciaUtmNorte }}</td>
                    <td rowspan="3">{{ $cabecera->Altitud }}</td>
                    <td rowspan="3" colspan="2" class="titulo">Intervalo de medición (min)</td>
                    <td rowspan="3">00:01</td>
                    <td colspan="3" class="titulo">Altura de la fuente hs (m):</td>
                    <td>{{ $cabecera->AlturaFuente }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="titulo">Altura del micrófono hr (m):</td>
                    <td>{{ $cabecera->AlturaMicrofono }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="titulo">Distancia desde la fuente (m):</td>
                    <td>{{ $cabecera->DistanciaFuente }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="titulo">Equipo de Medición Sonómetro</td>
                    <td colspan="2" class="titulo">{{ $cabecera->CodigoEquipoSonometro }}</td>
                    <td colspan="8">{{ $cabecera->DetalleEquipoSonometro }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="titulo">Calibrador Acústico 1000 Hz o 114 Db</td>
                    <td colspan="2" class="titulo">{{ $cabecera->CodigoEquipoCalibrador }}</td>
                    <td colspan="8">{{ $cabecera->DetalleEquipoCalibrador }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="titulo">Verificación pre muestreo</td>
                    <td class="titulo">NPS Leq</td>
                    <td>{{ $cabecera->Inicial }}</td>
                    <td rowspan="2" colspan="2" class="titulo">Valor de referencia dB</td>
                    <td rowspan="2">{{ $cabecera->ValorReferencia }}</td>
                    <td rowspan="2" colspan="2" class="titulo">Tolerancia db</td>
                    <td rowspan="2">{{ $cabecera->Tolerancia }}</td>
                    <td rowspan="2" class="titulo">Estado</td>
                    <td rowspan="2" colspan="2">{{ $cabecera->Estado }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="titulo">Verificación post muestreo</td>
                    <td class="titulo">NPS Leq</td>
                    <td>{{ $cabecera->Final }}</td>
                </tr>
                <tr>
                    <td colspan="14" class="tituloGrande">INFORMACIÓN SOBRE LOS RESULTADOS DE LA MEDICIÓN </td>
                </tr>
                <tr>
                    <td rowspan="2" colspan="2" >Tipos de ruido</td>
                    <td rowspan="2" colspan="2" >Nivel de presión sonora</td>
                    <td colspan="10">Número de muestras</td>
                </tr>
                <tr>
                    <td>L1</td>
                    <td>L2</td>
                    <td>L3</td>
                    <td>L4</td>
                    <td>L5</td>
                    <td>L6</td>
                    <td>L7</td>
                    <td>L8</td>
                    <td>L9</td>
                    <td>L10</td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="2">Nivel de Ruido total</td>
                    <td colspan="2">LA Max</td>
                    <td>{{ $detalle[0]->RTLAMax }}</td>
                    <td>{{ $detalle[1]->RTLAMax }}</td>
                    <td>{{ $detalle[2]->RTLAMax }}</td>
                    <td>{{ $detalle[3]->RTLAMax }}</td>
                    <td>{{ $detalle[4]->RTLAMax }}</td>
                    <td>{{ $detalle[5]->RTLAMax }}</td>
                    <td>{{ $detalle[6]->RTLAMax }}</td>
                    <td>{{ $detalle[7]->RTLAMax }}</td>
                    <td>{{ $detalle[8]->RTLAMax }}</td>
                    <td>{{ $detalle[9]->RTLAMax }}</td>
                </tr>
                <tr>
                    <td colspan="2">LA Min</td>
                    <td>{{ $detalle[0]->RTLAMin }}</td>
                    <td>{{ $detalle[1]->RTLAMin }}</td>
                    <td>{{ $detalle[2]->RTLAMin }}</td>
                    <td>{{ $detalle[3]->RTLAMin }}</td>
                    <td>{{ $detalle[4]->RTLAMin }}</td>
                    <td>{{ $detalle[5]->RTLAMin }}</td>
                    <td>{{ $detalle[6]->RTLAMin }}</td>
                    <td>{{ $detalle[7]->RTLAMin }}</td>
                    <td>{{ $detalle[8]->RTLAMin }}</td>
                    <td>{{ $detalle[9]->RTLAMin }}</td>
                </tr>
                <tr>
                    <td colspan="2">LA eq</td>
                    <td>{{ $detalle[0]->RTLAEq }}</td>
                    <td>{{ $detalle[1]->RTLAEq }}</td>
                    <td>{{ $detalle[2]->RTLAEq }}</td>
                    <td>{{ $detalle[3]->RTLAEq }}</td>
                    <td>{{ $detalle[4]->RTLAEq }}</td>
                    <td>{{ $detalle[5]->RTLAEq }}</td>
                    <td>{{ $detalle[6]->RTLAEq }}</td>
                    <td>{{ $detalle[7]->RTLAEq }}</td>
                    <td>{{ $detalle[8]->RTLAEq }}</td>
                    <td>{{ $detalle[9]->RTLAEq }}</td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="2">Nivel percentil  LN,T</td>
                    <td colspan="2">L 50</td>
                    <td>{{ $detalle[0]->NPL50 }}</td>
                    <td>{{ $detalle[1]->NPL50 }}</td>
                    <td>{{ $detalle[2]->NPL50 }}</td>
                    <td>{{ $detalle[3]->NPL50 }}</td>
                    <td>{{ $detalle[4]->NPL50 }}</td>
                    <td>{{ $detalle[5]->NPL50 }}</td>
                    <td>{{ $detalle[6]->NPL50 }}</td>
                    <td>{{ $detalle[7]->NPL50 }}</td>
                    <td>{{ $detalle[8]->NPL50 }}</td>
                    <td>{{ $detalle[9]->NPL50 }}</td>
                </tr>
                <tr>
                    <td colspan="2">L 90</td>
                    <td>{{ $detalle[0]->NPL90 }}</td>
                    <td>{{ $detalle[1]->NPL90 }}</td>
                    <td>{{ $detalle[2]->NPL90 }}</td>
                    <td>{{ $detalle[3]->NPL90 }}</td>
                    <td>{{ $detalle[4]->NPL90 }}</td>
                    <td>{{ $detalle[5]->NPL90 }}</td>
                    <td>{{ $detalle[6]->NPL90 }}</td>
                    <td>{{ $detalle[7]->NPL90 }}</td>
                    <td>{{ $detalle[8]->NPL90 }}</td>
                    <td>{{ $detalle[9]->NPL90 }}</td>
                </tr>
                <tr>
                    <td colspan="2">L 95</td>
                    <td>{{ $detalle[0]->NPL95 }}</td>
                    <td>{{ $detalle[1]->NPL95 }}</td>
                    <td>{{ $detalle[2]->NPL95 }}</td>
                    <td>{{ $detalle[3]->NPL95 }}</td>
                    <td>{{ $detalle[4]->NPL95 }}</td>
                    <td>{{ $detalle[5]->NPL95 }}</td>
                    <td>{{ $detalle[6]->NPL95 }}</td>
                    <td>{{ $detalle[7]->NPL95 }}</td>
                    <td>{{ $detalle[8]->NPL95 }}</td>
                    <td>{{ $detalle[9]->NPL95 }}</td>
                </tr>
                <tr>
                    <td colspan="2">Nivel del ruido residual</td>
                    <td colspan="2">LA eq (Res)</td>
                    <td>{{ $detalle[0]->RRLAEq }}</td>
                    <td>{{ $detalle[1]->RRLAEq }}</td>
                    <td>{{ $detalle[2]->RRLAEq }}</td>
                    <td>{{ $detalle[3]->RRLAEq }}</td>
                    <td>{{ $detalle[4]->RRLAEq }}</td>
                    <td>{{ $detalle[5]->RRLAEq }}</td>
                    <td>{{ $detalle[6]->RRLAEq }}</td>
                    <td>{{ $detalle[7]->RRLAEq }}</td>
                    <td>{{ $detalle[8]->RRLAEq }}</td>
                    <td>{{ $detalle[9]->RRLAEq }}</td>
                </tr>
                <tr>
                    <td colspan="11" class="titulo">Nivel Máximo ponderado en frecuencia "A" y tiempo Slow "S" LAmáx  dB(A):</td>
                    <td colspan="3" class="titulo">{{ $cabecera->TotalLaMax }}</td>
                </tr>
                <tr>
                    <td colspan="11" class="titulo">Nivel Mínimo ponderado en frecuencia "A" y tiempo Slow "S" LAmín  dB(A):</td>
                    <td colspan="3" class="titulo">{{ $cabecera->TotalLaMin }}</td>
                </tr>
                <tr>
                    <td colspan="11" class="titulo">Nivel equivalente ponderado en frecuencia "A" y tiempo Slow "S" Laeq,T  dB(A):</td>
                    <td colspan="3" class="titulo">{{ $cabecera->TotalLaEq }}</td>
                </tr>
                <tr>
                    <td colspan="11" class="titulo">Incertidumbre expandida de medición al 95% de confianza asociado al factor de cobertura k=2 (+/-) dB:</td>
                    <td colspan="3" class="titulo">{{ $cabecera->IncertidumbreExpandida }}</td>
                </tr>
                <tr>
                    <td colspan="11" class="titulo">Nivel de presión sonora continuo equivalente  LAeqT , Corregido por el nivel de ruido residual dB(A):</td>
                    <td colspan="3" class="titulo">{{ $cabecera->LaEqTCorregido }}</td>
                </tr>
                <tr>
                    <td colspan="14" class="titulo">Descripción de las condiciones Meteorológicas</td>
                </tr>
                <tr>
                    <td colspan="2" class="titulo">Periodos de medición</td>
                    <td colspan="2" class="titulo">Horas</td>
                    <td colspan="2" class="titulo">Velocidad de viento (m/s) Promedio</td>
                    <td colspan="2" class="titulo">Dirección del viento Promedio</td>
                    <td colspan="2" class="titulo">Temperatura ambiental (°C) Promedio</td>
                    <td colspan="2" class="titulo">Presión atmosférica (mbar) Promedio</td>
                    <td colspan="2" class="titulo">Humedad relativa (%) Promedio</td>
                </tr>
                <tr>
                    <td colspan="2">Antes de la medición</td>
                    <td colspan="2">{{ $cabecera->HoraMedicionAntes}}</td>
                    <td colspan="2">{{ $cabecera->VelocidadVientoAntesMedicion }}</td>
                    <td colspan="2">{{ $cabecera->DireccionVientoAntesMedicion }}</td>
                    <td colspan="2">{{ $cabecera->TemperaturaAmbientalAntesMedicion }}</td>
                    <td colspan="2">{{ $cabecera->PresionAtmosfericaAntesMedicion }}</td>
                    <td colspan="2">{{ $cabecera->HumedadRelativaAntesMedicion }}</td>
                </tr>
                <tr>
                    <td colspan="2">Durante la medición</td>
                    <td colspan="2">{{ $cabecera->HoraMedicion }}</td>
                    <td colspan="2">{{ $cabecera->VelocidadVientoDuranteMedicion }}</td>
                    <td colspan="2">{{ $cabecera->DireccionVientoDuranteMedicion }}</td>
                    <td colspan="2">{{ $cabecera->TemperaturaAmbientalDuranteMedicion }}</td>
                    <td colspan="2">{{ $cabecera->PresionAtmosfericaDuranteMedicion }}</td>
                    <td colspan="2">{{ $cabecera->HumedadRelativaDuranteMedicion }}</td>
                </tr>
                <tr>
                    <td colspan="14" class="tituloGrande">Descripción detallada del lugar de medición, que incluya la cubierta y condición del suelo, y las  ubicaciones, incluyendo la altura por encima del suelo y de la fuente </td>
                </tr>
                <tr>
                    <td colspan="14">{{ $cabecera->DescripcionLugarMedicion }}</td>
                </tr>
                <tr>
                    <td colspan="14" class="tituloGrande">Descripción de las condiciones de operación:</td>
                </tr>
                <tr>
                    <td colspan="14">{{ $cabecera->DescripcionCondiciones }}</td>
                </tr>
            </tbody>
        </table>
    </body>

    

    
    


</html>