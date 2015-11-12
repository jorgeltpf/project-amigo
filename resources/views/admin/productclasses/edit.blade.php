@extends('admin.layouts.default')

@section('title') Classes de Produto :: @parent @stop

@section('main')
	<style type="text/css">
		#est fieldset legend {
    		font-size: 1.2em;
		}
		#est label {
			font-weight: bold;
		}
	</style>
@if(isset($productClasses))
    <div class="page-header">
        <h3>
            Editar Classe - {!! $productClasses->description !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{{ URL::to('admin/productsclasses/') }}}"
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
		$productClasses,
		[
			'method' => 'POST',
			'id' => 'est',
			'class' => 'form-horizontal',
			'action' => ['Admin\ProductClassesController@update', $productClasses->id],
			'enctype' => "multipart/form-data"
		]
	)
!!}
	@include('admin.productclasses.form')

{!! Form::close() !!}
@endif
@stop