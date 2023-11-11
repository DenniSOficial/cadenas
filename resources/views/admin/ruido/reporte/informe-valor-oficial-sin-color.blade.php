<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>INFORME DE ENSAYO N° {{ $cabecera->Informe }} CON VALOR OFICIAL</title>

    <style>
       
        @page { 
            margin-top: 3.5cm; 
            margin-bottom: 2.5cm;
            margin-right: 1.3cm;
            margin-left: 2cm;
        }
      
        @font-face {
            font-family: 'Jost';
            font-weight: normal;
            font-style: normal;
            src: url('http://localhost/saglaboratorio/public/fonts/Jost-Regular.ttf') format('truetype');
        }

        @font-face {
            font-family: 'Jost-Bold';
            font-weight: normal;
            font-style: normal;
            src: url('http://localhost/saglaboratorio/public/fonts/Jost-Bold.ttf') format('truetype');
        }

        * {
            font-family: 'Jost';
        }

       body {
            font-size: 8px !important;
       }
       table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
            table-layout: fixed;
            font-size: 8px;
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

        td.texto-vertical {
            //writing-mode: vertical-lr;
            //transform: rotate(180deg);
        }
        td {
            vertical-align: middle;
            line-height: 90%;
        }
        
        .rowspan {
            border-left-width: 10px;
        }
        .tituloCabecera {
            font-family: 'Jost-Bold' !important;
            font-size: 16px;
            text-align: center;
            margin-right: 10rem;
            margin-left: 12rem;
            line-height: 90%
        }
        .titulo {
            font-family: 'Jost-Bold' !important;
            text-align: left;
        }
        .tituloGrande {
            font-family: 'Jost-Bold' !important;
            font-size: 8px;
            margin-bottom: 1rem;
        }
        .separador {
            height: 10px;
        }

        .headt td {
            height: 14px;
        }

        .headfo td {
            height: 11px;
            padding-bottom: 0.3rem;
            padding-top: 0.3rem;
        }

        .texto-izquierda {
            text-align: left !important;
        }

        .texto-derecha {
            text-align: right !important;
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
        footer { 
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px; 
            text-align: right;
            height: 50px; 
        }
        .pagenum:before {
        content: counter(page);
        }
        .color-celeste {
            /* background-color: #DAEEF3; */
        }
        .color-gris {
            /* background-color: #D9D9D9; */
        }
        .con-border {
            border: 1px solid black;
        }
    </style>
</head>

<?php $currentdetalle = 0; ?>
<?php $indice = 0; ?>

<footer>
    Página <span style="font-weight: normal;" class="pagenum"></span> de {{ $cabecera->Paginas + 1 }}
</footer>

    <body>

        <div class="tituloCabecera" style="padding-top: 2rem; padding-bottom: 1rem;">
            INFORME DE ENSAYO N° {{ $cabecera->Informe }} CON VALOR OFICIAL
        </div>

        <table>
            <tbody>
                <tr>
                    <td style="width: 35%;"></td>
                    <td></td>
                    <td style="width: 15%;"></td>
                </tr>
                <tr>
                    <td class="titulo">RAZÓN SOCIAL</td>
                    <td colspan="2">: {{ $cabecera->RazonSocial }}</td>
                </tr>
                <tr>
                    <td class="titulo">DOMICILIO LEGAL</td>
                    <td colspan="2">: {{ $cabecera->Domicilio }}</td>
                </tr>
                <tr>
                    <td class="titulo">SOLICITADO POR</td>
                    <td colspan="2">: {{ $cabecera->Contacto }}</td>
                </tr>
                <tr>
                    <td class="titulo">REFERENCIA</td>
                    <td colspan="2">: {{ $cabecera->Referencia }}</td>
                </tr>
                <tr>
                    <td class="titulo">PROCEDENCIA</td>
                    <td colspan="2">: {{ $cabecera->Procedencia }}</td>
                </tr>
                <tr>
                    <td class="titulo">FECHA DE RECEPCIÓN DE MUESTRAS</td>
                    <td colspan="2">: {{ $cabecera->FechaRecepcionMuestra }}</td>
                </tr>
                <tr>
                    <td class="titulo">FECHA(S) DE MUESTREO Y/O MEDICIÓN</td>
                    <td colspan="2">: {{ $cabecera->FechaMuestreoMedicion }}</td>
                </tr>
                <tr>
                    <td class="titulo">MUESTREADO POR</td>
                    <td colspan="2">: {{ $cabecera->Muestreado }}</td>
                </tr>
                <tr  >
                   <td style="height: 50px;" colspan="3" class="titulo">I. METODOLOGÍA DE ENSAYO:</td> 
                </tr>
                <tr>
                    <td class="color-celeste con-border texto-centrado">Ensayo</td>
                    <td class="color-celeste con-border texto-centrado">Método</td>
                    <td class="color-celeste con-border texto-centrado">Unidades</td>
                </tr>
                <tr>
                    <td class="con-border texto-centrado">{{ $cabecera->Ensayo }}</td>
                    <td class="con-border texto-centrado" style="padding-top: 1rem; padding-bottom: 1rem;">{{ $cabecera->Metodo }}</td>
                    <td class="con-border texto-centrado">{{ $cabecera->Unidad }}</td>
                </tr>
                <tr>
                    <?php
                    
                    $array = explode('-', $cabecera->Informe);
                                            
                    ?>
                    <td colspan="3">(1) Toma de muestra de acuerdo a plan de muestreo Nº {{ $array[0] }} y procedimiento PL-039.</td>
                </tr>
            </tbody>
        </table>
        
            <?php $total = count($detalle); ?>
            <?php $inicio = 1; ?>
            @foreach ($detalle as $item)

            
            <div style="page-break-after:always;"></div>

            <div class="tituloCabecera">
                INFORME DE ENSAYO N° {{ $cabecera->Informe }} CON VALOR OFICIAL
            </div>
            
            <div class="tituloGrande">
                II. RESULTADOS
            </div>

            <table class="cabecera">    
                <tbody>
                    <!-- Inicio -->
                    @if ($cabecera->Acreditado != 'IAS')
                        <tr>
                            <td colspan="14" class="tituloGrande color-celeste"> MEDICIÓN ACREDITADA ANTE INACAL-DA (SEDE LIMA 1) </td>
                        </tr>    
                    @endif
                    
                    <tr>
                        <td colspan="14" class="tituloGrande color-celeste">MEDICIÓN DE RUIDO AMBIENTAL - PERÍODO {{ $item->Periodo }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="titulo color-celeste texto-izquierda">ESTACIÓN DE MONITOREO:</td>
                        <td colspan="8" class="texto-izquierda">{{ $item->CodigoCliente }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="titulo color-celeste texto-izquierda">Descripción del punto de Monitoreo</td>
                        <td colspan="8" class="texto-izquierda">{{ $item->DescripcionPuntoMuestreo }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="titulo color-celeste texto-izquierda">Fecha de Medición</td>
                        <td colspan="8" class="texto-izquierda">{{ $item->FechaMedicion }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="titulo color-celeste texto-izquierda">Hora de Medición</td>
                        <td colspan="8" class="texto-izquierda">{{ $item->HoraMedicion }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="titulo color-celeste texto-izquierda">Zona de aplicación</td>
                        <td colspan="8" class="texto-izquierda">{{ $item->ZonaAplicacion }}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="titulo color-celeste texto-izquierda">Código de laboratorio</td>
                        <td colspan="8" class="texto-izquierda">{{ $item->CodigoLaboratorio }}</td>
                    </tr>
                    <tr>
                        <td colspan="14" class="tituloGrande color-celeste">INFORMACIÓN SOBRE UBICACIÓN DE LA ESTACIÓN DE MONITOREO Y POSICIONAMIENTO DEL MICRÓFONO</td>
                    </tr>
                    <tr>
                        <td rowspan="3" colspan="2" class="titulo color-celeste">Coordenadas: {{ $item->GeoferenciaSistema }} {{ $item->GeoferenciaBanda }} {{ $item->GeoferenciaZona }}</td>
                        <td rowspan="3" colspan="2"><span>E:</span> {{ $item->GeoferenciaUtmEste }}</td>
                        <td rowspan="3" colspan="2"><span>N:</span> {{ $item->GeoferenciaUtmNorte }}</td>
                        <td rowspan="3">{{ $item->Altitud }}</td>
                        <td rowspan="3" colspan="2" class="titulo color-celeste">Intervalo de medición (min)</td>
                        <td rowspan="3">00:01</td>
                        <td colspan="3" class="titulo color-celeste">Altura de la fuente hs (m):</td>
                        <td>{{ $item->AlturaFuente }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="titulo color-celeste">Altura del micrófono hr (m):</td>
                        <td>{{ $item->AlturaMicrofono }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="titulo color-celeste">Distancia desde la fuente (m):</td>
                        <td>{{ $item->DistanciaFuente }}</td>
                    </tr>
                    <tr>
                        <td colspan="14" class="tituloGrande color-celeste">INFORMACIÓN SOBRE EL EQUIPO Y PATRÓN UTILIZADO PARA LA MEDICIÓN</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="titulo color-celeste">Equipo de Medición Sonómetro</td>
                        <td colspan="2" class="titulo color-celeste">{{ $item->CodigoEquipoSonometro }}</td>
                        <td colspan="8">{{ $item->DetalleEquipoSonometro }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="titulo color-celeste">Calibrador Acústico 1000 Hz o 114 dB</td>
                        <td colspan="2" class="titulo color-celeste">{{ $item->CodigoEquipoCalibrador }}</td>
                        <td colspan="8">{{ $item->DetalleEquipoCalibrador }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="titulo color-celeste">Verificación pre muestreo</td>
                        <td class="titulo color-celeste">NPS Leq</td>
                        <td>{{ $item->Inicial }}</td>
                        <td rowspan="2" colspan="2" class="titulo color-celeste">Valor de referencia dB</td>
                        <td rowspan="2">{{ $item->ValorReferencia }}</td>
                        <td rowspan="2" colspan="2" class="titulo color-celeste">Tolerancia dB</td>
                        <td rowspan="2">{{ number_format($item->Tolerancia, 1) }}</td>
                        <td rowspan="2" class="titulo color-celeste">Estado</td>
                        <td rowspan="2" colspan="2">{{ $item->Estado }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="tituloGrande color-celeste">Verificación post muestreo</td>
                        <td class="titulo color-celeste">NPS Leq</td>
                        <td>{{ $item->Final }}</td>
                    </tr>
                    <tr>
                        <td colspan="14" class="tituloGrande color-celeste">INFORMACIÓN SOBRE LOS RESULTADOS DE LA MEDICIÓN </td>
                    </tr>
                    <tr>
                        <td rowspan="2" colspan="2" class="color-celeste" >Tipos de ruido</td>
                        <td rowspan="2" colspan="2" class="color-celeste">Nivel de presión sonora</td>
                        <td colspan="10" class="color-celeste">Número de muestras</td>
                    </tr>
                    <tr>
                        <td class="color-celeste">L1</td>
                        <td class="color-celeste">L2</td>
                        <td class="color-celeste">L3</td>
                        <td class="color-celeste">L4</td>
                        <td class="color-celeste">L5</td>
                        <td class="color-celeste">L6</td>
                        <td class="color-celeste">L7</td>
                        <td class="color-celeste">L8</td>
                        <td class="color-celeste">L9</td>
                        <td class="color-celeste">L10</td>
                    </tr>
                    <tr>
                        <td rowspan="3" colspan="2" class="color-celeste">Nivel de Ruido total</td>
                        <td colspan="2" class="color-celeste">LA Max</td>
                        <td>{{ $item->RtLaMax_1 }}</td>
                        <td>{{ $item->RtLaMax_2 }}</td>
                        <td>{{ $item->RtLaMax_3 }}</td>
                        <td>{{ $item->RtLaMax_4 }}</td>
                        <td>{{ $item->RtLaMax_5 }}</td>
                        <td>{{ $item->RtLaMax_6 }}</td>
                        <td>{{ $item->RtLaMax_7 }}</td>
                        <td>{{ $item->RtLaMax_8 }}</td>
                        <td>{{ $item->RtLaMax_9 }}</td>
                        <td>{{ $item->RtLaMax_10 }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="color-celeste">LA Min</td>
                        <td>{{ $item->RtLaMin_1 }}</td>
                        <td>{{ $item->RtLaMin_2 }}</td>
                        <td>{{ $item->RtLaMin_3 }}</td>
                        <td>{{ $item->RtLaMin_4 }}</td>
                        <td>{{ $item->RtLaMin_5 }}</td>
                        <td>{{ $item->RtLaMin_6 }}</td>
                        <td>{{ $item->RtLaMin_7 }}</td>
                        <td>{{ $item->RtLaMin_8 }}</td>
                        <td>{{ $item->RtLaMin_9 }}</td>
                        <td>{{ $item->RtLaMin_10 }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="color-celeste">LA eq</td>
                        <td>{{ $item->RtLeq_1 }}</td>
                        <td>{{ $item->RtLeq_2 }}</td>
                        <td>{{ $item->RtLeq_3 }}</td>
                        <td>{{ $item->RtLeq_4 }}</td>
                        <td>{{ $item->RtLeq_5 }}</td>
                        <td>{{ $item->RtLeq_6 }}</td>
                        <td>{{ $item->RtLeq_7 }}</td>
                        <td>{{ $item->RtLeq_8 }}</td>
                        <td>{{ $item->RtLeq_9 }}</td>
                        <td>{{ $item->RtLeq_10 }}</td>
                    </tr>
                    <tr>
                        <td rowspan="3" colspan="2" class="color-celeste">Nivel percentil  LN,T</td>
                        <td colspan="2" class="color-celeste">L 50</td>
                        <td>{{ $item->Npl50_1 }}</td>
                        <td>{{ $item->Npl50_2 }}</td>
                        <td>{{ $item->Npl50_3 }}</td>
                        <td>{{ $item->Npl50_4 }}</td>
                        <td>{{ $item->Npl50_5 }}</td>
                        <td>{{ $item->Npl50_6 }}</td>
                        <td>{{ $item->Npl50_7 }}</td>
                        <td>{{ $item->Npl50_8 }}</td>
                        <td>{{ $item->Npl50_9 }}</td>
                        <td>{{ $item->Npl50_10 }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="color-celeste">L 90</td>
                        <td>{{ $item->Npl90_1 }}</td>
                        <td>{{ $item->Npl90_2 }}</td>
                        <td>{{ $item->Npl90_3 }}</td>
                        <td>{{ $item->Npl90_4 }}</td>
                        <td>{{ $item->Npl90_5 }}</td>
                        <td>{{ $item->Npl90_6 }}</td>
                        <td>{{ $item->Npl90_7 }}</td>
                        <td>{{ $item->Npl90_8 }}</td>
                        <td>{{ $item->Npl90_9 }}</td>
                        <td>{{ $item->Npl90_10 }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="color-celeste">L 95</td>
                        <td>{{ $item->Npl95_1 }}</td>
                        <td>{{ $item->Npl95_2 }}</td>
                        <td>{{ $item->Npl95_3 }}</td>
                        <td>{{ $item->Npl95_4 }}</td>
                        <td>{{ $item->Npl95_5 }}</td>
                        <td>{{ $item->Npl95_6 }}</td>
                        <td>{{ $item->Npl95_7 }}</td>
                        <td>{{ $item->Npl95_8 }}</td>
                        <td>{{ $item->Npl95_9 }}</td>
                        <td>{{ $item->Npl95_10 }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="color-celeste">Nivel del ruido residual</td>
                        <td colspan="2" class="color-celeste">LA eq (Res)</td>
                        <td>{{ $item->RrLaeq_1 }}</td>
                        <td>{{ $item->RrLaeq_2 }}</td>
                        <td>{{ $item->RrLaeq_3 }}</td>
                        <td>{{ $item->RrLaeq_4 }}</td>
                        <td>{{ $item->RrLaeq_5 }}</td>
                        <td>{{ $item->RrLaeq_6 }}</td>
                        <td>{{ $item->RrLaeq_7 }}</td>
                        <td>{{ $item->RrLaeq_8 }}</td>
                        <td>{{ $item->RrLaeq_9 }}</td>
                        <td>{{ $item->RrLaeq_10 }}</td>
                    </tr>
                    <tr>
                        <td colspan="11" class="titulo color-celeste">Nivel Máximo ponderado en frecuencia "A" y tiempo Slow "S" LAmáx  dB(A):</td>
                        <td colspan="3" class="titulo">{{ $item->TotalLaMax }}</td>
                    </tr>
                    <tr>
                        <td colspan="11" class="titulo color-celeste">Nivel Mínimo ponderado en frecuencia "A" y tiempo Slow "S" LAmín  dB(A):</td>
                        <td colspan="3" class="titulo">{{ $item->TotalLaMin }}</td>
                    </tr>
                    <tr>
                        <td colspan="11" class="titulo color-celeste">Nivel equivalente ponderado en frecuencia "A" y tiempo Slow "S" Laeq,T  dB(A):</td>
                        <td colspan="3" class="titulo">{{ $item->TotalLaEq }}</td>
                    </tr>
                    <tr>
                        <td colspan="11" class="titulo color-celeste">Nivel de presión sonora continuo equivalente  LAeqT , Corregido por el nivel de ruido residual dB(A):</td>
                        <td colspan="3" class="titulo color-gris">{{ $item->LaEqTCorregido }}</td>
                    </tr>
                    <tr>
                        <td colspan="11" class="titulo color-celeste">Incertidumbre expandida de medición al 95% de confianza asociado al factor de cobertura k=2 (+/-) dB:</td>
                        <td colspan="3" class="titulo color-gris">{{ $item->IncertidumbreExpandida }}</td>
                    </tr>
                    <tr>
                        <td colspan="14" class="titulo color-celeste">Descripción de las condiciones Meteorológicas</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="titulo color-celeste">Periodos de medición</td>
                        <td colspan="2" class="titulo color-celeste">Horas</td>
                        <td colspan="2" class="titulo color-celeste">Velocidad de viento (m/s) Promedio</td>
                        <td colspan="2" class="titulo color-celeste">Dirección del viento Promedio</td>
                        <td colspan="2" class="titulo color-celeste">Temperatura ambiental (°C) Promedio</td>
                        <td colspan="2" class="titulo color-celeste">Presión atmosférica (mbar) Promedio</td>
                        <td colspan="2" class="titulo color-celeste">Humedad relativa (%) Promedio</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="color-celeste">Antes de la medición</td>
                        <td colspan="2">{{ $item->HoraMedicionAntes}}</td>
                        <td colspan="2">{{ $item->VelocidadVientoAntesMedicion }}</td>
                        <td colspan="2">{{ $item->DireccionVientoAntesMedicion }}</td>
                        <td colspan="2">{{ $item->TemperaturaAmbientalAntesMedicion }}</td>
                        <td colspan="2">{{ $item->PresionAtmosfericaAntesMedicion }}</td>
                        <td colspan="2">{{ $item->HumedadRelativaAntesMedicion }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="color-celeste">Durante la medición</td>
                        <td colspan="2">{{ $item->HoraMedicion }}</td>
                        <td colspan="2">{{ $item->VelocidadVientoDuranteMedicion }}</td>
                        <td colspan="2">{{ $item->DireccionVientoDuranteMedicion }}</td>
                        <td colspan="2">{{ $item->TemperaturaAmbientalDuranteMedicion }}</td>
                        <td colspan="2">{{ $item->PresionAtmosfericaDuranteMedicion }}</td>
                        <td colspan="2">{{ $item->HumedadRelativaDuranteMedicion }}</td>
                    </tr>
                    <tr>
                        <td colspan="14" class="tituloGrande color-celeste">Descripción detallada del lugar de medición, que incluya la cubierta y condición del suelo, y las  ubicaciones, incluyendo la altura por encima del suelo y de la fuente </td>
                    </tr>
                    <tr>
                        <td colspan="14">{{ $item->DescripcionLugarMedicion }}</td>
                    </tr>
                    <tr>
                        <td colspan="14" class="tituloGrande color-celeste">Descripción de las condiciones de operación:</td>
                    </tr>
                    <tr>
                        <td colspan="14">{{ $item->DescripcionCondiciones }}</td>
                    </tr>
                    @if ($inicio == $total)
                        <tr>
                            <td colspan="14" class="texto-derecha" style="height: 50px; border:none;">
                                {{ $cabecera->FechaElaboracion }}
                            </td>
                        </tr>
                    @endif

                    
                    <!-- TERMINA REPORTE -->
                </tbody>
            </table>
                           
            <?php $inicio += 1; ?> 

            @endforeach
            
        
    </body>

</html>