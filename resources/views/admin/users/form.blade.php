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
        	{!! Form::input('text', 'name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nome']) !!}
        </div>
    </div>
    @if(!isset($user))
	    <div class="form-group">
	    	{!! Form::label('username', 'Usuário', ['class' => 'control-label col-xs-2', 'for' => 'username']) !!}
	        <div class="col-xs-10">
	        	{!! Form::input('text', 'username', null, ['class' => 'form-control', 'id' => 'username', 'placeholder' => 'Usuário']) !!}
	        </div>
	    </div>
	    <div class="form-group">
	    	{!! Form::label('email', 'E-mail:', ['class' => 'control-label col-xs-2', 'for' => 'email']) !!}
	        <div class="col-xs-10">
	        	{!! Form::input('text', 'email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'E-mail:']) !!}
	        </div>
	    </div>
	@endif
	<div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
		<label class="col-xs-2 control-label" for="password">{{
			trans('admin/users.password') }}:
		</label>
		<div class="col-xs-6">
			<input class="form-control" tabindex="5"
				placeholder="{{ trans('admin/users.password') }}"
				type="password" name="password" id="password" value="" />
			{!!$errors->first('password', '<label class="control-label"
				for="password">:message</label>')!!}
		</div>
	</div>
	<div class="form-group {{{ $errors->has('password_confirmation') ? 'has-error' : '' }}}">
		<label class="col-xs-2 control-label" for="password_confirmation">{{
			trans('admin/users.password_confirmation') }}:</label>
		<div class="col-xs-6">
			<input class="form-control" type="password" tabindex="6"
				placeholder="{{ trans('admin/users.password_confirmation') }}"
				name="password_confirmation" id="password_confirmation" value="" />
			{!!$errors->first('password_confirmation', '<label
				class="control-label" for="password_confirmation">:message</label>')!!}
		</div>
	</div>
	@if (Entrust::hasRole('admin'))
		<div class="form-group div-role-list">
			{!! Form::label('role_list', 'Perfis:', ['class' => 'col-xs-2 control-label']) !!}
			<div class="col-xs-4">
				{!! Form::select('role_list', $roles, null, ['id' => 'role_list', 'class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group div-est-list">
			{!! Form::label('establishment_list', 'Estabelecimentos:', ['class' => 'col-xs-2 control-label']) !!}
			<div class="col-xs-4">
				{!! Form::select('establishment_list', $establishments, null, ['id' => 'establishment_list', 'class' => 'form-control']) !!}
			</div>
		</div>
	@endif
	<div class="form-group">
		<label class="col-xs-2 control-label" for="confirm">{{
			trans('admin/users.activate_user') }}:</label>
		<div class="col-xs-2">
			<select class="form-control" name="confirmed" id="confirmed">
				<option value="1" {{{ ((isset($user) && $user->confirmed == 1)? '
					selected="selected"' : '') }}}>{{{ trans('admin/users.yes')
					}}}
				</option>
				<option value="0" {{{ ((isset($user) && $user->confirmed == 0) ?
					' selected="selected"' : '') }}}>{{{ trans('admin/users.no')
					}}}
				</option>
			</select>
		</div>
	</div>
</fielset>
<hr>
<fieldset>
	<legend class="text-center">Informações Pessoais</legend>
	<div class="form-group">
		<label class="col-xs-2 control-label" for="people_type">
			Tipo:
		</label>
		<div class="col-xs-2">
			<select class="form-control" name="people_type" id="people_type">
				<option value="1">Física</option>
				<option value="2">Jurídica</option>
			</select>
		</div>
	</div>
    @include('partials.person_form')
</fieldset>
<div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
        <button type="button" class="btn btn-primary">
        	<a href="{{{ URL::to('admin/users/') }}}"></a>
            <span class="glyphicon glyphicon-backward"></span> Voltar
    	</button>
        <button type="submit" class="btn btn-success save-user" id="save-user">Salvar</button>
    </div>
</div>

@section('scripts')

{!! $validator !!}

<script type="text/javascript">
	$(function() {
		// $("#role_list").select2();
		// $("#establishment_list").select2();

		if ($("#role_list").val() == "4") {
			$("#establishment_list").val("");
			$(".div-est-list").hide();
		}

		$(document).on('change', '#role_list', function() {
			if ($(this).val() == "4") {
				$("#establishment_list").val("");
				$(".div-est-list").hide();
			} else {
				$(".div-est-list").show();
			}
		});
	});
</script>
@stop