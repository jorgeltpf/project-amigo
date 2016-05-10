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

	@if (isset($user))
		{!! Form::close() !!}
	@else
		</form>
	@endif

@stop
