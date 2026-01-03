<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gastos;

class gastos_control extends Controller
{
    //  
    public function showGastos($idconsorcio){

        $gastos = Gastos::all()
        ->where('idcons', $idconsorcio)
        ->where('liquidado', 'n')
        ;

        return view('gasto_view', [
            'gastos' => $gastos
        ]);
    }
}
