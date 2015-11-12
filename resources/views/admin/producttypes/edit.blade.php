@extends('admin.layouts.default')

@section('title') Tipos de Produto :: @parent @stop

@section('main')
	<style type="text/css">
		#est fieldset legend {
    		font-size: 1.2em;
		}
		#est label {
			font-weight: bold;
		}
	</style>
@if(isset($productTypes))
    <div class="page-header">
        <h3>
            Editar Tipo - {!! $productTypes->description !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{{ URL::to('admin/producttypes/') }}}"
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
		$productTypes,
		[
			'method' => 'POST',
			'id' => 'est',
			'class' => 'form-horizontal',
			'action' => ['Admin\ProductTypesController@update', $productTypes->id],
			'enctype' => "multipart/form-data"
		]
	)
!!}
	@include('admin.producttypes.form')

{!! Form::close() !!}
@endif
@stop