<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use PDF;
use App\Custom\WebServiceManagerCurl;

class RadiacionController extends Controller
{
    protected $urlApiSAG = 'http://161.132.181.82:85/sag-app/public/api';
    
    public function index()
    {
        $cadenas = [];
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/radiacion/listado', );
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

        return view('admin.radiacion.index')->with('cadenas', $cadenas);
    }

    public function create()
    {
        $normativas = array('IEE/IEC', 'UNE');
        $contactos = [];

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/metodologia-ensayo/listado', );
        $metodologias = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-analistas', );
        $analistas = $webService->get();
        
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-personal-laboratorio', );
        $laboratorios = $webService->get();

        return view('admin.radiacion.create')
                ->with('contactos', $contactos)
                ->with('metodologias', $metodologias)
                ->with('normativas', $normativas)
                ->with('analistas', $analistas)
                ->with('laboratorios', $laboratorios);
    }

    public function store(Request $request)
    {
        $metodologias = '';
        if (isset($request->metodologias)) {
            foreach ($request->metodologias as $key => $value) {
                $metodologias .= $key . ',';
            }
        }

        try {
            $postdata = array(
                'id' => 0,
                'id_cliente' => $request->id_cliente,
                'cliente' => str_replace(array("'"), "''", $request->cliente),
                'id_contacto' => $request->id_contacto,
                'contacto' => str_replace(array("'"), "''", $request->contacto),
                'email' => $request->email,
                'telefono_cliente' => $request->telefono_cliente,
                'lugar' => is_null($request->lugar) ? '' : $request->lugar,
                'empresa' => is_null($request->empresa) ? '' : $request->empresa,
                'planta' => is_null($request->planta) ? '' : $request->planta,
                'muestreo' => $request->muestreo,
                'nro_cotizacion' => $request->nro_cotizacion,
                'nro_informe' => $request->nro_informe,
                'analista1' => is_null($request->analista1) ? '' : $request->analista1,
                'analista2' => is_null($request->analista2) ? '' : $request->analista2,
                'supervisor' => is_null($request->supervisor) ? '' : $request->supervisor,
                'laboratorio' => is_null($request->laboratorio) ? '' : $request->laboratorio,
                'normativa' => $request->normativa,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );

            //dd($postdata);

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/radiacion/mantenimiento', $postdata );
            $resultado = $webService->post();

            //dd($resultado);

            if ($resultado) {
                Toastr::success('Cadena de custodia registrada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            }

            return redirect('/admin/radiacion');

        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/radiacion');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
