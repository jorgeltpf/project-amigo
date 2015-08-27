@extends('admin.layouts.default')

@section('title') Estabelecimentos :: @parent @stop

@section('main')
	<style type="text/css">
		#est fieldset legend {
    		font-size: 1.2em;
		}
		#est label {
			font-weight: bold;
		}
	</style>
@if(isset($establishments))
    <div class="page-header">
        <h3>
            Editar Estabelecimento - {!! $establishments->name !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{{ URL::to('admin/establishments/') }}}"
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
		$establishments,
		[
			'method' => 'POST',
			'id' => 'est',
			'class' => 'form-horizontal',
			'action' => ['Admin\EstablishmentsController@postEdit', $establishments->id]
		]
	)
!!}
	@include('admin.establishments.form')

{!! Form::close() !!}
@endif
@stop