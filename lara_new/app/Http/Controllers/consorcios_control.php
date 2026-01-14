<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\consorcios;
use App\Models\banco;
use App\Models\Gastos;
use App\Models\proveedoresPropios;
use App\Models\unidadesFuncionales;
use App\Models\cajas;
  

class consorcios_control extends Controller
{
    //
    public function consorcios()
    {

        $cons = consorcios::all()
            ->where("activo", 's')
            ->all();


        $desde = now()->startOfMonth();
        $hasta = now()->endOfMonth();

        $totalImporte = banco::whereBetween('ban_mov_fecha', [$desde, $hasta])
            ->where('ban_uf', 0)
            ->sum('ban_mov_importe');

        // GAstos pendientes
        $gastos_pendientes = Gastos::all()
            ->where('liquidado', 'n')
            ->count('idgasto');



        return view('dashboard', [
            'consorcios' => $cons,
            'total' => count($cons),
            'gastos' => 140000,
            'totalImporte' => $totalImporte,
            'gastosPendi' => $gastos_pendientes,
        ]);
    }


    public function show($id)
    {
        // with carga automáticamente los proveedores del consorcio
        $consorcio = consorcios::with(['proveedoresPropios', 'unidadesFuncionales', 'cajas', 'gastos', 'proveedoresPropios.infoProveedor'])
            ->where('idcons', $id)
            ->firstOrFail();

        return view('consorcios.show', [
            'consorcio' => $consorcio
            // YA NO pasamos 'prov' => $prov, porque va adentro de $consorcio
        ]);
    }
}
