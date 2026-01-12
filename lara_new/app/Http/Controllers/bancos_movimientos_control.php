<?php

namespace App\Http\Controllers;

use App\Models\banco;
use Illuminate\Http\Request;
use App\Models\bancos;


class bancos_movs extends Controller
{
public function movimientos()
{
    $desde = now()->startOfMonth();
    $hasta = now()->endOfMonth();

    
    $totalImporte = banco::whereBetween('fecha', [$desde, $hasta])
        ->where('ban_uf', 0)
        ->sum('ban_mov_importe');

    // 2. Para obtener la LISTA de movimientos (para una tabla):
    $movimientos = banco::whereBetween('fecha', [$desde, $hasta])
        ->where('ban_uf', 0)
        ->get();

    return view('dashboard', [
        'total_dinero' => $totalImporte,
        'movs'         => $movimientos
    ]);
}
}
