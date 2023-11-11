<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>PLAN DE MUESTREO</title>

    <style>
       
       /* @page { margin: 10; } */

       body {
            font-size: 7px;
            font-family: DejaVu Sans, sans-serif;
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
            text-align: left !important;
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
            background-color: rgb(255, 255, 153)
        }

        .fondo-titulo2 {
            background-color: rgb(204, 255, 204)
        }

    </style>
</head>

<?php $currentdetalle = 0; ?>
<?php $indice = 0; ?>
    
    <body>

        <table class="header">
            <tr>
                <td rowspan="3" style="width: 20%;">
                    <img src="{{ public_path() . '\assets\img\logo-sag-azul.png'; }}" alt="" style="height: 50px;">
                </td>
                <td rowspan="3" class="tituloCabecera">PLAN DE MUESTREO</td>
                <td style="width: 10%;" class="texto-derecha">FM-093</td>
            </tr>
            <tr>
                <td class="texto-derecha">Versión: 08</td>
            </tr>
            <tr>
                <td class="texto-derecha">F.E.: 02/2020</td>
            </tr>
            <tr>
                <td colspan="3" class="tituloCabecera">N° de informes: </td>
            </tr>
        </table>
        
        <table class="cabecera">
            <tbody>
                <!-- 1. DATOS DEL CLIENTE -->
                <tr>
                    <td colspan="26" class="titulo fondo-titulo" style="text-align: left !important;">1. DATOS DEL CLIENTE</td>
                </tr>
                <tr>
                    <td colspan="4" class="titulo ">Cliente</td>
                    <td colspan="22" class="" style="border-right: 1px solid black !important;">{{ $cadena->NombreCliente }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="titulo ">Contacto en la cotización</td>
                    <td colspan="9" class="" style="border-right: 1px solid black !important;">{{ $cadena->ContactoCliente }}</td>
                    <td colspan="2" class="titulo ">Teléfono fijo</td>
                    <td colspan="5" class="" style="border-right: 1px solid black !important;">---</td>
                    <td colspan="2" class="titulo ">Celular</td>
                    <td colspan="4" class="" style="border-right: 1px solid black !important;">{{ $cadena->TelefonoCliente }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="titulo ">Contacto en campo</td>
                    <td colspan="9" class="" style="border-right: 1px solid black !important;">Teonila</td>
                    <td colspan="2" class="titulo ">Teléfono fijo</td>
                    <td colspan="5" class="" style="border-right: 1px solid black !important;">---</td>
                    <td colspan="2" class="titulo ">Celular</td>
                    <td colspan="4" class="" style="border-right: 1px solid black !important;">---</td>
                </tr>
                <tr>
                    <td colspan="4" class="titulo ">Proyecto</td>
                    <td colspan="22" class="" style="border-right: 1px solid black !important;">{{ $cadena->Proyecto }}</td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border"></td>
                </tr>

                <!-- 2. PERSONAL DE MUESTREO -->
                <tr>
                    <td colspan="26" class="titulo fondo-titulo" style="text-align: left !important;">2. PERSONAL DE MUESTREO</td>
                </tr>
                <tr>
                    <td rowspan="4" colspan="2" class="titulo ">Nombres</td>
                    <td colspan="16"></td>
                    <td rowspan="4" colspan="2" class="titulo ">N° de DNI</td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td colspan="16">{{ $muestreo->Analista }}</td>
                    <td colspan="6">{{ $muestreo->DocumentoAnalista }}</td>
                </tr>
                <tr>
                    <td colspan="16"></td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td colspan="16"></td>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border"></td>
                </tr>

                <!-- 3. LUGAR DE MUESTREO -->
                <tr>
                    <td colspan="26" class="titulo fondo-titulo" style="text-align: left !important;">3. LUGAR DE MUESTREO</td>
                </tr>
                <tr>
                    <td colspan="4" class="titulo ">Departamento</td>
                    <td colspan="9">{{ $muestreo->DepartamentoMuestreo }}</td>
                    <td colspan="2" class="titulo ">Provincia</td>
                    <td colspan="5">{{ $muestreo->ProvinciaMuestreo }}</td>
                    <td colspan="2" class="titulo ">Distrito</td>
                    <td colspan="4">{{ $muestreo->DistritoMuestreo }}</td>
                </tr>
                <tr>
                    <td colspan="7" class="titulo ">Fecha(s) en que se realizará el muestreo</td>
                    <td colspan="3"></td>
                    <td colspan="8">{{ isset($muestreo->FechaTerminoMuestreo) ? $muestreo->FechaInicioMuestreo . ' - ' . $muestreo->FechaTerminoMuestreo : $muestreo->FechaInicioMuestreo }}</td>
                    <td colspan="4" class="titulo ">Días a considerar</td>
                    <td colspan="4">1</td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border"></td>
                </tr>

                <!-- 4. MUESTREO REALIZADO SEGUN PROCEDIMIENTO PL-009 -->
                <tr>
                    <td colspan="26" class="titulo fondo-titulo" style="text-align: left !important;">4. MUESTREO REALIZADO SEGÚN PROCEDIMIENTO PL-009</td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border" style="height: 0.1rem; border-left: 1px black solid !important; border-right: 1px black solid !important;"></td>
                </tr>
                <tr>
                    <td colspan="5" class="titulo sin-border" style="border-left: 1px black solid !important;">Muestreo de Aguas</td>
                    <td>{{ in_array(1,  explode(';', $muestreo->Muestreos) ) ? 'X' : '' }}</td>
                    <td colspan="4" class="sin-border"></td>
                    <td colspan="6" class="titulo sin-border">Muestreo de suelos/sedimentos</td>
                    <td>{{ in_array(3,  explode(';', $muestreo->Muestreos) ) ? 'X' : '' }}</td>
                    <td colspan="2" class="sin-border"></td>
                    <td colspan="4" class="titulo sin-border">Muestreo isocinético</td>
                    <td>{{ in_array(5,  explode(';', $muestreo->Muestreos) ) ? 'X' : '' }}</td>
                    <td colspan="2" class="sin-border" style="border-right: 1px black solid !important;"></td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border" style="height: 0.1rem; border-left: 1px black solid !important; border-right: 1px black solid !important;"></td>
                </tr>
                <tr>
                    <td colspan="5" class="titulo sin-border" style="border-left: 1px black solid !important;">Muestreo de calidad de aire</td>
                    <td>{{ in_array(2,  explode(';', $muestreo->Muestreos) ) ? 'X' : '' }}</td>
                    <td colspan="4" class="sin-border"></td>
                    <td colspan="6" class="titulo sin-border">Muestreo de emisiones</td>
                    <td>{{ in_array(4,  explode(';', $muestreo->Muestreos) ) ? 'X' : '' }}</td>
                    <td colspan="2" class="sin-border"></td>
                    <td colspan="4" class="titulo sin-border">Otros</td>
                    <td colspan="3" class="sin-border" style="border-right: 1px black solid !important; border-bottom: 1px dotted #000 !important;"></td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border" style="height: 0.1rem; border-left: 1px black solid !important; border-right: 1px black solid !important; border-bottom: 1px black solid !important;"></td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border"></td>
                </tr>

                <!-- 5. ANÁLISIS A REALIZAR SEGÚN COTIZACIÓN N° -->
                <tr>
                    <td colspan="26" class="titulo fondo-titulo" style="text-align: left !important;">5. ANÁLISIS A REALIZAR SEGÚN COTIZACIÓN N° {{ $cadena->NumeroCotizacion }}</td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border"></td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="3" class="titulo fondo-titulo2">Fecha</td>
                    <td colspan="24" class="titulo fondo-titulo2">NÚMERO DE PUNTOS DE MUESTREO</td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="2" class="titulo fondo-titulo2">Agua</td>
                    <td colspan="9" class="titulo fondo-titulo2">Calidad de Aire</td>
                    <td colspan="2" rowspan="2" class="titulo fondo-titulo2">Suelos</td>
                    <td colspan="5" class="titulo fondo-titulo2">Emisiones</td>
                    <td colspan="2" rowspan="2" class="titulo fondo-titulo2">Otros</td>
                    <td colspan="4" rowspan="2" class="titulo fondo-titulo2">Observaciones</td>
                </tr>
                <tr>
                    <td colspan="3" class="titulo fondo-titulo2">Aire</td>
                    <td colspan="3" class="titulo fondo-titulo2">Ruido</td>
                    <td colspan="3" class="titulo fondo-titulo2">Metereologia</td>
                    <td colspan="3" class="titulo fondo-titulo2">Gaseosas</td>
                    <td colspan="2" class="titulo fondo-titulo2">Isocinético</td>
                </tr>
                @php
                    $totalPuntos = count($muestreo->puntos);
                    $totalAgua = 0;
                    $totalAire = 0;
                    $totalRuido = 0;
                    $totalMetereologia = 0;
                    $totalSuelo = 0;
                    $totalGaseosa = 0;
                    $totalIsocinetico = 0;
                    $totalOtro = 0;
                @endphp
                @for ($i = 0; $i < 10; $i++)
                    @if ($i < $totalPuntos)
                        <tr>
                            <td colspan="2">{{ $muestreo->puntos[$i]->Fecha }}</td>
                            <td colspan="2">{{ $muestreo->puntos[$i]->Agua }}</td>
                            <td colspan="3">{{ $muestreo->puntos[$i]->Aire }}</td>
                            <td colspan="3">{{ $muestreo->puntos[$i]->Ruido }}</td>
                            <td colspan="3">{{ $muestreo->puntos[$i]->Metereologia }}</td>
                            <td colspan="2">{{ $muestreo->puntos[$i]->Suelo }}</td>
                            <td colspan="3">{{ $muestreo->puntos[$i]->Gaseosa }}</td>
                            <td colspan="2">{{ $muestreo->puntos[$i]->Isocinetico }}</td>
                            <td colspan="2">{{ $muestreo->puntos[$i]->Otro }}</td>
                            <td colspan="4">{{ $muestreo->puntos[$i]->Observaciones }}</td>
                        </tr>
                        @php
                            $totalAgua += $muestreo->puntos[$i]->Agua;
                            $totalAire += $muestreo->puntos[$i]->Aire;
                            $totalRuido += $muestreo->puntos[$i]->Ruido;
                            $totalMetereologia += $muestreo->puntos[$i]->Metereologia;
                            $totalSuelo += $muestreo->puntos[$i]->Suelo;
                            $totalGaseosa += $muestreo->puntos[$i]->Gaseosa;
                            $totalIsocinetico += $muestreo->puntos[$i]->Isocinetico;
                            $totalOtro += $muestreo->puntos[$i]->Otro;
                        @endphp
                    @else
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2"></td>
                            <td colspan="3"></td>
                            <td colspan="3"></td>
                            <td colspan="3"></td>
                            <td colspan="2"></td>
                            <td colspan="3"></td>
                            <td colspan="2"></td>
                            <td colspan="2"></td>
                            <td colspan="4"></td>
                        </tr>
                    @endif
                    
                @endfor
                <tr>
                    <td colspan="2" class="titulo">TOTAL</td>
                    <td colspan="2">{{ $totalAgua }}</td>
                    <td colspan="3">{{ $totalAire }}</td>
                    <td colspan="3">{{ $totalRuido }}</td>
                    <td colspan="3">{{ $totalMetereologia }}</td>
                    <td colspan="2">{{ $totalSuelo }}</td>
                    <td colspan="3">{{ $totalGaseosa }}</td>
                    <td colspan="2">{{ $totalIsocinetico }}</td>
                    <td colspan="2">{{ $totalOtro }}</td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border" style="height: 0.1rem;"></td>
                </tr>
                <tr>
                    <td colspan="2" class="sin-border"></td>
                    <td colspan="2" class="titulo fondo-titulo2">Agua para uso y consumo humano</td>
                    <td>{{ in_array(1, explode(';', $muestreo->Tipos)) ? 'X' : '' }}</td>
                    <td colspan="2" class="sin-border"></td>
                    <td colspan="3" class="titulo fondo-titulo2">Aguas Naturales</td>
                    <td>{{ in_array(2, explode(';', $muestreo->Tipos)) ? 'X' : '' }}</td>
                    <td colspan="2" class="sin-border"></td>
                    <td colspan="2" class="titulo fondo-titulo2">Aguas residuales</td>
                    <td>{{ in_array(3, explode(';', $muestreo->Tipos)) ? 'X' : '' }}</td>
                    <td colspan="2" class="sin-border"></td>
                    <td colspan="2" class="titulo fondo-titulo2">Aguas Salinas</td>
                    <td>{{ in_array(4, explode(';', $muestreo->Tipos)) ? 'X' : '' }}</td>
                    <td class="sin-border"></td>
                    <td colspan="2" class="titulo fondo-titulo2">Aguas de Proceso</td>
                    <td>{{ in_array(5, explode(';', $muestreo->Tipos)) ? 'X' : '' }}</td>
                    <td class="sin-border"></td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border" style="height: 0.1rem;"></td>
                </tr>
                <tr>
                    <td colspan="7" class="titulo fondo-titulo2">¿ Se tomo Muestra dirimente ?</td>
                    <td class="sin-border">Si</td>
                    <td>{{ ($muestreo->MuestraDirimente == 1) ? 'X' : '' }}</td>
                    <td class="sin-border"></td>
                    <td class="sin-border">No</td>
                    <td>{{ ($muestreo->MuestraDirimente == 0) ? 'X' : '' }}</td>
                    <td colspan="2" class="sin-border"></td>
                    <td colspan="6" class="titulo sin-border">Matriz de la muestra dirimente:</td>
                    <td colspan="6" class="sin-border" style="border-bottom: 1px dotted #000 !important;" >{{ $muestreo->MatrizMuestraDirimente }}</td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border"></td>
                </tr>

                <!-- 6. DOCUMENTOS ASOCIADOS -->
                <tr>
                    <td colspan="26" class="titulo fondo-titulo" style="text-align: left !important;">6. DOCUMENTOS ASOCIADOS</td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border"></td>
                </tr>
                <tr>
                    <td colspan="2" class="titulo fondo-titulo2">DA-002</td>
                    <td>{{ in_array(1, explode(';', $muestreo->DocumentosAsociados)) ? 'X' : '' }}</td>
                    <td colspan="2" class="sin-border"></td>
                    <td colspan="2" class="titulo fondo-titulo2">CDC</td>
                    <td>{{ in_array(2, explode(';', $muestreo->DocumentosAsociados)) ? 'X' : '' }}</td>
                    <td colspan="2" class="sin-border"></td>
                    <td colspan="3" class="titulo fondo-titulo2">DA-031</td>
                    <td>{{ in_array(3, explode(';', $muestreo->DocumentosAsociados)) ? 'X' : '' }}</td>
                    <td class="sin-border"></td>
                    <td colspan="3" class="titulo fondo-titulo2">PL-009</td>
                    <td>{{ in_array(4, explode(';', $muestreo->DocumentosAsociados)) ? 'X' : '' }}</td>
                    <td colspan="2" class="sin-border"></td>
                    <td colspan="2" class="titulo fondo-titulo2">Otros</td>
                    <td colspan="3" ></td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border"></td>
                </tr>

                <!-- 7. EQUIPOS DE MUESTREO A USAR: -->
                <tr>
                    <td colspan="26" class="titulo fondo-titulo" style="text-align: left !important;">7. EQUIPOS DE MUESTREO A USAR:</td>
                </tr>
                <tr>
                    <td colspan="26" class="sin-border"></td>
                </tr>
                <tr>
                    <td colspan="13" class="titulo fondo-titulo2">Equipo</td>
                    <td colspan="13" class="titulo fondo-titulo2">Código de Laboratorio</td>
                </tr>
                @php
                    $totalEquipos = count($muestreo->equipos);
                @endphp
                @for ($i = 0; $i < 12; $i++)
                    @if ($i < $totalEquipos)
                        <tr>
                            <td colspan="13">{{ $muestreo->equipos[$i]->Equipo }}</td>
                            <td colspan="13">{{ $muestreo->equipos[$i]->CodigoLaboratorio }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="13"></td>
                            <td colspan="13"></td>
                        </tr>
                    @endif
                    
                @endfor
                <tr>
                    <td colspan="26" class="sin-border"></td>
                </tr>

            </tbody>
        </table>

        <div style="page-break-after:always;"></div>
        
        <table class="header">
            <tr>
                <td rowspan="3" style="width: 20%;">
                    <img src="{{ public_path() . '\assets\img\logo-sag-azul.png'; }}" alt="" style="height: 50px;">
                </td>
                <td rowspan="3" class="tituloCabecera">PLAN DE MUESTREO</td>
                <td style="width: 10%;" class="texto-derecha">FM-093</td>
            </tr>
            <tr>
                <td class="texto-derecha">Versión: 08</td>
            </tr>
            <tr>
                <td class="texto-derecha">F.E.: 02/2020</td>
            </tr>
            <tr>
                <td colspan="3" class="tituloCabecera">N° de informes: </td>
            </tr>
        </table>

        <table class="cabecera">
            <tbody>
                <!-- 8. RESUMEN DE ASEGURAMIENTO DE LA CALIDAD -->
                <tr>
                    <td colspan="20" class="titulo fondo-titulo" style="text-align: left !important;">8. RESUMEN DE ASEGURAMIENTO DE LA CALIDAD</td>
                </tr>
                <tr>
                    <td colspan="20" class="sin-border"></td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="2" class="titulo fondo-titulo">Aseguramiento de la calidad</td>
                    <td colspan="2" rowspan="2" class="titulo fondo-titulo">AGUA</td>
                    <td colspan="2" rowspan="2" class="titulo fondo-titulo">SUELO / SEDIMENTO / LOGO</td>
                    <td colspan="10" class="titulo fondo-titulo">AIRE</td>
                    <td colspan="4" class="sin-border"></td>
                </tr>
                <tr>
                    <td class="titulo fondo-titulo">PM10↑</td>
                    <td class="titulo fondo-titulo">PM2.5↑</td>
                    <td class="titulo fondo-titulo">PM10↓</td>
                    <td class="titulo fondo-titulo">PM2.5↓</td>
                    <td class="titulo fondo-titulo">PTS</td>
                    <td class="titulo fondo-titulo">PM1</td>
                    <td class="titulo fondo-titulo">VOCs (barrido)</td>
                    <td class="titulo fondo-titulo">BENCENO</td>
                    <td class="titulo fondo-titulo">merurio (MGT)</td>
                    <td class="titulo fondo-titulo">GASES*</td>
                    <td colspan="4" class="sin-border"></td>
                </tr>
                <tr>
                    <td colspan="2">BKc</td>
                    <td colspan="2">X A</td>
                    <td colspan="2"></td>
                    <td></td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td style="text-decoration: underline;">X</td>
                    <td style="text-decoration: underline;">X</td>
                    <td style="text-decoration: underline;">X</td>
                    <td style="text-decoration: underline;">X</td>
                    <td>CO D</td>
                    <td colspan="4" class="sin-border"></td>
                </tr>
                <tr>
                    <td colspan="2">BKv</td>
                    <td colspan="2">X</td>
                    <td colspan="2"></td>
                    <td></td>
                    <td>X</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="4" class="sin-border"></td>
                </tr>
                <tr>
                    <td colspan="2"Duplicado></td>
                    <td colspan="2">X B</td>
                    <td colspan="2">X C</td>
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
                    <td colspan="4" class="sin-border"></td>
                </tr>
                <tr>
                    <td colspan="11" class="sin-border texto-izquierda">*GASES: NO₂, SO₂, O₃, H₂S, Niebla ácida</td>
                    <td colspan="9" class="sin-border texto-izquierda">**Dos Blancos</td>
                </tr>
                <tr>
                    <td colspan="20" class="sin-border"></td>
                </tr>
                <!-- -->
                <tr>
                    <td colspan="2" rowspan="2" class="titulo fondo-titulo">Aseguramiento de la calidad</td>
                    <td colspan="16" class="titulo fondo-titulo">EMISIONES</td>
                    <td colspan="2" class="titulo fondo-titulo">SALUD OCUPACIONAL</td>
                </tr>
                <tr>
                    <td colspan="2" class="titulo fondo-titulo">Material Particulado EPA 5</td>
                    <td colspan="2" class="titulo fondo-titulo">SO₂ EPA 6</td>
                    <td class="titulo fondo-titulo">O₂, CO, NO₂ (CTM 30 / CTM34)</td>
                    <td class="titulo fondo-titulo">METALES EPA 29</td>
                    <td class="titulo fondo-titulo">TRS (H₂S) EPA 16 A</td>
                    <td class="titulo fondo-titulo">VOCs EPA 18</td>
                    <td class="titulo fondo-titulo">H₂SO₄, SO₂ EPA 8</td>
                    <td class="titulo fondo-titulo">NO₂, NO, EPA 7</td>
                    <td class="titulo fondo-titulo">SO₂ EPA 6C</td>
                    <td class="titulo fondo-titulo">H₂S (CELDAS ELECTRO QUIMICAS)</td>
                    <td class="titulo fondo-titulo">OPACIDAD</td>
                    <td class="titulo fondo-titulo">TOC EPA 25A</td>
                    <td colspan="2" class="titulo fondo-titulo">HCI, HBr, HF, CI₂, Br₂ EPA 26A</td>
                    <td class="titulo fondo-titulo">Polvo inhalable</td>
                    <td class="titulo fondo-titulo">Polvo respirable</td>
                </tr>
                <tr>
                    <td colspan="2">BKc</td>
                    <td colspan="2"></td>
                    <td colspan="2">X E</td>
                    <td></td>
                    <td style="text-decoration: underline;">X</td>
                    <td style="text-decoration: underline;">X</td>
                    <td style="text-decoration: underline;">X</td>
                    <td style="text-decoration: underline;">X</td>
                    <td style="text-decoration: underline;">X</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2"></td>
                    <td>X**</td>
                    <td>X**</td>
                </tr>
                <tr>
                    <td colspan="2">Bk de filtro</td>
                    <td colspan="2">X</td>
                    <td colspan="2"></td>
                    <td></td>
                    <td style="text-decoration: underline;">X</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">Bk de acetona</td>
                    <td colspan="2" style="text-decoration: underline;">X***</td>
                    <td colspan="2"></td>
                    <td></td>
                    <td style="text-decoration: underline;">X***</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">Duplicado</td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td>X</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-decoration: underline;">X</td>
                    <td style="text-decoration: underline;">X</td>
                    <td></td>
                    <td></td>
                    <td colspan="2"></td>
                    <td>X</td>
                    <td>X</td>
                </tr>
                <tr>
                    <td colspan="20" class="sin-border texto-izquierda">Consultar en el DA-031 sobre los item A, B, C, D, E</td>
                </tr>
                <tr>
                    <td colspan="20" class="sin-border texto-izquierda">***acetona: solo EPA5 sera 200ml: EPA 29 y EPA 5 100mL</td>
                </tr>
                <tr>
                    <td colspan="20" class="sin-border"></td>
                </tr>
                <!-- 9. DUPLICADOS A CONSIDERAR EN LA MATRIZ DE -->
                <tr>
                    <td colspan="20" class="titulo fondo-titulo sin-border" style="text-align: left !important; border-top: 1px solid black !important; border-right: 1px solid black !important; border-left: 1px solid black !important;"></td>
                </tr>
                <tr>
                    <td colspan="7" class="titulo fondo-titulo sin-border" style="text-align: left !important; border-left: 1px solid black !important;">9. DUPLICADOS A CONSIDERAR EN LA MATRIZ DE:</td>
                    <td class="titulo fondo-titulo sin-border">AGUA</td>
                    <td class="titulo">{{ in_array(1, explode(';', $muestreo->Procedimientos)) ? 'X' : '' }}</td>
                    <td class="titulo fondo-titulo sin-border"></td>
                    <td colspan="3" class="titulo fondo-titulo sin-border">SUELO / SEDIMENTO</td>
                    <td class="titulo">{{ in_array(2, explode(';', $muestreo->Procedimientos)) ? 'X' : '' }}</td>
                    <td class="titulo fondo-titulo sin-border"></td>
                    <td colspan="3" class="titulo fondo-titulo sin-border">EMISIONES GASEOSAS</td>
                    <td class="titulo">{{ in_array(3, explode(';', $muestreo->Procedimientos)) ? 'X' : '' }}</td>
                    <td class="titulo fondo-titulo sin-border" style="border-right: 1px solid black !important;"></td>
                </tr>
                <tr>
                    <td colspan="20" class="titulo fondo-titulo sin-border" style="text-align: left !important; border-bottom: 1px solid black !important; border-right: 1px solid black !important; border-left: 1px solid black !important;"></td>
                </tr>
                <tr>
                    <td colspan="6" class="titulo">Matriz</td>
                    <td colspan="14" class="titulo">parámetro a considerarse para el duplicado</td>
                </tr>
                @php
                    $totalMatrices = count($muestreo->parametros)
                @endphp
                @for ($i = 0; $i < 10; $i++)
                    @if ($i < $totalMatrices)
                        <tr>
                            <td colspan="6">{{ $muestreo->parametros[$i]->Matriz }}</td>
                            <td colspan="14">{{ $muestreo->parametros[$i]->Parametro }}</td>
                        </tr>    
                    @else    
                        <tr>
                            <td colspan="6"></td>
                            <td colspan="14"></td>
                        </tr>    
                    @endif
                @endfor
            </tbody>
        </table>

    </body>

    

    
    


</html>