<?php

namespace sisInventario\Http\Controllers;

use Illuminate\Http\Request;

use sisInventario\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisInventario\Http\Requests\ArticuloFormRequest;
use sisInventario\Articulo;
use sisInventario\Categoria;
use sisInventario\Estado;
use sisInventario\Ubicacion;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class ArticuloController extends Controller
{
    public function __construct()
    {
        //este es la version 2 de la prueba xD v2 repito v2
    }
    public function index(Request $request)
    {
        // if ($request)
        // {
        //     // $articulos = Articulo::with('categoria')->get();         
        //     // var_dump(Articulo::find(1)->categoria);
        //     // var_dump(DB::getQueryLog());
        //     $query = trim($request->input('searchText'));
        //     $articulos = DB::table('articulo as a')
        //     ->join('categoria as c','a.idcategoria','=','c.idcategoria')
        //     ->join('estado as e','a.idestado','=','e.idestado')
        //     ->join('ubicacion as u','a.idubicacion','=','u.idubicacion')
        //     ->select('a.idarticulo','a.nombre','a.codigo','a.cantidad','c.nombre as categoria','e.nombre as estado','u.nombre as ubicacion','a.descripcion','a.imagen')
        //     ->where('a.nombre', 'LIKE', "%$query%")
        //     ->orwhere('a.codigo', 'LIKE', "%$query%")
        //     ->orderBy('a.idcategoria', 'DESC')
        //     ->paginate(7);
        //     return view('inventario.articulo.index', ['articulos'=>$articulos,'searchText'=>$query]);
        // }
        if($request)
        {
            $query=trim($request->get('searchText'));
            $articulos=DB::table('articulo as a')
            ->join('categoria as c','a.idcategoria','=','c.idcategoria')
            ->join('estado as e','a.idestado','=','e.idestado')
            ->join('ubicacion as u','a.idubicacion','=','u.idubicacion')
            ->select('a.idarticulo','a.nombre','a.codigo','a.cantidad','c.nombre as categoria','e.nombre as estado','u.nombre as ubicacion','a.descripcion','a.imagen','a.condicion')
            ->where('a.nombre','LIKE','%'.$query.'%')
            ->orwhere('a.codigo','LIKE','%'.$query.'%')
            //->where('condicion','=','1')
            ->orderBy('a.idarticulo','desc')
            ->paginate(7);
            return view('inventario.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
        }

        // if($request)
        // {
        //     $query=trim($request->get('searchText'));
        //     $articulos=DB::table('articulo as a')
        //     //->join('categoria as c','a.idcategoria','=','c.idcategoria')
        //     ->where('a.nombre','LIKE','%'.$query.'%')
        //     //->where('condicion','=','1')
        //     ->orderBy('idcategoria','desc')
        //     ->paginate(7);
        //     return view('inventario.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
        // }
    }
    public function create()
    {
        //Para el select form
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        $estados=DB::table('estado')->where('condicion','=','1')->get();
        $ubicaciones=DB::table('ubicacion')->where('condicion','=','1')->get();
        return view("inventario.articulo.create",
            [
                "categorias"=>$categorias,
                "estados"=>$estados,
                "ubicaciones"=>$ubicaciones
            ]);
        // $estados=DB::table('estado')->where('condicion','=','1')->get();
        // return view("inventario.articulo.create",["estados"=>$estados]);

    }
    public function store(ArticuloFormRequest $request)
    {
        $articulo=new Articulo;
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->cantidad=$request->get('cantidad');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->condicion = 'Activo';

        if(Input::hasFile('imagen'))
        {
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }

        $articulo->idestado=$request->get('idestado');
        $articulo->idubicacion=$request->get('idubicacion');
        $articulo->save();
        return Redirect::to('inventario/articulo');
    }
    public function show($id)
    {
        return view("inventario.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
    }
    public function edit($id)
    {
        $articulo=Articulo::findOrFail($id);
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        $estados=DB::table('estado')->where('condicion','=','1')->get();
        $ubicaciones=DB::table('ubicacion')->where('condicion','=','1')->get();
        return view("inventario.articulo.edit",
            [
                "articulo"=>$articulo,
                "categorias"=>$categorias,
                "estados"=>$estados,
                "ubicaciones"=>$ubicaciones
            ]);
    }
    public function update(ArticuloFormRequest $request,$id)
    {
        $articulo=Articulo::findOrFail($id);

        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->cantidad=$request->get('cantidad');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->condicion = 'Activo';

        if(Input::hasFile('imagen'))
        {
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }

        $articulo->idestado=$request->get('idestado');
        $articulo->idubicacion=$request->get('idubicacion');
        

        $articulo->update();
        return Redirect::to('inventario/articulo');
    }
    public function destroy($id)
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->condicion = 'Inactivo';
        $articulo->update();
        return Redirect::to('inventario/articulo');
    }
}
