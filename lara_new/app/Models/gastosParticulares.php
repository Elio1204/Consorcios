<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gastosParticulares extends Model
{
    //
    protected $table = 'gastos_particulares';
    public $timestamps = false;

    public function unidadesFuncionales()
    {
        return $this->belongsTo(ConsUniFun::class, 'iduf', 'iduf')
            
        ;
    }

}
