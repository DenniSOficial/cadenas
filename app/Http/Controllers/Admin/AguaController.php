<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use PDF;
use App\Custom\WebServiceManagerCurl;
//use App\Models\Control;

class AguaController extends Controller
{
    protected $urlApiSAG = 'http://161.132.181.82:85/sag-app/public/api';

    public function index()
    {
        $cadenas = [];

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/list-cadena-custodia', );
        $listado = $webService->get();

        if (!is_null($listado)) {
            if (Auth::guard('admin')->user()->IdRol == 3) { // Analista
                foreach ($listado as $key => $value) {
                    if ($value->UsuarioCreacion == Auth::guard('admin')->user()->Usuario) {
                        array_push($cadenas, $value);
                    }
                } 
            } else {
                $cadenas = $listado;
            }
        }
        
        return view('admin.agua.index')->with('cadenas', $cadenas);
    }

    public function create()
    {
        $cadena = null;
        $contactos = [];

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-analistas', );
        $analistas = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-personal-laboratorio', );
        $laboratorios = $webService->get();
        
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/detalle/list-parametros-agua' , );
        $metodologias = $webService->get();
        $mis_metodos = [];


        return view('admin.agua.create')
                ->with('cadena', $cadena)
                ->with('contactos', $contactos)
                ->with('analistas', $analistas)
                ->with('laboratorios', $laboratorios)
                ->with('metodologias', $metodologias)
                ->with('mis_metodos', $mis_metodos);
    }

