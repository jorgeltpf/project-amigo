		
		<style type="text/css">
			.input-xs {
				width: 62px;
			}
		</style>
		<fieldset>
    		<legend class="text-center">Informações Básicas</legend>
    		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
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
			<div class="form-group">
				{!! Form::label('image', 'Imagem:', ['class' => 'control-label col-xs-2', 'for' => 'image']) !!}
				<div class="col-xs-10">
					<!-- <input name="est_photo" type="file" class="uploader" id="est_photo" value="Upload" /> -->
					{!! Form::file('image', null) !!}
					@if(!empty($establishments))
						{!! HTML::image('/images/establishments/'.$establishments->id.'/'.$establishments->image) !!}
					@endif
				</div>
			</div>
	    </fielset>
	    <fieldset>
			<legend class="text-center">Localização</legend>
		    <div class="form-group">
		    	{!! Form::label('cep', 'CEP:', ['class' => 'control-label col-xs-2', 'for' => 'cep']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'cep', null, ['class' => 'form-control cep', 'id' => 'cep', 'placeholder' => 'CEP']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('street', 'Rua:', ['class' => 'control-label col-xs-2', 'for' => 'street']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'street', null, ['class' => 'form-control', 'id' => 'street', 'placeholder' => 'Rua']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('neighborhood', 'Bairro:', ['class' => 'control-label col-xs-2', 'for' => 'neighborhood']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'neighborhood', null, ['class' => 'form-control', 'id' => 'neighborhood', 'placeholder' => 'Bairro']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('street_number', 'Número:', ['class' => 'control-label col-xs-2', 'for' => 'number']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'street_number', null, ['class' => 'form-control st_number', 'id' => 'number', 'placeholder' => 'Número']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('complement', 'Complemento:', ['class' => 'control-label col-xs-2', 'for' => 'complement']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'complement', null, ['class' => 'form-control', 'id' => 'complement', 'placeholder' => 'Complemento']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	{!! Form::label('city', 'Cidade:', ['class' => 'control-label col-xs-2', 'for' => 'city']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'city', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'Cidade']) !!}
		        </div>
		    </div>
		    <div class="form-group">
		    	@include ('states')
		    </div>
		    <div class="form-group">
		    	{!! Form::label('country', 'País:', ['class' => 'control-label col-xs-2', 'for' => 'country']) !!}
		        <div class="col-xs-10">
		        	{!! Form::input('text', 'country', 'Brasil', ['class' => 'form-control', 'id' => 'country', 'placeholder' => 'País']) !!}
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

		    @if(isset($adjustWeeks))
		    	@foreach($adjustWeeks as $keys => $weeks)
			    <div class="form-group week-input">
		        	<label class="control-label col-xs-2">Dias</label>
		        	<div class="col-sm-2">
		        		<select id="sel-{!! $weeks['week_day_id'] !!}" name="weekday[{!! $weeks['week_day_id'] !!}][day]" class="sel-week form-control">
		        			<option value={!! $weeks['week_day_id'] !!}>{!! $weeks['name'] !!}</option>
		        		</select>
		        	</div>
		        	@for($i=1; $i<4; $i++)
		        		@if(!empty($weeks['days'][$i]['time_on']))
							<div class="col-sm-1 col-md-1">
								<input name="weekday[{!! $keys !!}][time_on_{!! $i !!}_{!! $i !!}{!! $keys !!}]" id="initial-{!! $i !!}" type="text" class="time form-control input-xs" placeholder="00:00" value="{!! $weeks['days'][$i]['time_on'] !!}">
								<div class="help">Aberto</div>
							</div>
						@else
							<div class="col-sm-1 col-md-1">
								<input name="weekday[{!! $keys !!}][time_on_{!! $i !!}_{!! $i !!}{!! $keys !!}]" id="initial-{!! $i !!}" type="text" class="time form-control input-xs" placeholder="00:00" value="">
								<div class="help">Aberto</div>
							</div>
						@endif
						@if(!empty($weeks['days'][$i]['time_off']))
							<div class="col-sm-1 col-md-1">
								<input name="weekday[{!! $keys !!}][time_off_{!! $i !!}_{!! $i !!}{!! $keys !!}]" id="initial-{!! $i !!}" type="text" class="time form-control input-xs" placeholder="00:00" value="{!! $weeks['days'][$i]['time_off'] !!}">
								<div class="help">Fechado</div>
							</div>
						@else
							<div class="col-sm-1 col-md-1">
								<input name="weekday[{!! $keys !!}][time_off_{!! $i !!}_{!! $i !!}{!! $keys !!}]" id="initial-{!! $i !!}" type="text" class="time form-control input-xs" placeholder="00:00" value="">
								<div class="help">Fechado</div>
							</div>
						@endif
		        	@endfor
		        		<div class="col-sm-1"><button type="button" class="btn btn-danger remove-div"><span class="glyphicon glyphicon-remove"></span></button></div>
<!-- 		        	@foreach($weeks['days'] as $keys => $days)
						<div class="col-sm-1 col-md-1">
							<input name="weekday[{!! $weeks['week_day_id'] !!}][time_on_{!! $weeks['week_day_id'] !!}_"setShift({!! $keys !!})+"{!! $keys !!}]" id="initial-{!! $weeks['week_day_id'] !!}" type="text" class="time form-control input-xs" placeholder="00:00" value="{!! $days['time_on'] !!}">
							<div class="help">Aberto</div>
						</div>
						<div class="col-sm-1 col-md-1">
							<input name="weekday[{!! $weeks['week_day_id'] !!}][time_off_{!! $weeks['week_day_id'] !!}_"+setShift({!! $keys !!})+"{!! $keys !!}]" id="initial-{!! $weeks['week_day_id'] !!}" type="text" class="time form-control input-xs" placeholder="00:00" value="{!! $days['time_off'] !!}">
							<div class="help">Fechado</div>
						</div>
					@endforeach -->
			    </div>
			    @endforeach
		    @endif

	    </fieldset>
	    <div class="form-group">
	        <div class="col-xs-offset-2 col-xs-10">
	            <button type="submit" class="btn btn-success">Salvar</button>
	            <button type="submit" class="btn btn-primary">
	            	<a href="{{{ URL::to('admin/establishments/') }}}"></a>
                    <span class="glyphicon glyphicon-backward"></span> Voltar

            	</button>

	        </div>
	    </div>

@section('scripts')
 
 {!! $validator !!}

<script type="text/javascript">
	$(document).ready(function() {
		$('#cep').on('change', function() {
			if ($('#cep').val()) {
				$.ajax({
                    type: "GET",
                    url: "http://viacep.com.br/ws/"+$('#cep').val()+"/json/",
                    // data: $('form.contact').serialize(),
                    success: function(data) {
                        if (data) {
                            if (data.logradouro) {
                                $('#street').val(data.logradouro);
                            } else {
                                $('#street').val('').removeAttr('readonly');
                            }
                            if (data.bairro) {
                                $('#neighborhood').val(data.bairro);
                            } else {
                                $('#neighborhood').val('').removeAttr('readonly');
                            }
                            if (data.localidade) {
                                $('#city').val(data.localidade);
                            } else {
                                $('#city').val('').removeAttr('readonly');   
                            }
                            if (data.complemento) {
                                $('#complement').val(data.complemento);
                            } else {
                                $('#complement').val('').removeAttr('readonly');   
                            }
                            if (data.uf) {
                                $('#state').val(data.uf);
                            } else {
                                $('#state').val('').removeAttr('readonly');   
                            }
                        }
                    },
                    error: function() {
                        alert("Ocorreu um erro!");
                    }
                });
			}
		})

		var weekdays = "";
		// Ajax para buscar os dias da semana
		$.get('/weekdays', function(data) {
			weekdays = data;
		});

	 	// Adiciona campos para cadastro dos dias da semana e horários
	 	$('#add-field').on('click', function() {
			if (($('.week-input select.form-control').length+1) > 7) {
                alert("Apenas 7 dias podem ser selecionados");
                return false;
            }
            var id = ($('.week-input select.form-control').length + 1).toString();
        	$('#week-input').after(
        		createWeekDiv(id, weekdays)
    		);
	 	});

		// Altera o botão do dia para inputs com horário
		$(document).on('click', '.open-hor', function() {
			var id = $(this).attr('id');
			var len = $('.week-input select.form-control').length;
			var timeClick = $(this).closest('.week-input').find('select').attr('id');
			var idSel = timeClick.split('-')[1];
			var buttonId = id.split('-')[1];

			$(this).parent().after(
				'<div class="col-sm-1 col-md-1"><input name="weekday['+idSel+'][time_on_'+idSel+'_'+buttonId+']" id="initial-'+buttonId+'" type="text" class="hour form-control input-xs" placeholder="00:00"><div class="help">Aberto</div></div>'+
				'<div class="col-sm-1 col-md-1"><input name="weekday['+idSel+'][time_off_'+idSel+'_'+buttonId+']" id="final-'+buttonId+'" type="text" class="hour form-control input-xs" placeholder="00:00"><div class="help">Fechado</div></div>'
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

	function setShift(key) {
        var shift = "";
        switch (key) {
            case '1':
                shift = 'm';
                break;
            case '2':
                shift = 't';
                break;
            case '3':
                shift = 'n';
                break;
         }
         return shift;
	}

	function createWeekDiv(id, option) {
		var html = "";
		var selects = [];
		var len = $('.week-input select.form-control').length+1;
		if ($('.sel-week :selected')) {
			$('.sel-week :selected').each(function(key, val) {
				selects.push($(val).text());
			});
		}
		html += '<div class="form-group week-input">';
		html += '<label class="control-label col-xs-2">Dias</label>';
        html += '<div class="col-sm-2">';
        html +=	'<select id="sel-'+len+'" name="weekday['+len+'][day]" class="sel-week form-control">';
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