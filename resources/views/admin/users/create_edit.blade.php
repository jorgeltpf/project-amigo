@extends('admin.layouts.default')

@section('title') Usuários :: @parent @stop

@section('main')
	<style type="text/css">
		#user fieldset legend {
    		font-size: 1.2em;
		}
		#user label {
			font-weight: bold;
		}
	</style>

@if(isset($user))

    <div class="page-header">
        <h3>
            Editar Usuário - {!! $user->name !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{{ URL::to('admin/users/') }}}"
                       class="btn btn-sm btn-primary iframe">
                       <span class="glyphicon glyphicon-backward"></span>
                       Voltar
                    </a>
                </div>
            </div>
        </h3>
    </div>

{!!
	Form::model(
		$user,
		[
			'method' => 'POST',
			'action' => ['Admin\UserController@postEdit', $user->id],
			'class'  => 'form-horizontal',
			'id'	 => 'user'
		]
	)
!!}
@else

    <div class="page-header">
        <h3>
            Novo Usuário
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{{ URL::to('admin/users/') }}}"
                       class="btn btn-sm btn-primary iframe">
                       <span class="glyphicon glyphicon-backward"></span>
                       Voltar
                    </a>
                </div>
            </div>
        </h3>
    </div>

{!!

	Form::open(
		[
			'action' => ['Admin\UserController@postCreate'],
			'class' => 'form-horizontal',
			'id' => 'user',
		]
	)

!!}
@endif

	@include('admin.users.form')


	@if (Entrust::hasRole('admin2'))
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<div class="tab-content">
			<div class="tab-pane active" id="tab-general">
				<div class="col-md-12">
					<div class="form-group">
						<!-- {!! Form::label('name', '{{ trans("admin/users.name") }}', ['class' => 'col-md-2 control-label', 'for' => 'name']) !!} -->
						<label class="col-md-2 control-label" for="name">{{
							trans('admin/users.name') }}</label>
						<div class="col-md-10">
							{!! Form::input('text','name', null, ['class' => 'form-control', 'tabindex' => '1', 'placeholder' => "Nome"]) !!}
	<!-- 						<input class="form-control" tabindex="1"
								placeholder="{{ trans('admin/users.name') }}" type="text"
								name="name" id="name"
								value="{{{ Input::old('name', isset($user) ? $user->name : null) }}}"> -->
						</div>
					</div>
				</div>
	            @if(!isset($user))
	            <div class="col-md-12">
	                <div class="form-group {{{ $errors->has('username') ? 'has-error' : '' }}}">
	                    <label class="col-md-2 control-label" for="username">{{
							trans('admin/users.username') }}</label>
	                    <div class="col-md-10">
	                        <input class="form-control" type="username" tabindex="4"
	                               placeholder="{{ trans('admin/users.username') }}" name="username"
	                               id="username"
	                               value="{{{ Input::old('username', isset($user) ? $user->username : null) }}}" />
	                        {!! $errors->first('username', '<label class="control-label"
	                                                            for="username">:message</label>')!!}
	                    </div>
	                </div>
	            </div>
				<div class="col-md-12">
					<div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
						<label class="col-md-2 control-label" for="email">{{
							trans('admin/users.email') }}</label>
						<div class="col-md-10">
							<input class="form-control" type="email" tabindex="4"
								placeholder="{{ trans('admin/users.email') }}" name="email"
								id="email"
								value="{{{ Input::old('email', isset($user) ? $user->email : null) }}}" />
							{!! $errors->first('email', '<label class="control-label" for="email">:message</label>')!!}
						</div>
					</div>
				</div>
				@endif
				<div class="col-md-12">
					<div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
						<label class="col-md-2 control-label" for="password">{{
							trans('admin/users.password') }}</label>
						<div class="col-md-10">
							<input class="form-control" tabindex="5"
								placeholder="{{ trans('admin/users.password') }}"
								type="password" name="password" id="password" value="" />
							{!!$errors->first('password', '<label class="control-label"
								for="password">:message</label>')!!}
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group {{{ $errors->has('password_confirmation') ? 'has-error' : '' }}}">
						<label class="col-md-2 control-label" for="password_confirmation">{{
							trans('admin/users.password_confirmation') }}</label>
						<div class="col-md-10">
							<input class="form-control" type="password" tabindex="6"
								placeholder="{{ trans('admin/users.password_confirmation') }}"
								name="password_confirmation" id="password_confirmation" value="" />
							{!!$errors->first('password_confirmation', '<label
								class="control-label" for="password_confirmation">:message</label>')!!}
						</div>
					</div>
				</div>
				@if (Entrust::hasRole('admin'))
				<div class="col-md-12">
					<div class="form-group">
						{!! Form::label('role_list', 'Perfis:', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-6">
							{!! Form::select('role_list', $roles, null, ['id' => 'role_list', 'class' => 'form-control']) !!}
						</div>
					</div>
				</div>
				@endif
				<div class="col-xs-12">
					<div class="form-group">
						<label class="col-md-2 control-label" for="confirm">{{
							trans('admin/users.activate_user') }}</label>
						<div class="col-md-6">
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
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<button type="reset" class="btn btn-sm btn-danger close_popup">
					<span class="glyphicon glyphicon-ban-circle"></span> {{
					trans("admin/modal.cancel") }}
				</button>
				<button type="reset" class="btn btn-sm btn-default">
					<span class="glyphicon glyphicon-remove-circle"></span> {{
					trans("admin/modal.reset") }}
				</button>
				<button type="submit" class="btn btn-sm btn-success">
					<span class="glyphicon glyphicon-ok-circle"></span> 
					    @if	(isset($user))
					        {{ trans("admin/modal.edit") }}
					    @else
					        {{trans("admin/modal.create") }}
					    @endif
				</button>
			</div>
		</div>
	@endif
@if (isset($user))
{!! Form::close() !!}
@else
</form>
@endif

@stop

@section('scripts')
<script type="text/javascript">
	$(function() {
		$("#roles").select2();
	});
</script>
@stop
