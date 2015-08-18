<?php
	$states = array(
		'AC' => 'Acre',
		'AL' => 'Alagoas',
		'AP' => 'Amapá',
		'AM' => 'Amazonas',
		'BA' => 'Bahia',
		'CE' => 'Ceará',
		'DF'=>'Distrito Federal',
		'GO'=>'Goiás',
		'ES'=>'Espírito Santo',
		'MA'=>'Maranhão',
		'MT'=>'Mato Grosso',
		'MS'=>'Mato Grosso do Sul',
		'MG'=>'Minas Gerais',
		'PA'=>'Pará',
		'PB'=>'Paraíba',
		'PR'=>'Paraná',
		'PE'=>'Pernambuco',
		'PI'=>'Piauí',
		'RJ'=>'Rio de Janeiro',
		'RS'=>'Rio Grande do Sul',
		'RN'=>'Rio Grande do Norte',		
		'RO'=>'Rondônia',
		'RR'=>'Roraima',
		'SP'=>'São Paulo',
		'SC'=>'Santa Catarina',
		'SE'=>'Sergipe',
		'TO'=>'Tocantins'
	);
?>
{!! Form::label('state', 'Estado:', ['class' => 'control-label col-xs-2', 'for' => 'est_state']) !!}
<div class="col-xs-10">
	{!! Form::select('states[]', $states, 'RS', ['id' => 'states', 'class' => 'form-control']) !!}
</div>
