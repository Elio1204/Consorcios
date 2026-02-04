<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class gastosParticulares extends Model
{
    //
    protected $table = 'gastos_particulares';
    public $timestamps = false;
    protected $primaryKey = 'gas_par_registro';

    public function unidadesFuncionales()
    {
        return $this->belongsTo(ConsUniFun::class, 'iduf', 'iduf')
            
        ;
    }
    protected $guarded = [];

}
