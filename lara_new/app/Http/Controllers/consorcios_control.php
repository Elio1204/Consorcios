<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\consorcios;
use App\Models\banco;
use App\Models\Gastos;

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
        $consorcio = consorcios::where('idcons', $id)->firstOrFail();

        return view('consorcios.show', [
            'consorcio' => $consorcio
        ]);
    }
}
