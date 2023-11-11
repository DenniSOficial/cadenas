<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use PDF;
use App\Custom\WebServiceManagerCurl;

class IluminacionController extends Controller
{
    protected $urlApiSAG = 'http://161.132.181.82:85/sag-app/public/api';

    public function index()
    {
        $cadenas = [];
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/listado', );
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
        
        return view('admin.iluminacion.index')->with('cadenas', $cadenas);
    }

    public function create()
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/metodologia-ensayo/listado', );
        $metodologias = $webService->get();
        $cadena = null;
        $contactos = [];

        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/list-analistas', );
        $analistas = $webService->get();
        
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/list-personal-laboratorio', );
        $laboratorios = $webService->get();
        
        return view('admin.iluminacion.create')
                ->with('cadena', $cadena)
                ->with('contactos', $contactos)
                ->with('metodologias', $metodologias)
                ->with('analistas', $analistas)
                ->with('laboratorios', $laboratorios);
    }

    public function store(Request $request)
    {
        //dd($request);
        
        try {
            $postdata = array(
                    'id' => 0,
                    'id_metodologia' => $request->id_metodologia,
                    'id_cliente' => $request->id_cliente,
                    'cliente' => str_replace(array("'"), "''", $request->cliente),
                    'id_contacto' => $request->id_contacto,
                    'contacto' => str_replace(array("'"), "''", $request->contacto),
                    'email' => $request->email,
                    'telefono_cliente' => $request->telefono_cliente,
                    'lugar' => is_null($request->lugar) ? '' : $request->lugar,
                    'nro_cotizacion' => $request->nro_cotizacion,
                    'proyecto' => is_null($request->proyecto) ? '' : $request->proyecto,
                    'muestreo' => isset($request->muestreo) ? '1' : '0',
                    'nro_informe' => $request->nro_informe,
                    'analista1' => is_null($request->analista1) ? '' : $request->analista1,
                    'analista2' => is_null($request->analista2) ? '' : $request->analista2,
                    'supervisor' => is_null($request->supervisor) ? '' : $request->supervisor,
                    'laboratorio' => is_null($request->laboratorio) ? '' : $request->laboratorio,
                    'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl( $this->urlApiSAG . '/laboratorio/iluminacion/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Cadena de custodia registrada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/iluminacion');
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
        }
                
    }

    public function edit(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/find?id=' . $id , );
        $cadena = $webService->get();
        
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/metodologia-ensayo/listado', );
        $metodologias = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-analistas', );
        $analistas = $webService->get();
        
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-personal-laboratorio', );
        $laboratorios = $webService->get();
        
        if (count($cadena) > 0) {

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/ruido/find-contacto-by-cliente?id=' . $cadena[0]->IdCliente, );
            $contactos = $webService->get();

            return view('admin.iluminacion.edit')
                ->with('cadena', $cadena[0])
                ->with('contactos', $contactos)
                ->with('metodologias', $metodologias)
                ->with('analistas', $analistas)
                ->with('laboratorios', $laboratorios);

        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
        }
        
    }

    public function update(Request $request, $id)
    {
        //dd($id);
        try {
            $postdata = array(
                    'id' => $id,
                    'id_metodologia' => $request->id_metodologia,
                    'id_cliente' => $request->id_cliente,
                    'cliente' => str_replace(array("'"), "''", $request->cliente),
                    'id_contacto' => $request->id_contacto,
                    'contacto' => str_replace(array("'"), "''", $request->contacto),
                    'email' => $request->email,
                    'telefono_cliente' => $request->telefono_cliente,
                    'lugar' => is_null($request->lugar) ? '' : $request->lugar,
                    'nro_cotizacion' => $request->nro_cotizacion,
                    'proyecto' => is_null($request->proyecto) ? '' : $request->proyecto,
                    'muestreo' => isset($request->muestreo) ? '1' : '0',
                    'nro_informe' => $request->nro_informe,
                    'analista1' => is_null($request->analista1) ? '' : $request->analista1,
                    'analista2' => is_null($request->analista2) ? '' : $request->analista2,
                    'supervisor' => is_null($request->supervisor) ? '' : $request->supervisor,
                    'laboratorio' => is_null($request->laboratorio) ? '' : $request->laboratorio,
                    'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl( $this->urlApiSAG . '/laboratorio/iluminacion/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Cadena de custodia actualizada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/iluminacion');
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
        }
    }

    public function show(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/find?id=' . $id , );
        $cadena = $webService->get();
        
        if (count($cadena) > 0) {
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/detalle/listado-codigos-cadena?id_cadena=' . $id , );
            $codigos = $webService->get();
            //dd($codigos);
            return view('admin.iluminacion.detail')
                    ->with('cadena', $cadena[0])
                    ->with('codigos', $codigos);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
        }
    }

    public function print(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/find?id=' . $id , );
        $cadena = $webService->get();
        
        if (count($cadena) > 0) {
            
            /* OBTENIENDO DETALLE */
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/detalle/listado-codigos-cadena?id_cadena=' . $id , );
            $detalles = $webService->get();

            foreach ($detalles as $key => $value) {
                
                /* OBTENIENDO DATOS DE MUESTREO */

                if ($detalles[$key]->FlagCadenaCustodiaIluminacionDatosMuestreo == "1") {
                    //dd($detalles[$key]->IdCadenaCustodiaIluminacionDatosMuestreo);
                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/muestreo/buscar?id=' . $detalles[$key]->IdCadenaCustodiaIluminacionDatosMuestreo , );
                    $muestreo = $webService->get();
                    
                    if (count($muestreo) > 0) {
                        $detalles[$key]->datos_muestreo = $muestreo[0];
                    } else {
                        $detalles[$key]->datos_muestreo = null;
                    }

                } else {
                    $detalles[$key]->datos_muestreo = null;
                }

                /* OBTENIENDO DATOS DE MEDICION */
                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/informacion-medicion/listado?id_detalle=' . $detalles[$key]->Id , );
                $informacion = $webService->get();
                
                if (count($informacion) > 0) {
                    $detalles[$key]->datos_informacion = $informacion;
                } else {
                    $detalles[$key]->datos_informacion = null;
                }

            }

            $data['cabecera'] = $cadena[0];
            $data['detalles'] = $detalles;
            //dd($data);
            //return view('admin.iluminacion.reporte.cadena-custodia-iee')->with('cabecera', $cadena[0])->with('detalles', $detalles);
            $pdf = PDF::loadView('admin.iluminacion.reporte.cadena-custodia-iee', $data)->setPaper('a4', 'landscape');
            return $pdf->stream();
            
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
        }

    }

    public function cambiarEstadoCadena(Request $request, $id, $estado)
    {
        $usuario = Auth::guard('admin')->user()->Usuario;
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/cambia-estado-cadena?id=' . $id . '&estado=' . $estado . '&usuario=' . $usuario, );
        $resultado = $webService->get();

        if ($resultado) {
            Toastr::success('Cadena de custodia actualizada satisfactoriamente.', 'Sistemas Análiticos Generales');
        } else {
            Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
        }
        return redirect('/admin/iluminacion');
    }

    public function recepcionMuestra(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/find?id=' . $id , );
        $cadena = $webService->get();
        
        if (count($cadena) > 0) {

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/detalle/listado-codigos-cadena?id_cadena=' . $id , );
            $detalles = $webService->get();
            //dd($codigos);
            return view('admin.iluminacion.recepcion-muestra')
                    ->with('cadena', $cadena[0])
                    ->with('detalles', $detalles);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
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
            $webService = new WebServiceManagerCurl($this->urlApiSAG .  '/laboratorio/iluminacion/mantenimiento-recepcion-muestra', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {

                for ($i=0; $i < count($request->id_detalle) ; $i++) { 
                    //dd($request->id_detalle[$i]);
                    $postdata = array(
                        'id' => $request->id_detalle[$i],
                        'laboratorio' => $request->laboratorio[$i],
                        'usuario' => Auth::guard('admin')->user()->Usuario
                    );

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/detalle/update-codigo-laboratorio', $postdata );
                    $resultado = $webService->post();

                }
                
                Toastr::success('Cadena de custodia actualizada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/iluminacion');
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
        }
    }

    public function informe(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/reporte-informe-valor-oficial/cabecera?id=' . $id , );
        $cadena = $webService->get();
        
        return view('admin.iluminacion.informe')->with('cadena', $cadena[0]);
    }

    public function delete(Request $request, $id)
    {
        try {
            
            $postdata = array(
                'id' => $id,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );
            
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/eliminar', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Cadena de custodia eliminada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al eliminar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');    
            }
            return redirect('/admin/iluminacion');
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al eliminar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
        }
    }

    /* DETALLE */

    public function createDetail(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/find?id=' . $id , );
        $cadena = $webService->get();
        
        $detalle = null;
        //$ubicaciones[0] = array('Valor' => '0', 'Nombre' => 'Ubicado en campo libre');
        //$ubicaciones[1] = array('Valor' => '0.4', 'Nombre' => 'Ubicado  frente a superficie reflectante');
        
        if (count($cadena) > 0) {
            return view('admin.iluminacion.detalle.create')
                    ->with('detalle', $detalle)
                    ->with('cadena', $cadena[0]);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
        }   
    }

    public function storeDetail(Request $request, $id)
    {
        //dd($request);
        try {
            $postdata = array(
                'id' => 0,
                'id_cadena' => $request->id_cadena,
                'codigo_cliente' => $request->codigo_cliente,
                'codigo_laboratorio' => $request->codigo_laboratorio,
                'nombre_cliente' => $request->nombre_cliente,
                'iluminacion_interior' => isset($request->iluminacion_interior) ? '1' : '0',
                'iluminacion_exterior' => isset($request->iluminacion_exterior) ? '1' : '0',
                'finicio_muestreo' => $request->finicio_muestreo,
                'hinicio_muestreo' => $request->hinicio_muestreo,
                'ffin_muestreo' => $request->ffin_muestreo,
                'hfin_muestreo' => $request->hfin_muestreo,
                'flag_datos_muestreo' => $request->flag_dmuestreo,
                'id_datos_muestreo' => $request->id_dmuestreo,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/detalle/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Código cliente registrado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/iluminacion/show/'. $id);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion/show/'. $id);
        }
    }

    public function editDetail(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/detalle/find?id=' . $id , );
        $detalle = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/find?id=' . $detalle[0]->IdCadenaCustodiaIluminacion , );
        $cadena = $webService->get();

        //$ubicaciones[0] = array('Valor' => '0', 'Nombre' => 'Ubicado en campo libre');
        //$ubicaciones[1] = array('Valor' => '0.4', 'Nombre' => 'Ubicado  frente a superficie reflectante');
        
        if (count($cadena) > 0) {
            return view('admin.iluminacion.detalle.edit')
                    ->with('detalle', $detalle[0])
                    ->with('cadena', $cadena[0]);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
        }  
    }

    public function updateDetail(Request $request, $id)
    {
        try {
            $postdata = array(
                'id' => $id,
                'id_cadena' => $request->id_cadena,
                'codigo_cliente' => $request->codigo_cliente,
                'codigo_laboratorio' => $request->codigo_laboratorio,
                'nombre_cliente' => $request->nombre_cliente,
                'iluminacion_interior' => isset($request->iluminacion_interior) ? '1' : '0',
                'iluminacion_exterior' => isset($request->iluminacion_exterior) ? '1' : '0',
                'finicio_muestreo' => $request->finicio_muestreo,
                'hinicio_muestreo' => $request->hinicio_muestreo,
                'ffin_muestreo' => $request->ffin_muestreo,
                'hfin_muestreo' => $request->hfin_muestreo,
                'flag_datos_muestreo' => $request->flag_dmuestreo,
                'id_datos_muestreo' => $request->id_dmuestreo,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/detalle/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Código cliente actualizado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al actualizar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/iluminacion/show/'. $request->id_cadena);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al actualizar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion/show/'. $request->id_cadena);
        }
    }

    public function deleteDetail(Request $request, $id)
    {
        try {
            $postdata = array(
                'id' => $id,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );
            
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/detalle/eliminar', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {

                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/detalle/find?id=' . $id , );
                $detalle = $webService->get();
                //dd($detalle);
                Toastr::success('Código cliente eliminado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al eliminar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');    
            }
            return redirect('/admin/iluminacion/show/' . $detalle[0]->IdCadenaCustodiaIluminacion);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al eliminar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion/show/' . $detalle[0]->IdCadenaCustodiaIluminacion);
        }
    }

    public function datosMuestreo(Request $request, $id, $muestreo)
    {
        $fuentes = array('Fluorescente', 'Incandescente', 'LED', 'Mixta');
        $iluminaciones = array('General', 'Localizada', 'Mixta');

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/detalle/find?id=' . $id , );
        $detalle = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/find?id=' . $detalle[0]->IdCadenaCustodiaIluminacion , );
        $cadena = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/listado-tarea-visual', );
        $tareas = $webService->get();
        
        if (count($detalle) > 0) {
            $current_muestreo = [];
            if ($muestreo !== '0') {
                //dd($muestreo);
                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/muestreo/buscar?id=' . $muestreo , );
                $current_muestreo = $webService->get();
            }
            //dd($current_muestreo);
            return view('admin.iluminacion.detalle.muestreo')
                    ->with('cadena', $cadena[0])
                    ->with('detalle', $detalle[0])
                    ->with('muestreo', $muestreo)
                    ->with('current_muestreo', count($current_muestreo) > 0 ? $current_muestreo[0] : null)
                    ->with('tareas', $tareas)
                    ->with('fuentes', $fuentes)
                    ->with('iluminaciones', $iluminaciones);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
        }
    }

    public function datosMuestreoUpdate(Request $request, $id)
    {
        //dd($request);
        try {
            $postdata = array(
                'id' => $id,
                'id_detalle' => $request->id_detalle,
                'id_tarea_visual' => $request->tarea_visual,
                'descripcion_muestreo' => $request->descripcion_muestreo,
                'geoferencia_este' => $request->geoferencia_este,
                'geoferencia_norte' => $request->geoferencia_norte,
                'altitud' => $request->altitud,
                'temperatura' => $request->temperatura,
                'presion' => $request->presion,
                'equipo_luxometro' => $request->equipo_luxometro,
                'puesto_tipo' => $request->puesto_tipo,
                'tipo_fuente' => $request->tipo_fuente,
                'iluminacion' => $request->iluminacion,
                'observaciones' => $request->observaciones,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/muestreo/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Datos de muestreo registrado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar los datos de muestreo, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/iluminacion/show/' . $request->id_cadena);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar los datos metereológicos, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion/show/' . $request->id_cadena);
        }
    }

    public function datosInformacionMedicion(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/detalle/find?id=' . $id , );
        $detalle = $webService->get();

        if (count($detalle) > 0) {
            
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/find?id=' . $detalle[0]->IdCadenaCustodiaIluminacion , );
            $cadena = $webService->get();
            
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/informacion-medicion/listado?id_detalle=' . $id , );
            $current_informacion = $webService->get();
            //dd($current_informacion);

            return view('admin.iluminacion.detalle.informacion-medicion')
                    ->with('detalle', $detalle[0])
                    ->with('cadena', $cadena[0])
                    ->with('current_informacion', count($current_informacion) > 0 ? $current_informacion : null);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
        }
        
    }

    public function datosInformacionMedicionForm($id, $info)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/detalle/find?id=' . $id , );
        $detalle = $webService->get();

        if (count($detalle) > 0) {
            
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/find?id=' . $detalle[0]->IdCadenaCustodiaIluminacion , );
            $cadena = $webService->get();
            
            if ($info > 0) {
                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/informacion-medicion/buscar?id=' . $info , );
                $current_informacion = $webService->get();
                //dd($current_informacion);
            }
            
            return view('admin.iluminacion.detalle.informacion-medicion-form')
                    ->with('detalle', $detalle[0])
                    ->with('cadena', $cadena[0])
                    ->with('current_informacion', $info > 0 ? $current_informacion[0] : null)
                    ->with('info', $info);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
        }
    }

    public function datosInformacionMedicionFormUpdate(Request $request)
    {
        //dd($request);
        try {
            $postdata = array(
                    'id' => $request->id_medicion,
                    'id_detalle' => $request->id_detalle,
                    'fecha' => $request->fecha,
                    'hinicio' => $request->hinicio,
                    'hfin' => $request->hfin,
                    'maxlux' => $request->max_lux,
                    'minlux' => $request->min_lux,
                    'avglux' => $request->avg_lux,
                    'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/informacion-medicion/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if ($resultado) {
                Toastr::success('Datos de informacion de medicion actualizado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al actualizar los datos de informacion de medicion, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/iluminacion/detalle/' . $request->id_detalle . '/informacion-medicion');
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al actualizar los datos de informacion de medicion, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion/detalle/' . $request->id_detalle . '/informacion-medicion');
        }
    }

    public function printRegistroMedicion($id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/find?id=' . $id , );
        $cadena = $webService->get();
        
        if (count($cadena) > 0) {
            
            /* OBTENIENDO DETALLE */
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/detalle/listado-codigos-cadena?id_cadena=' . $id , );
            $detalles = $webService->get();

            foreach ($detalles as $key => $value) {
                
                /* OBTENIENDO DATOS DE MUESTREO */

                if ($detalles[$key]->FlagCadenaCustodiaIluminacionDatosMuestreo == "1") {
                    //dd($detalles[$key]->IdCadenaCustodiaIluminacionDatosMuestreo);
                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/muestreo/buscar?id=' . $detalles[$key]->IdCadenaCustodiaIluminacionDatosMuestreo , );
                    $muestreo = $webService->get();
                    
                    if (count($muestreo) > 0) {
                        $detalles[$key]->datos_muestreo = $muestreo[0];
                    } else {
                        $detalles[$key]->datos_muestreo = null;
                    }

                } else {
                    $detalles[$key]->datos_muestreo = null;
                }

                /* OBTENIENDO DATOS DE MEDICION */
                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/iluminacion/informacion-medicion/listado?id_detalle=' . $detalles[$key]->Id , );
                $informacion = $webService->get();
                
                if (count($informacion) > 0) {
                    $detalles[$key]->datos_informacion = $informacion;
                } else {
                    $detalles[$key]->datos_informacion = null;
                }

            }

            $data['cabecera'] = $cadena[0];
            $data['detalles'] = $detalles;
            
            $pdf = PDF::loadView('admin.iluminacion.reporte.registro-digital-iluminacion', $data);
            return $pdf->stream();
            
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/iluminacion');
        }
        
    }
}
