<?php
	$weekdays = array(
		'0' => 'Domingo',
		'1' => 'Segunda',
		'2' => 'Terça',
		'3' => 'Quarta',
		'4' => 'Quinta',
		'5' => 'Sexta',
		'6' => 'Sábado'
	);
?>
{!! Form::label('weekdays', 'Dias:', ['class' => 'control-label col-xs-2', 'for' => 'est_weekdays']) !!}
<div class="col-sm-2">
	{!! Form::select('weekdays[]', $weekdays, null, ['id' => 'weekdays', 'class' => 'form-control']) !!}
</div>
