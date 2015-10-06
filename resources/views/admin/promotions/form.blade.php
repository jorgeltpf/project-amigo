		
		<style type="text/css">
			.input-xs {
				width: 62px;
			}
		</style>
		<fieldset>
    		<legend class="text-center">Informações Básicas</legend>
    		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		    <div class="form-group">
		    	{!! Form::label('name', 'Nome:', ['class' => 'control-label col-xs-2', 'for' => 'promo_name']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'name', null, ['class' => 'form-control', 'id' => 'promo_name', 'placeholder' => 'Nome']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('establishments_list', 'Estabelecimentos:', ['class' => 'control-label col-xs-2', 'for' => 'establishments_list']) !!}
		        <div class="col-xs-10">
		        	{!! Form::select('establishments_list', $establishments_list, null,['class' => 'form-control', 'id' => 'establishments_list']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('products_list', 'Produtos:', ['class' => 'control-label col-xs-2', 'for' => 'products_list']) !!}
		        <div class="col-xs-10">
		        	{!! Form::select('products_list', $products_list, null,['class' => 'form-control', 'id' => 'products_list']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('discount', 'Desconto:', ['class' => 'control-label col-xs-2', 'for' => 'promo_discount']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'discount', null, ['class' => 'form-control money', 'id' => 'promo_discount', 'placeholder' => 'Desconto']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('initial_period', 'Início:', ['class' => 'control-label col-xs-2', 'for' => 'initial_period']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'initial_period', null, ['class' => 'form-control', 'id' => 'initial_period', 'placeholder' => 'Início']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('final_period', 'Final:', ['class' => 'control-label col-xs-2', 'for' => 'final_period']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'final_period', null, ['class' => 'form-control', 'id' => 'final_period', 'placeholder' => 'Final']) !!}
		        </div>
		    </div>
		    

	    </fieldset>
	    <div class="form-group">
	        <div class="col-xs-offset-2 col-xs-10">
	            <button type="submit" class="btn btn-success">Salvar</button>
	            <button type="submit" class="btn btn-primary">
	            	<a href="{{{ URL::to('admin/promoucts/') }}}"></a>
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