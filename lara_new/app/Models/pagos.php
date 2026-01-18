<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pagos extends Model
{
    //
    protected $table = 'pagos';
    public $timestamps = false;

    public function proveedoresPropios()
    {
        return $this->belongsTo(proveedores::class, 'idproveedor', 'idproveedor');
    }
    public function unidadesFuncionales()
    {
        return $this->belongsTo(ConsUniFun::class, 'iduf', 'iduf');
    }
}
