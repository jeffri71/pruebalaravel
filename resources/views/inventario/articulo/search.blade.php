{!! Form::open(array('url'=>'inventario/articulo','method'=>'GET','autocomplete'=>'off','rule'=>'search'))!!}
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}"></input>
		<span class="input-group">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>
{{Form::close()}}