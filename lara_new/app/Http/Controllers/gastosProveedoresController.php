<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gastos;

class gastosProveedoresController extends Controller
{
    //
    public function store(Request $request){

        $request->validate([
            'idcons'=> "required|integer",
            'idproveedor' => "required|integer",
            'monto' => "required|numeric",
            'control' => "required|integer",
            'fecha' => "required|date"
        ]);

        //crea registro en la db

        $gasto = new Gastos();
        $gasto->idcons = $request->input('idcons');
        $gasto->idproveedor = $request->input('idproveedor');
        $gasto->monto = $request->input('monto');
        $gasto->idcontrl = $request->input('control');
        $gasto->fecha = $request->input('fecha');


        // guardado del gasto

        try{
            $gasto->save();
            return back()->with('success', "Se guardoo correctamente el gasto particular.");
        }catch(\Exception $e) {
            return "Error de DB: " . $e->getMessage();
        }

    }
}
