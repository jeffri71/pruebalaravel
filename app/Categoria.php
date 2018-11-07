<?php

namespace sisInventario;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categoria';
    protected $primaryKey='idcategoria';
    public $timestamps=false;

    protected $fillable =
    [
    	'nombre',
    	'descripcion',
    	'condicion'
    ];
    // protected $guarded =
    // [
    	
    // ];
    public function articulos()
    {
        //Una Categoria puede tener muchos artículos
        //return $this->hasMany(Articulo::class);
    }
}
