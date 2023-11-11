<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use PDF;
use App\Custom\WebServiceManagerCurl;
use App\Models\Control;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheep;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RuidoController extends Controller
{
    public function index()
    {
        $cadenas = [];
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/list-cadena-custodia', );
        $listado = $webService->get();
        
        if (!is_null($listado)) {

            foreach ($listado as $key => $value) {
                
                if ($value->IdEstadoCadenaCustodia == 1 || $value->IdEstadoCadenaCustodia == 5 || $value->IdEstadoCadenaCustodia == 4) { // Ingreso
                    if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2 ) {
                        array_push($cadenas, $value); //Administrador y supervisores ven todo
                    } elseif (Auth::guard('admin')->user()->IdRol == 3) { // solo analistas 
                        if ($value->UsuarioCreacion == Auth::guard('admin')->user()->Usuario) {
                            array_push($cadenas, $value);
                        }
                    }
                } elseif ($value->IdEstadoCadenaCustodia == 2) {
                    if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2 || Auth::guard('admin')->user()->IdRol == 4 ) {
                        array_push($cadenas, $value);
                    }
                } elseif ($value->IdEstadoCadenaCustodia == 3) {
                    if (Auth::guard('admin')->user()->IdRol == 1 || Auth::guard('admin')->user()->IdRol == 2) {
                        array_push($cadenas, $value);
                    }
                } 

            }
           
        }
        
        return view('admin.ruido.index')->with('cadenas', $cadenas);
    }

    public function create()
    {
        $acreditaciones = array('IAS', 'INACAL');
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/metodologia-ensayo/listado', );
        $metodologias = $webService->get();
        $cadena = null;
        $contactos = [];

        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/list-analistas', );
        $analistas = $webService->get();
        //dd($analistas);
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/list-personal-laboratorio', );
        $laboratorios = $webService->get();
        //dd($laboratorios);

        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/list-condicion-terreno', );
        $terrenos = $webService->get();
        $mis_terrenos = [];
        return view('admin.ruido.create')
                ->with('acreditaciones', $acreditaciones)
                ->with('cadena', $cadena)
                ->with('contactos', $contactos)
                ->with('terrenos', $terrenos)
                ->with('mis_terrenos', $mis_terrenos)
                ->with('metodologias', $metodologias)
                ->with('analistas', $analistas)
                ->with('laboratorios', $laboratorios);
    }

    public function store(Request $request)
    {
        $terrenos = '';
        if (isset($request->terreno)) {
            foreach ($request->terreno as $key => $value) {
                $terrenos .= $key . ',';
            }
        }

        try {
            $postdata = array(
                    'id' => 0,
                    'id_cliente' => $request->id_cliente,
                    'id_metodologia' => $request->id_metodologia,
                    'cliente' => str_replace(array("'"), "''", $request->cliente),
                    'id_contacto' => $request->id_contacto,
                    'contacto' => str_replace(array("'"), "''", $request->contacto),
                    'email' => $request->email,
                    'telefono_cliente' => $request->telefono_cliente,
                    'lugar' => is_null($request->lugar) ? '' : $request->lugar,
                    'nro_cotizacion' => $request->nro_cotizacion,
                    'empresa' => is_null($request->empresa) ? '' : $request->empresa,
                    'planta' => is_null($request->planta) ? '' : $request->planta,
                    'proyecto' => is_null($request->proyecto) ? '' : $request->proyecto,
                    'acreditado' => $request->acreditado,
                    'muestreo' => isset($request->muestreo) ? '1' : '0',
                    'nro_informe' => $request->nro_informe,
                    'terrenos' => $terrenos,
                    'usuario' => Auth::guard('admin')->user()->Usuario,
                    'analista1' => is_null($request->analista1) ? '' : $request->analista1,
                    'analista2' => is_null($request->analista2) ? '' : $request->analista2,
                    'supervisor' => is_null($request->supervisor) ? '' : $request->supervisor,
                    'laboratorio' => is_null($request->laboratorio) ? '' : $request->laboratorio
            );
            ///dd($postdata);
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Cadena de custodia registrada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/ruido');
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
                
    }

    public function findCotizacionAjax(Request $request) 
    {
        if ($request->ajax()) {

            $nro_cotizacion = $request->nro;
            $data = [];
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/find-cliente-by-cotizacion?nro=' . $nro_cotizacion, );
            $listado = $webService->get();

            if (count($listado) > 0) {
                $message = 'Ok';
                $data['cliente'] = $listado[0];
                $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/find-contacto-by-cliente?id=' . $data['cliente']->nIdCliente, );
                $listado = $webService->get();
                $data['contactos'] = $listado;
            } else {
                $message = 'No se encontro datos';
                $data = [];
            }
            
            $response = [
                'message' => $message,
                'data' => $data
            ];
    
            return response()->json($response, 200);
            
        }

    }

    public function edit(Request $request, $id)
    {
        $acreditaciones = array('IAS', 'INACAL');
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/buscar?id=' . $id , );
        $cadena = $webService->get();
        $mis_terrenos = explode(',', $cadena[0]->Terrenos);

        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/metodologia-ensayo/listado', );
        $metodologias = $webService->get();
        //dd($metodologias);
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/list-condicion-terreno', );
        $terrenos = $webService->get();

        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/list-analistas', );
        $analistas = $webService->get();

        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/list-personal-laboratorio', );
        $laboratorios = $webService->get();
        //dd($cadena[0]);
        if (count($cadena) > 0) {
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/find-contacto-by-cliente?id=' . $cadena[0]->IdCliente, );
            $contactos = $webService->get();
            return view('admin.ruido.edit')->with('acreditaciones', $acreditaciones)
                    ->with('cadena', $cadena[0])
                    ->with('contactos', $contactos)
                    ->with('terrenos', $terrenos)
                    ->with('mis_terrenos', $mis_terrenos)
                    ->with('metodologias', $metodologias)
                    ->with('analistas', $analistas)
                    ->with('laboratorios', $laboratorios);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
        
    }

    public function update(Request $request, $id)
    {
        $terrenos = '';
        if (isset($request->terreno)) {
            foreach ($request->terreno as $key => $value) {
                $terrenos .= $key . ',';
            }
        }
        //dd($request);
        try {
            $postdata = array(
                    'id' => $id,
                    'id_cliente' => $request->id_cliente,
                    'id_metodologia' => $request->id_metodologia,
                    'cliente' => str_replace(array("'"), "''", $request->cliente),
                    'id_contacto' => $request->id_contacto,
                    'contacto' => str_replace(array("'"), "''", $request->contacto),
                    'email' => $request->email,
                    'telefono_cliente' => $request->telefono_cliente,
                    'lugar' => is_null($request->lugar) ? '' : $request->lugar,
                    'nro_cotizacion' => $request->nro_cotizacion,
                    'empresa' => is_null($request->empresa) ? '' : $request->empresa,
                    'planta' => is_null($request->planta) ? '' : $request->planta,
                    'proyecto' => is_null($request->proyecto) ? '' : $request->proyecto,
                    'acreditado' => $request->acreditado,
                    'muestreo' => isset($request->muestreo) ? '1' : '0',
                    'nro_informe' => $request->nro_informe,
                    'terrenos' => $terrenos,
                    'usuario' => Auth::guard('admin')->user()->Usuario,
                    'analista1' => is_null($request->analista1) ? '' : $request->analista1,
                    'analista2' => is_null($request->analista2) ? '' : $request->analista2,
                    'supervisor' => is_null($request->supervisor) ? '' : $request->supervisor,
                    'laboratorio' => is_null($request->laboratorio) ? '' : $request->laboratorio
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Cadena de custodia actualizada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/ruido');
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
    }

    public function show(Request $request, $id)
    {
        //dd($id);
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/buscar?id=' . $id , );
        $cadena = $webService->get();
        //dd($cadena);
        if (count($cadena) > 0) {
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/buscar-by-cadena?id_cadena=' . $id , );
            $codigos = $webService->get();
            //dd($codigos);
            return view('admin.ruido.detail')->with('cadena', $cadena[0])->with('codigos', $codigos);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
        
    }

    public function print(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/reporte/cabecera?id=' . $id , );
        $cabecera = $webService->get();
        //dd($cabecera);
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/reporte/detalle?id=' . $id , );
        $detalle = $webService->get();
        
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/list-condicion-terreno' , );
        $terrenos = $webService->get();
        //dd($terrenos);
        $mis_terrenos = explode(',', $cabecera[0]->Terrenos);
        
        $data['cabecera'] = $cabecera[0];
        $data['detalle'] = $detalle;
        $data['paginas'] = count($detalle) / 4;
        $data['terrenos'] = $terrenos;
        $data['mis_terrenos'] = $mis_terrenos;
        //dd($data);

        $pdf = PDF::loadView('admin.ruido.reporte.cadena-custodia', $data)->setPaper('a4', 'landscape');
        return $pdf->stream();

        return view('admin.ruido.reporte.cadena-custodia')->with('data', $data); 

    }

    public function informe(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/reporte-informe-valor-oficial/cabecera?id=' . $id , );
        $cadena = $webService->get();
        //dd($cadena[0]);
        return view('admin.ruido.informe')->with('cadena', $cadena[0]);
    }

    public function informeUpdate(Request $request, $id)
    {
        //dd($request);
        try {
            $postdata = array(
                    'id' => $id,
                    'razon_social' => $request->razon_social,
                    'domicilio' => str_replace(array("'"), "''", $request->domicilio),
                    'contacto' => $request->contacto,
                    'referencia' => $request->referencia,
                    'procedencia' => $request->procedencia,
                    'fecha_muestra' => $request->fecha_muestra,
                    'fecha_medicion_1' => $request->fecha_medicion_1,
                    'fecha_medicion_2' => $request->fecha_medicion_2,
                    'fecha_elaboracion' => $request->fecha_elaboracion,
                    'usuario' => Auth::guard('admin')->user()->Usuario                    
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/mantenimiento-informe', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Cadena de custodia actualizada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/ruido');
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
    }

    public function unir(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/buscar?id=' . $id , );
        $cadena = $webService->get();
        //dd($cadena);
        if (count($cadena) > 0) {
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/buscar-by-cadena?id_cadena=' . $id , );
            $codigos = $webService->get();
            
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/listado-codigos-by-cadena-informe?id=' . $id . '&informe=' . $cadena[0]->NumeroInforme  , );
            $nuevos = $webService->get();
            //dd($nuevos);
            
            return view('admin.ruido.unir')
                    ->with('cadena', $cadena[0])
                    ->with('codigos', $codigos)
                    ->with('nuevos', $nuevos);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
    }

    public function unirUpdate(Request $request, $id)
    {
        $contador = 0;

        foreach ($request->id_detalle as $detalle) {
            //dd($detalle);
            $postdata = array(
                'id' => $id,
                'detalle' => $detalle,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/unir-codigos', $postdata );
            $resultado = $webService->post();

            if ($resultado) {
                $contador += 1;
            }
        }

        if ($contador > 0) {
            Toastr::success( $contador . ' códigos agregados satisfactoriamente.', 'Sistemas Análiticos Generales');
        } else {
            Toastr::error('Hubo un error al agregar los códigos, intente nuevamente.', 'Sistemas Análiticos Generales');
        }
        return redirect('/admin/ruido');

    }

    public function duplicar(Request $request, $id)
    {
        $usuario = Auth::guard('admin')->user()->Usuario;

        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/duplicar?id=' . $id . '&usuario=' . $usuario , );
        $rpta = $webService->get();
        //dd($rpta);
        Toastr::success('Se duplico la cadena satisfactoriamente.', 'Sistemas Análiticos Generales');

        return redirect('/admin/ruido');
    }

    public function recepcionMuestra(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/buscar?id=' . $id , );
        $cadena = $webService->get();
        
        if (count($cadena) > 0) {

            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/buscar-by-cadena?id_cadena=' . $id , );
            $codigos = $webService->get();
            //dd($codigos);
            return view('admin.ruido.recepcion-muestra')
                    ->with('cadena', $cadena[0])
                    ->with('codigos', $codigos);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }

    }

    public function recepcionMuestraUpdate(Request $request, $id)
    {
        //dd($request);

        try {
            $postdata = array(
                    'id' => $id,
                    'nro_informe' => $request->nro_informe,
                    'prioridad' => isset($request->prioridad) ? '1' : '0',
                    'fecha_muestra_1' => $request->fecha_muestra_1,
                    'fecha_muestra_2' => $request->fecha_muestra_2,
                    'hora_muestra' => $request->hora_muestra,
                    'fecha_medicion_1' => $request->fecha_medicion_1,
                    'fecha_medicion_2' => $request->fecha_medicion_2,
                    'fecha_elaboracion' => $request->fecha_elaboracion,
                    'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/mantenimiento-recepcion-muestra', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {

                for ($i=0; $i < count($request->id_detalle) ; $i++) { 
                    //dd($request->id_detalle[$i]);
                    $postdata = array(
                        'id' => $request->id_detalle[$i],
                        'laboratorio' => $request->laboratorio[$i],
                        'usuario' => Auth::guard('admin')->user()->Usuario
                    );

                    $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/update-codigo-laboratorio', $postdata );
                    $resultado = $webService->post();

                }
                
                Toastr::success('Cadena de custodia actualizada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/ruido');
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
    }

    public function habilitarDeshabilitarCadena(Request $request, $id)
    {
        $usuario = Auth::guard('admin')->user()->Usuario;
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/habilita-deshabilita?id=' . $id . '&usuario=' . $usuario, );
        $resultado = $webService->get();

        if ($resultado) {
            Toastr::success('Cadena de custodia actualizada satisfactoriamente.', 'Sistemas Análiticos Generales');
        } else {
            Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
        }
        return redirect('/admin/ruido');
    }

    public function cambiarEstadoCadena(Request $request, $id, $estado)
    {
        $usuario = Auth::guard('admin')->user()->Usuario;
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/cambia-estado-cadena?id=' . $id . '&estado=' . $estado . '&usuario=' . $usuario, );
        $resultado = $webService->get();

        if ($resultado) {
            Toastr::success('Cadena de custodia actualizada satisfactoriamente.', 'Sistemas Análiticos Generales');
        } else {
            Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
        }
        return redirect('/admin/ruido');
    }

    public function delete(Request $request, $id)
    {
        //dd($id);
        try {
            //dd($request);
            $postdata = array(
                'id' => $id,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );
            
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/eliminar', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Cadena de custodia eliminada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al eliminar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');    
            }
            return redirect('/admin/ruido');
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al eliminar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
    }

    public function createDetail(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/buscar?id=' . $id , );
        $cadena = $webService->get();
        
        $ubicaciones[0] = array('Valor' => '0', 'Nombre' => 'Ubicado en campo libre');
        $ubicaciones[1] = array('Valor' => '0.4', 'Nombre' => 'Ubicado  frente a superficie reflectante');
        
        if (count($cadena) > 0) {
            return view('admin.ruido.detalle.create')
                    ->with('detalle', null)
                    ->with('cadena', $cadena[0])
                    ->with('ubicaciones', $ubicaciones);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }        
        
    }

    public function storeDetail(Request $request, $id)
    {
        try {
            $postdata = array(
                'id' => 0,
                'id_cadena' => $request->id_cadena,
                'codigo_cliente' => $request->codigo_cliente,
                'codigo_laboratorio' => $request->codigo_laboratorio,
                'nombre_cliente' => $request->nombre_cliente,
                'zona_aplicacion' => $request->zona_aplicacion,
                'flag_diurno' => isset($request->flag_diurno) ? '1' : '0',
                'flag_nocturno' => isset($request->flag_nocturno) ? '1' : '0',
                'rc_total' => $request->rc_total,
                'rc_residual' => $request->rc_residual,
                'altura_fuente' => is_null($request->altura_fuente) ? '0' : $request->altura_fuente,
                'altura_microfono' => is_null($request->altura_microfono) ? '0' : $request->altura_microfono,
                'distancia_fuente' => is_null($request->distancia_fuente) ? '0' : $request->distancia_fuente,
                'drhshr' => is_null($request->drhshr) ? '0' : $request->drhshr,
                'drideal' => is_null($request->drideal) ? '0' : $request->drideal,
                'ubicacion_microfono' => $request->ubicacion_microfono,
                'ubicacion_microfono_valor' => $request->ubicacion_microfono_valor,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );
            
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Código cliente registrado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/ruido/show/'. $id);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido/show/'. $id);
        }
                
    }

    public function editDetail(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/buscar?id=' . $id , );
        $detalle = $webService->get();
        
        $ubicaciones[0] = array('Valor' => '0', 'Nombre' => 'Ubicado en campo libre');
        $ubicaciones[1] = array('Valor' => '0.4', 'Nombre' => 'Ubicado  frente a superficie reflectante');
        //dd($ubicaciones);
        //dd($detalle);
        //dd($terrenos);
        if (count($detalle) > 0) {
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/buscar?id=' . $detalle[0]->IdCadenaCustodiaRuido , );
            $cadena = $webService->get();
            return view('admin.ruido.detalle.edit')->with('cadena', $cadena[0])->with('detalle', $detalle[0])->with('ubicaciones', $ubicaciones);
        } else {
            Toastr::warning('No se encontró el codigo de cliente seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }  
    }

    public function updateDetail(Request $request, $id)
    {
        $terrenos = '';
        if (isset($request->terreno)) {
            foreach ($request->terreno as $key => $value) {
                $terrenos .= $key . ',';
            }
        }
        //dd($terrenos);
        try {
            $postdata = array(
                'id' => $id,
                'id_cadena' => $request->id_cadena,
                'codigo_cliente' => $request->codigo_cliente,
                'codigo_laboratorio' => $request->codigo_laboratorio,
                'nombre_cliente' => $request->nombre_cliente,
                'zona_aplicacion' => $request->zona_aplicacion,
                'flag_diurno' => isset($request->flag_diurno) ? '1' : '0',
                'flag_nocturno' => isset($request->flag_nocturno) ? '1' : '0',
                'rc_total' => $request->rc_total,
                'rc_residual' => $request->rc_residual,
                'altura_fuente' => is_null($request->altura_fuente) ? '0' : $request->altura_fuente,
                'altura_microfono' => is_null($request->altura_microfono) ? '0' : $request->altura_microfono,
                'distancia_fuente' => is_null($request->distancia_fuente) ? '0' : $request->distancia_fuente,
                'drhshr' => is_null($request->drhshr) ? '0' : $request->drhshr,
                'drideal' => is_null($request->drideal) ? '0' : $request->drideal,
                'terrenos' => $terrenos,
                'ubicacion_microfono' => $request->ubicacion_microfono,
                'ubicacion_microfono_valor' => $request->ubicacion_microfono_valor,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );
            
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Código cliente actualizado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al actualizar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/ruido/show/'. $request->id_cadena);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al actualizar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido/show/'. $id);
        }
    }

    public function deleteDetail(Request $request, $id)
    {
        try {
            $postdata = array(
                'id' => $id,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );
            
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/eliminar', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {

                $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/buscar?id=' . $id , );
                $detalle = $webService->get();
                Toastr::success('Código cliente eliminado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al eliminar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');    
            }
            return redirect('/admin/ruido/show/' . $detalle[0]->IdCadenaCustodiaRuido);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al eliminar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido/show/' . $detalle[0]->IdCadenaCustodiaRuido);
        }
    }

    public function printInformeValorOficial(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/reporte-informe-valor-oficial/cabecera?id=' . $id , );
        $cabecera = $webService->get();

        if (count($cabecera) > 0) {
            $data = [];
            $data['cabecera'] = $cabecera[0];

            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/reporte-informe-valor-oficial/detalle?id=' . $id , );
            $detalle = $webService->get();
            $data['detalle'] = $detalle;
            
            $arrayInforme = explode('-', $data['cabecera']->Informe);
                        
            if (count($arrayInforme) == 2) {
                if($arrayInforme[1] == "2023") 
                {
                    $pdf = PDF::loadView('admin.ruido.reporte.informe-valor-oficial-sin-color', $data)->setPaper('a4', 'portrait');
                } else {
                    $pdf = PDF::loadView('admin.ruido.reporte.informe-valor-oficial', $data)->setPaper('a4', 'portrait');
                }
            } else {
                $pdf = PDF::loadView('admin.ruido.reporte.informe-valor-oficial', $data)->setPaper('a4', 'portrait');
            }

            return $pdf->stream();

            //return view('admin.ruido.reporte.informe-valor-oficial', $data);
        }
        
    }

    public function datosMedicion(Request $request, $id, $medicion, $periodo)
    {
      
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/buscar?id=' . $id , );
        $detalle = $webService->get();
        //dd($detalle);
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/medicion/buscar?id=' . $medicion , );
        $current_medicion = $webService->get();
        //dd($current_medicion);
        if (count($detalle) > 0) {
            return view('admin.ruido.detalle.medicion')->with('detalle', $detalle[0])->with('current_medicion', count($current_medicion) > 0 ? $current_medicion[0] : null)->with('medicion', $medicion)->with('periodo', $periodo);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
    }

    public function datosMedicionUpdate(Request $request, $id)
    {
        try {
            $postdata = array(
                    'id' => $id,
                    'id_detalle' => $request->id_detalle,
                    'periodo' => $request->periodo,
                    'id_metereologicos' => $request->id_metereologicos,
                    'id_verificacion' => $request->id_verificacion,
                    'rt_fecha_1' => $request->rt_fecha_1,
                    'rt_fecha_2' => $request->rt_fecha_2,
                    'rt_inicio' => $request->rt_inicio,
                    'rt_final' => $request->rt_final,
                    'rs_fecha_1' => $request->rs_fecha_1,
                    'rs_fecha_2' => $request->rs_fecha_2,
                    'rs_inicio' => $request->rs_inicio,
                    'rs_final' => $request->rs_final,
                    'descripcion_lugar' => $request->descripcion_lugar,
                    'descripcion_condiciones' => $request->descripcion_condiciones,
                    'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/medicion/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Cadena de custodia registrada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/ruido/show/' . $request->id_cadena);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido/show/' . $request->id_cadena);
        }
    }

    public function datosMuestreo(Request $request, $id, $muestreo)
    {
        //$webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/muestreo/medidor-clima' , );
        //$medidores = $webService->get();
        //dd($medidores);
        //$webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/muestreo/equipo-calibrador' , );
        //$calibradores = $webService->get();
        //dd($calibradores);
        //$webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/muestreo/equipo-sonometro' , );
        //$sonometros = $webService->get();
        //dd($sonometros);
        //dd($medidores);
        //$medidores = array('ELAB-588', 'ELAB-226', 'ELAB-477', 'ELAB-755', 'ELAB-756', 'ELAB-757', 'ELAB-758', 'ELAB-759', 'ELAB-760', 'ELAB-761', 'ELAB-762', 'ELAB-763', 'ELAB-764');
        //$calibradores = array('ELAB-195-1', 'ELAB-726', 'ELAB-727', 'ELAB-223');
        //$sonometros = array('ELAB-218', 'ELAB-315', 'ELAB-593', 'ELAB-592', 'ELAB-673', 'ELAB-724', 'ELAB-725', 'ELAB-672', 'ELAB-633', 'ELAB-584');

        $sistemas = array('WGS-84', 'PSAD-56');
        $bandas = array('UMT');
        $zonas = array('17M', '18M', '17L', '18L', '18K', '19K', '19L');

        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/detalle/buscar?id=' . $id , );
        $detalle = $webService->get();
        //dd($detalle);
        if (count($detalle) > 0) {
            $current_muestreo = [];
            if ($muestreo !== '0') {
                $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/muestreo/buscar?id=' . $muestreo , );
                $current_muestreo = $webService->get();
            }
            //dd($current_muestreo);
            return view('admin.ruido.detalle.muestreo')
                    ->with('detalle', $detalle[0])
                    ->with('muestreo', $muestreo)
                    ->with('current_muestreo', count($current_muestreo) > 0 ? $current_muestreo[0] : null)
                    ->with('sistemas', $sistemas)
                    ->with('zonas', $zonas)
                    ->with('bandas', $bandas);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
    }

    public function datosMuestreoUpdate(Request $request, $id)
    {
        //dd($request);
        try {
            $postdata = array(
                    'id' => $id,
                    'id_detalle' => $request->id_detalle,
                    'descripcion_muestreo' => $request->descripcion_muestreo,
                    'observaciones_tecnicas' => $request->observaciones_tecnicas,
                    'medidor_clima' => $request->medidor_clima,
                    'equipo_calibrador' => $request->equipo_calibrador,
                    'equipo_sonometro' => $request->equipo_sonometro,
                    'geoferencia_utm_este' => $request->geoferencia_utm_este,
                    'geoferencia_utm_norte' => $request->geoferencia_utm_norte,
                    'altitud' => $request->altitud,
                    'geoferencia_sistema' => $request->geoferencia_sistema,
                    'geoferencia_zona' => $request->geoferencia_zona,
                    'geoferencia_banda' => $request->geoferencia_banda,
                    'usuario' => Auth::guard('admin')->user()->Usuario
            );
            
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/muestreo/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Datos metereológicos registrada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar los datos metereológicos, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/ruido/show/' . $request->id_cadena);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar los datos metereológicos, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido/show/' . $request->id_cadena);
        }
    }

    public function datosMetereologico(Request $request, $id, $metereologico, $periodo)
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/medicion/buscar-by-id-detalle-periodo?id=' . $id . '&periodo=' . $periodo , );
        $medicion = $webService->get();
        //dd($medicion);
        if (count($medicion) > 0) {
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/metereologico/buscar?id=' . $metereologico , );
            $current_metereologico = $webService->get();
            //dd($current_metereologico);
            return view('admin.ruido.detalle.metereologico')->with('medicion', $medicion[0])->with('current_metereologico', count($current_metereologico) > 0 ? $current_metereologico[0] : null)->with('metereologico', $metereologico)->with('periodo', $periodo);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
    }

    public function datosMetereologicoUpdate(Request $request, $id)
    {
        try {
            $postdata = array(
                    'id' => $id,
                    'id_medicion' => $request->id_medicion,
                    'inicio' => $request->inicio,
                    'final' => $request->final,
                    'velocidad_viento_antes' => $request->velocidad_viento_antes,
                    'velocidad_viento_durante' => $request->velocidad_viento_durante,
                    'direccion_viento_antes' => $request->direccion_viento_antes,
                    'direccion_viento_durante' => $request->direccion_viento_durante,
                    'temperatura_ambiental_antes' => $request->temperatura_ambiental_antes,
                    'temperatura_ambiental_durante' => $request->temperatura_ambiental_durante,
                    'presion_atmosferica_antes' => $request->presion_atmosferica_antes,
                    'presion_atmosferica_durante' => $request->presion_atmosferica_durante,
                    'humedad_relativa_antes' => $request->humedad_relativa_antes,
                    'humedad_relativa_durante' => $request->humedad_relativa_durante,
                    'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/metereologico/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Datos metereológicos registrada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar los datos metereológicos, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/ruido/show/' . $request->id_cadena);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar los datos metereológicos, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido/show/' . $request->id_cadena);
        }
    }

    public function datosVerificacion(Request $request, $id, $verificacion, $periodo)
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/medicion/buscar-by-id-detalle-periodo?id=' . $id . '&periodo=' . $periodo , );
        $medicion = $webService->get();
        //dd($medicion);
        if (count($medicion) > 0) {
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/verificacion-equipo/buscar?id=' . $medicion[0]->IdCadenaCustodiaRuidoVerificacionEquipo , );
            $current_verificacion = $webService->get();
            //dd($current_verificacion);
            return view('admin.ruido.detalle.verificacion')->with('medicion', $medicion[0])->with('current_verificacion', count($current_verificacion) > 0 ? $current_verificacion[0] : null)->with('verificacion', $verificacion)->with('periodo', $periodo);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
    }

    public function datosVerificacionUpdate(Request $request, $id)
    {
        try {
            $postdata = array(
                    'id' => $id,
                    'id_medicion' => $request->id_medicion,
                    'verificacion_inicial' => $request->verificacion_inicial,
                    'verificacion_final' => $request->verificacion_final,
                    'valor_referencia' => $request->valor_referencia,
                    'tolerancia' => $request->tolerancia,
                    'estado' => $request->estado,
                    'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/verificacion-equipo/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Datos de verificación de equipo actualizado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al actualizar los datos de verificación de equipo, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/ruido/show/' . $request->id_cadena);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al actualizar los datos de verificación de equipo, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido/show/' . $request->id_cadena);
        }
    }

    public function datosInformacionMedicion(Request $request, $id, $periodo)
    {
        // $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/medicion/buscar?id=' . $id  , );
        // $medicion = $webService->get();
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/medicion/buscar-by-id-periodo?id=' . $id . '&periodo=' . $periodo , );
        $medicion = $webService->get();
        //dd($medicion);
        if (count($medicion) > 0) {
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/informacion-medicion/buscar-id-medicion?id=' . $medicion[0]->Id , );
            $current_informacion = $webService->get();
            //dd($current_informacion);
            //$current_informacion = [];
            return view('admin.ruido.detalle.informacion-medicion')->with('medicion', $medicion[0])->with('current_informacion', count($current_informacion) > 0 ? $current_informacion : null)->with('periodo', $periodo);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
    }

    public function datosInformacionMedicionForm(Request $request, $medicion, $id, $periodo)
    {
        
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/medicion/buscar-by-id-periodo?id=' . $medicion . '&periodo=' . $periodo , );
        $medicion = $webService->get();
        //dd($medicion);
        if (count($medicion) > 0) {
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/informacion-medicion/buscar?id=' . $id , );
            $current_informacion = $webService->get();
            //dd($current_informacion);
            return view('admin.ruido.detalle.informacion-medicion-form')->with('medicion', $medicion[0])->with('current_informacion', count($current_informacion) > 0 ? $current_informacion[0] : null)->with('periodo', $periodo)->with('informacion', $id);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido/detalle/' . $medicion . '/informacion-medicion/' . $periodo);
        }
    }

    public function datosInformacionMedicionFormUpdate(Request $request, $id)
    {
        //dd($request);
        try {
            $postdata = array(
                    'id' => $id,
                    'id_medicion' => $request->id_medicion,
                    'numero_muestra' => $request->numero_muestra,
                    'rtlamax' => $request->rtlamax,
                    'rtlamin' => $request->rtlamin,
                    'rtlaeq' => $request->rtlaeq,
                    'npl50' => $request->npl50,
                    'npl90' => $request->npl90,
                    'npl95' => $request->npl95,
                    'rrlaeq' => $request->rrlaeq,
                    'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/informacion-medicion/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Datos de verificación de equipo actualizado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al actualizar los datos de verificación de equipo, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/ruido/detalle/' . $request->id_medicion . '/informacion-medicion/' . $request->periodo);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al actualizar los datos de verificación de equipo, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido/detalle/' . $request->id_medicion . '/informacion-medicion/' . $request->periodo);
        }
    }

    public function printdatosInformacionMedicion(Request $request, $id, $periodo)
    {
        //dd($id);
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/reporte-registro-medicion/cabecera?id=' . $id . '&periodo=' . $periodo , );
        $cabecera = $webService->get();
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/reporte-registro-medicion/detalle?id=' . $id , );
        $detalle = $webService->get();
        $data = [];
        
        $data['cabecera'] = $cabecera[0];
        $data['detalle'] = $detalle;
        $pdf = PDF::loadView('admin.ruido.reporte.registro-digital-medicion', $data);
        return $pdf->stream();
        //return view('admin.ruido.reporte.registro-digital-medicion');
    }

    public function printdatosInformacionCalculoIncertidumbreMedicion(Request $request, $id, $periodo)
    {
        
        // $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/reporte-registro-medicion/cabecera?id=' . $id . '&periodo=' . $periodo , );
        // $cabecera = $webService->get();
        
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/reporte-registro-medicion/cabecera?id=' . $id . '&periodo=' . $periodo , );
        $cabecera = $webService->get();
        
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/reporte-calculo-incertidumbre/data?id_medicion=' . $id . '&periodo=' . $periodo , );
        $detalle = $webService->get();
        $data = [];
        $data['cabecera'] = $cabecera[0];
        $data['detalle'] = $detalle[0];
        
        //dd($detalle[0]);
        $pdf = PDF::loadView('admin.ruido.reporte.calculo-incertidumbre', $data)->setPaper('a4', 'landscape');;
        return $pdf->stream();
        //return view('admin.ruido.reporte.calculo-incertidumbre', $data);
    }

    public function fileImport(Request $request, $id)
    {
        if (!$request->hasFile('file')) {
            exit('El archivo cargado está vacio');
        }
        //dd($request);
        $path = storage_path() . '/app/' . request()->file('file')->store('tmp');

        $reader = new ReaderXlsx();
        $spreadsheet = $reader->load($path);
        $sheet = $spreadsheet->getActiveSheet();

        $worksheetInfo = $reader->listWorksheetInfo($path);

        //dd($sheet);

        for ($i=5; $i <=14 ; $i++) { 

            $la_max = $sheet->getCellByColumnAndRow($i, 4)->getValue();
            $la_min = $sheet->getCellByColumnAndRow($i, 5)->getValue();
            $la_eq = $sheet->getCellByColumnAndRow($i, 6)->getValue();
            $l_50 = $sheet->getCellByColumnAndRow($i, 7)->getValue();
            $l_90 = $sheet->getCellByColumnAndRow($i, 8)->getValue();
            $l_95 = $sheet->getCellByColumnAndRow($i, 9)->getValue();
            $la_eq_res = $sheet->getCellByColumnAndRow($i, 10)->getValue();
            
            $postdata = array(
                'id' => 0,
                'id_medicion' => $id,
                'numero_muestra' => 'L' . ($i - 4),
                'rtlamax' => $la_max,
                'rtlamin' => $la_min,
                'rtlaeq' => $la_eq,
                'npl50' => $l_50,
                'npl90' => $l_90,
                'npl95' => $l_95,
                'rrlaeq' => $la_eq_res,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );

            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/informacion-medicion/mantenimiento', $postdata );
            $resultado = $webService->post();
        }

        Toastr::success('Datos de verificación de equipo actualizado satisfactoriamente.', 'Sistemas Análiticos Generales');
        return redirect('/admin/ruido/detalle/' . $id . '/informacion-medicion/' . $request->periodo);


    }

    public function fileDownload(Request $request)
    {
        //dd(storage_path());
        $filePath = storage_path() . "/app/public/documentos/Plantilla registro de muestras.xlsx";
        return \Response::download($filePath);
    }
}
