<?php

namespace sisInventario;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table='ubicacion';
    protected $primaryKey='idubicacion';
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
