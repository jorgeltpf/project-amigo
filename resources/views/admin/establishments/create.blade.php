@extends('admin.layouts.default')

@section('title') Estabelecimentos :: @parent @stop

@section('main')
	<style type="text/css">
		#est fieldset legend {
    		font-size: 1.2em;
		}
		#est label {
			font-weight: bold;
		}
	</style>
    <div class="page-header">
        <h3>
            Novo Estabelecimento
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{{ URL::to('admin/establishments/') }}}"
                       class="btn btn-sm btn-primary iframe">
                       <span class="glyphicon glyphicon-backward"></span>
                       Voltar
                    </a>
                </div>
            </div>
        </h3>
    </div>

@if(isset($establishments))
{!!
	Form::model(
		$establishments,
		[
			'method' => 'POST',
			'id' => 'est',
			'class' => 'form-horizontal',
			'action' => ['Admin\EstablishmentsController@postEdit', $establishments->id]
		]
	)
!!}
@else
{!!
	Form::open(
		[
			'action' => ['Admin\EstablishmentsController@store'],
			'class' => 'form-horizontal',
			'id' => 'est'
		]
	)
!!}
@endif

    <!-- <form id="est" class="form-horizontal"> -->
    	<fieldset>
    		<legend class="text-center">Informações Básicas</legend>
		    <div class="form-group">
		    	{!! Form::label('name', 'Nome:', ['class' => 'control-label col-xs-2', 'for' => 'est_name']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'name', null, ['class' => 'form-control', 'id' => 'est_name', 'placeholder' => 'Nome']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('cnpj', 'CNPJ:', ['class' => 'control-label col-xs-2', 'for' => 'est_cnpj']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'cnpj', null, ['class' => 'form-control cnpj', 'id' => 'est_cnpj', 'placeholder' => 'CNPJ']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('email', 'E-mail:', ['class' => 'control-label col-xs-2', 'for' => 'est_email']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'email', null, ['class' => 'form-control', 'id' => 'est_email', 'placeholder' => 'E-mail']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('phone', 'Telefone:', ['class' => 'control-label col-xs-2', 'for' => 'est_phone']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'phone', null, ['class' => 'form-control phone_with_ddd', 'id' => 'est_phone', 'placeholder' => 'Telefone']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('cell_phone', 'Celular:', ['class' => 'control-label col-xs-2 ', 'for' => 'est_cell_phone']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'cell_phone', null, ['class' => 'form-control phone_with_ddd', 'id' => 'est_cell_phone', 'placeholder' => 'Celular']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('delivery_max_time', 'Tempo Máx de Entrega:', ['class' => 'control-label col-xs-2', 'for' => 'est_delivery_max_time']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'delivery_max_time', null, ['class' => 'form-control st_number', 'id' => 'est_cell_phone', 'placeholder' => 'Tempo Máx de Entrega em Minutos']) !!}
		        </div>
		    </div>
	    </fielset>
	    <fieldset>
			<legend class="text-center">Localização</legend>
		    <div class="form-group">
		    	{!! Form::label('cep', 'CEP:', ['class' => 'control-label col-xs-2', 'for' => 'est_cep']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'cep', null, ['class' => 'form-control cep', 'id' => 'est_cep', 'placeholder' => 'CEP']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('street', 'Rua:', ['class' => 'control-label col-xs-2', 'for' => 'est_street']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'street', null, ['class' => 'form-control', 'id' => 'est_street', 'placeholder' => 'Rua']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('street_number', 'Número:', ['class' => 'control-label col-xs-2', 'for' => 'est_number']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'street_number', null, ['class' => 'form-control st_number', 'id' => 'est_number', 'placeholder' => 'Número']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('complement', 'Complemento:', ['class' => 'control-label col-xs-2', 'for' => 'est_complement']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'complement', null, ['class' => 'form-control', 'id' => 'est_complement', 'placeholder' => 'Complemento']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('city', 'Cidade:', ['class' => 'control-label col-xs-2', 'for' => 'est_city']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'city', null, ['class' => 'form-control', 'id' => 'est_city', 'placeholder' => 'Cidade']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	@include ('states')
		    </div>
		    <div class="form-group">
		    	{!! Form::label('country', 'País:', ['class' => 'control-label col-xs-2', 'for' => 'est_country']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'country', 'Brasil', ['class' => 'form-control', 'id' => 'est_country', 'placeholder' => 'País']) !!}
		        </div>
		    </div>
	    </fieldset>
	    <fieldset>
	    	<legend class="text-center">Dias Aberto</legend>
		    <div class="form-group" id="week-input">
		        <div class="col-xs-offset-2 col-xs-10">
		            <button type="button" class="btn btn-primary" id="add-field">Adicionar</button>
		            <button type="button" class="btn btn-success">Manhã</button>
        			<button type="button" class="btn btn-success">Tarde</button>
        			<button type="button" class="btn btn-success">Noite</button>
		        </div>
		    </div>
	    </fieldset>
	    <div class="form-group">
	        <div class="col-xs-offset-2 col-xs-10">
	            <button type="submit" class="btn btn-success">Salvar</button>
	            <button type="button" class="btn btn-primary">
	            	<span class="glyphicon glyphicon-backward"></span> Voltar
            	</button>
	        </div>
	    </div>
{!! Form::close() !!}
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		var weekdays = "";
		// Ajax para buscar os dias da semana
		$.get('/weekdays', function(data) {
			weekdays = data;
		});

		// Máscaras - TRANSFERIR PARA ARQUIVO JS ÚNICO
		$('.st_number').mask('99999');
		$('.cep').mask('99999-999');
		$('.phone_with_ddd').mask('(00) 0000-0000');
	 	$('.cnpj').mask('99.999.999/9999-99');	 	

	 	// Adiciona campos para cadastro dos dias da semana e horários
	 	$('#add-field').on('click', function() {
			if (($('.week-input .form-control').length+1) > 7) {
                alert("Apenas 7 dias podem ser selecionados");
                return false;
            }
            var id = ($('#week-input .control-group').length + 1).toString();
        	$('#week-input').after(
        		createWeekDiv(id, weekdays)
    		);
	 	});

		// Altera o botão do dia para inputs com horário
		$(document).on('click', '.open-hor', function() {
			var id = $(this).attr('id');
			$(this).parent().after(
				'<div class="col-sm-1 col-md-1"><input id="initial-'+id+'" type="text" class="hour form-control" placeholder="00:00"><div class="help">Aberto</div></div>'+
				'<div class="col-sm-1 col-md-1"><input id="final-'+id+'" type="text" class="hour form-control" placeholder="00:00"><div class="help">Fechado</div></div>'
			);
			$('.hour').mask('00:00');
			$(this).parent().css('display', 'none');
			$(this).parent().remove();
		});

		// Remove divs de horário
		$(document).on('click', '.remove-div', function() {
			var $this = $(this),
				options = $($this.parent().siblings('div').first('select')).find('select option'),
  				nextDiv = $($this.parents('div.week-input').next()).find('select').prepend(options);
			$this.parents('div.week-input').remove();
		});
	});

	function createWeekDiv(id, option) {
		var html = "";
		var selects = [];
		if ($('.sel-week :selected')) {
			$('.sel-week :selected').each(function(key, val) {
				selects.push($(val).text());
			});
		}
		html += '<div class="form-group week-input">';
		html += '<label class="control-label col-xs-2">Dias</label>';
        html += '<div class="col-sm-2">';
        html +=	'<select class="sel-week form-control">';
        if (option) {
        	$.each(option, function(key, val) {
        		if (selects.indexOf(val.name) == -1) {
					html += '<option value="'+val.id+'">'+val.name+'</option>';
					// Remove outros elementos dos selects anteriores
					$('.sel-week option:not(:selected)').remove();
				}
        	});
        } else {
        	html += '<option value="1">Domingo</option>';
        	html += '<option value="2">Segunda</option>';
        	html += '<option value="3">Terça</option>';
        	html += '<option value="4">Quarta</option>';
        	html += '<option value="5">Quinta</option>';
        	html += '<option value="6">Sexta</option>';
        	html += '<option value="7">Sábado</option>';
        }
        html += '</select></div>';
        html += '<div class="col-sm-1"><button type="button" id="btn-m'+id+'" class="btn btn-success open-hor">Manhã</button></div>';
        html += '<div class="col-sm-1"><button type="button" id="btn-t'+id+'" class="btn btn-success open-hor">Tarde</button></div>';
        html += '<div class="col-sm-1"><button type="button" id="btn-n'+id+'" class="btn btn-success open-hor">Noite</button></div>';
        html += '<div class="col-sm-1"><button type="button" class="btn btn-danger remove-div"><span class="glyphicon glyphicon-remove"></span></button></div>';
        html += '</div>';
        return html;
	}
</script>
@stop