		
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
					trans('admin/users.password') }}:</label>
				<div class="col-xs-10">
					<input class="form-control" tabindex="5"
						placeholder="{{ trans('admin/users.password') }}"
						type="password" name="password" id="password" value="" />
					{!!$errors->first('password', '<label class="control-label"
						for="password">:message</label>')!!}
				</div>
			</div>
			<div class="form-group {{{ $errors->has('password_confirmation') ? 'has-error' : '' }}}">
				<label class="col-md-2 control-label" for="password_confirmation">{{
					trans('admin/users.password_confirmation') }}:</label>
				<div class="col-md-10">
					<input class="form-control" type="password" tabindex="6"
						placeholder="{{ trans('admin/users.password_confirmation') }}"
						name="password_confirmation" id="password_confirmation" value="" />
					{!!$errors->first('password_confirmation', '<label
						class="control-label" for="password_confirmation">:message</label>')!!}
				</div>
			</div>
			@if (Entrust::hasRole('admin'))
				<div class="form-group">
					{!! Form::label('role_list', 'Perfis:', ['class' => 'col-xs-2 control-label']) !!}
					<div class="col-xs-4">
						{!! Form::select('role_list', $roles, null, ['id' => 'role_list', 'class' => 'form-control']) !!}
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
							}}}</option>
						<option value="0" {{{ ((isset($user) && $user->confirmed == 0) ?
							' selected="selected"' : '') }}}>{{{ trans('admin/users.no')
							}}}</option>
					</select>
				</div>
			</div>
	    </fielset>
	    <div class="form-group">
	        <div class="col-xs-offset-2 col-xs-10">
	            <button type="submit" class="btn btn-success save-user" id="save-user">Salvar</button>
	            <button type="button" class="btn btn-primary">
	            	<a href="{{{ URL::to('admin/users/') }}}"></a>
                    <span class="glyphicon glyphicon-backward"></span> Voltar
            	</button>
	        </div>
	    </div>

@section('scripts')

{!! $validator !!}

<script type="text/javascript">
	$(function() {
		$("#roles").select2();
	});
</script>
@stop