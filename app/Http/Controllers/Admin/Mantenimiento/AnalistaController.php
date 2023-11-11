<?php

namespace App\Http\Controllers\Admin\Mantenimiento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Custom\WebServiceManagerCurl;

class AnalistaController extends Controller
{
    public function index()
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/list-analistas', );
        $analistas = $webService->get();
        //dd($analistas);
        return view('admin.mantenimiento.analista.index')->with('analistas', $analistas);
    }

    public function create()
    {
        return view('admin.mantenimiento.analista.create');
    }

    public function store(Request $request)
    {
        //dd($request);
        try {
            $postdata = array(
                'id' => 0,
                'documento' => $request->documento,
                'apaterno' => $request->apaterno,
                'amaterno' => $request->amaterno,
                'nombres' => $request->nombres,
                'usuario' => Auth::guard('admin')->user()->Usuario  
            );
            //dd($postdata);

            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/analista/mantenimiento', $postdata);
            $resultado = $webService->post();

            if ($resultado) {
                Toastr::success('Analista registrado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar al analista, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/mantenimiento/analista');

        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar al analista, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/mantenimiento/analista');
        }
    }

    public function edit(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/analista/buscar?id=' . $id, );
        $resultado = $webService->get();
        //dd($resultado);
        return view('admin.mantenimiento.analista.edit')->with('analista', $resultado[0]);
    }

    public function update(Request $request, $id)
    {
        //dd($id);
        try {
            $postdata = array(
                'id' => $id,
                'documento' => $request->documento,
                'apaterno' => $request->apaterno,
                'amaterno' => $request->amaterno,
                'nombres' => $request->nombres,
                'usuario' => Auth::guard('admin')->user()->Usuario  
            );
            //dd($request->hasfile('firma'));
            if($request->hasfile('firma'))
            {
                $imagen         =   $request->file('firma');
                $nombreimagen   =   $id . '.' . strtolower($imagen->getClientOriginalExtension());
                $nuevaruta      =   public_path('/assets/img/analista/'.$nombreimagen);
                copy($imagen->getRealPath(),$nuevaruta);
            }
                
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/analista/mantenimiento', $postdata);
            $resultado = $webService->post();

            if ($resultado) {
                Toastr::success('Analista registrado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al actualizar al analista, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/mantenimiento/analista');

        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al actualizar al analista, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/mantenimiento/analista');
        }
    }

    public function delete(Request $request, $id)
    {
        //dd($request);
        try {
            $postdata = array(
                'id' => $id,
                'usuario' => Auth::guard('admin')->user()->Usuario  
            );

            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/analista/elimina', $postdata);
            $resultado = $webService->post();

            if ($resultado) {
                Toastr::success('Analista eliminado satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al eliminar al analista, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/mantenimiento/analista');

        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al eliminar al analista, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/mantenimiento/analista');
        }
    }
}
