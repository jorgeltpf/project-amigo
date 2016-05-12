
<style type="text/css">
	.input-xs {
		width: 62px;
	}
</style>
<fieldset>
	<legend class="text-center">Informações Básicas</legend>
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="form-group">
    	{!! Form::label('descrição', 'Descrição:', ['class' => 'control-label col-xs-2', 'for' => 'particular_description']) !!}
        <div class="col-xs-10">
        	{!! Form::input('text', 'description', null, ['class' => 'form-control', 'id' => 'particular_description', 'placeholder' => 'Descrição']) !!}
        </div>
    </div>
    <div class="form-group">
    	{!! Form::label('particular_types_list', 'Tipo:', ['class' => 'control-label col-xs-2', 'for' => 'particular_type']) !!}
        <div class="col-xs-4">
        	{!! Form::select('particular_type_id', $particular_types_list, null,['class' => 'form-control', 'id' => 'particular_type']) !!}
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

@stop