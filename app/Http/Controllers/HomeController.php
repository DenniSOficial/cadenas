<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

use App\Custom\WebServiceManagerCurl;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->user = json_decode(Session::get('usuario'));
    }

    public function index()
    {
        //$mes = getdate();
        $dias = Carbon::now()->lastOfMonth()->format('d');
        $nombresMes = Carbon::now()->lastOfMonth()->format('F');
        //dd($dias);
        $arrayDias = '[';
        for ($i=1; $i <= $dias; $i++) { 
            $arrayDias .= $i;
            if ($i != $dias) {
                $arrayDias .= ',';
            }
        }
        $arrayDias .= ']';
        
        $webService = new WebServiceManagerCurl('http://161.132.181.82:85/sag-app/public/api/laboratorio/ruido/grafico/cantidades-por-mes' , );
        $rpta = $webService->get();
        //dd($rpta);
        $cantidades = $rpta[0]->Cantidades;
        $total = $rpta[0]->Total;
        $maximo = $rpta[0]->Maximo;
        return view('admin.home')->with('dias', $arrayDias)->with('nombreMes', $nombresMes)->with('cantidades', $cantidades)->with('total', $total)->with('maximo', $maximo);
    }
}

