<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    //
    protected $table = 'gastos';
    public $timestamps = false;

    public function proveedoresPropios()
    {
        return $this->belongsTo(proveedores::class, 'idproveedor', 'idproveedor');
    }

    public function controlesInfo()
    {
        return $this->belongsTo(controles::class, 'idcontrol', 'idcontrol');
    }

    protected $guarded = [];

}