    public function store(Request $request)
    {
        //dd($request);
        try {
            $postdata = array(
                'id' => 0,
                'id_cliente' => $request->id_cliente,
                'cliente' => $request->cliente,
                'id_contacto' => $request->id_contacto,
                'contacto' => str_replace(array("'"), "''", $request->contacto),
                'email' => $request->email,
                'telefono_cliente' => $request->telefono_cliente,
                'lugar' => is_null($request->lugar) ? '' : $request->lugar,
                'empresa' => is_null($request->empresa) ? '' : $request->empresa,
                'planta' => is_null($request->planta) ? '' : $request->planta,
                'proyecto' => is_null($request->proyecto) ? '' : $request->proyecto,
                'nro_cotizacion' => $request->nro_cotizacion,
                'muestreo_sag' => isset($request->muestreo_sag) ? '1' : '0',
                'muestreo_cliente' => isset($request->muestreo_cliente) ? '1' : '0',
                'nro_informe' => $request->nro_informe,
                'analista' => is_null($request->analista) ? '' : $request->analista,
                'supervisor' => $request->supervisor,
                'laboratorio' => is_null($request->laboratorio) ? '' : $request->laboratorio,
                'observaciones' => $request->observaciones,
                'usuario' => Auth::guard('admin')->user()->Usuario                    
            );
            
            //dd($postdata);

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/mantenimiento', $postdata);
            $resultado = $webService->post();
            
            if (count($resultado) > 0) {
                
                if (isset($request->metodo)) {
                    foreach ($request->metodo as $key => $value) {
                        $postdata_metodos = array(
                            'id_cadena' => $resultado[0]["Resultado"],
                            'id_metodo' => $key
                        );
                        
                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/mantenimiento-metodos', $postdata_metodos);
                        $result = $webService->post();

                    }
                    
                }      
                Toastr::success('Cadena de custodia registrada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            }

            return redirect('/admin/agua');
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua');
        }
    }

    public function edit(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar?id=' . $id, );
        $cadena = $webService->get();
        
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-analistas', );
        $analistas = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-personal-laboratorio', );
        $laboratorios = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/detalle/list-parametros-agua' , );
        $metodologias = $webService->get();
        
        $mis_metodos = [];

        if (count($cadena) > 0) {
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/ruido/find-contacto-by-cliente?id=' . $cadena[0]->IdCliente, );
            $contactos = $webService->get();

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar-metodos?id_cadena=' . $id, );
            $metodos = $webService->get();
            $mis_metodos = array_column($metodos, 'IdMetodologiasAgua');
            
            return view('admin.agua.edit')
                ->with('cadena', $cadena[0])
                ->with('contactos', $contactos)
                ->with('analistas', $analistas)
                ->with('laboratorios', $laboratorios)
                ->with('metodologias', $metodologias)
                ->with('mis_metodos', $mis_metodos);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua');
        }
        
    }

    public function update(Request $request, $id)
    {
        try {
            $postdata = array(
                'id' => $id,
                'id_cliente' => $request->id_cliente,
                'cliente' => $request->cliente,
                'id_contacto' => $request->id_contacto,
                'contacto' => str_replace(array("'"), "''", $request->contacto),
                'email' => $request->email,
                'telefono_cliente' => $request->telefono_cliente,
                'lugar' => is_null($request->lugar) ? '' : $request->lugar,
                'empresa' => is_null($request->empresa) ? '' : $request->empresa,
                'planta' => is_null($request->planta) ? '' : $request->planta,
                'proyecto' => is_null($request->proyecto) ? '' : $request->proyecto,
                'nro_cotizacion' => $request->nro_cotizacion,
                'muestreo_sag' => isset($request->muestreo_sag) ? '1' : '0',
                'muestreo_cliente' => isset($request->muestreo_cliente) ? '1' : '0',
                'nro_informe' => $request->nro_informe,
                'analista' => is_null($request->analista) ? '' : $request->analista,
                'supervisor' => $request->supervisor,
                'laboratorio' => is_null($request->laboratorio) ? '' : $request->laboratorio,
                'observaciones' => $request->observaciones,
                'usuario' => Auth::guard('admin')->user()->Usuario                    
            );
            
            //dd($postdata);

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/mantenimiento', $postdata);
            $resultado = $webService->post();
            
            if (count($resultado) > 0) {
                
                if (isset($request->metodo)) {
                    foreach ($request->metodo as $key => $value) {
                        $postdata_metodos = array(
                            'id_cadena' => $resultado[0]["Resultado"],
                            'id_metodo' => $key
                        );
                        
                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/mantenimiento-metodos', $postdata_metodos);
                        $result = $webService->post();

                    }
                    
                }      
                Toastr::success('Cadena de custodia actualizada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/agua');
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al actualizar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua');
        }
    }

    public function show(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar?id=' . $id , );
        $cadena = $webService->get();
        //dd($cadena);
        if (count($cadena) > 0) {
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/detalle/buscar-by-cadena?id_cadena=' . $id , );
            $codigos = $webService->get();
            //dd($codigos);
            //$codigos = [];
            return view('admin.agua.detail')
                    ->with('cadena', $cadena[0])
                    ->with('codigos', $codigos);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua');
        }
    }

    public function recepcionMuestra(Request $request, $id)
    {

    }

    public function verificacionOperacional(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar?id=' . $id, );
        $cadena = $webService->get();
        //dd($cadena);
        if (count($cadena) > 0) {

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar-verificacion?id_cadena=' . $id, );
            $verificacion = $webService->get();
            //dd($verificacion);
            return view('admin.agua.verificacion-operacional')
                ->with('cadena', $cadena[0])
                ->with('verificacion', $verificacion[0]);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua');
        }
    }
    
    public function verificacionOperacionalForm(Request $request, $id, $tipo)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar?id=' . $id, );
        $cadena = $webService->get();
        //dd($cadena);
        if (count($cadena) > 0) {

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/buscar-by-cadena?id=' . $id, );
            $vo = $webService->get();
            //dd($vo);
            switch ($tipo) {
                case 'Potenciometro':

                    $potenciometro = null;
                    $current_id = $vo[0]->IdVerificacionOperacionalPotenciometro;

                    if ($current_id != 0) {
                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/potenciometro-buscar?id=' . $current_id, );
                        $potenciometro = $webService->get();
                        $potenciometro = $potenciometro[0];

                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/potenciometro-detalle-buscar-by-tipo?id=' . $current_id . '&tipo=A', );
                        $ajuste = $webService->get();
                        $potenciometro->ajuste = $ajuste;

                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/potenciometro-detalle-buscar-by-tipo?id=' . $current_id . '&tipo=C', );
                        $control = $webService->get();
                        $potenciometro->control = $control;
                    }
                    //dd($potenciometro);
                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/buffer/buscar-tipo-parametro?tipo=A&parametro=PH', );
                    $ajustes = $webService->get();

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/buffer/buscar-tipo-parametro?tipo=C&parametro=PH', );
                    $controls = $webService->get();

                    return view('admin.agua.verificacion-operacional.potenciometro')
                            ->with('cadena', $cadena[0])
                            ->with('parametro', $tipo)
                            ->with('potenciometro', $potenciometro)
                            ->with('ajustes', $ajustes)
                            ->with('controls', $controls);
                    break;
                case 'Conductimetro':
                    $conductimetro = null;
                    $current_id = $vo[0]->IdVerificacionOperacionalConductimetro;

                    if ($current_id != 0) {

                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/conductimetro-buscar?id=' . $current_id, );
                        $conductimetro = $webService->get();
                        $conductimetro = $conductimetro[0];

                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/conductimetro-detalle-buscar-by-tipo?id=' . $current_id . '&tipo=A', );
                        $ajuste = $webService->get();
                        $conductimetro->ajuste = $ajuste;

                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/conductimetro-detalle-buscar-by-tipo?id=' . $current_id . '&tipo=C', );
                        $control = $webService->get();
                        $conductimetro->control = $control;

                    }
                    
                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/buffer/buscar-tipo-parametro?tipo=A&parametro=CE', );
                    $ajustes = $webService->get();

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/buffer/buscar-tipo-parametro?tipo=C&parametro=CE', );
                    $controls = $webService->get();

                    return view('admin.agua.verificacion-operacional.conductimetro')
                            ->with('cadena', $cadena[0])
                            ->with('parametro', $tipo)
                            ->with('conductimetro', $conductimetro)
                            ->with('ajustes', $ajustes)
                            ->with('controls', $controls);

                    break;
                case 'Oximetro':
                    $oximetro = null;
                    $current_id = $vo[0]->IdVerificacionOperacionalOximetro;

                    if ($current_id != 0) {
                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/oximetro-buscar?id=' . $current_id, );
                        $oximetro = $webService->get();
                        $oximetro = $oximetro[0];
                        //dd($oximetro);
                    }

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-personal-laboratorio', );
                    $laboratorios = $webService->get();

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/buffer/buscar-tipo-parametro?tipo=C&parametro=OD', );
                    $controls = $webService->get();
                    //dd($controls);
                    return view('admin.agua.verificacion-operacional.oximetro')
                            ->with('cadena', $cadena[0])
                            ->with('parametro', $tipo)
                            ->with('oximetro', $oximetro)
                            ->with('laboratorios', $laboratorios)
                            ->with('controls', $controls);
                    break;
                case 'MedidorCloro':
                    $cloro = null;
                    $current_id = $vo[0]->IdVerificacionOperacionalMedidorCloro;

                    if ($current_id) {
                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/medidor-cloro-buscar?id=' . $current_id, );
                        $cloro = $webService->get();
                        $cloro = $cloro[0];

                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/medidor-cloro-detalle-buscar-by-tipo?id=' . $current_id . '&tipo=A', );
                        $ajuste = $webService->get();
                        $cloro->ajuste = $ajuste;

                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/medidor-cloro-detalle-buscar-by-tipo?id=' . $current_id . '&tipo=C', );
                        $control = $webService->get();
                        $cloro->control = $control;
                    }

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/buffer/buscar-tipo-parametro?tipo=A&parametro=CL', );
                    $ajustes = $webService->get();

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/buffer/buscar-tipo-parametro?tipo=C&parametro=CL', );
                    $controls = $webService->get();

                    return view('admin.agua.verificacion-operacional.cloro')
                            ->with('cadena', $cadena[0])
                            ->with('parametro', $tipo)
                            ->with('cloro', $cloro)
                            ->with('ajustes', $ajustes)
                            ->with('controls', $controls);
                    break;
                case 'Turbiedad':
                    $turbiedad = null;
                    $current_id = $vo[0]->IdVerificacionOperacionalTurbiedad;

                    if ($current_id) {
                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/turbiedad-buscar?id=' . $current_id, );
                        $turbiedad = $webService->get();
                        $turbiedad = $turbiedad[0];

                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/turbiedad-detalle-buscar-by-tipo?id=' . $current_id . '&tipo=A', );
                        $ajuste = $webService->get();
                        $turbiedad->ajuste = $ajuste;

                        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/turbiedad-detalle-buscar-by-tipo?id=' . $current_id . '&tipo=C', );
                        $control = $webService->get();
                        $turbiedad->control = $control;
                    }

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/buffer/buscar-tipo-parametro?tipo=A&parametro=TB', );
                    $ajustes = $webService->get();

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/buffer/buscar-tipo-parametro?tipo=C&parametro=TB', );
                    $controls = $webService->get();

                    return view('admin.agua.verificacion-operacional.turbiedad')
                            ->with('cadena', $cadena[0])
                            ->with('parametro', $tipo)
                            ->with('turbiedad', $turbiedad)
                            ->with('ajustes', $ajustes)
                            ->with('controls', $controls);

                    break;
                default:
                    # code...
                    break;
            }

        }
        
    }

    public function verificacionOperacionalUpdate(Request $request, $id)
    {
        //dd($request);
        try {
            
            switch ($request->parametro) {
                case 'Potenciometro':

                    $postdata = array(
                        'id' => $request->id,
                        'id_cadena' => $request->id_cadena,
                        'marca_equipo' => $request->marca_equipo,
                        'slope_optimo' => $request->slope_optimo,
                        'codigo_bureta' => isset($request->codigo_bureta) ? $request->codigo_bureta : '',
                        'codigo_equipo' => $request->codigo_equipo,
                        'slope' => $request->slope,
                        'usuario' => Auth::guard('admin')->user()->Usuario
                    );

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/mantenimiento-potenciometro', $postdata);
                    break;
                case 'Conductimetro':
                    
                    $postdata = array(
                        'id' => $request->id,
                        'id_cadena' => $request->id_cadena,
                        'codigo_equipo' => $request->codigo_equipo,
                        'usuario' => Auth::guard('admin')->user()->Usuario
                    );
                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/mantenimiento-conductimetro', $postdata);
                    break;
                case 'Oximetro':

                    $postdata = array(
                        'id' => $request->id,
                        'id_cadena' => $request->id_cadena,

                        'codigo_bureta_sm' => $request->codigo_bureta_sm,
                        'codigo_equipo_sm' => $request->codigo_equipo_sm,
                        'id_buffer_sm' => $request->id_buffer_sm,
                        'lectura_od_sm' => $request->lectura_od_sm,
                        'lectura_sensor_sm' => $request->lectura_sensor_sm,
                        'lectura_volumetrica_sm' => $request->lectura_volumetrica_sm,
                        'factor_tiosulfato_sm' => $request->factor_tiosulfato_sm,
                        'normalidad_corregida_sm' => $request->normalidad_corregida_sm,
                        'diferencia_optima_sm' => $request->diferencia_optima_sm,
                        'laboratorio_sm' => $request->laboratorio_sm,
                        'obs_sm' => $request->obs_sm,

                        'codigo_bureta_ntp' => $request->codigo_bureta_ntp,
                        'codigo_equipo_ntp' => $request->codigo_equipo_ntp,
                        'id_buffer_ntp' => $request->id_buffer_ntp,
                        'lectura_od_ntp' => $request->lectura_od_ntp,
                        'lectura_sensor_ntp' => $request->lectura_sensor_ntp,
                        'lectura_volumetrica_ntp' => $request->lectura_volumetrica_ntp,
                        'factor_tiosulfato_ntp' => $request->factor_tiosulfato_ntp,
                        'normalidad_corregida_ntp' => $request->normalidad_corregida_ntp,
                        'diferencia_optima_ntp' => $request->diferencia_optima_ntp,
                        'laboratorio_ntp' => $request->laboratorio_ntp,
                        'obs_ntp' => $request->obs_ntp,
                        'concentracion_medido_od_ntp' => $request->concentracion_medido_od_ntp,
                        'temperatura_agua_ntp' => $request->temperatura_agua_ntp,
                        'presion_barometrica_ntp' => $request->presion_barometrica_ntp,
                        'concentracion_od_teorica_ntp' => $request->concentracion_od_teorica_ntp,
                        'rango97_ntp' => $request->rango97_ntp,
                        'rango104_ntp' => $request->rango104_ntp,
                        'c_ntp' => $request->c_ntp,
                        'nc_ntp' => $request->nc_ntp,

                        'usuario' => Auth::guard('admin')->user()->Usuario
                    );
                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/mantenimiento-oximetro', $postdata);
                    break;
                case 'MedidorCloro':
                    //dd('entro');
                    $postdata = array(
                        'id' => $request->id,
                        'id_cadena' => $request->id_cadena,
                        'codigo_equipo' => $request->codigo_equipo,
                        'usuario' => Auth::guard('admin')->user()->Usuario
                    );
                    //dd($postdata);
                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/mantenimiento-medidorcloro', $postdata);
                    //dd($webservice);
                    break;
                case 'Turbiedad':
                    $postdata = array(
                        'id' => $request->id,
                        'id_cadena' => $request->id_cadena,
                        'codigo_equipo' => $request->codigo_equipo,
                        'usuario' => Auth::guard('admin')->user()->Usuario
                    );
                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/mantenimiento-turbiedad', $postdata);
                    break;
                default:
                    # code...
                    break;
            }
            //dd($webService);
            $resultado = $webService->post();
            
            if ($resultado) {
                //Toastr::success('Código cliente registrado satisfactoriamente.', 'Sistemas Análiticos Generales');
                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/buscar-by-cadena?id=' . $id, );
                $vo = $webService->get();

                $id_vo_parametro = 0;

                switch ($request->parametro) {
                    case 'Potenciometro':
                        $id_vo_parametro = $vo[0]->IdVerificacionOperacionalPotenciometro;
                        break;
                    case 'Conductimetro':
                        $id_vo_parametro = $vo[0]->IdVerificacionOperacionalConductimetro;
                        break;
                    case 'MedidorCloro':
                        $id_vo_parametro = $vo[0]->IdVerificacionOperacionalMedidorCloro;
                        break;
                    case 'Turbiedad':
                        $id_vo_parametro = $vo[0]->IdVerificacionOperacionalTurbiedad;
                        break;
                    default:
                        # code...
                        break;
                }
                
                if ($request->parametro !== 'Oximetro') {
                    for ($i=0; $i < count($request->ajuste_marca) ; $i++) { 

                        switch ($request->parametro) {
                            case 'Potenciometro':
    
                                $postdata = array(
                                    'id' => 0,
                                    'id_vo_parametro' => $id_vo_parametro,
                                    'id_buffer' => $request->ajuste_id_buffer[$i],
                                    'marca' => $request->ajuste_marca[$i],
                                    'lote' => $request->ajuste_lote[$i],
                                    'valor_ph' => $request->ajuste_valor[$i],
                                    'rango' => '',
                                    'lectura' => 0,
                                    'usuario' => Auth::guard('admin')->user()->Usuario,
                                    'tipo' => 'A'
                                );
    
                                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/mantenimiento-potenciometro-detalle', $postdata);
                                break;
                            case 'Conductimetro':
                                $postdata = array(
                                    'id' => 0,
                                    'id_vo_parametro' => $id_vo_parametro,
                                    'id_buffer' => $request->ajuste_id_buffer[$i],
                                    'marca' => $request->ajuste_marca[$i],
                                    'lote' => $request->ajuste_lote[$i],
                                    'concentracion_teorico' => $request->ajuste_valor[$i],
                                    'constante_celda' => $request->ajuste_constante[$i],
                                    'concentracionuS' => 0,
                                    'concentracionmS' => 0,
                                    'usuario' => Auth::guard('admin')->user()->Usuario,
                                    'tipo' => 'A'
                                );
                                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/mantenimiento-conductimetro-detalle', $postdata);
                                break;
                            case 'MedidorCloro':
                                $postdata = array(
                                    'id' => 0,
                                    'id_vo_parametro' => $id_vo_parametro,
                                    'id_buffer' => $request->ajuste_id_buffer[$i],
                                    'marca' => $request->ajuste_marca[$i],
                                    'lote' => $request->ajuste_lote[$i],
                                    'valor_ph' => $request->ajuste_valor[$i],
                                    'rango' => '',
                                    'lectura' => '',
                                    'usuario' => Auth::guard('admin')->user()->Usuario,
                                    'tipo' => 'A'
                                );
                                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/mantenimiento-medidorcloro-detalle', $postdata);
                                break;
                            case 'Turbiedad':
                                $postdata = array(
                                    'id' => 0,
                                    'id_vo_parametro' => $id_vo_parametro,
                                    'id_buffer' => $request->ajuste_id_buffer[$i],
                                    'marca' => $request->ajuste_marca[$i],
                                    'lote' => $request->ajuste_lote[$i],
                                    'valor_teorico' => $request->ajuste_valor[$i],
                                    'rango' => '',
                                    'lectura' => '',
                                    'usuario' => Auth::guard('admin')->user()->Usuario,
                                    'tipo' => 'A'
                                );
                                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/mantenimiento-turbiedad-detalle', $postdata);
                                break;
                            default:
                                # code...
                                break;
                        }
                        
                        $resultado = $webService->post();
                        //dd($resultado);
                        
                    }
    
                    for ($i=0; $i < count($request->control_marca) ; $i++) { 
                            
                        switch ($request->parametro) {
                            case 'Potenciometro':
                                $postdata = array(
                                    'id' => 0,
                                    'id_vo_parametro' => $id_vo_parametro,
                                    'id_buffer' => $request->control_id_buffer[$i],
                                    'marca' => $request->control_marca[$i],
                                    'lote' => $request->control_lote[$i],
                                    'valor_ph' => $request->control_valort[$i],
                                    'rango' => '',
                                    'lectura' => $request->control_valorc[$i],
                                    'usuario' => Auth::guard('admin')->user()->Usuario,
                                    'tipo' => 'C'
                                );
                                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/mantenimiento-potenciometro-detalle', $postdata);
                                break;
                            case 'Conductimetro':
                                $postdata = array(
                                    'id' => 0,
                                    'id_vo_parametro' => $id_vo_parametro,
                                    'id_buffer' => $request->control_id_buffer[$i],
                                    'marca' => $request->control_marca[$i],
                                    'lote' => $request->control_lote[$i],
                                    'concentracion_teorico' => $request->control_valort[$i],
                                    'constante_celda' => 0,
                                    'concentracionuS' => $request->control_us[$i],
                                    'concentracionmS' => $request->control_ms[$i],
                                    'usuario' => Auth::guard('admin')->user()->Usuario,
                                    'tipo' => 'C'
                                    );
                                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/mantenimiento-conductimetro-detalle', $postdata);
                                break;
                            case 'MedidorCloro':
                                $postdata = array(
                                    'id' => 0,
                                    'id_vo_parametro' => $id_vo_parametro,
                                    'id_buffer' => $request->control_id_buffer[$i],
                                    'marca' => $request->control_marca[$i],
                                    'lote' => $request->control_lote[$i],
                                    'valor_ph' => $request->control_valort[$i],
                                    'rango' => $request->control_rango[$i],
                                    'lectura' => $request->control_valorc[$i],
                                    'usuario' => Auth::guard('admin')->user()->Usuario,
                                    'tipo' => 'C'
                                );
                                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/mantenimiento-medidorcloro-detalle', $postdata);
                                break;
                            case 'Turbiedad':
                                $postdata = array(
                                    'id' => 0,
                                    'id_vo_parametro' => $id_vo_parametro,
                                    'id_buffer' => $request->control_id_buffer[$i],
                                    'marca' => $request->control_marca[$i],
                                    'lote' => $request->control_lote[$i],
                                    'valor_teorico' => $request->control_valort[$i],
                                    'rango' => $request->control_rango[$i],
                                    'lectura' => $request->control_valorc[$i],
                                    'usuario' => Auth::guard('admin')->user()->Usuario,
                                    'tipo' => 'C'
                                );
                                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/mantenimiento-turbiedad-detalle', $postdata);
                                break;
                            default:
                                # code...
                                break;
                        }
                        
                        $resultado = $webService->post();
                                            
                    }
                }
                
                Toastr::success('Se actualizo los datos satisfactoriamente.', 'Sistemas Análiticos Generales');
                return redirect('/admin/agua/verificacion-operacional/' . $id);

            } else {
                Toastr::error('Hubo un error al registrar los datos, intente nuevamente.', 'Sistemas Análiticos Generales');
                return redirect('/admin/agua/verificacion-operacional/' . $id);
            }

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }

    public function verificacionOperacionalPrint(Request $request, $id)
    {
        $data = [];

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar?id=' . $id , );
        $cadena = $webService->get();
        $data['cadena'] = $cadena[0];
        //dd($cadena[0]);

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar-verificacion?id_cadena=' . $id, );
        $verificacion = $webService->get();
        //dd($verificacion);

        if ($verificacion[0]->FlagPotenciometro == 1) {
            //dd($verificacion[0]->IdVerificacionOperacionalPotenciometro);
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/potenciometro-buscar?id=' . $verificacion[0]->IdVerificacionOperacionalPotenciometro, );
            $potenciometro = $webService->get();
            $data['cadena']->potenciometro = $potenciometro[0];

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/potenciometro-detalle-buscar-by-tipo?id=' . $verificacion[0]->IdVerificacionOperacionalPotenciometro . '&tipo=A', );
            $ajuste = $webService->get();
            $data['cadena']->potenciometro->ajuste = $ajuste;

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/potenciometro-detalle-buscar-by-tipo?id=' . $verificacion[0]->IdVerificacionOperacionalPotenciometro . '&tipo=C', );
            $control = $webService->get();
            $data['cadena']->potenciometro->control = $control;
        }

        if ($verificacion[0]->FlagConductimetro == 1) {
            //dd($verificacion[0]->IdVerificacionOperacionalPotenciometro);
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/conductimetro-buscar?id=' . $verificacion[0]->IdVerificacionOperacionalConductimetro, );
            $conductimetro = $webService->get();
            $data['cadena']->conductimetro = $conductimetro[0];

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/conductimetro-detalle-buscar-by-tipo?id=' . $verificacion[0]->IdVerificacionOperacionalConductimetro . '&tipo=A', );
            $ajuste = $webService->get();
            $data['cadena']->conductimetro->ajuste = $ajuste;

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/conductimetro-detalle-buscar-by-tipo?id=' . $verificacion[0]->IdVerificacionOperacionalConductimetro . '&tipo=C', );
            $control = $webService->get();
            $data['cadena']->conductimetro->control = $control;
        }

        if ($verificacion[0]->FlagOximetro == 1) {
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/oximetro-buscar?id=' . $verificacion[0]->IdVerificacionOperacionalOximetro, );
            $oximetro = $webService->get();
            $data['cadena']->oximetro = $oximetro[0];
        }

        if ($verificacion[0]->FlagMedidorCloro == 1) {
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/medidor-cloro-buscar?id=' . $verificacion[0]->IdVerificacionOperacionalMedidorCloro, );
            $cloro = $webService->get();
            $data['cadena']->cloro = $cloro[0];

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/medidor-cloro-detalle-buscar-by-tipo?id=' . $verificacion[0]->IdVerificacionOperacionalMedidorCloro . '&tipo=A', );
            $ajuste = $webService->get();
            $data['cadena']->cloro->ajuste = $ajuste;

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/medidor-cloro-detalle-buscar-by-tipo?id=' . $verificacion[0]->IdVerificacionOperacionalMedidorCloro . '&tipo=C', );
            $control = $webService->get();
            $data['cadena']->cloro->control = $control;
        }

        if ($verificacion[0]->FlagTurbiedad == 1) {
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/turbiedad-buscar?id=' . $verificacion[0]->IdVerificacionOperacionalTurbiedad, );
            $turbiedad = $webService->get();
            $data['cadena']->turbiedad = $turbiedad[0];

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/turbiedad-detalle-buscar-by-tipo?id=' . $verificacion[0]->IdVerificacionOperacionalTurbiedad . '&tipo=A', );
            $ajuste = $webService->get();
            $data['cadena']->turbiedad->ajuste = $ajuste;

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/verificacion-operacional/turbiedad-detalle-buscar-by-tipo?id=' . $verificacion[0]->IdVerificacionOperacionalTurbiedad . '&tipo=C', );
            $control = $webService->get();
            $data['cadena']->turbiedad->control = $control;
        }

        //dd($data);
        $pdf = PDF::loadView('admin.agua.reporte.vo', $data)->setPaper('a4', 'portrait');
        return $pdf->stream();
        //return view('admin.agua.reporte.vo', $data);
    }

    public function planMuestreo(Request $request, $id)
    {
        $muestreos = [];

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/listar?id_cadena=' . $id,  );
        $listado = $webService->get();
        
        if (!is_null($listado)) {
            /* if (Auth::guard('admin')->user()->IdRol == 3) { // Analista
                foreach ($listado as $key => $value) {
                    if ($value->UsuarioCreacion == Auth::guard('admin')->user()->Usuario) {
                        array_push($cadenas, $value);
                    }
                } 
            } else {
                $cadenas = $listado;
            } */
            $muestreos = $listado;
        }
        
        return view('admin.agua.muestreo.index')->with('muestreos', $muestreos)->with('id', $id);
    }

    public function delete($id)
    {
        try {

            $postdata = array(
                'id' => $id,
                'usuario' => Auth::guard('admin')->user()->usuario
            );

            $webService = new WebServiceManagerCurl( $this->urlApiSAG . '/laboratorio/agua/eliminar', $postdata );
            $resultado = $webService->post();

            if ($resultado) {
                Toastr::success('Cadena de custodia eliminada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al eliminar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');    
            }
            return redirect('/admin/agua');

        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al eliminar la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua');
        }
    }

    public function printRegistroCampo(Request $request, $id)
    {
        //dd($id);

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar?id=' . $id , );
        $cabecera = $webService->get();
        //dd($cabecera);
        if (count($cabecera) > 0) {
            $data = [];
            $data['cabecera'] = $cabecera[0];

            $pdf = PDF::loadView('admin.agua.reporte.registro-campo', $data)->setPaper('a4', 'landscape');;
            return $pdf->stream();
        }
                
    }

    public function createDetail(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar?id=' . $id , );
        $cadena = $webService->get();

        if (count($cadena) > 0) {

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-parametros-in-situ' , );
            $parametros = $webService->get();
            $mis_parametros = [];

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-analisis-laboratorio' , );
            $analisis = $webService->get();
            $mis_analisis = [];
            
            
            return view('admin.agua.detalle.create')
                        ->with('detalle', null)
                        ->with('cadena', $cadena[0])
                        ->with('parametros', $parametros)
                        ->with('mis_parametros', $mis_parametros)
                        ->with('analisis', $analisis)
                        ->with('mis_analisis', $mis_analisis);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua');
        }
    }

    public function storeDetail(Request $request, $id)
    {
        //dd($request);

        try {
            $postdata = array(
                'id' => 0,
                'id_cadena' => $id,
                'codigo_cliente' => $request->codigo_cliente,
                'fecha' => $request->fecha,
	            'hora' => $request->hora,
                'tipo_matriz' => $request->tipo_matriz,
                'este' => $request->este,
                'norte' => $request->norte,
                'altitud' => $request->altitud,
                'descripcion_punto' => $request->descripcion_punto,
                'usuario'  =>  Auth::guard('admin')->user()->Usuario   
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl( $this->urlApiSAG . '/laboratorio/agua/detalle/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if (count($resultado) > 0) {
                if ($resultado[0]["Resultado"] > 0) {

                    /* Registrando las variables Parametros in situ*/
                    foreach ($request->lectura as $key => $value) {
                        $postdata_parametros = array(
                            'id' => 0,
                            'id_cadena' => $resultado[0]["Resultado"],
                            'id_parametro' => $key,
                            'flag' => isset($request->parametro) ? (array_key_exists($key, $request->parametro) ? 1 : 0) : 0,
                            'lectura' => $request->lectura[$key],
                            'duplicado' => $request->duplicado[$key],
                            'usuario'  =>  Auth::guard('admin')->user()->Usuario   
                        );
                        
                        $webService = new WebServiceManagerCurl( $this->urlApiSAG . '/laboratorio/agua/detalle/mantenimiento-parametros', $postdata_parametros );
                        $resultado_parametro = $webService->post();

                    }

                    foreach ($request->analisis as $key => $value) {
                        $posdata_analisis = array(
                            'id' => 0,
                            'id_cadena' => $resultado[0]["Resultado"],
                            'id_analisis' => $value,
                            'usuario'  =>  Auth::guard('admin')->user()->Usuario
                        );
                        $webService = new WebServiceManagerCurl( $this->urlApiSAG . '/laboratorio/agua/detalle/mantenimiento-analisis', $posdata_analisis );
                        $resultado_analisis = $webService->post();
                    }
                    
                    Toastr::success('Detalle Cadena de custodia registrada satisfactoriamente.', 'Sistemas Análiticos Generales');
                } else {
                    Toastr::error('Hubo un error al registrar el detalle de la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
                }
                return redirect('/admin/agua/show/' . $cadena);
            }
            /* if (count($resultado) > 0) {
                if ($resultado[0]["Resultado"] > 0) {
                    Toastr::success('Detalle Cadena de custodia registrada satisfactoriamente.', 'Sistemas Análiticos Generales');
                } else {
                    Toastr::error('Hubo un error al registrar el detalle de la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
                }
                return redirect('/admin/agua/show/' . $id);
            } */
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar el detalle de la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
        
    }

    public function editDetail(Request $request, $cadena, $id)
    {
        //dd($id);
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/detalle/buscar?id=' . $id , );
        $detalle = $webService->get();
        //dd($detalle);
        //$mis_parametros = explode(',', $detalle[0]->Parametros);
        //$mis_analisis = explode(',', $detalle[0]->Analisis);

        $mis_parametros = [];
        $mis_analisis = [];

        if (count($detalle) > 0) {

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-parametros-in-situ' , );
            $parametros = $webService->get();
            //dd($parametros);
            //$mis_parametros = [];
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-analisis-laboratorio' , );
            $analisis = $webService->get();
            //$mis_analisis = [];
            ///dd($analisis);
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar?id=' . $detalle[0]->IdCadenaCustodiaAgua , );
            $cadena = $webService->get();
            //dd($cadena);
            
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/detalle/listado-detalle-parametros?id_cadena=' . $detalle[0]->Id , );
            $mis_parametros = $webService->get();

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/detalle/listado-detalle-analisis?id_cadena=' . $detalle[0]->Id , );
            $mis_analisis = $webService->get();
            //dd($mis_analisis);
            $found_key = array_search(3, array_column($mis_analisis, 'IdAnalisisLaboratorio'));
            //dd($found_key);
            //dd($mis_parametros[$found_key]);
            
            return view('admin.agua.detalle.edit')
                    ->with('cadena', $cadena[0])
                    ->with('detalle', $detalle[0])
                    ->with('parametros', $parametros)
                    ->with('mis_parametros', $mis_parametros)
                    ->with('analisis', $analisis)
                    ->with('mis_analisis', $mis_analisis);
        } else {
            Toastr::warning('No se encontró el codigo de cliente seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua');
        }  
    }

    public function updateDetail(Request $request, $cadena, $id)
    {
        //dd($request->analisis);

        try {
            $postdata = array(
                'id' => $id,
                'id_cadena' => $cadena,
                'codigo_cliente' => $request->codigo_cliente,
                'fecha' => $request->fecha,
	            'hora' => $request->hora,
                'tipo_matriz' => $request->tipo_matriz,
                'este' => $request->este,
                'norte' => $request->norte,
                'altitud' => $request->altitud,
                'descripcion_punto' => $request->descripcion_punto,
                'usuario'  =>  Auth::guard('admin')->user()->Usuario
            );
            
            $webService = new WebServiceManagerCurl( $this->urlApiSAG . '/laboratorio/agua/detalle/mantenimiento', $postdata );
            $resultado = $webService->post();
            
            if (count($resultado) > 0) {
                if ($resultado[0]["Resultado"] > 0) {

                    /* Registrando las variables Parametros in situ*/
                    foreach ($request->lectura as $key => $value) {
                        $postdata_parametros = array(
                            'id' => 0,
                            'id_cadena' => $resultado[0]["Resultado"],
                            'id_parametro' => $key,
                            'flag' => isset($request->parametro) ? (array_key_exists($key, $request->parametro) ? 1 : 0) : 0,
                            'lectura' => $request->lectura[$key],
                            'duplicado' => $request->duplicado[$key],
                            'usuario'  =>  Auth::guard('admin')->user()->Usuario   
                        );
                        
                        $webService = new WebServiceManagerCurl( $this->urlApiSAG . '/laboratorio/agua/detalle/mantenimiento-parametros', $postdata_parametros );
                        $resultado_parametro = $webService->post();

                    }

                    foreach ($request->analisis as $key => $value) {
                        $posdata_analisis = array(
                            'id' => 0,
                            'id_cadena' => $resultado[0]["Resultado"],
                            'id_analisis' => $value,
                            'usuario'  =>  Auth::guard('admin')->user()->Usuario
                        );
                        $webService = new WebServiceManagerCurl( $this->urlApiSAG . '/laboratorio/agua/detalle/mantenimiento-analisis', $posdata_analisis );
                        $resultado_analisis = $webService->post();
                    }
                    
                    Toastr::success('Detalle Cadena de custodia registrada satisfactoriamente.', 'Sistemas Análiticos Generales');
                } else {
                    Toastr::error('Hubo un error al registrar el detalle de la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
                }
                return redirect('/admin/agua/show/' . $cadena);
            }
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar el detalle de la cadena, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/ruido');
        }
    }

    public function deleteDetail(Request $request, $id)
    {
        try {
            $postdata = array(
                'id' => $id,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/detalle/eliminar', $postdata );
            $resultado = $webService->post();
            //dd($resultado);
            if ($resultado) {

                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/detalle/buscar?id=' . $id , );
                $detalle = $webService->get();

                Toastr::success('Código cliente eliminado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al eliminar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');    
            }
            return redirect('/admin/agua/show/' . $detalle[0]->IdCadenaCustodiaAgua);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al eliminar el código de cliente, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua');
        }
    }

    public function createMuestreo(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar?id=' . $id, );
        $cadena = $webService->get();
        
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-analistas', );
        $analistas = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/list-tipo-muestreo');
        $muestreos = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/list-documentos-asociados');
        $documentos = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/list-tipo-agua-muestra');
        $taguas = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/list-matriz-duplicado');
        $matrices = $webService->get();
        //dd($matrices);
        if (count($cadena) > 0) {

            //$webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar-verificacion?id_cadena=' . $id, );
            //$verificacion = $webService->get();
            
            return view('admin.agua.muestreo.create')
                ->with('cadena', $cadena[0])
                ->with('analistas', $analistas)
                ->with('muestreos', $muestreos)
                ->with('documentos', $documentos)
                ->with('taguas', $taguas)
                ->with('matrices', $matrices);
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua');
        }
    }

    public function storeMuestreo(Request $request, $id)
    {
        //dd($request);
        try {
            $postdata = array(
                'id' => 0,
                'id_cadena' => $request->id_cadena,
                'contacto_campo' => $request->contacto_campo,
                'celular_contacto' => $request->contacto_telefono,
                'departamento' => $request->departamento,
                'provincia' => $request->provincia,
                'distrito' => $request->distrito,
                'fecha_inicio' => is_null($request->fecha_inicio) ? '' : $request->fecha_inicio,
                'fecha_termino' => is_null($request->fecha_termino) ? '' : $request->fecha_termino,
                'muestra_dirimente' => is_null($request->muestra_dirimente) ? 0 : 1,
                'matriz_muestra_dirimente' => is_null($request->matriz_muestra_dirimente) ? '' : $request->matriz_muestra_dirimente,
                'muestreos' => isset($request->muestreo) ? implode(array_keys($request->muestreo), ';') : '',
                'procedimientos' => isset($request->matriz) ? implode(array_keys($request->matriz), ';') : '',
                'documentos_asociados' => isset($request->documento) ? implode(array_keys($request->documento), ';') : '',
                'tipos' => isset($request->agua) ? implode(array_keys($request->agua), ';') : '',
                'usuario' => Auth::guard('admin')->user()->Usuario,
                'id_analista' => $request->id_analista
            );
            
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/mantenimiento', $postdata);
            $resultado = $webService->post();
            
            $id_muestreo = $resultado[0]['Result'];

            /* Registrando puntos */

            if (isset($request->fechaPuntoMuestreo)) {
                for ($i=0; $i < count($request->fechaPuntoMuestreo) ; $i++) { 

                    $postdata_puntos = array(
                        'id' => 0,
                        'id_muestreo' => $id_muestreo,
                        'fecha' => $request->fechaPuntoMuestreo[$i],
                        'agua' => isset($request->aguaPuntoMuestreo[$i]) ? $request->aguaPuntoMuestreo[$i] : 0,
                        'aire' => isset($request->airePuntoMuestreo[$i]) ? $request->airePuntoMuestreo[$i] : 0,
                        'ruido' => isset($request->ruidoPuntoMuestreo[$i]) ? $request->ruidoPuntoMuestreo[$i] : 0,
                        'metereologia' => isset($request->metereologiaPuntoMuestreo[$i]) ? $request->metereologiaPuntoMuestreo[$i] : 0,
                        'suelo' => isset($request->sueloPuntoMuestreo[$i]) ? $request->sueloPuntoMuestreo[$i] : 0,
                        'gaseosa' => isset($request->gaseosaPuntoMuestreo[$i]) ? $request->gaseosaPuntoMuestreo[$i] : 0,
                        'isocinetico' => isset($request->isocineticoPuntoMuestreo[$i]) ? $request->isocineticoPuntoMuestreo[$i] : 0,
                        'otro' => isset($request->otrosPuntoMuestreo[$i]) ? $request->otrosPuntoMuestreo[$i] : 0,
                        'observacion' => $request->observacionPuntoMuestreo[$i],
                        'usuario' => Auth::guard('admin')->user()->Usuario
                    );
    
                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/mantenimiento-puntos', $postdata_puntos);
                    $resultado = $webService->post();
                }
            }
            

            /* REGISTRANDO EQUIPOS */
            if (isset($request->EquipoMuestreo)) {
                for ($i=0; $i < count($request->EquipoMuestreo) ; $i++) { 
                
                    $postdata_equipo = array(
                        'id' => 0,
                        'id_muestreo' => $id_muestreo,
                        'equipo' => $request->EquipoMuestreo[$i],
                        'codigo_laboratorio' => $request->CodigoMuestreo[$i],
                        'usuario' => Auth::guard('admin')->user()->Usuario
                    );

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/mantenimiento-equipos', $postdata_equipo);
                    $resultado = $webService->post();

                }
            }
            
            /* REGISTRANDO EQUIPOS */
            if (isset($request->MatrizMuestreo)) {
                for ($i=0; $i < count($request->MatrizMuestreo) ; $i++) { 
                
                    $postdata_equipo = array(
                        'id' => 0,
                        'id_muestreo' => $id_muestreo,
                        'matriz' => $request->MatrizMuestreo[$i],
                        'parametro' => $request->ParametroMuestreo[$i],
                        'usuario' => Auth::guard('admin')->user()->Usuario
                    );

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/mantenimiento-parametros', $postdata_equipo);
                    $resultado = $webService->post();

                }
            }
                
            //dd($id_muestreo);
            
            if ($resultado || isset($resultado)) {
                Toastr::success('Plan de muestreo registrado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar el plan de muestreo, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/agua/plan-muestreo/' . $id);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar el plan de muestreo, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua/plan-muestreo/' . $id);
        }
    }

    public function editMuestreo(Request $request, $cadena_id, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar?id=' . $cadena_id, );
        $cadena = $webService->get();
        
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/list-analistas', );
        $analistas = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/list-tipo-muestreo');
        $muestreos = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/list-documentos-asociados');
        $documentos = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/list-tipo-agua-muestra');
        $taguas = $webService->get();

        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/list-matriz-duplicado');
        $matrices = $webService->get();
        //dd($cadena);
        if (count($cadena) > 0) {

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/buscar?id=' . $id, );
            $muestreo = $webService->get();

            if (count($muestreo) > 0) {
                
                $muestreo = $muestreo[0];
                
                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/buscar-puntos?id=' . $id, );
                $muestreo->puntos = $webService->get();

                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/buscar-equipos?id=' . $id, );
                $muestreo->equipos = $webService->get();

                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/buscar-parametros?id=' . $id, );
                $muestreo->parametros = $webService->get();
                
                return view('admin.agua.muestreo.edit')
                    ->with('cadena', $cadena[0])
                    ->with('analistas', $analistas)
                    ->with('muestreos', $muestreos)
                    ->with('documentos', $documentos)
                    ->with('taguas', $taguas)
                    ->with('matrices', $matrices)
                    ->with('muestreo', $muestreo);
                    
            } 
            
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua');
        }
    }

    public function updateMuestreo(Request $request, $cadena_id, $id)
    {
        //dd($id);
        try {
            $postdata = array(
                'id' => $id,
                'id_cadena' => $request->id_cadena,
                'contacto_campo' => $request->contacto_campo,
                'celular_contacto' => $request->contacto_telefono,
                'departamento' => $request->departamento,
                'provincia' => $request->provincia,
                'distrito' => $request->distrito,
                'fecha_inicio' => is_null($request->fecha_inicio) ? '' : $request->fecha_inicio,
                'fecha_termino' => is_null($request->fecha_termino) ? '' : $request->fecha_termino,
                'muestra_dirimente' => is_null($request->muestra_dirimente) ? 0 : 1,
                'matriz_muestra_dirimente' => is_null($request->matriz_muestra_dirimente) ? '' : $request->matriz_muestra_dirimente,
                'muestreos' => isset($request->muestreo) ? implode(array_keys($request->muestreo), ';') : '',
                'procedimientos' => isset($request->matriz) ? implode(array_keys($request->matriz), ';') : '',
                'documentos_asociados' => isset($request->documento) ? implode(array_keys($request->documento), ';') : '',
                'tipos' => isset($request->agua) ? implode(array_keys($request->agua), ';') : '',
                'usuario' => Auth::guard('admin')->user()->Usuario,
                'id_analista' => $request->id_analista
            );
            
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/mantenimiento', $postdata);
            $resultado = $webService->post();
            
            $id_muestreo = $resultado[0]['Result'];

            /* Registrando puntos */

            if (isset($request->fechaPuntoMuestreo)) {
                for ($i=0; $i < count($request->fechaPuntoMuestreo) ; $i++) { 

                    $postdata_puntos = array(
                        'id' => 0,
                        'id_muestreo' => $id_muestreo,
                        'fecha' => $request->fechaPuntoMuestreo[$i],
                        'agua' => isset($request->aguaPuntoMuestreo[$i]) ? $request->aguaPuntoMuestreo[$i] : 0,
                        'aire' => isset($request->airePuntoMuestreo[$i]) ? $request->airePuntoMuestreo[$i] : 0,
                        'ruido' => isset($request->ruidoPuntoMuestreo[$i]) ? $request->ruidoPuntoMuestreo[$i] : 0,
                        'metereologia' => isset($request->metereologiaPuntoMuestreo[$i]) ? $request->metereologiaPuntoMuestreo[$i] : 0,
                        'suelo' => isset($request->sueloPuntoMuestreo[$i]) ? $request->sueloPuntoMuestreo[$i] : 0,
                        'gaseosa' => isset($request->gaseosaPuntoMuestreo[$i]) ? $request->gaseosaPuntoMuestreo[$i] : 0,
                        'isocinetico' => isset($request->isocineticoPuntoMuestreo[$i]) ? $request->isocineticoPuntoMuestreo[$i] : 0,
                        'otro' => isset($request->otrosPuntoMuestreo[$i]) ? $request->otrosPuntoMuestreo[$i] : 0,
                        'observacion' => $request->observacionPuntoMuestreo[$i],
                        'usuario' => Auth::guard('admin')->user()->Usuario
                    );
    
                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/mantenimiento-puntos', $postdata_puntos);
                    $resultado = $webService->post();
                }
            }
            

            /* REGISTRANDO EQUIPOS */
            if (isset($request->EquipoMuestreo)) {
                for ($i=0; $i < count($request->EquipoMuestreo) ; $i++) { 
                
                    $postdata_equipo = array(
                        'id' => 0,
                        'id_muestreo' => $id_muestreo,
                        'equipo' => $request->EquipoMuestreo[$i],
                        'codigo_laboratorio' => $request->CodigoMuestreo[$i],
                        'usuario' => Auth::guard('admin')->user()->Usuario
                    );

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/mantenimiento-equipos', $postdata_equipo);
                    $resultado = $webService->post();

                }
            }
            
            /* REGISTRANDO EQUIPOS */
            if (isset($request->MatrizMuestreo)) {
                for ($i=0; $i < count($request->MatrizMuestreo) ; $i++) { 
                
                    $postdata_equipo = array(
                        'id' => 0,
                        'id_muestreo' => $id_muestreo,
                        'matriz' => $request->MatrizMuestreo[$i],
                        'parametro' => $request->ParametroMuestreo[$i],
                        'usuario' => Auth::guard('admin')->user()->Usuario
                    );

                    $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/mantenimiento-parametros', $postdata_equipo);
                    $resultado = $webService->post();

                }
            }
                
            //dd($id_muestreo);
            
            if ($resultado || isset($resultado)) {
                Toastr::success('Plan de muestreo registrado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar el plan de muestreo, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/agua/plan-muestreo/' . $cadena_id);
        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar el plan de muestreo, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua/plan-muestreo/' . $cadena_id);
        }
    }

    public function printMuestreo(Request $request, $cadena_id, $id)
    {
        //dd($id);
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/buscar?id=' . $cadena_id, );
        $cadena = $webService->get();

        if (count($cadena) > 0) {

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/buscar?id=' . $id, );
            $muestreo = $webService->get();

            if (count($muestreo) > 0) {
                
                $muestreo = $muestreo[0];
                
                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/buscar-puntos?id=' . $id, );
                $muestreo->puntos = $webService->get();

                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/buscar-equipos?id=' . $id, );
                $muestreo->equipos = $webService->get();

                $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/agua/muestreo/buscar-parametros?id=' . $id, );
                $muestreo->parametros = $webService->get();
                
                $data['cadena'] = $cadena[0];
                $data['muestreo'] = $muestreo;

                $pdf = PDF::loadView('admin.agua.reporte.plan-muestreo', $data)->setPaper('a4', 'portrait');
                return $pdf->stream();
                
            } 
            
        } else {
            Toastr::warning('No se encontró la cadena seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/agua');
        }
    }

    public function deleteMuestreo(Request $request, $id)
    {
        //dd($request);
        try {
            $postdata = array(
                'id' => $id,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );

            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/agua/muestreo/eliminar', $postdata );
            $resultado = $webService->post();

            if ($resultado) {
                Toastr::success('Plan de muestreo eliminado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al eliminar el plan de muestreo, intente nuevamente.', 'Sistemas Análiticos Generales');    
            }
            return redirect('/admin/agua/plan-muestreo/' . $id);

        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al eliminar el plan de muestreo, intente nuevamente.', 'Sistemas Análiticos Generales');    
            return redirect('/admin/agua/plan-muestreo/' . $id);
        }
    }
}
