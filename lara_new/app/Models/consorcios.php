<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\proveedoresPropios;
use App\Models\unidadesFuncionales;
use App\Models\cajas;
use App\Models\Gastos;

class consorcios extends Model
{
    //
    protected $table = 'consorcios';
    public $timestamps = false;

    //esto seria como un puente entre consorcios y proveedores propios debido a que consorcios es el padre y proveedores propios el hijo
    public function proveedoresPropios()
    {   
        // el segundo parametro es la local key en la consorcios en este caso
        return $this->hasMany(proveedoresPropios::class, 'idcons', 'idcons');
    }

    public function unidadesFuncionales()
    {
        return $this->hasMany(unidadesFuncionales::class, 'idcons', 'idcons');
    }
    public function cajas()
    {
        return $this->hasMany(cajas::class, 'idcons', 'idcons');
    }

    public function gastos()
    {
        return $this->hasMany(Gastos::class, 'idcons', 'idcons')
            ->where('liquidado', 'n');
        
    }
     
    public function proveedoresGenerales()
    {
        return $this->hasMany(proveedores::class, 'idcons', 'idcons');
    }
}