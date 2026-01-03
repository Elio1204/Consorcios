<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\consorcios;

class consorcios_control extends Controller
{
    //
    public function consorcios(){

        $consorcios = consorcios::all()
        ->where("activo", 's');

        return view('consorcios_view', [
            'consorcios' => $consorcios
        ]);
    }

}
