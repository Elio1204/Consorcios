<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class proveedoresPropios extends Model
{
    //
    protected $table = 'proveedores_abonos';
    public $timestamps = false;

    public function infoProveedor()
    {
        return $this->belongsTo(proveedores::class, 'idproveedor', 'idproveedor');
    }
}
