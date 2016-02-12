@extends('app', ['title' => 'user'])

@section('styles')
	<style type="text/css">
		.people label {
			font-size: 15px;
			font-weight: bold;
		}
		.side-menu a {
			font-size: 15px;
		}
	</style>
@stop

@section('title') Pessoa :: @parent @stop

@section('content')
	<div class="row">
		@include('partials.side_menu')

		<div class="col-md-9 people">
			<div class="row">
				<div class="page-header">
					{{$user->name}}
				</div>
			</div>
			{!! Form::model(
				$user,
				[
					'method'	=> 'POST',
					'id'		=> 'client',
					'action' 	=> ['ClientsController@update', $user->id],
					'class' 	=> 'form-horizontal'
				]
			) !!}
				@include('clients.form')
			{!! Form::close() !!}
		</div>
	</div>
@stop
