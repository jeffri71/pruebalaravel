<?php

namespace sisInventario\Http\Controllers;

use Illuminate\Http\Request;

use sisInventario\Http\Requests;
use sisInventario\Estado;
use Illuminate\Support\Facades\Redirect;
use sisInventario\Http\Requests\EstadoFormRequest;
use DB;

class EstadoController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
    	if($request)
    	{
    		$query=trim($request->get('searchText'));
    		$estados=DB::table('estado')
    		->where('nombre','LIKE','%'.$query.'%')
    		->where('condicion','=','1')
    		// ->orderBy('idestado','desc')
            ->orderBy('idestado')
    		->paginate(7);
    		return view('inventario.estado.index',["estados"=>$estados,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("inventario.estado.create");
    }
    public function store(EstadoFormRequest $request)
    {
    	$estado=new Estado;
    	$estado->nombre=$request->get('nombre');
    	$estado->descripcion=$request->get('descripcion');
    	$estado->condicion='1';
    	$estado->save();
    	return Redirect::to('inventario/estado');
    }
    public function show($id)
    {
    	return view("inventario.estado.show",["estado"=>Estado::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("inventario.estado.edit",["estado"=>Estado::findOrFail($id)]);
    }
    public function update(EstadoFormRequest $request,$id)
    {
        $estado=Estado::findOrFail($id);
        $estado->nombre=$request->get('nombre');
        $estado->descripcion=$request->get('descripcion');
        $estado->update();
        return Redirect::to('inventario/estado');
    }
    public function destroy($id)
    {
        $estado=Estado::findOrFail($id);
        $estado->condicion='0';
        $estado->update();
        return Redirect::to('inventario/estado');
    }
}
