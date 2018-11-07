@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Lista de Ubicación <a href="ubicacion/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('inventario.ubicacion.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Descripción</th>
						<th>Opciones</th>
					</thead>
					@foreach ($ubicaciones as $ubi)
					<tr>
						<td>{{$ubi->idubicacion}}</td>
						<td>{{$ubi->nombre}}</td>
						<td>{{$ubi->descripcion}}</td>
						<td>
							<a href="{{URL::action('UbicacionController@edit',$ubi->idubicacion)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#danger-alert{{$ubi->idubicacion}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                         
						</td>
					</tr>
					@include('inventario.ubicacion.modal')
					@endforeach
				</table>
			</div>
			{{$ubicaciones->render()}}
		</div>
	</div>
@endsection

