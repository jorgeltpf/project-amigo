@extends('admin.layouts.default')

@section('title') Características :: @parent @stop
@section('main')
	<style type="text/css">
		#est fieldset legend {
    		font-size: 1.2em;
		}
		#est label {
			font-weight: bold;
		}
	</style>
@if(isset($particulars))
    <div class="page-header">
        <h3>
            Editar Característica - {!! $particulars->description !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{{ URL::to('admin/particulars/') }}}"
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
		$particulars,
		[
			'method' => 'POST',
			'id' => 'est',
			'class' => 'form-horizontal',
			'action' => ['Admin\ParticularsController@update', $particulars->id],
			'enctype' => "multipart/form-data"
		]
	)
!!}
	@include('admin.particulars.form')

{!! Form::close() !!}
@endif
@stop