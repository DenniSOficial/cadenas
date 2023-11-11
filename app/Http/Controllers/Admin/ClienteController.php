<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Custom\WebServiceManagerCurl;

class ClienteController extends Controller
{
    public function index()
    {
        if (isset($_POST['cboEjecutivo'])) {
            dd('post');
        } 
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/encuestas/clientes/list-ejecutivos', );
        $ejecutivos = $webService->get();
        //dd($ejecutivos);
        return view('admin.clientes.index')->with('ejecutivos', $ejecutivos);
    }
}
