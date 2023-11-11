<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Cadena Custodia de Monitoreo de Iluminacion</title>

    <style>
        @page {
            margin: 10;
        }

        body {
            font-size: 8px;
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
            height: 20px;
        }

        table.cabecera {
            margin-bottom: 1rem;
        }

        table.header td {}

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
        }

        .separador {
            height: 10px !important;
        }

        .headt td {
            height: 15px;
        }

        .headfo td {
            height: 10px;
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
            font-size: 5px;
        }

        .saltopagina {
            page-break-after: always;
        }

        .td {
            height: 25px !important;
        }
    </style>
</head>

<?php $currentdetalle = 0; ?>
<?php $indice = 0; ?>

<?php $registros_x_hoja = 5; ?>
<?php $cant_registro_actual = 1 ?>
<?php $paginas = intval(ceil(count($detalles)/$registros_x_hoja)); ?>
<?php $current_detalle = 0; ?>
<?php $inicio = 1 ?>

<?php for ($i=0; $i < $paginas ; $i++) { ?>

        <header>
            <table class="header">
                <tr>
                    <td rowspan="4" style="width: 20%;">
    
                        <img src="{{ public_path() . '\assets\img\logo-sag-azul.png' }}" alt=""
                            style="height: 50px;">
                    </td>
                    <td rowspan="4" class="tituloCabecera">CADENA DE CUSTODIA DE MONITOREO DE SALUD OCUPACIONAL - MEDICIONES DIRECTAS</td>
                    <td style="width: 10%;" class="texto-derecha">FM-064</td>
                </tr>
                <tr>
                    <td class="texto-derecha">Versión: 00</td>
                </tr>
                <tr>
                    <td class="texto-derecha">F.E.: 01/2019</td>
                </tr>
                <tr>
                    <td class="texto-derecha">Página {!! $i + 1 !!} de {!! $paginas !!}</td>
                </tr>
            </table>
        </header>
    
        <body>
    
            <table class="cabecera">
    
                <tbody>
                    
                    <tr>
                        <td colspan="28" class="separador sin-border"></td>
                    </tr>

                    <tr>
                        <td class="titulo sin-border">Cliente/Empresa:</td>
                        <td colspan="7" class="sin-border">{{ $cabecera->NombreCliente }}</td>
    
                        <td colspan="2" class="titulo sin-border">Lugar/Planta:</td>
                        <td colspan="5" class="sin-border">{{ $cabecera->Lugar }}</td>
    
                        <td colspan="2" class="titulo sin-border">Contacto:</td>
                        <td colspan="3" class="sin-border">{{ $cabecera->ContactoCliente }}</td>
    
                        <td colspan="2" class="titulo sin-border">Email:</td>
                        <td colspan="3" class="sin-border">{{ $cabecera->EmailCliente }}</td>
    
                        <td colspan="1" class="titulo sin-border">Telf(s).:</td>
                        <td colspan="2" class="sin-border">{{ $cabecera->TelefonoCliente }}</td>
                    </tr>
    
                    <tr>
                        <td class="titulo sin-border">Proyecto:</td>
                        <td colspan="11" class="sin-border">{{ $cabecera->Proyecto }}</td>
    
                        <td colspan="3" class="titulo sin-border">N° Cotización:</td>
                        <td colspan="8" class="sin-border">{{ $cabecera->NumeroCotizacion }}</td>
    
                        <td colspan="2" class="titulo ">N° Informe:</td>
                        <td colspan="3" class="">{{ $cabecera->NumeroInforme }}</td>
                    </tr>
    
                    <tr>
                        <td colspan="28" class="separador sin-border"></td>
                    </tr>
                    <tr>
                        <td colspan="28" class="separador sin-border"></td>
                    </tr>
    
                    <tr>
                        <td rowspan="4" class="titulo letra-chica">CÓDIGO DEL CLIENTE</td>
                        <td rowspan="2" colspan="2" class="titulo">INICIO DE MUESTREO</td>
                        <td rowspan="2" colspan="2" class="titulo">FINAL DE MUESTREO</td>
                        <td colspan="23" class="titulo">PARÁMETROS</td>
                    </tr>
    
                    <tr>
                        <td colspan="11" class="titulo">AGENTES FÍSICOS</td>
                        <td colspan="8" class="titulo">AGENTES QUÍMICOS</td>
                        
                        <td rowspan="3" class="titulo letra-chica">ERGONOMÍA</td>
                        <td rowspan="3" class="titulo letra-chica">RIESGO PSICOSOCIAL</td>
                        <td rowspan="3" colspan="2" class="titulo">CÓDIGO DE LABORATORIO</td>
                    </tr>
    
                    <tr>
                        <td rowspan="2" class="titulo">FECHA</td>
                        <td rowspan="2" class="titulo">HORA</td>
                        <td rowspan="2" class="titulo">FECHA</td>
                        <td rowspan="2" class="titulo">HORA</td>
                        <td rowspan="2" class="titulo letra-chica">RUIDO OCUPACIONAL</td>
                        <td rowspan="2" class="titulo letra-chica">ESTRÉS TÉRMICO CALOR</td>
                        <td rowspan="2" class="titulo letra-chica">ESTRÉS TÉRMICO FRÍO</td>
                        <td rowspan="2" class="titulo letra-chica">ILUMINACIÓN INTERIORES</td>
                        <td rowspan="2" class="titulo letra-chica">ILUMINACIÓN EXTERIORES</td>
                        <td rowspan="2" class="titulo letra-chica">RADIACIONES UV</td>
                        <td rowspan="2" class="titulo letra-chica">VIBRACIONES EN EDIFICACIONES</td>
    
                        <td colspan="4" class="titulo">RADIACIÓN NO IONIZANTE</td>
                        <td colspan="8" class="titulo">CELDAS ELECTROQUÍMICAS</td>
                    </tr>
    
                    <tr>
                        <td class="titulo letra-chica">INTENSIDAD DE CAMPO ELECTRICO (V/m)</td>
                        <td class="titulo letra-chica">INTENSIDAD DE CAMPO MAGNETICO (Am)</td>
                        <td class="titulo letra-chica">DENSIDAD DE FLUJO MAGNETICO (uT)</td>
                        <td class="titulo letra-chica">DENSIDAD DE POTENCIA</td>
                        <td class="titulo">CO</td>
                        <td class="titulo">O2</td>
                        <td class="titulo">CO2</td>
                        <td class="titulo">NO2</td>
                        <td class="titulo">NH3</td>
                        <td class="titulo">LEL</td>
                        <td class="titulo">CH3</td>
                        <td class="titulo"></td>
                    </tr>
                    
                    <tr>
                        <td>{!! $detalles[$current_detalle + 0]->CodigoCliente !!}</td>
                        <td>{!! date('d/m/Y', strtotime($detalles[$current_detalle + 0]->FechaInicioMuestreo)) !!}</td>
                        <td>{!! substr($detalles[$current_detalle + 0]->HoraInicioMuestreo, 0, 5) !!}</td>
                        <td>{!! date('d/m/Y', strtotime($detalles[$current_detalle + 0]->FechaFinMuestreo)) !!}</td>
                        <td>{!! substr($detalles[$current_detalle + 0]->HoraFinMuestreo, 0, 5) !!}</td>

                        <td></td>
                        <td></td>
                        <td></td>

                        <td>{!! ($detalles[$current_detalle + 0]->IluminacionInterior == '1') ? 'X' : '' !!}</td>
                        <td>{!! ($detalles[$current_detalle + 0]->IluminacionExterior == '1') ? 'X' : '' !!}</td>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td colspan="2"></td>
    
                    </tr>

                    <tr>
                        <td>{!! (isset($detalles[$current_detalle + 1])) ? $detalles[$current_detalle + 1]->CodigoCliente : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 1])) ? date('d/m/Y', strtotime($detalles[$current_detalle + 1]->FechaInicioMuestreo)) : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 1])) ? substr($detalles[$current_detalle + 1]->HoraInicioMuestreo, 0, 5) : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 1])) ? date('d/m/Y', strtotime($detalles[$current_detalle + 1]->FechaFinMuestreo)) : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 1])) ? substr($detalles[$current_detalle + 1]->HoraFinMuestreo, 0, 5) : ''  !!}</td>

                        <td></td>
                        <td></td>
                        <td></td>

                        <td>{!! (isset($detalles[$current_detalle + 1])) ? ($detalles[$current_detalle + 1]->IluminacionInterior == '1') ? 'X' : '' : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 1])) ? ($detalles[$current_detalle + 1]->IluminacionExterior == '1') ? 'X' : '' : '' !!}</td>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td colspan="2"></td>
    
                    </tr>
                    
                    <tr>
                        <td>{!! (isset($detalles[$current_detalle + 2])) ? $detalles[$current_detalle + 2]->CodigoCliente : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 2])) ? date('d/m/Y', strtotime($detalles[$current_detalle + 2]->FechaInicioMuestreo)) : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 2])) ? substr($detalles[$current_detalle + 2]->HoraInicioMuestreo, 0, 5) : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 2])) ? date('d/m/Y', strtotime($detalles[$current_detalle + 2]->FechaFinMuestreo)) : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 2])) ? substr($detalles[$current_detalle + 2]->HoraFinMuestreo, 0, 5) : '' !!}</td>

                        <td></td>
                        <td></td>
                        <td></td>

                        <td>{!! (isset($detalles[$current_detalle + 2])) ? ($detalles[$current_detalle + 2]->IluminacionInterior == '1') ? 'X' : '' : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 2])) ? ($detalles[$current_detalle + 2]->IluminacionExterior == '1') ? 'X' : '' : '' !!}</td>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td colspan="2"></td>
    
                    </tr>

                    <tr>
                        <td>{!! (isset($detalles[$current_detalle + 3])) ? $detalles[$current_detalle + 3]->CodigoCliente : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 3])) ? date('d/m/Y', strtotime($detalles[$current_detalle + 3]->FechaInicioMuestreo)) : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 3])) ? substr($detalles[$current_detalle + 3]->HoraInicioMuestreo, 0, 5) : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 3])) ? date('d/m/Y', strtotime($detalles[$current_detalle + 3]->FechaFinMuestreo)) : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 3])) ? substr($detalles[$current_detalle + 3]->HoraFinMuestreo, 0, 5) : '' !!}</td>

                        <td></td>
                        <td></td>
                        <td></td>

                        <td>{!! (isset($detalles[$current_detalle + 3])) ? ($detalles[$current_detalle + 3]->IluminacionInterior == '1') ? 'X' : '' : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 3])) ? ($detalles[$current_detalle + 3]->IluminacionExterior == '1') ? 'X' : '' : '' !!}</td>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td colspan="2"></td>
    
                    </tr>

                    <tr>
                        <td>{!! (isset($detalles[$current_detalle + 4])) ? $detalles[$current_detalle + 4]->CodigoCliente : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 4])) ? date('d/m/Y', strtotime($detalles[$current_detalle + 4]->FechaInicioMuestreo)) : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 4])) ? substr($detalles[$current_detalle + 4]->HoraInicioMuestreo, 0, 5) : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 4])) ? date('d/m/Y', strtotime($detalles[$current_detalle + 4]->FechaFinMuestreo)) : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 4])) ? substr($detalles[$current_detalle + 4]->HoraFinMuestreo, 0, 5) : '' !!}</td>

                        <td></td>
                        <td></td>
                        <td></td>

                        <td>{!! (isset($detalles[$current_detalle + 4])) ? ($detalles[$current_detalle + 4]->IluminacionInterior == '1') ? 'X' : '' : '' !!}</td>
                        <td>{!! (isset($detalles[$current_detalle + 4])) ? ($detalles[$current_detalle + 4]->IluminacionExterior == '1') ? 'X' : '' : '' !!}</td>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td colspan="2"></td>
    
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td></td>
                        <td></td>
                        <td></td>

                        <td></td>
                        <td></td>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td colspan="2"></td>
    
                    </tr>

                    <tr>
                        <td class="titulo letra-chica">CÓDIGO DEL CLIENTE</td>
                        <td class="titulo" colspan="9">DESCRIPCIÓN DEL PUNTO DE MUESTREO / ESTACIÓN DE MUESTREO</td>
                        <td class="titulo" colspan="4">GEOFERENCIA</td>
                        <td class="titulo" colspan="2">ALTITUD (m.s.n.m)</td>
                        <td class="titulo" colspan="4">TEMPERATURA AMBIENTE PROMEDIO (C°)</td>
                        <td class="titulo" colspan="4">PRESIÓN AMBIENTAL PROMEDIO (mbar)</td>
                        <td class="titulo" colspan="4">OBSERVACIONES</td>
                    </tr>
                    
                    <tr>
                        <td>{!! $detalles[$current_detalle + 0]->CodigoCliente !!}</td>
                        <td colspan="9">{!! $detalles[$current_detalle + 0]->datos_muestreo->DescripcionPuntoMuestreo !!}</td>
                        <td colspan="2">E: {!! $detalles[$current_detalle + 0]->datos_muestreo->GeoferenciaEste !!}</td>
                        <td colspan="2">N: {!! $detalles[$current_detalle + 0]->datos_muestreo->GeoferenciaNorte !!}</td>
                        <td colspan="2">{!! $detalles[$current_detalle + 0]->datos_muestreo->Altitud !!}</td>
                        <td colspan="4">{!! $detalles[$current_detalle + 0]->datos_muestreo->TemperaturaAmbientePromedio !!}</td>
                        <td colspan="4">{!! $detalles[$current_detalle + 0]->datos_muestreo->PresionAmbientalPromedio !!}</td>
                        <td colspan="4">{!! $detalles[$current_detalle + 0]->datos_muestreo->Observaciones !!}</td>
                    </tr>
    
                    <tr>
                        <td>{!! (isset($detalles[$current_detalle + 1])) ? $detalles[$current_detalle + 1]->CodigoCliente : '' !!}</td>
                        <td colspan="9">{!! (isset($detalles[$current_detalle + 1])) ? $detalles[$current_detalle + 1]->datos_muestreo->DescripcionPuntoMuestreo : '' !!}</td>
                        <td colspan="2">E: {!! (isset($detalles[$current_detalle + 1])) ? $detalles[$current_detalle + 1]->datos_muestreo->GeoferenciaEste : '' !!}</td>
                        <td colspan="2">N: {!! (isset($detalles[$current_detalle + 1])) ? $detalles[$current_detalle + 1]->datos_muestreo->GeoferenciaNorte : '' !!}</td>
                        <td colspan="2">{!! (isset($detalles[$current_detalle + 1])) ? $detalles[$current_detalle + 1]->datos_muestreo->Altitud : '' !!}</td>
                        <td colspan="4">{!! (isset($detalles[$current_detalle + 1])) ? $detalles[$current_detalle + 1]->datos_muestreo->TemperaturaAmbientePromedio : '' !!}</td>
                        <td colspan="4">{!! (isset($detalles[$current_detalle + 1])) ? $detalles[$current_detalle + 1]->datos_muestreo->PresionAmbientalPromedio : '' !!}</td>
                        <td colspan="4">{!! (isset($detalles[$current_detalle + 1])) ? $detalles[$current_detalle + 1]->datos_muestreo->Observaciones : '' !!}</td>
                    </tr>
    
                    <tr>
                        <td>{!! (isset($detalles[$current_detalle + 2])) ? $detalles[$current_detalle + 2]->CodigoCliente : '' !!}</td>
                        <td colspan="9">{!! (isset($detalles[$current_detalle + 2])) ? $detalles[$current_detalle + 2]->datos_muestreo->DescripcionPuntoMuestreo : '' !!}</td>
                        <td colspan="2">E: {!! (isset($detalles[$current_detalle + 2])) ? $detalles[$current_detalle + 2]->datos_muestreo->GeoferenciaEste : '' !!}</td>
                        <td colspan="2">N: {!! (isset($detalles[$current_detalle + 2])) ? $detalles[$current_detalle + 2]->datos_muestreo->GeoferenciaNorte : '' !!}</td>
                        <td colspan="2">{!! (isset($detalles[$current_detalle + 2])) ? $detalles[$current_detalle + 2]->datos_muestreo->Altitud : '' !!}</td>
                        <td colspan="4">{!! (isset($detalles[$current_detalle + 2])) ? $detalles[$current_detalle + 2]->datos_muestreo->TemperaturaAmbientePromedio : '' !!}</td>
                        <td colspan="4">{!! (isset($detalles[$current_detalle + 2])) ? $detalles[$current_detalle + 2]->datos_muestreo->PresionAmbientalPromedio : '' !!}</td>
                        <td colspan="4">{!! (isset($detalles[$current_detalle + 2])) ? $detalles[$current_detalle + 2]->datos_muestreo->Observaciones : '' !!}</td>
                    </tr>
    
                    <tr>
                        <td>{!! (isset($detalles[$current_detalle + 3])) ? $detalles[$current_detalle + 3]->CodigoCliente : '' !!}</td>
                        <td colspan="9">{!! (isset($detalles[$current_detalle + 3])) ? $detalles[$current_detalle + 3]->datos_muestreo->DescripcionPuntoMuestreo : '' !!}</td>
                        <td colspan="2">E: {!! (isset($detalles[$current_detalle + 3])) ? $detalles[$current_detalle + 3]->datos_muestreo->GeoferenciaEste : '' !!}</td>
                        <td colspan="2">N: {!! (isset($detalles[$current_detalle + 3])) ? $detalles[$current_detalle + 3]->datos_muestreo->GeoferenciaNorte : '' !!}</td>
                        <td colspan="2">{!! (isset($detalles[$current_detalle + 3])) ? $detalles[$current_detalle + 3]->datos_muestreo->Altitud : '' !!}</td>
                        <td colspan="4">{!! (isset($detalles[$current_detalle + 3])) ? $detalles[$current_detalle + 3]->datos_muestreo->TemperaturaAmbientePromedio : '' !!}</td>
                        <td colspan="4">{!! (isset($detalles[$current_detalle + 3])) ? $detalles[$current_detalle + 3]->datos_muestreo->PresionAmbientalPromedio : '' !!}</td>
                        <td colspan="4">{!! (isset($detalles[$current_detalle + 3])) ? $detalles[$current_detalle + 3]->datos_muestreo->Observaciones : '' !!}</td>
                    </tr>
    
                    <tr>
                        <td>{!! (isset($detalles[$current_detalle + 4])) ? $detalles[$current_detalle + 4]->CodigoCliente : ''  !!}</td>
                        <td colspan="9">{!! (isset($detalles[$current_detalle + 4])) ? $detalles[$current_detalle + 4]->datos_muestreo->DescripcionPuntoMuestreo : '' !!}</td>
                        <td colspan="2">E: {!! (isset($detalles[$current_detalle + 4])) ? $detalles[$current_detalle + 4]->datos_muestreo->GeoferenciaEste : '' !!}</td>
                        <td colspan="2">N: {!! (isset($detalles[$current_detalle + 4])) ? $detalles[$current_detalle + 4]->datos_muestreo->GeoferenciaNorte : '' !!}</td>
                        <td colspan="2">{!! (isset($detalles[$current_detalle + 4])) ? $detalles[$current_detalle + 4]->datos_muestreo->Altitud : '' !!}</td>
                        <td colspan="4">{!! (isset($detalles[$current_detalle + 4])) ? $detalles[$current_detalle + 4]->datos_muestreo->TemperaturaAmbientePromedio : '' !!}</td>
                        <td colspan="4">{!! (isset($detalles[$current_detalle + 4])) ? $detalles[$current_detalle + 4]->datos_muestreo->PresionAmbientalPromedio : '' !!}</td>
                        <td colspan="4">{!! (isset($detalles[$current_detalle + 4])) ? $detalles[$current_detalle + 4]->datos_muestreo->Observaciones : '' !!}</td>
                    </tr>
    
                    <tr>
                        <td></td>
                        <td colspan="9"></td>
                        <td colspan="2">E:</td>
                        <td colspan="2">N:</td>
                        <td colspan="2"></td>
                        <td colspan="4"></td>
                        <td colspan="4"></td>
                        <td colspan="4"></td>
                    </tr>
    
                    <?php $inicio = 1; ?>
                    <?php $final = 4; ?>
    
    
                    <tr class="headfo">
                        <td colspan="5" class="sin-border" style="border-left: 1px solid black !important;">Nombre(s) y Apellido(s) del Responsable del Muestreo:</td>
                        <td colspan="12" class="sin-border">{!! $cabecera->NombreCompletoAnalista1 !!}</td>
                        <td class="sin-border">Firma(s)</td>
                        
                        @if (file_exists(public_path() . '\assets\img\analista\\' . $cabecera->Analista1 . '.png'))
                            <td colspan="2" class="sin-border">
                                <img src="{{ public_path() . '\assets\img\analista\\' . $cabecera->Analista1 . '.png' }}"
                                    alt="" style="height: 40px; ">
                            </td>
                        @else
                            <td colspan="2" class="sin-border"></td>
                        @endif
        
                        @if (file_exists(public_path() . '\assets\img\analista\\' . $cabecera->Analista2 . '.png'))
                            <td colspan="2" class="sin-border">
                                <img src="{{ public_path() . '\assets\img\analista\\' . $cabecera->Analista2 . '.png' }}"
                                    alt="" style="height: 40px; ">
                            </td>
                        @else
                            <td colspan="2" class="sin-border"></td>
                        @endif
        
        
                        <td colspan="3" class="sin-border" style="border-left: 1px solid black !important;">Recibido en laboratorio por:</td>
                        <td colspan="3" class="sin-border" style="border-right: 1px solid black !important;">{{ $cabecera->ResponsableLaboratorio }}</td>
                    </tr>
                    <tr class="headfo">
                        <td colspan="6" class="sin-border" style="border-left: 1px solid black !important; border-bottom: 1px solid black !important;">Nombre(s) y Apellido(s) del Responsable del Supervisor de Campo:</td>
                        <td colspan="11" class="sin-border" style="border-bottom: 1px solid black !important;"></td>
                        <td class="sin-border" style="border-bottom: 1px solid black !important;">Firma(s)</td>
                        <td colspan="4" class="sin-border" style="border-bottom: 1px solid black !important;">
                            <hr>
                        </td>
                        <td colspan="3" class="sin-border" style="border-left: 1px solid black !important; border-bottom: 1px solid black !important;">Día/Hora:</td>
                        <td colspan="3" class="sin-border" style="border-bottom: 1px solid black !important; border-right: 1px solid black !important;"></td>
                    </tr>

                </tbody>
            </table>
    
        </body>

        <?php if ($i + 1 != $paginas) { ?>
            <div style="page-break-after:always;"></div>
        <?php } ?>
                
        <?php $current_detalle = 5; ?>
<?php } ?>

</html>
