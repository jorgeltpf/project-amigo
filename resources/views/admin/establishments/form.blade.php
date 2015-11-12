		
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
								<input name="weekday[{!! $keys !!}][time_on_{!! $i !!}_{!! $i !!}{!! $keys !!}]" id="initial-{!! $i !!}" type="text" class="time hour form-control input-xs hour-open" placeholder="00:00" value="{!! $weeks['days'][$i]['time_on'] !!}">
								<div class="help">Aberto</div>
							</div>
						@else
							<div class="col-sm-1 col-md-1">
								<input name="weekday[{!! $keys !!}][time_on_{!! $i !!}_{!! $i !!}{!! $keys !!}]" id="initial-{!! $i !!}" type="text" class="time hour form-control input-xs hour-open" placeholder="00:00" value="">
								<div class="help">Aberto</div>
							</div>
						@endif
						@if(!empty($weeks['days'][$i]['time_off']))
							<div class="col-sm-1 col-md-1">
								<input name="weekday[{!! $keys !!}][time_off_{!! $i !!}_{!! $i !!}{!! $keys !!}]" id="final-{!! $i !!}" type="text" class="time hour form-control input-xs hour-closed" placeholder="00:00" value="{!! $weeks['days'][$i]['time_off'] !!}">
								<div class="help">Fechado</div>
							</div>
						@else
							<div class="col-sm-1 col-md-1">
								<input name="weekday[{!! $keys !!}][time_off_{!! $i !!}_{!! $i !!}{!! $keys !!}]" id="final-{!! $i !!}" type="text" class="time hour form-control input-xs hour-closed" placeholder="00:00" value="">
								<div class="help">Fechado</div>
							</div>
						@endif
		        	@endfor
	        		<div class="col-sm-1"><button type="button" class="btn btn-danger remove-div"><span class="glyphicon glyphicon-remove"></span></button></div>
			    </div>
			    @endforeach
		    @endif
	    </fieldset>
	    <div class="form-group">
	        <div class="col-xs-offset-2 col-xs-10">
	            <button type="button" class="btn btn-success save-est" id="save-est">Salvar</button>
	            <button type="button" class="btn btn-primary">
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
		});

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
			var buttonTime = buttonId.substring(0,1).toString();

			switch (buttonTime) {
				case "m":
					$(this).parent().after(
						'<div class="col-sm-1 col-md-1"><input name="weekday['+idSel+'][time_on_'+idSel+'_'+buttonId+']" id="initial-'+buttonId+'" type="text" class="hour morning form-control input-xs hour-open" placeholder="00:00"><div class="help">Aberto</div></div>'+
						'<div class="col-sm-1 col-md-1"><input name="weekday['+idSel+'][time_off_'+idSel+'_'+buttonId+']" id="final-'+buttonId+'" type="text" class="hour morning form-control input-xs hour-closed" placeholder="00:00"><div class="help">Fechado</div></div>'
					);
					break;
				case "t":
					$(this).parent().after(
						'<div class="col-sm-1 col-md-1"><input name="weekday['+idSel+'][time_on_'+idSel+'_'+buttonId+']" id="initial-'+buttonId+'" type="text" class="hour afternoon form-control input-xs hour-open" placeholder="00:00"><div class="help">Aberto</div></div>'+
						'<div class="col-sm-1 col-md-1"><input name="weekday['+idSel+'][time_off_'+idSel+'_'+buttonId+']" id="final-'+buttonId+'" type="text" class="hour afternoon form-control input-xs hour-closed" placeholder="00:00"><div class="help">Fechado</div></div>'
					);
					break;
				case "n":
					$(this).parent().after(
						'<div class="col-sm-1 col-md-1"><input name="weekday['+idSel+'][time_on_'+idSel+'_'+buttonId+']" id="initial-'+buttonId+'" type="text" class="hour night form-control input-xs hour-open" placeholder="00:00"><div class="help">Aberto</div></div>'+
						'<div class="col-sm-1 col-md-1"><input name="weekday['+idSel+'][time_off_'+idSel+'_'+buttonId+']" id="final-'+buttonId+'" type="text" class="hour night form-control input-xs hour-closed" placeholder="00:00"><div class="help">Fechado</div></div>'
					);
					break;
			}

			// $(this).parent().after(
			// 	'<div class="col-sm-1 col-md-1"><input name="weekday['+idSel+'][time_on_'+idSel+'_'+buttonId+']" id="initial-'+buttonId+'" type="text" class="morning hour2 form-control input-xs hour-open" placeholder="00:00"><div class="help">Aberto</div></div>'+
			// 	'<div class="col-sm-1 col-md-1"><input name="weekday['+idSel+'][time_off_'+idSel+'_'+buttonId+']" id="final-'+buttonId+'" type="text" class="hour form-control input-xs hour-closed" placeholder="00:00"><div class="help">Fechado</div></div>'
			// );

			var nightMask = function(val) {
				var first = val.substring(0,1).toString(),
					sec = val.substring(1,2).toString(),
					ter = val.substring(3,4).toString(),
					finalMask = "00:00";

		  		if (first == 1) {
		  			if (sec && (sec > 7 && sec <= 9)) {
		  				finalMask = first + sec + ":";
		  			} else {
		  				finalMask = first;		  				
		  			}
	  				if (ter >= 0 && ter <= 5) {	  					
	  					finalMask = finalMask+ter+"0";
	  				} else {
	  					finalMask = finalMask+"50";
	  				}
		  		} else if (first == 2) {
		  			if (sec && (sec >= 0 && sec <= 3)) {
		  				finalMask = first + sec + ":";
		  			} else {
		  				finalMask = first;
		  			}
	  				if (ter >= 0 && ter <= 5) {
	  					finalMask = finalMask+ter+"0";
	  				} else {
	  					finalMask = finalMask+"50";
	  				}
		  		} else if (first == 0) {
		  			if (sec && (sec >= 0 && sec <= 4)) {
		  				finalMask = first + sec + ":";
		  			} else {
		  				finalMask = first;
		  			}
	  				if (ter >= 0 && ter <= 5) {
	  					finalMask = finalMask+ter+"0";
	  				} else {
	  					finalMask = finalMask+"50";
	  				}
		  		} else {
		  			finalMask = "18:00";
		  		}
		  		return finalMask;
		  		// return phone.match('/0?[0-9]|1[0-9]|2[0-3]:^[0-5][0-9]$/');
			};

			var morningMask = function(val) {
				var first = val.substring(0,1).toString(),
					sec = val.substring(1,2).toString(),
					ter = val.substring(3,4).toString(),
					finalMask = "05:00";

		  		if (first == 1) {
		  			if (sec && (sec >= 0 && sec <= 2)) {
		  				finalMask = first + sec + ":";
		  			} else {
		  				finalMask = first;		  				
		  			}
	  				if (ter >= 0 && ter <= 5) {	  					
	  					finalMask = finalMask+ter+"0";
	  				} else {
	  					finalMask = finalMask+"50";
	  				}
		  		} else if (first == 0) {
		  			if (sec && (sec >= 5 && sec <= 9)) {
		  				finalMask = first + sec + ":";
		  			} else {
		  				finalMask = first;
		  			}
	  				if (ter >= 0 && ter <= 5) {
	  					finalMask = finalMask+ter+"0";
	  				} else {
	  					finalMask = finalMask+"50";
	  				}
		  		} else {
		  			finalMask = "12:50";
		  		}
		  		return finalMask;
		  		// return phone.match('/0?[0-9]|1[0-9]|2[0-3]:^[0-5][0-9]$/');
			};

			// var SPMaskBehavior = function (val) {
			//   return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
			// },

			var maskNightOptions = {
			  onKeyPress: function(val, e, field, options) {
			      field.mask(nightMask.apply({}, arguments), options);
			    }
			};

			var maskMorningOptions = {
			  onKeyPress: function(val, e, field, options) {
			      field.mask(morningMask.apply({}, arguments), options);
			    }
			};

			$('.hour').mask('00:00');
			$('.morning').mask(morningMask, maskMorningOptions);
			// $('.morning').mask('AB:YS',
			// 	{'translation': {
   //                  A: {pattern: /[0]?[0-1]/},
   //                  B: {pattern: /[0]?[5-9]/},
   //                  Y: {pattern: /[0-5]/},
   //                  S: {pattern: /[0-9]*/}
   //            	}
   //          });

			$('.afternoon').mask('1A:YS',
				{'translation': {
                    A: {pattern: /[1]?[0-8]/},
                    Y: {pattern: /[0-5]/},
                    S: {pattern: /[0-9]*/}
              	}
            });

			$('.night').mask(nightMask, maskNightOptions);

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

		$('.save-est').on('click', function() {
			var hourOpen = [];
			var hourClosed = [];
			var testHour = {
				'open': [], 'close': []
			};
			$('.hour-open').each(function(key, val) {	
				// if ($(this).val()) {			
					var item = {};
					if ($(this).hasClass('night')
						&& $(this).attr('id').split('-')[0] == 'initial'
						&& ($(this).val() > 0 && $(this).val() < "04:59")
						) {
						var initialhour = (parseInt($(val).val())+24+":00").toString();
						item['open'] = initialhour;
					} else {
						item['open'] = $(val).val();
					}
					hourOpen.push(item);
					testHour.open.push(item);
				// }
			});			

			$('.hour-closed').each(function(key, val) {
				// if ($(this).val()) {
					var item = {};
					if ($(this).hasClass('night')
						&& $(this).attr('id').split('-')[0] == 'final'
						) {
						var finalhour = (parseInt($(val).val())+24+":00").toString();
						item['close'] = finalhour;
					} else {
						item['close'] = $(val).val();
					}
					hourClosed.push(item);
					testHour.close.push(item);
				// }
			});

			var test = {
		  		'initial': [],
			  	'final': []
			}
			var id = "";

			$('.hour').each(function(key, val) {
			  	var array = [];
			  	var split = $(val).attr('id').split('-');
			  	id = split[1];

			  	if (split[0] == 'initial') {
			    	array.push($(val).val())
			    	test.initial.push(array)
	  			} else if (split[0] == 'final') {
			    	array.push($(val).val())
			    	test.final.push(array)
			  	} 
			});

			var comp = false;
			var info = "";
			$(test.initial).each(function(keyI, valI) {
			  	$(test.final).each(function(keyF, valF) {
			    	if (keyI == keyF) {
			      		if (valI != "" && valF == "") {
			        		comp = true;
			        		info = "Campo final vazio";
			      		} else if (valI == "" && valF != "") {
			        		comp = true;
			        		info = "Campo inicial vazio";
			      		} else if (valI != "" && valF != "") {
			        		if (valI > valF) {
			           			comp = true;
			           			info = "Campo inicial maior que o final";
			        		}
		      			} else {
			        		// alert('erro 333333!!!!'); 
			      		}
		    		}
			  	})
			});

			// var comp = compareHour(hourOpen, hourClosed, testHour);
			if (!$('.hour').val()) {
				info = "Selecione horário(s) de funcionamento!";
			}

			if ($('.hour').val() && comp == false) {
				$('#est').submit();
			} else {
				$('#save-est').qtip({
			        content: info,
					show: {
						when: false,
						ready: true,
		           		// effect: function() {
			            // 	$(this).slideDown();
			            // }
					},
					hide: 'click',
					api: {
						onRender: function() {
							// Hide the tooltip when it is clicked
							this.elements.tooltip.click(this.hide)
						},
						onHide: function() {
							// Set a state cookie
							$('#save-est', true, { path: '/', expires: 10 });
		 
							// Destroy me since I have no futher use!
							this.destroy();
						}
					}

				});
			}
		});
	});

	function compareHour(hourOpen, hourClosed, testHour) {
		var prb = false,
			open,
			secondsOpen,
			close,
			secondsClose,
			count = testHour.open.length;

		$(testHour.open).each(function(keyOpen, valOpen) {
			$(testHour.close).each(function(keyClose, valClose) {
				if (testHour.open[keyOpen] && testHour.close[keyClose]) {
					// console.log(testHour.open[keyOpen]);
					// console.log(testHour.close[keyClose]);
				}
			});
		});

		$(hourOpen).each(function(key, val) {
			$(hourClosed).each(function(keyC, valC) {
				if (val['open'].length>0 && valC['close'].length>0) {
					if (val['open'] >= valC['close']) {
						prb = true;
					}
				}
			});
		});
		// alert(prb);
		return prb;
	}

	function getHour24(timeString) {
	    time = null;
	    var matches = timeString.match(/^(\d{1,2}):00 (\w{2})/);

	    if (matches != null && matches.length == 3) {
	        time = parseInt(matches[1]);
	        if (matches[2] == 'PM') {
	            time += 12;
	        }
	    }
	    return time;
	}

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