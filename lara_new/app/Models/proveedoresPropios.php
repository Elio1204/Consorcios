<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\proveedores;

class proveedoresPropios extends Model
{
    //
    protected $table = 'proveedores_abonos';
    public $timestamps = false;

    public function proveedor()
    {
        return $this->belongsTo(proveedores::class, 'idproveedor', 'idproveedor');
    }
}
