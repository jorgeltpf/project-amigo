<fieldset>
	<legend>PESSOAAAA</legend>
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

	<div class="form-group">
		{!! Form::label('username', 'Usuário:') !!}
		{!! Form::text('username', $user->username, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('name', 'Nome:') !!}
		{!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('email', 'E-mail:') !!}
		{!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('password', 'Senha:') !!}
		{!! Form::password('password', ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('password_confirmation', 'Confirmar Senha:') !!}
		{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Atualizar', ['class' => 'btn btn-primary form-control']) !!}
	</div>
</fieldset>