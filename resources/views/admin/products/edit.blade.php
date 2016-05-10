@extends('admin.layouts.default')

@section('title') Produtos :: @parent @stop

@section('main')
	<style type="text/css">
		#est fieldset legend {
    		font-size: 1.2em;
		}
		#est label {
			font-weight: bold;
		}
	</style>
@if(isset($products))
    <div class="page-header">
        <h3>
            Editar Produto - {!! $products->name !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{{ URL::to('admin/products/') }}}"
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
		$products,
		[
			'method' => 'POST',
			'id' => 'est',
			'class' => 'form-horizontal',
			'action' => ['Admin\ProductsController@update', $products->id],
			'enctype' => "multipart/form-data"
		]
	)
!!}
	@include('admin.products.form')

{!! Form::close() !!}
@endif
@stop