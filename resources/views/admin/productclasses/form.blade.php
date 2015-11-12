
		<style type="text/css">
			.input-xs {
				width: 62px;
			}
		</style>
		<fieldset>
    		<legend class="text-center">Informações Básicas</legend>
    		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		    <div class="form-group">
		    	{!! Form::label('description', 'Descrição:', ['class' => 'control-label col-xs-2', 'for' => 'description']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Descrição']) !!}
		        </div>
		    </div>
		    
		    

	    </fieldset>
	    <div class="form-group">
	        <div class="col-xs-offset-2 col-xs-10">
	            <button type="submit" class="btn btn-success">Salvar</button>
	            <button type="submit" class="btn btn-primary">
	            	<a href="{{{ URL::to('admin/productclasses/') }}}"></a>
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