<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\proveedoresPropios;
use Illuminate\Http\Request;

class dashboardDatos extends Controller
{
    //
    public function obtenerProveedoresPropios($idconsorcio)
    {
        $proveedores = proveedoresPropios::where('idcons', $idconsorcio)->get();



        return view('consorcios.show', [
            'prov' => $proveedores
        ]);
    }
}
