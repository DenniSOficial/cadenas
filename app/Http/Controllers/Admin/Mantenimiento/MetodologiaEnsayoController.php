<?php

namespace App\Http\Controllers\Admin\Mantenimiento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

use App\Custom\WebServiceManagerCurl;

class MetodologiaEnsayoController extends Controller
{
    public function index()
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/metodologia-ensayo/listado', );
        $metodologias = $webService->get();
        return view('admin.mantenimiento.metodologia-ensayo.index')->with('metodologias', $metodologias);
    }

    public function create()
    {
        $metodologia = null;
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/list-unidades-medida', );
        $unidades = $webService->get();
        return view('admin.mantenimiento.metodologia-ensayo.create')->with('metodologia', $metodologia)->with('unidades', $unidades);
    }

    public function store(Request $request)
    {
        //dd($request);

        try {
            $postdata = array(
                'id' => 0,
                'ensayo' => $request->ensayo,
                'metodologia' => $request->metodologia,
                'unidad' => $request->unidad,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/metodologia-ensayo/mantenimiento', $postdata );
            $resultado = $webService->post();

            if ($resultado) {
                Toastr::success('Metodología de ensayo registrada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al registrar la metodología de ensayo, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/mantenimiento/metodologia-ensayo');

        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al registrar la metodología de ensayo, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/mantenimiento/metodologia-ensayo');
        }
    }

    public function edit(Request $request, $id)
    {
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/metodologia-ensayo/buscar?id=' . $id, );
        $metodologia = $webService->get();
        
        if (count($metodologia) > 0) {
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/list-unidades-medida', );
            $unidades = $webService->get();
            return view('admin.mantenimiento.metodologia-ensayo.edit')->with('metodologia', $metodologia[0])->with('unidades', $unidades);
        } else {
            Toastr::warning('No se encontró la metodología seleccionada, verifique.', 'Sistemas Análiticos Generales');
            return redirect('/admin/mantenimiento/metodologia-ensayo');
        }
        
        
    }

    public function update(Request $request, $id)
    {
        try {
            $postdata = array(
                'id' => $id,
                'ensayo' => $request->ensayo,
                'metodologia' => $request->metodologia,
                'unidad' => $request->unidad,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/metodologia-ensayo/mantenimiento', $postdata );
            $resultado = $webService->post();

            if ($resultado) {
                Toastr::success('Metodología de ensayo editada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al editar la metodología de ensayo, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/mantenimiento/metodologia-ensayo');

        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al editar la metodología de ensayo, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/mantenimiento/metodologia-ensayo');
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $postdata = array(
                'id' => $id,
                'usuario' => Auth::guard('admin')->user()->Usuario
            );
            //dd($postdata);
            $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/mantenimiento/metodologia-ensayo/eliminar', $postdata );
            $resultado = $webService->post();

            if ($resultado) {
                Toastr::success('Metodología de ensayo eliminada satisfactoriamente.', 'Sistemas Análiticos Generales');
            } else {
                Toastr::error('Hubo un error al eliminar la metodología de ensayo, intente nuevamente.', 'Sistemas Análiticos Generales');
            }
            return redirect('/admin/mantenimiento/metodologia-ensayo');

        } catch (\Throwable $th) {
            Toastr::error('Hubo un error al eliminar la metodología de ensayo, intente nuevamente.', 'Sistemas Análiticos Generales');
            return redirect('/admin/mantenimiento/metodologia-ensayo');
        }
    }
    
}
