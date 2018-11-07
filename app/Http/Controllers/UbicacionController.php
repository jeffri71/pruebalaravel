<?php

namespace sisInventario\Http\Controllers;

use Illuminate\Http\Request;

use sisInventario\Http\Requests;
use sisInventario\Ubicacion;
use Illuminate\Support\Facades\Redirect;
use sisInventario\Http\Requests\UbicacionFormRequest;
use DB;

class UbicacionController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
    	if($request)
    	{
    		$query=trim($request->get('searchText'));
    		$ubicaciones=DB::table('ubicacion')
    		->where('nombre','LIKE','%'.$query.'%')
    		->where('condicion','=','1')
    		// ->orderBy('idestado','desc')
            ->orderBy('idubicacion', 'desc')
    		->paginate(7);
    		return view('inventario.ubicacion.index',["ubicaciones"=>$ubicaciones,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("inventario.ubicacion.create");
    }
    public function store(UbicacionFormRequest $request)
    {
    	$ubicacion=new Ubicacion;
    	$ubicacion->nombre=$request->get('nombre');
    	$ubicacion->descripcion=$request->get('descripcion');
    	$ubicacion->condicion='1';
    	$ubicacion->save();
    	return Redirect::to('inventario/ubicacion');
    }
    public function show($id)
    {
    	return view("inventario.ubicacion.show",["ubicacion"=>Ubicacion::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("inventario.ubicacion.edit",["ubicacion"=>Ubicacion::findOrFail($id)]);
    }
    public function update(UbicacionFormRequest $request,$id)
    {
        $ubicacion=Ubicacion::findOrFail($id);
        $ubicacion->nombre=$request->get('nombre');
        $ubicacion->descripcion=$request->get('descripcion');
        $ubicacion->update();
        return Redirect::to('inventario/ubicacion');
    }
    public function destroy($id)
    {
        $ubicacion=Ubicacion::findOrFail($id);
        $ubicacion->condicion='0';
        $ubicacion->update();
        return Redirect::to('inventario/ubicacion');
    }
}
