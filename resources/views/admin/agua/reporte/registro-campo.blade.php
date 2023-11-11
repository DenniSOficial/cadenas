<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Registro de campo</title>

    <style>
       
       @page { margin: 10; }

       body {
            font-size: 6px;
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
            font-size: 7px;
        }

        .saltopagina{
            page-break-after:always;
        }
        

    </style>

</head>
<?php $pagInicial = 1; ?>
<?php $currentdetalle = 0; ?>
<?php $indice = 0; ?>


    <header>
        <table class="header">
            <tr>
                <td rowspan="4" style="width: 20%;">
                    
                    <img src="{{ public_path() . '\assets\img\logo-sag-azul.png'; }}" alt="" style="height: 50px;">
                </td>
                <td rowspan="4" class="tituloCabecera">REGISTRO DE CAMPO - CALIDAD DE AGUA</td>
                <td style="width: 10%;" class="texto-derecha">FM-006</td>
            </tr>
            <tr>
                <td class="texto-derecha">Versión: 15</td>
            </tr>
            <tr>
                <td class="texto-derecha">F.E.: 08/2022</td>
            </tr>
            
        </table>
    </header>

    <body>
        
            <table class="cabecera">

                <tbody>
                    <tr>
                        <td colspan="5" class="titulo sin-border">Cliente:</td>
                        <td colspan="13" class="sin-border">{{ $cabecera->NombreCliente}}</td>

                        <td colspan="2" class="titulo sin-border">Lugar:</td>
                        <td colspan="6" class="sin-border">{{ $cabecera->Lugar }}</td>

                        <td colspan="3" class="titulo sin-border">Empresa / Planta:</td>
                        <td colspan="9" class="sin-border">{{ $cabecera->Empresa }}</td>

                        <td colspan="4" class="titulo sin-border">Cotización:</td>
                        <td colspan="6" class="sin-border">{{ $cabecera->NumeroCotizacion }}</td>
                    </tr>

                    <tr>
                        <td colspan="4" class="titulo sin-border">Multiparámetro:</td>
                        <td colspan="2" class="sin-border">ELAB-</td>

                        <td colspan="2" class="titulo sin-border">Colorímetro:</td>
                        <td colspan="3" class="sin-border">ELAB-</td>

                        <td colspan="2" class="titulo sin-border">Termómetro:</td>
                        <td colspan="2" class="sin-border">ELAB-</td>

                        <td colspan="3" class="titulo sin-border">Medidor de ORP:</td>
                        <td colspan="2" class="sin-border">ELAB-</td>

                        <td colspan="3" class="titulo sin-border">Turbidímetro:</td>
                        <td colspan="2" class="sin-border">ELAB-</td>

                        <td colspan="2" class="titulo sin-border">Correntómetro:</td>
                        <td colspan="2" class="sin-border">ELAB-</td>

                        <td colspan="2" class="titulo sin-border">Cronómetro:</td>
                        <td colspan="2" class="sin-border">ELAB-</td>

                        <td colspan="2" class="titulo sin-border">Probeta:</td>
                        <td colspan="4" class="sin-border">ELAB-</td>

                        <td colspan="3" class="titulo sin-border">Wincha:</td>
                        <td colspan="2" class="sin-border">ELAB-</td>

                        <td colspan="2" class="titulo sin-border">Disco Secchi:</td>
                        <td colspan="2" class="sin-border">ELAB-</td>
                    </tr>
                    <tr>
                        <td colspan="48" class="sin-border"></td>
                    </tr>
                    <tr>
                        <td colspan="48">EL ASEGURAMIENTO DE CALIDAD DE RESULTADOS:    Se realiza: Muestra Control (MC),  Duplicado,   para cada 10 muestras y/o cada día . </td>
                    </tr>
                    
                    <tr>
                        <td rowspan="3" colspan="2" class="titulo ">Material de referencia:</td>
                        <td rowspan="5" colspan="2" class="titulo">Potencial oxido reducción (mV)</td>
                        <td class="titulo" class="titulo">Valor MC</td>
                        <td class="titulo" class="titulo">Marca</td>
                        <td class="titulo" class="titulo">Lote</td>
                        <td rowspan="5" colspan="2" class="titulo" class="titulo">Conductividad MC (uS/cm)</td>
                        <td colspan="2" class="titulo" class="titulo">Valor MC</td>
                        <td colspan="2" class="titulo" class="titulo">Marca</td>
                        <td colspan="2" class="titulo" class="titulo">Lote</td>
                        <td rowspan="5" colspan="2" class="titulo" class="titulo">pH  MC (unid. pH)</td>
                        <td class="titulo" class="titulo">Valor MC</td>
                        <td class="titulo" class="titulo">Marca</td>
                        <td colspan="2" class="titulo" class="titulo">Lote</td>
                        <td rowspan="5" colspan="2" class="titulo" class="titulo">Oxígeno Disuelto MC: (O2 mg/L) </td>
                        <td colspan="2" class="titulo" class="titulo">NaSO3: </td>
                        <td class="titulo" class="titulo">Marca</td>
                        <td class="" class="titulo"></td>
                        <td class="titulo" class="titulo">Lote</td>
                        <td class="" class="titulo"></td>
                        <td rowspan="5" colspan="2" class="titulo" class="titulo">Turbiedad  (NTU)</td>
                        <td class="" class="titulo">MC: 10 NTU</td>
                        <td class="" class="titulo">Rango: 9.5-10.5</td>
                        <td colspan="3" class="" class="titulo">Marca: <br>Lote: </td>
                        <td rowspan="5" colspan="2" class="titulo" class="titulo">Temperatura (°C )</td>
                        <td rowspan="3" colspan="2" class="titulo" class="titulo">Resultado obtenido de la tabla de corrección del equipo</td>
                        <td rowspan="5" colspan="2" class="titulo" class="titulo">Cloro ( Cl2  mg/L )</td>
                        <td class="" class="titulo">MC:</td>
                        <td class="" class="titulo">Rango: +/- 0.09 mg/L</td>
                        <td colspan="4" class="" class="titulo">Marca: <br>Lote: </td>
                    </tr>

                    {{-- <tr><td colspan="18" class="separador sin-border"></td></tr> --}}

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" class="titulo">CoCl2:</td>
                        <td class="titulo">Marca</td>
                        <td></td>
                        <td class="titulo">Lote</td>
                        <td></td>
                        <td class="" class="titulo">MC: 100 NTU</td>
                        <td class="" class="titulo">Rango: 9.5-10.5</td>
                        <td colspan="3" class="" class="titulo">Marca: <br>Lote: </td>
                        <td class="" class="titulo">MC:</td>
                        <td class="" class="titulo">Rango: +/- 0.09 mg/L</td>
                        <td colspan="4" class="" class="titulo">Marca: <br>Lote: </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" class="titulo">CoCl2:</td>
                        <td class="titulo">Marca</td>
                        <td></td>
                        <td class="titulo">Lote</td>
                        <td></td>
                        <td class="" class="titulo">MC: 100 NTU</td>
                        <td class="" class="titulo">Rango: 9.5-10.5</td>
                        <td colspan="3" class="" class="titulo">Marca: <br>Lote: </td>
                        <td class="" class="titulo">MC:</td>
                        <td class="" class="titulo">Rango: +/- 0.09 mg/L</td>
                        <td colspan="4" class="" class="titulo">Marca: <br>Lote: </td>
                    </tr>

                    <tr>
                        <td rowspan="2" colspan="2" class="titulo">Rango de Aceptación de Duplicados</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2">≤ 84 mS/cm</td>
                        <td colspan="2">> 84 uS/cm - ≤ 1413 uS/cm</td>
                        <td colspan="2">>1413 mS/cm </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td rowspan="2" colspan="3"> RPD OXÍGENO POR MENBRANA ≤ 5.2 %</td>
                        <td rowspan="2" colspan="3">RPD OXÍGENO POR  LUMINICENCIA ≤ 4.0 %</td>
                        <td rowspan="2" colspan="5">0.4 - ≤ 10    NTU  RPD  ≤ 15.0 % <br> >10 -  ≤ 50 NTU  RPD  ≤ 13.0 % <br> > 50 NTU  RPD  ≤ 10.0 %</td>
                        <td colspan="2">Temperatura  0.1 -100 °C</td>
                        <td colspan="6" rowspan="2">> 0.1 - ≤ 0.25 mg/L  RSD  ≤ 20 % <br> > 0.25 - ≤ 2.0 mg/L  RSD  ≤ 16 % <br> >  2.0 mg/L      RSD     ≤ 10 % </td>
                    </tr>

                    <tr>
                        <td colspan="3">Duplicado  ≤     + / - 10 mV</td>
                        <td colspan="2">RPD                                              ≤ 1.7 %</td>
                        <td colspan="2">RPD                                                  ≤ 0.6 %</td>
                        <td colspan="2">RPD                                            ≤1.0%</td>
                        <td colspan="4"> RPD  ≤ 1.0%</td>
                        <td colspan="2">RPD  ≤ 4.1%</td>
                    </tr>
                    {{-- <tr>
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
                    </tr> --}}

                    <?php $inicio = 1; ?>
                    <?php $final = 4; ?>

                    {{-- @while ($inicio <= $final)
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
                    @endwhile --}}

                    {{-- <tr>
                        <td colspan="18" class="separador sin-border" style="height: 20px;">
                            <span>DATOS DEL MUESTREO:</span> Registrar la información de campo en el siguiente recuadro: <span>(Completar o Marcar "X")</span> 
                        </td>
                    </tr> --}}

                    {{-- DATOS del MUESTREO --}}

                    <tr>
                        <td colspan="48"></td>
                    </tr>

                    <tr>
                        <td colspan="7" rowspan="5" class="titulo">CÓDIGO DEL PUNTO</td>
                        <td rowspan="5" colspan="4" class="titulo">Fecha <br>(aaaa-mm-dd)</td>
                        <td colspan="2" rowspan="5">Hora de muestreo (formato de 24 horas)</td>
                        <td rowspan="3" colspan="5">Potencial oxido reducción ORP(l) (mV)</td>
                        <td rowspan="3" colspan="2">T (a)  (°C) (usar tabla de corrección)</td>
                        <td rowspan="3" colspan="3">pH(b)  (unid. pH)</td>
                        <td rowspan="3" colspan="2">Cond.(c) (uS/cm) (revisar las unidades)</td>
                        <td rowspan="3" colspan="2">OD(d) ó (e) (mg/L)</td>
                        <td rowspan="3" colspan="2">Cloro residual / libre (f) mg/L</td>
                        <td rowspan="3" colspan="2">Cloro total  (g)   mg/L</td>
                        <td rowspan="3" colspan="4">Turbiedad (h)   (NTU)</td>
                        <td colspan="5">Caudal</td>
                        <td colspan="5">Transperencia</td>
                        <td colspan="3" rowspan="5">Metodologías: Marcar con un Check el método  empleado.</td>
                    </tr>
                    
                    <tr>
                        <td colspan="3" rowspan="2">Caudal canales abiertos ***</td>
                        <td colspan="2" rowspan="2">Caudal volumétrico</td>
                        <td colspan="5">reportar el diametro (Ø) y tipo de disco</td>
                    </tr>
                    
                    <tr>
                        <td rowspan="2" colspan="5">* profundidades mayor a 0.5 m, redondear a 0.1 m
                            ** Profundidades inferiores a 0.5 m redondear a 0.05 m</td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" rowspan="2">Lectura</td>
                        <td colspan="3" rowspan="2">Duplicado</td>

                        <td rowspan="2">Lectura</td>
                        <td rowspan="2">Duplicado</td>

                        <td rowspan="2">Lectura</td>
                        <td rowspan="2" colspan="2">Duplicado</td>

                        <td rowspan="2">Lectura</td>
                        <td rowspan="2">Duplicado</td>

                        <td rowspan="2">Lectura</td>
                        <td rowspan="2">Duplicado</td>

                        <td rowspan="2">Lectura</td>
                        <td rowspan="2">Duplicado</td>

                        <td rowspan="2">Lectura</td>
                        <td rowspan="2">Duplicado</td>

                        <td rowspan="2">Lectura</td>
                        <td rowspan="2">Duplicado</td>

                        <td rowspan="2">Lectura</td>
                        <td rowspan="2">Duplicado</td>

                        <td rowspan="2" colspan="3">Caudal (i)    m3/s</td>
                        <td rowspan="2" colspan="2">Caudal (j)    L/s</td>
                    </tr>

                    <tr>
                        <td colspan="5">m (k)</td>
                    </tr>

                    {{-- DATA --}}
                    
                    <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                        <td  colspan="2">(a) SM 2550 B</td>
                        <td >X</td>
                    </tr>

                    <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                        <td  colspan="2">(b) SM 4500-H+ B</td>
                        <td >X</td>
                    </tr>

                    <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                        <td  colspan="2">(c) SM 2510 B</td>
                        <td >X</td>
                    </tr>
                    
                    <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                        <td  colspan="2">(d) SM 4500-O G</td>
                        <td >X</td>
                    </tr>

                    <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                        <td  colspan="2">(e) NTP 214.046:2013 </td>
                        <td >X</td>
                    </tr>

                    <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                        <td rowspan="2" colspan="2">(f) SMEWW-APHA-AWWA-WEF Part 4500-Cl G. 23 rd Ed., 2017. Validado (modificado) </td>
                        <td rowspan="2">X</td>
                    </tr>

                    <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                        {{-- <td  colspan="2">(g) SMEWW-APHA-AWWA-WEF Part 4500-Cl G. 23 rd Ed., 2017. </td>
                        <td >X</td> --}}
                    </tr>

                    <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                        <td rowspan="2" colspan="2">(g) SMEWW-APHA-AWWA-WEF Part 4500-Cl G. 23 rd Ed., 2017. </td>
                        <td rowspan="2">X</td>
                    </tr>

                    <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                    </tr>

                    <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                        <td  colspan="2">(h)SM 2130-B Turbidy Nefhelometric Method</td>
                        <td >X</td>
                    </tr>

                    <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                        <td  colspan="2">(i) ISO 748:2007 Hydrometry</td>
                        <td >X</td>
                    </tr>

                    <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                        <td  colspan="2">(j) NTP 214.060.2016 (anexo D)</td>
                        <td >X</td>
                    </tr>

                    <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                        <td  colspan="2">(k) DIN EN ISO 7027-2</td>
                        <td >X</td>
                    </tr>

                    <tr>
                        <td colspan="3">ORP (LDM)</td>
                        <td colspan="3">No aplica</td>
                        <td colspan="3">Cloro libre/total  (LC)</td>
                        <td colspan="2">0.1 mg/L</td>
                        <td colspan="4">Oxigeno Disuelto (LDM):</td>
                        <td colspan="2">0.5 mg/L</td>
                        <td colspan="2">pH (LDM):</td>
                        <td colspan="2">No aplica</td>
                        <td colspan="3">Conductividad (LC):</td>
                        <td colspan="2">No aplica</td>
                        <td colspan="3">Temperatura (LDM)</td>
                        <td colspan="2">No aplica</td>
                        <td colspan="2">Turbiedad (LC)</td>
                        <td>0.4 NTU</td>
                    </tr>
                    {{-- <tr>
                        <td  colspan="7">adasdas</td>
                        <td  colspan="4">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="2">adasdas</td>
                        <td  colspan="3">adasdas</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td  colspan="2"></td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td >0</td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td  colspan="3"></td>
                        <td  colspan="2"></td>
                        <td  colspan="5">transparencia a : …...........(m), Ø….......(cm)/ secciones en blanco y negro </td>
                        <td  colspan="2">(l)SM 2580-B Oxidation-Reduction Potential Measurument </td>
                        <td >X</td>
                    </tr> --}}


                    <tr>
                        <td colspan="48"></td>
                    </tr>

                </tbody>
            </table>
            
    </body>

    <footer>
        <table class="footer">
            <tr class="headfo">
                <td colspan="5">Nombre(s) y Apellido(s) del Responsable del Muestreo:</td>
                {{-- <td colspan="6">{{ $cabecera->ResponsableMuestreo}}</td> --}}
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

                {{-- @if(file_exists( public_path() . '\assets\img\analista\\' . $cabecera->id_analista . '.png' ))
                    <td >
                        <img src="{{ public_path() . '\assets\img\analista\\' . $cabecera->id_analista . '.png'; }}" alt="" style="height: 40px; ">
                    </td>
                @else
                    <td ></td>
                @endif --}}

                {{-- @if(file_exists( public_path() . '\assets\img\analista\\' . $cabecera->id_analista2 . '.png' ))
                    <td >
                        <img src="{{ public_path() . '\assets\img\analista\\' . $cabecera->id_analista2 . '.png'; }}" alt="" style="height: 40px; ">
                    </td>
                @else
                    <td ></td>
                @endif --}}

                
                <td colspan="2">Recibido en laboratorio por:</td>
                {{-- <td colspan="2">{{ $cabecera->ResponsableLaboratorio}}</td> --}}
            </tr>
            <tr class="headfo">
                <td colspan="6">Nombre(s) y Apellido(s) del Responsable del Supervisor de Campo:</td>
                {{-- <td colspan="5">{{ $cabecera->ResponsableCampo}}</td> --}}
                <td>Firma(s)</td>
                <td colspan="2"><hr></td>
                <td colspan="2">Día/Hora:</td>
                {{-- <td colspan="2">{{ $cabecera->FechaRecepcionMuestra . ' / ' . substr($cabecera->HoraRecepcionMuestra, 0, 5) }}</td> --}}
            </tr>
        </table>
    </footer>

    

    


</html>