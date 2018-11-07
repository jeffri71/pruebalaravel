<?php

namespace sisInventario;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table='articulo';
    protected $primaryKey='idarticulo';
    public $timestamps=false;

    protected $fillable =
    [
    	'idcategoria',
    	'codigo',
    	'nombre',
    	'cantidad',
    	'descripcion',
    	'imagen',
    	'idestado',
    	'idubicacion',
        'condicion'
    ];
    protected $guarded =
    [
    	
    ];
    public function categoria()
    {
        //Un Articulo puede pertenecer a una Categoria
        //return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
