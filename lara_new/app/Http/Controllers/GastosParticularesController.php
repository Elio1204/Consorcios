<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gastosParticulares;

class GastosParticularesController extends Controller
{
    //

    public function store(Request $request)
    {
        // dd($request->all());
        $request ->validate([
            'idcons' => "required|integer",
            'iduf' => "required|integer",
            'gas_par_importe' => "required|numeric",
            'gas_par_saldo' => "required|numeric",
        ]);

        //crear el registros en la db

        $gasto = new gastosParticulares();
        $gasto->idcons = $request->input('idcons');
        $gasto->iduf = $request->input('iduf');
        $gasto->gas_par_importe = $request->input('gas_par_importe');
        $gasto->gas_par_descripcion = "TESTING GASTO PARTICULAR";
        $gasto->gas_par_saldo = $request->input('gas_par_saldo');
        $gasto->idcajacons = 1;
        $gasto->gas_par_fecha = now();
        try {
            $gasto->save();
            return back()->with('success', "Se guardoo correctamente el gasto particular.");
        } catch (\Exception $e) {
            return "Error de DB: " . $e->getMessage();
        }

    } 
} 
