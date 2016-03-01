@extends('app')

@section('styles')
<!-- {!! HTML::style('css/shop.css') !!}  -->
    <style type="text/css">
    	.payment-group-buttons .first-button {
			color: #000; 
		}
		.payment-group-buttons .last-button {
			color: #fff;
    	}
    	.payment-form .glyphicon {
    		font-size: 30px;
    	}
    	.payment-form li:nth-child(1) span {
    		color: #C1240B;
    	}
    	.payment-form li:nth-child(2) span {
    		color: #2F831E;
    	}
    </style>
@stop

@section('title') @parent :: Pagamento @stop

@section('content')
	<div class="row">
		<div class="page-header">
			<h2>Pagamento</h2>
		</div>
	</div>


	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h2>Resumo do Pedido</h2>
				<div class="col-md-12">
					<table class="table table-header">
						<thead>
							<tr>
								<td colspan="{{sizeOf($result)}}">Pedido nº</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Quantidade</td>
								<td>{{$result['qtd']}}</td>
							</tr>
							<tr>
								<td>Frete</td>
								<td>0,00</td>
							</tr>
							<tr>
								<td>Valor Total</td>
								<td>{{$result['total']}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-4">
				<h2>Endereço de Entrega</h2>
				<table class="table table-header">
					<thead>
						<tr>
							<td colspan="{{sizeOf($result)}}">CEP</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Rua</td>
							<td></td>
						</tr>
						<tr>
							<td>Bairro</td>
							<td></td>
						</tr>
						<tr>
							<td>Complemento</td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-4 panel payment-form">
				<h2>Formas de Pagamento</h2>
				<form class="form-horizontal">
					<div class="panel-body panel-list">
						<ul class="list-inline col-sm-12">
							<li class="col-md-4 col-sm-4 col-xs-6 grid-icon" style="text-align:center">
								<span class="glyphicon glyphicon-credit-card"></span>
								<p>Crédito</p>
								<input type="radio" name="types[]" id="type_1" value="1">
							</li>
							<li class="col-md-4 col-sm-2 col-xs-6 grid-icon" style="text-align:center">
								<span class="glyphicon glyphicon-credit-card"></span>
								<p>Débito</p>
								<input type="radio" name="types[]" id="type_2" value="2">
							</li>
							<li class="col-md-4 col-sm-2 col-xs-6 grid-icon" style="text-align:center">
								<span class="glyphicon glyphicon-piggy-bank"></span>
								<p>Dinheiro</p>
								<input type="radio" name="types[]" id="type_3" value="3">
							</li>
						</ul>
							<div class="col-md-12 form-group">
								<label class="control-label col-md-6">
									Código Promocional
								</label>
								<input type="text" id="promo" class="col-md-6" name="promo">
							</div>
						</div>
					</form>
			</div>
		</div>

		<hr>

		<div class="row">
	        <div class="payment-group-buttons pull-right">
	        	<button type="button" class="btn btn-default">
		        	<a class="first-button" href="/orders/4/payments_index/">
	            		<span class="glyphicon glyphicon-chevron-left"></span> Voltar
	        		</a>
	        	</button>
	        	<button type="submit" class="btn btn-success">
		        	<a class="last-button" href="/orders/4/payments_index/">
	            		Finalizar Compra <span class="glyphicon glyphicon-play"></span>
	        		</a>
	        	</button>
        	</div>
       	</div>
	</div>
@stop