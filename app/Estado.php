<?php

namespace sisInventario;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table='estado';
    protected $primaryKey='idestado';
    public $timestamps=false;

    protected $fillable =
    [
    	'nombre',
    	'descripcion',
    	'condicion'
    ];
    protected $guarded =
    [
    	
    ];
}
