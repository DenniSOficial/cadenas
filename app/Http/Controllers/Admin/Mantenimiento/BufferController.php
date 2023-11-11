<?php

namespace App\Http\Controllers\admin\mantenimiento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

use App\Custom\WebServiceManagerCurl;

class BufferController extends Controller
{
    protected $urlApiSAG = 'http://161.132.181.82:85/sag-app/public/api';

    public function index()
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/buffer/listado', );
        $buffers = $webService->get();

        return view('admin.mantenimiento.buffer.index')
                ->with('buffers', $buffers);
    }

    public function create()
    {
        $buffer = null;
        
        $tipos[0] = array('Valor' => 'A', 'Descripcion' => 'Ajuste');
        $tipos[1] = array('Valor' => 'C', 'Descripcion' => 'Control');

        $parametros[0] = array('Valor' => 'CL', 'Descripcion' => 'Cloro');
        $parametros[1] = array('Valor' => 'CE', 'Descripcion' => 'Conductimetro');
        $parametros[2] = array('Valor' => 'OD', 'Descripcion' => 'Oximetro');
        $parametros[3] = array('Valor' => 'PH', 'Descripcion' => 'Potenciometro');
        $parametros[4] = array('Valor' => 'TB', 'Descripcion' => 'Turbiedad');
        
        return view('admin.mantenimiento.buffer.create')
                ->with('buffer', $buffer)
                ->with('tipos', $tipos)
                ->with('parametros', $parametros);
    }

    public function store(Request $request)
    {
        $array_desde = explode('/', $request->desde);
        $array_vigencia = explode('/', $request->vigencia);

        try {
            $postdata = array(
                'id' => 0,
                'desde' => $array_desde[0] . $array_desde[1],
                'vigencia' => $array_vigencia[0] . $array_vigencia[1],
                'material' => $request->material,
                'marca' => $request->marca,
                'lote' => $request->lote,
                'valor_referencia' => $request->valor_referencia,
                'rango_inicial' => $request->rango_inicial,
                'rango_final' => $request->rango_final,
                'tipo' => $request->tipo,
                'parametro' => $request->parametro,
            );

            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/buffer/mantenimiento', $postdata );
            $resultado = $webService->post();

            if ($resultado) {
                Toastr::success('Buffer registrado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar el buffer, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/mantenimiento/buffer');

        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar el buffer, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/mantenimiento/buffer');
        }
    }

    public function edit(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/buffer/buscar?id=' . $id, );
        $buffer = $webService->get();
        //dd($buffer);
        $tipos[0] = array('Valor' => 'A', 'Descripcion' => 'Ajuste');
        $tipos[1] = array('Valor' => 'C', 'Descripcion' => 'Control');

        $parametros[0] = array('Valor' => 'CL', 'Descripcion' => 'Cloro');
        $parametros[1] = array('Valor' => 'CE', 'Descripcion' => 'Conductimetro');
        $parametros[2] = array('Valor' => 'OD', 'Descripcion' => 'Oximetro');
        $parametros[3] = array('Valor' => 'PH', 'Descripcion' => 'Potenciometro');
        $parametros[4] = array('Valor' => 'TB', 'Descripcion' => 'Turbiedad');

        return view('admin.mantenimiento.buffer.edit')
                ->with('buffer', $buffer[0])
                ->with('tipos', $tipos)
                ->with('parametros', $parametros);
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $array_desde = explode('/', $request->desde);
        $array_vigencia = explode('/', $request->vigencia);
        //dd($id);
        try {
            $postdata = array(
                'id' => $id,
                'desde' => $array_desde[0] . $array_desde[1],
                'vigencia' => $array_vigencia[0] . $array_vigencia[1],
                'material' => $request->material,
                'marca' => $request->marca,
                'lote' => $request->lote,
                'valor_referencia' => $request->valor_referencia,
                'rango_inicial' => $request->rango_inicial,
                'rango_final' => $request->rango_final,
                'tipo' => $request->tipo,
                'parametro' => $request->parametro,
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/mantenimiento/buffer/mantenimiento', $postdata );
            $resultado = $webService->post();

            if ($resultado) {
                Toastr::success('Buffer actualizado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al actualizar el buffer, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/mantenimiento/buffer');

        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al actualizar el buffer, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/mantenimiento/buffer');
        }
    }
}
