<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pagos as Pago;


class pagosProveedoresController extends Controller
{
    //
    public function store(Request $request)
    {
        //
        $request->validate([
            'idcons' => "required|integer",
            'idproveedor' => "required|integer",
            'importe_total' => "required|numeric",
            'medio_pago' => "required|string",
            'nro_pago' => "nullable|string",
            'fecha' => "required|date"
        ]);

        //crea registro en la db

        $pago = new Pago();
        $pago->idcons = $request->input('idcons');
        $pago->idproveedor = $request->input('idproveedor');
        $pago->importe_total = $request->input('importe_total');
        $pago->medio_pago = $request->input('medio_pago');
        $pago->status = 'p';
        $pago->iduf = 0;
        $pago->idadmin = 1;
        $pago->nro_pago = $request->input('nro_pago');
        $pago->fecha = $request->input('fecha');


        // guardado del pago
        try {
            $pago->save();
            return back()->with('success', "Se guardoo correctamente el pago al proveedor.");
        } catch (\Exception $e) {
            return back()->with('error', "No se ha podido guardar el pago al proveedor. Error: " . $e->getMessage());
        }
    }



    public function update(Request $request, $idpago)
    {
        $gasto = Pago::findOrFail($idpago);
        $gasto->update([
            'idproveedor' => $request->idproveedor,
            'importe_total'       => $request->importe_total,
            'observaciones'     => $request->observaciones,
            'medio_pago'  => $request->medio_pago,
            'fecha'       => $request->fecha,
        ]);
        return back()->with('success', 'GGasto actualizado correctamente');
    }
}
