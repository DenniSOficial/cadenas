<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>CÁLCULO INCERTIDUMBRE</title>

    <style>
       
       /* @page { margin: 10; } */

       body {
            font-size: 7px;
            word-break: break-all;
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
            font-size: 6px;
        }

        .saltopagina{
            page-break-after:always;
        }

    </style>
</head>

    <header>
        <table class="header">
            <tr>
                <td rowspan="4" style="width: 20%;">
                    <img src="{{ public_path() . '\assets\img\logo-sag-azul.png'; }}" alt="" style="height: 50px;">
                </td>
                <td rowspan="4" class="tituloCabecera">CÁLCULO INCERTIDUMBRE</td>
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
                    <td rowspan="2">Número de mediciones</td>
                    <td rowspan="2">LAeq [dB]</td>
                    <td rowspan="2">Aseguramiento N° 01 (Mediciones consecutivas)</td>
                    <td rowspan="2">Ruido residual</td>
                    <td rowspan="2">Aseguramiento N° 01 (Mediciones consecutivas)</td>

                    <td colspan="5">Corrección por ruido residual</td>

                    <td colspan="2" rowspan="2">Incertidumbre estandar del método</td>

                    <td colspan="2">Aporte de condiciones de operación</td>
                    <td colspan="5">Aporte de incertidumbre del ruido residual</td>
                    <td rowspan="2">APORTE DE LA UBICACIÓN DEL MICRÓFONO ULoc</td>
                    <td colspan="2">Aporte de las condiciones Met. UMet</td>
                    <td rowspan="2">Incertidumbre combinada de cada ventana uL</td>
                    <td rowspan="3">Aporte del certificado de calibración del equipo</td>
                    <td colspan="2" rowspan="3"></td>
                </tr>
                <tr>
                    <td>Diferencia</td>
                    <td>Condición de Corrección</td>
                    <td>LAeq Corregido </td>
                    <td>LAeq Res</td>
                    <td>(100.1*Li - 100.1*Lk)2</td>

                    <td>Laeq</td>
                    <td>usou</td>
                    <td>Cres</td>
                    <td>CL´</td>
                    <td>ures</td>
                    <td>uL´ Referido a clase 1 Sonómetro</td>
                    <td>uL</td>
                    <td>Alturas</td>
                    <td>Unidad (m)</td>
                </tr>
                <tr>
                    <td colspan="12">{{ $detalle->CodigoCliente }}</td>
                    <td colspan="11">Medición {{ ($detalle->Periodo == 'DIURNO') ? 'Diurna' : 'Nocturna' }}</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>{{ $detalle->Laeq1}}</td>
                    <td>-</td>
                    <td>{{ $detalle->Rr1 }}</td>
                    <td>-</td>
                    <td>{{ $detalle->Diferencia1 }}</td>
                    <td>{{ $detalle->CondicionCorrecion1 }}</td>
                    <td>{{ $detalle->LaeqCorregido1 }}</td>
                    <td rowspan="10">{{ $detalle->LaeqRes }}</td>
                    <td class="letra-chica">{{ $detalle->Li_Lk_1 }}</td>
                    <td>Lk1=</td>
                    <td>{{$detalle->Lk1}}</td>
                    <td>{{ $detalle->Laeq1}}</td>
                    <td rowspan="10">{{ $detalle->Usou }}</td>
                    <td>{{ $detalle->Cres1 }}</td>
                    <td>{{ $detalle->Cl1 }}</td>
                    <td rowspan="10">{{ $detalle->Ures }}</td>
                    <td rowspan="10">{{ $detalle->UlSonometro }}</td>
                    <td rowspan="10">{{ $detalle->Ul }}</td>
                    <td rowspan="4">{{ $detalle->UbicacionMicrofonoTexto }}</td>
                    <td>hs =</td>
                    <td>{{ $detalle->hs }}</td>
                    <td rowspan="10">{{ $detalle->IncertidumbreCombinada }}</td>
                    <td rowspan="10">{{ $detalle->AporteCertificadoCalibracion }}</td>
                    <td rowspan="5">Incertidumbre combinada</td>
                    <td rowspan="5">{{ $detalle->IncertidumbreCombinada }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>{{ $detalle->Laeq2}}</td>
                    <td>{{ $detalle->AseguramientoLaeq1 }}</td>
                    <td>{{ $detalle->Rr2 }}</td>
                    <td>{{ $detalle->AseguramientoRr1 }}</td>
                    <td>{{ $detalle->Diferencia2 }}</td>
                    <td>{{ $detalle->CondicionCorrecion2 }}</td>
                    <td>{{ $detalle->LaeqCorregido2 }}</td>
                    <td class="letra-chica">{{ $detalle->Li_Lk_2 }}</td>
                    <td>Sk1=</td>
                    <td>{{$detalle->Sk1}}</td>
                    <td>{{ $detalle->Laeq2}}</td>
                    <td>{{ $detalle->Cres2 }}</td>
                    <td>{{ $detalle->Cl2 }}</td>
                    <td>hs =</td>
                    <td>{{ $detalle->hs }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>{{ $detalle->Laeq3}}</td>
                    <td>{{ $detalle->AseguramientoLaeq2 }}</td>
                    <td>{{ $detalle->Rr3 }}</td>
                    <td>{{ $detalle->AseguramientoRr2 }}</td>
                    <td>{{ $detalle->Diferencia3 }}</td>
                    <td>{{ $detalle->CondicionCorrecion3 }}</td>
                    <td>{{ $detalle->LaeqCorregido3 }}</td>
                    <td class="letra-chica">{{ $detalle->Li_Lk_3 }}</td>
                    <td rowspan="8">Uk1=</td>
                    <td rowspan="8">{{$detalle->Uk1}}</td>
                    <td>{{ $detalle->Laeq3}}</td>
                    <td>{{ $detalle->Cres3 }}</td>
                    <td>{{ $detalle->Cl3 }}</td>
                    <td>hs =</td>
                    <td>{{ $detalle->hs }}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>{{ $detalle->Laeq4}}</td>
                    <td>{{ $detalle->AseguramientoLaeq3 }}</td>
                    <td>{{ $detalle->Rr4 }}</td>
                    <td>{{ $detalle->AseguramientoRr3 }}</td>
                    <td>{{ $detalle->Diferencia4 }}</td>
                    <td>{{ $detalle->CondicionCorrecion4 }}</td>
                    <td>{{ $detalle->LaeqCorregido4 }}</td>
                    <td class="letra-chica">{{ $detalle->Li_Lk_4 }}</td>
                    <td>{{ $detalle->Laeq4}}</td>
                    <td>{{ $detalle->Cres4 }}</td>
                    <td>{{ $detalle->Cl4 }}</td>
                    <td>hs =</td>
                    <td>{{ $detalle->hs }}</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>{{ $detalle->Laeq5}}</td>
                    <td>{{ $detalle->AseguramientoLaeq4 }}</td>
                    <td>{{ $detalle->Rr5 }}</td>
                    <td>{{ $detalle->AseguramientoRr4 }}</td>
                    <td>{{ $detalle->Diferencia5 }}</td>
                    <td>{{ $detalle->CondicionCorrecion5 }}</td>
                    <td>{{ $detalle->LaeqCorregido5 }}</td>
                    <td class="letra-chica">{{ $detalle->Li_Lk_5 }}</td>
                    <td>{{ $detalle->Laeq5}}</td>
                    <td>{{ $detalle->Cres5 }}</td>
                    <td>{{ $detalle->Cl5 }}</td>
                    <td rowspan="6">{{ $detalle->UbicacionMicrofono }}</td>
                    <td>hs =</td>
                    <td>{{ $detalle->hs }}</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>{{ $detalle->Laeq6}}</td>
                    <td>{{ $detalle->AseguramientoLaeq5 }}</td>
                    <td>{{ $detalle->Rr6 }}</td>
                    <td>{{ $detalle->AseguramientoRr5 }}</td>
                    <td>{{ $detalle->Diferencia6 }}</td>
                    <td>{{ $detalle->CondicionCorrecion6 }}</td>
                    <td>{{ $detalle->LaeqCorregido6 }}</td>
                    <td class="letra-chica">{{ $detalle->Li_Lk_6 }}</td>
                    <td>{{ $detalle->Laeq6}}</td>
                    <td>{{ $detalle->Cres6 }}</td>
                    <td>{{ $detalle->Cl6 }}</td>
                    <td>hs =</td>
                    <td>{{ $detalle->hs }}</td>
                    <td rowspan="5">Incertidumbre expandida, factor de cobertura K=2</td>
                    <td rowspan="5">{{ $detalle->IncertidumbreExpandida }}</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>{{ $detalle->Laeq7}}</td>
                    <td>{{ $detalle->AseguramientoLaeq6 }}</td>
                    <td>{{ $detalle->Rr7 }}</td>
                    <td>{{ $detalle->AseguramientoRr6 }}</td>
                    <td>{{ $detalle->Diferencia7 }}</td>
                    <td>{{ $detalle->CondicionCorrecion7 }}</td>
                    <td>{{ $detalle->LaeqCorregido7 }}</td>
                    <td class="letra-chica">{{ $detalle->Li_Lk_7 }}</td>
                    <td>{{ $detalle->Laeq7}}</td>
                    <td>{{ $detalle->Cres7 }}</td>
                    <td>{{ $detalle->Cl7 }}</td>
                    <td>hs =</td>
                    <td>{{ $detalle->hs }}</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>{{ $detalle->Laeq8}}</td>
                    <td>{{ $detalle->AseguramientoLaeq7 }}</td>
                    <td>{{ $detalle->Rr8 }}</td>
                    <td>{{ $detalle->AseguramientoRr7 }}</td>
                    <td>{{ $detalle->Diferencia8 }}</td>
                    <td>{{ $detalle->CondicionCorrecion8 }}</td>
                    <td>{{ $detalle->LaeqCorregido8 }}</td>
                    <td class="letra-chica">{{ $detalle->Li_Lk_8 }}</td>
                    <td>{{ $detalle->Laeq8}}</td>
                    <td>{{ $detalle->Cres8 }}</td>
                    <td>{{ $detalle->Cl8 }}</td>
                    <td>hs =</td>
                    <td>{{ $detalle->hs }}</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>{{ $detalle->Laeq9}}</td>
                    <td>{{ $detalle->AseguramientoLaeq8 }}</td>
                    <td>{{ $detalle->Rr9 }}</td>
                    <td>{{ $detalle->AseguramientoRr8 }}</td>
                    <td>{{ $detalle->Diferencia9 }}</td>
                    <td>{{ $detalle->CondicionCorrecion9 }}</td>
                    <td>{{ $detalle->LaeqCorregido9 }}</td>
                    <td class="letra-chica">{{ $detalle->Li_Lk_9 }}</td>
                    <td>{{ $detalle->Laeq9}}</td>
                    <td>{{ $detalle->Cres9 }}</td>
                    <td>{{ $detalle->Cl9 }}</td>
                    <td>hs =</td>
                    <td>{{ $detalle->hs }}</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>{{ $detalle->Laeq10}}</td>
                    <td>{{ $detalle->AseguramientoLaeq9 }}</td>
                    <td>{{ $detalle->Rr10 }}</td>
                    <td>{{ $detalle->AseguramientoRr9 }}</td>
                    <td>{{ $detalle->Diferencia10 }}</td>
                    <td>{{ $detalle->CondicionCorrecion10 }}</td>
                    <td>{{ $detalle->LaeqCorregido10 }}</td>
                    <td class="letra-chica">{{ $detalle->Li_Lk_10 }}</td>
                    <td>{{ $detalle->Laeq10}}</td>
                    <td>{{ $detalle->Cres10 }}</td>
                    <td>{{ $detalle->Cl10 }}</td>
                    <td>hs =</td>
                    <td>{{ $detalle->hs }}</td>
                </tr>
                
                
            </tbody>
        </table>
    </body>

    

    
    


</html>