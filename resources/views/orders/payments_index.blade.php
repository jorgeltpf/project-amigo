@extends('app')

@section('title') @parent :: Pagamento @stop

@section('content')
	<div class="row">
		<div class="page-header">
			<h2>Pagamento</h2>
		</div>
	</div>


	<div class="container">
		<div class="row">
			<div class="col-md-6">
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
			<div class="col-md-6">
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
		</div>
		<div class="panel">
			<h2>Formas de Pagamento</h2>
			<div class="panel-body panel-list">
				<ul class="list-inline col-sm-12">
					@foreach($payment_types as $types)
						<li class="col-md-1 col-sm-2 col-xs-6 grid-icon" style="text-align:center">
							<span class="glyphicon glyphicon-credit-card"></span>
							<p>{{$types['description']}}</p>
							<input type="radio" name="types" id="type_{{$types['id']}}" value="{{$types['id']}}">
						</li>
					@endforeach
				</ul>
			</div>
		</div>
		<div class="row">
	        <div class="col-sm-12 col-md-12">
	        <a class="btn btn-success pull-right" href="/orders/4/payments_index/">
            		Finalizar Compra <span class="glyphicon glyphicon-play"></span>
        		</a>
        	</div>
       	</div>
	</div>
@stop