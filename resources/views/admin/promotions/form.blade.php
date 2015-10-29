		
<style type="text/css">
	.input-xs {
		width: 62px;
	}
</style>
<fieldset>
	<legend class="text-center">Informações Básicas</legend>
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
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
        	{!! Form::select('products_list[]', $products_list, null,['class' => 'form-control', 'id' => 'products_list', 'multiple']) !!}
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
        	{!! Form::input('date', 'initial_period', null, ['class' => 'form-control date datepicker', 'id' => 'initial_period', 'placeholder' => 'Início']) !!}
        </div>
    </div>
    <div class="form-group">
    	{!! Form::label('final_period', 'Final:', ['class' => 'control-label col-xs-2', 'for' => 'final_period']) !!}
        <div class="col-xs-10">
        	{!! Form::input('date', 'final_period', null, ['class' => 'form-control date datepicker', 'id' => 'final_period', 'placeholder' => 'Final']) !!}
        </div>
    </div>
</fieldset>
<div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
        <button type="submit" class="btn btn-success" id="save-promo">Salvar</button>
        <button type="submit" class="btn btn-primary">
        	<a href="{{{ URL::to('admin/promotions/') }}}"></a>
            <span class="glyphicon glyphicon-backward"></span> Voltar
    	</button>
    </div>
</div>

@section('scripts')



{!! $validator !!}

<script type="text/javascript">
	$(document).ready(function() {
		$('.datepicker').datepicker({
			format: "dd/mm/yyyy",
            language: "pt-BR",
            autoclose: true,
            startDate: '+0d'
		});

		$('#products_list').select2();

		// $('#products_list').select2({
		//     formatResult:function(object, container, query){
		//         if(object.id=='all' || object.id=='clear')
		//             return '<span style="color:#31708F;font-size:10px;"><i class="fa fa-chevron-right"></i> '+object.text+'</span>';

		//         return object.text;
		//     }
		// });
		// $('#products_list').on("change", function(e) {
		//     if($.inArray('all', e.val)===0){
		//         var selected = [];
		//         $(this).find("option").each(function(i,e){
		//             if($(e).attr("value")=='all' || $(e).attr("value")=='clear')
		//                 return true;

		//             selected[selected.length]=$(e).attr("value");
		//         });
		//         $(this).select2('val',selected);
		//     }else if($.inArray('clear', e.val)===0){
		//         $(this).select2('val','');
		//     }
		// });
	});

</script>
@stop