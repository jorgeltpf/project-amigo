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
    <div class="page-header">
        <h3>
            Novo Estabelecimento
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
	Form::open(
		[
			'action' => ['Admin\EstablishmentsController@store'],
			'class' => 'form-horizontal',
			'id' => 'est',
			'enctype' => "multipart/form-data"
		]
	)
!!}

	@include('admin.establishments.form')

{!! Form::close() !!}
@stop

