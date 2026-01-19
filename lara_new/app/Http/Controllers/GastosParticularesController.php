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
            'descrip' => "required|string|max:255",
        ]);

        //crear el registros en la db

        $gasto = new gastosParticulares();
        $gasto->idcons = $request->input('idcons');
        $gasto->iduf = $request->input('iduf');
        $gasto->gas_par_importe = $request->input('gas_par_importe');
        $gasto->descrip = $request->input('descrip');;
        // $gasto->fecha = now();
        $gasto->save();

        return redirect()->back()->with('success', 'Gasto agregado correctamente');
    }
}
