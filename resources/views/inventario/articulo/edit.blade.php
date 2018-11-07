@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Artículo: {{$articulo->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
			{!!Form::model($articulo,['method'=>'PATCH','route'=>['articulo.update',$articulo->idarticulo],'files'=>'true'])!!} 
            {{Form::token()}}
            <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control">
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
    			<label>Estado</label>
    			<select name="idestado" class="form-control">
    				@foreach ($estados as $est)
    					@if($est->idestado==$articulo->idestado)
    					<option value="{{$est->idestado}}" selected>{{$est->nombre}}</option>
    					@else
    					<option value="{{$est->idestado}}">{{$est->nombre}}</option>
    					@endif		
    				@endforeach
    			</select>
    		</div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
    			<label>Categoría</label>
    			<select name="idcategoria" class="form-control">
    				@foreach ($categorias as $cat)
    					@if($cat->idcategoria==$articulo->idcategoria)
    					<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
    					@else
    					<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
    					@endif	
    				@endforeach
    			</select>
    		</div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
    			<label>Ubicación</label>
    			<select name="idubicacion" class="form-control">
    				@foreach ($ubicaciones as $ubi)
    					@if($ubi->idubicacion==$articulo->idubicacion)
    					<option value="{{$ubi->idubicacion}}" selected>{{$ubi->nombre}}</option>
    					@else
    					<option value="{{$ubi->idubicacion}}">{{$ubi->nombre}}</option>
    					@endif	
    				@endforeach
    			</select>
    		</div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="codigo">Código</label>
            	<input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control">
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="cantidad">Cantidad</label>
            	<input type="text" name="cantidad" required value="{{$articulo->cantidad}}" class="form-control">
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<input type="text" name="descripcion" value="{{$articulo->descripcion}}" class="form-control" placeholder="Descripción...">
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="imagen">Imagen</label>
            	<input type="file" name="imagen" class="form-control">
            	@if(($articulo->imagen)!="")
            		<img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" height="300px" width="300px">
            	@endif
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
    	</div>            	
    </div>
            

			{!!Form::close()!!}		
            

@endsection