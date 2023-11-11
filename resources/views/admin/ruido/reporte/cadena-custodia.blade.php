<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Cadena Custodia de Monitoreo de Ruido Ambiental</title>

    <style>
       
       @page { margin: 10; }

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
        .separador {
            height: 10px;
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
            font-size: 7.5px;
        }

        .saltopagina{
            page-break-after:always;
        }

    </style>
</head>
<?php $pagInicial = 1; ?>
<?php $currentdetalle = 0; ?>
<?php $indice = 0; ?>
@while ($pagInicial <= $paginas)

    <header>
        <table class="header">
            <tr>
                <td rowspan="4" style="width: 20%;">
                    
                    <img src="{{ public_path() . '\assets\img\logo-sag-azul.png'; }}" alt="" style="height: 50px;">
                </td>
                <td rowspan="4" class="tituloCabecera">CADENA DE CUSTODIA DE MONITOREO DE RUIDO AMBIENTAL</td>
                <td style="width: 10%;" class="texto-derecha">FM-094</td>
            </tr>
            <tr>
                <td class="texto-derecha">Versión: 03</td>
            </tr>
            <tr>
                <td class="texto-derecha">F.E.: 09/2022</td>
            </tr>
            <tr>
                <td class="texto-derecha">Página {{ $pagInicial }} de {{ $paginas }}</td>
            </tr>
        </table>
    </header>

    <body>
        
            <table class="cabecera">

                <tbody>
                    <tr>
                        <td class="titulo sin-border">Cliente:</td>
                        <td colspan="4" class="sin-border">{{ $cabecera->NombreCliente}}</td>

                        <td class="titulo sin-border">Contacto:</td>
                        <td colspan="4" class="sin-border">{{ $cabecera->ContactoCliente }}</td>

                        <td class="titulo sin-border">Email:</td>
                        <td colspan="4" class="sin-border">{{ $cabecera->EmailCliente }}</td>

                        <td class="titulo sin-border">Telf(s).:</td>
                        <td colspan="2" class="sin-border">{{ $cabecera->TelefonoCliente }}</td>
                    </tr>

                    <tr>
                        <td class="titulo sin-border">Lugar:</td>
                        <td colspan="3" class="sin-border">{{ $cabecera->Lugar }}</td>

                        <td class="titulo sin-border">Empresa:</td>
                        <td colspan="3" class="sin-border">{{ $cabecera->Empresa }}</td>

                        <td class="titulo sin-border">Planta:</td>
                        <td colspan="3" class="sin-border">{{ $cabecera->Planta }}</td>

                        <td class="titulo sin-border">Proyecto:</td>
                        <td colspan="5" class="sin-border">{{ $cabecera->Proyecto }}</td>
                    </tr>

                    <tr>
                        <td colspan="3" class="titulo sin-border">Número de Solicitud / Cotización:</td>
                        <td colspan="3" class="sin-border">{{ $cabecera->NumeroCotizacion }}</td>
                        
                        <td colspan="2" class="titulo sin-border">Acreditado por:</td>
                        <td colspan="2" class="titulo">{{ $cabecera->Acreditado }}</td>
                        
                        <td colspan="2">Muestreado por SAG</td>
                        <td class="titulo">{{ $cabecera->MuestreadoSag }}</td>
                        <td class="sin-border"></td>
                        
                        <td colspan="2" class="titulo">NÚMERO DE INFORME</td>
                        <td colspan="2">{{ $cabecera->NumeroInforme }}</td>

                    </tr>

                    <tr><td colspan="18" class="separador sin-border"></td></tr>

                    <tr>
                        <td class="titulo">CÓDIGO DEL CLIENTE</td>
                        <td class="titulo">Periodo</td>
                        <td class="titulo">Nivel de presión sonora</td>
                        <td class="titulo">Fecha</td>
                        <td class="titulo">Hora Inicio</td>
                        <td class="titulo">Hora Final</td>
                        <td class="titulo">Periodo</td>
                        <td class="titulo">Nivel de presión sonora</td>
                        <td class="titulo">Fecha</td>
                        <td class="titulo">Hora Inicio</td>
                        <td class="titulo">Hora Final</td>
                        <td class="titulo">RUIDO CONTINUO</td>
                        <td class="titulo">Altura de la fuente (hs) (m)</td>
                        <td class="titulo">Altura del micrófono (hr) (m)</td>
                        <td class="titulo">Distancia desde la fuente (D) (m)</td>
                        <td class="titulo">D/R curv (hs-hr)/(D) (campo)</td>
                        <td class="titulo">D/R curv (Ideal) (>= 1)</td>
                        <td class="titulo letra-chica">CODIGO DE LABORATORIO</td>
                    </tr>

                    <?php $inicio = 1; ?>
                    <?php $final = 4; ?>

                    @while ($inicio <= $final)
                        <tr>
                            <td rowspan="2" class="titulo">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sCodigoCliente }}</td>
                            <td rowspan="2" class="titulo">Diurno</td>
                            <td class="titulo">Ruido Total</td>
                            <td>{{ isset($detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoTotalFechaDiurno) ? $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoTotalFechaDiurno : '-' }}</td>
                            <td>{{ isset($detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoTotalHIDiurno) ? $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoTotalHIDiurno : '-' }}</td>
                            <td>{{ isset($detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoTotalHFDiurno) ? $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoTotalHFDiurno : '-' }}</td>
                            <td rowspan="2" class="titulo">Nocturno</td>
                            <td class="titulo">Ruido Total</td>
                            <td>{{ isset($detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoTotalFechaNocturno) ? $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoTotalFechaNocturno : '-' }}</td>
                            <td>{{ isset($detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoTotalHINocturno) ? $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoTotalHINocturno : '-' }}</td>
                            <td>{{ isset($detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoTotalHFNocturno) ? $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoTotalHFNocturno : '-' }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoTotalContinuo }}</td>
                            <td rowspan="2">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sAlturaFuente }}</td>
                            <td rowspan="2">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sAlturaMicrofono }}</td>
                            <td rowspan="2">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sDistanciaFuente }}</td>
                            <td rowspan="2">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sDRHsHr }}</td>
                            <td rowspan="2">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sDRIdeal }}</td>
                            <td rowspan="2">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sCodigoLaboratorio }}</td>
                        </tr>
                        <tr>
                            <td class="titulo letra-chica">Ruido Residual</td>
                            <td>{{ isset($detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoResidualFechaDiurno) ? $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoResidualFechaDiurno : '-' }}</td>
                            <td>{{ isset($detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoResidualHIDiurno) ? $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoResidualHIDiurno : '-' }}</td>
                            <td>{{ isset($detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoResidualHFDiurno) ? $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoResidualHFDiurno : '-' }}</td>
                            <td class="titulo letra-chica">Ruido Residual</td>
                            <td>{{ isset($detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoResidualFechaNocturno) ? $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoResidualFechaNocturno : '-' }}</td>
                            <td>{{ isset($detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoResidualHINocturno) ? $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoResidualHINocturno : '-' }}</td>
                            <td>{{ isset($detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoResidualHFNocturno) ? $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoResidualHFNocturno : '-' }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sRuidoResidualContinuo }}</td>
                        </tr>
                        <?php $inicio += 1; ?>
                    @endwhile

                    <tr>
                        <td colspan="18" class="separador sin-border" style="height: 20px;">
                            <span>DATOS DEL MUESTREO:</span> Registrar la información de campo en el siguiente recuadro: <span>(Completar o Marcar "X")</span> 
                        </td>
                    </tr>

                    {{-- DATOS del MUESTREO --}}

                    <tr>
                        <td rowspan="2" class="titulo">CÓDIGO DEL CLIENTE</td>
                        <td rowspan="2" colspan="4" class="titulo">Descripción del punto de muestreo / Informar si el punto es designado por el cliente</td>
                        <td rowspan="2" colspan="3" class="titulo">Observaciones técnicas detalladas</td>
                        <td rowspan="2" class="titulo letra-chica">CÓDIGO DE MEDIDOR DE CLIMA (ELAB)</td>
                        <td rowspan="2" class="titulo letra-chica">CÓDIGO DE EQUIPO CALIBRADOR (ELAB)</td>
                        <td rowspan="2" class="titulo letra-chica">CÓDIGO DE EQUIPO SONÓMETRO (ELAB)</td>
                        <td colspan="2" class="titulo">GEOFERENCIA (UTM)</td>
                        <td rowspan="2" class="titulo">Altitud (m.s.n.m)</td>
                        <td rowspan="2" colspan="4" class="titulo">GEOFERENCIA (Sistema, Zona y Banda)</td>
                    </tr>
                    <tr>
                        <td class="titulo">Este:</td>
                        <td class="titulo">Norte:</td>
                    </tr>
                    
                    <?php $inicio = 1; ?>
                    <?php $final = 4; ?>
                    @while ($inicio <= $final)
                        <tr class="headt">
                            <td rowspan="2" class="titulo">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sCodigoCliente }}</td>
                            <td rowspan="2" colspan="4">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sDescripcionPuntoMuestreo }}</td>
                            <td rowspan="2" colspan="3">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sObservacionesTecnicas }}</td>
                            <td rowspan="2">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sCodigoMedidorClima }}</td>
                            <td rowspan="2">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sCodigoEquipoCalibrador }}</td>
                            <td rowspan="2">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sCodigoEquipoSonometro }}</td>
                            <td rowspan="2">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sGeoferenciaUtmEste }}</td>
                            <td rowspan="2">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sGeoferenciaUtmNorte }}</td>
                            <td rowspan="2">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sAltitud }}</td>
                            <td class="titulo">Sistema</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sGeoferenciaSistema }}</td>
                            <td class="titulo">Zona</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sGeoferenciaZona }}</td>
                        </tr>
                        <tr class="headt">
                            <td class="titulo">Banda</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sGeoferenciaBanda }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php $inicio += 1; ?>
                    @endwhile

                    {{-- DATOS metereológicos --}}

                    <tr>
                        <td rowspan="10" class="titulo">Datos de Condiciones Metereológicas (Datos promedios)</td>
                        {{-- <td rowspan="10" class="titulo"></td> --}}
                        <td rowspan="2" class="titulo">Estaciones</td>
                        <td colspan="2" class="titulo">Velocidad del viento (m/s)</td>
                        <td colspan="2" class="titulo">Dirección del viento</td>
                        <td colspan="2" class="titulo">Temperatura ambiental (°C)</td>
                        <td colspan="2" class="titulo">Presión atmosférica (mbar)</td>
                        <td colspan="2" class="titulo">Humedad relativa (%)</td>
                        <td colspan="4" class="titulo">VERIFICACIÓN DEL EQUIPO EN CAMPO</td>
                        <td rowspan="2" colspan="2" class="titulo">CONDICIONES DEL TERRENO</td>
                    </tr>
                    <tr>
                        <td class="titulo">Antes de la medición</td>
                        <td class="titulo">Durante la medición</td>
                        <td class="titulo">Antes de la medición</td>
                        <td class="titulo">Durante la medición</td>
                        <td class="titulo">Antes de la medición</td>
                        <td class="titulo">Durante la medición</td>
                        <td class="titulo">Antes de la medición</td>
                        <td class="titulo">Durante la medición</td>
                        <td class="titulo">Antes de la medición</td>
                        <td class="titulo">Durante la medición</td>
                        <td colspan="2" class="titulo">Verificación Inicial</td>
                        <td colspan="2" class="titulo">Verificación Final</td>
                    </tr>

                    <?php $inicio = 1; ?>
                    <?php $final = 4; ?>
                    <?php $current_terreno = 0; ?>
                    @while ($inicio <= $final)
                        <tr>
                            <td rowspan="2" class="titulo">{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sCodigoCliente }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sVVAMedicionDiurno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sVVDMedicionDiurno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sDVAMedicionDiurno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sDVDMedicionDiurno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sTAAMedicionDiurno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sTADMedicionDiurno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sPAAMedicionDiurno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sPADMedicionDiurno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sHRAMedicionDiurno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sHRDMedicionDiurno }}</td>
                            <td class="titulo">Inicial</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sVerificacionEquipoInicialDiurno }}</td>
                            <td class="titulo">Final</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sVerificacionEquipoFinalDiurno }}</td>
                            @if ($current_terreno < count($terrenos))
                                <td>{{ $terrenos[$current_terreno]->Descripcion }}</td>
                                <td>  
                                    @if (in_array($terrenos[$current_terreno]->Id, $mis_terrenos))
                                        X
                                    @endif
                                </td>    
                            @else 
                                <td rowspan="2" class="titulo  text-chico">Tiempo de medición (min)</td>
                                <td rowspan="2" class="titulo ">10:00</td>    
                            @endif
                            
                            
                        </tr>
                        <?php $current_terreno += 1; ?>
                        <tr>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sVVAMedicionNocturno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sVVDMedicionNocturno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sDVAMedicionNocturno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sDVDMedicionNocturno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sTAAMedicionNocturno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sTADMedicionNocturno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sPAAMedicionNocturno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sPADMedicionNocturno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sHRAMedicionNocturno }}</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sHRDMedicionNocturno }}</td>
                            <td class="titulo">Inicial</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sVerificacionEquipoInicialNocturno }}</td>
                            <td class="titulo">Final</td>
                            <td>{{ $detalle[(($pagInicial - 1) * 4) + ($inicio - 1)]->sVerificacionEquipoFinalNocturno }}</td>
                            @if ($current_terreno < count($terrenos))
                                <td>{{ $terrenos[$current_terreno]->Descripcion }}</td>
                                <td>
                                    @if (in_array($terrenos[$current_terreno]->Id, $mis_terrenos))
                                        X
                                    @endif
                                </td>    
                            @endif
                        </tr>
                        <?php $current_terreno += 1; ?>
                        <?php $inicio += 1; ?>
                    @endwhile

                </tbody>
            </table>
            
    </body>

    <footer>
        <table class="footer">
            <tr class="headfo">
                <td colspan="5">Nombre(s) y Apellido(s) del Responsable del Muestreo:</td>
                <td colspan="6">{{ $cabecera->ResponsableMuestreo}}</td>
                <td>Firma(s)</td>
                
               {{--  @if(file_exists( public_path() . '\assets\img\analista\\' . $cabecera->id_analista . '.png' ))
                    <td colspan="2">
                        <img src="{{ public_path() . '\assets\img\analista\\' . $cabecera->id_analista . '.png'; }}" alt="" style="height: 40px; float: left; border: 1px solid #000; margin-top: 0;">
                        @if (isset($cabecera->id_analista2))
                            @if(file_exists( public_path() . '\assets\img\analista\\' . $cabecera->id_analista2 . '.png' ))
                                <img src="{{ public_path() . '\assets\img\analista\\' . $cabecera->id_analista2 . '.png'; }}" alt="" style="height: 40px; float: right; border: 1px solid #000;">
                            @endif
                        @endif
                       
                    </td>
                @else
                    <td colspan="2"></td>
                @endif --}}

                @if(file_exists( public_path() . '\assets\img\analista\\' . $cabecera->id_analista . '.png' ))
                    <td >
                        <img src="{{ public_path() . '\assets\img\analista\\' . $cabecera->id_analista . '.png'; }}" alt="" style="height: 40px; ">
                    </td>
                @else
                    <td ></td>
                @endif

                @if(file_exists( public_path() . '\assets\img\analista\\' . $cabecera->id_analista2 . '.png' ))
                    <td >
                        <img src="{{ public_path() . '\assets\img\analista\\' . $cabecera->id_analista2 . '.png'; }}" alt="" style="height: 40px; ">
                    </td>
                @else
                    <td ></td>
                @endif

                
                <td colspan="2">Recibido en laboratorio por:</td>
                <td colspan="2">{{ $cabecera->ResponsableLaboratorio}}</td>
            </tr>
            <tr class="headfo">
                <td colspan="6">Nombre(s) y Apellido(s) del Responsable del Supervisor de Campo:</td>
                <td colspan="5">{{ $cabecera->ResponsableCampo}}</td>
                <td>Firma(s)</td>
                <td colspan="2"><hr></td>
                <td colspan="2">Día/Hora:</td>
                <td colspan="2">{{ $cabecera->FechaRecepcionMuestra . ' / ' . substr($cabecera->HoraRecepcionMuestra, 0, 5) }}</td>
            </tr>
        </table>
    </footer>

    @if ($pagInicial !== $paginas)
        <div style="page-break-after:always;"></div>    
    @endif

    <?php $pagInicial += 1 ?>
@endwhile

</html>