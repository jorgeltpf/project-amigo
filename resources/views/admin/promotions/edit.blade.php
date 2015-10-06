@extends('admin.layouts.default')

@section('title') Promoções :: @parent @stop

@section('main')
	<style type="text/css">
		#est fieldset legend {
    		font-size: 1.2em;
		}
		#est label {
			font-weight: bold;
		}
	</style>
@if(isset($promotions))
    <div class="page-header">
        <h3>
            Editar Promoção - {!! $promotions->name !!}
            <div class="pull-right">
                <div class="pull-right">
                    <a href="{{{ URL::to('admin/promotions/') }}}"
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
		$promotions,
		[
			'method' => 'POST',
			'id' => 'est',
			'class' => 'form-horizontal',
			'action' => ['Admin\PromotionsController@update', $promotions->id],
			'enctype' => "multipart/form-data"
		]
	)
!!}
	@include('admin.promotions.form')

{!! Form::close() !!}
@endif
@stop