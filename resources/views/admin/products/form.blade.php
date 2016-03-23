
		<style type="text/css">
			.input-xs {
				width: 62px;
			}
		</style>
		<fieldset>
    		<legend class="text-center">Informações Básicas</legend>
    		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		    <div class="form-group">
		    	{!! Form::label('name', 'Nome:', ['class' => 'control-label col-xs-2', 'for' => 'prod_name']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'name', null, ['class' => 'form-control', 'id' => 'prod_name', 'placeholder' => 'Nome']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('product_types_list', 'Tipo:', ['class' => 'control-label col-xs-2', 'for' => 'prod_type']) !!}
		        <div class="col-xs-10">
		        	{!! Form::select('product_type_id', $product_types_list, null,['class' => 'form-control', 'id' => 'prod_type']) !!}
		        </div>
		    </div>  
		     <div class="form-group">
		    	{!! Form::label('establishments_list', 'Estabelecimento:', ['class' => 'control-label col-xs-2', 'for' => 'estab']) !!}
		        <div class="col-xs-10">
		        	{!! Form::select('establishment_id', $establishments_list, null,['class' => 'form-control', 'id' => 'estab']) !!}
		        </div>
		    </div>  
		    <div class="form-group">
		    	{!! Form::label('price', 'Preço:', ['class' => 'control-label col-xs-2', 'for' => 'prod_price']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'price', null, ['class' => 'form-control money', 'id' => 'prod_price', 'placeholder' => 'Preço']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('ingredients', 'Ingredientes:', ['class' => 'control-label col-xs-2', 'for' => 'prod_ingredients']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'ingredients', null, ['class' => 'form-control', 'id' => 'prod_ingredients', 'placeholder' => 'Ingredientes']) !!}
		        </div>
		    </div>
		    

	    </fieldset>
	    <div class="form-group">
	        <div class="col-xs-offset-2 col-xs-10">
	            <button type="submit" class="btn btn-success">Salvar</button>
	            <button type="submit" class="btn btn-primary">
	            	<a href="{{{ URL::to('admin/products/') }}}"></a>
                    <span class="glyphicon glyphicon-backward"></span> Voltar

            	</button>

	        </div>
	    </div>

@section('scripts')

{!! $validator !!}

<script type="text/javascript">
	$(document).ready(function() {
		
		
	});

</script>
@stop