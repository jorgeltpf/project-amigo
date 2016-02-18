@extends('app')

@section('title') @parent :: Carrinho @stop

@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-sm-12 col-md-12">
	            <table class="table table-hover">
	                <thead>
	                    <tr>
	                        <th>Produto</th>
	                        <th>Qtd</th>
	                        <th class="text-center">Preço</th>
	                        <th class="text-center">Total</th>
	                        <th> </th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@foreach($item_orders[0]['orders'][0]['item_orders'] as $items)
	                		<tr>
	                			<td class="col-sm-8 col-md-6">
		                        <div class="media">
		                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
		                            <div class="media-body">
		                                <h4 class="media-heading"><a href="#">{{$items['Product']['name']}}</a></h4>
		                                <h5 class="media-heading"> Por <a href="#">{{$item_orders[0]['name']}}</a></h5>
		                                <span>Descrição: </span><span class="text-success"><strong>{{$items['Product']['description']}}</strong></span>
		                            </div>
		                        </div></td>
		                        <td class="col-sm-1 col-md-1" style="text-align: center">
		                        <input type="email" class="form-control" id="qtd" value="{{$items['quantity']}}">
		                        </td>
		                        <td class="col-sm-1 col-md-1 text-center"><strong>R${{$items['amount']}}</strong></td>
		                        <td class="col-sm-1 col-md-1 text-center"><strong>R${{$items['total_amount']}}</strong></td>
								<td class="actions" data-th="">
									<button title="Atualizar" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-refresh"></i></button>
									<button title="Excluir" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>								
								</td>
	                		</tr>
	                	@endforeach
	                    <tr>
	                        <td class="col-sm-8 col-md-6">
	                        <div class="media">
	                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
	                            <div class="media-body">
	                                <h4 class="media-heading"><a href="#">Product name</a></h4>
	                                <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
	                                <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
	                            </div>
	                        </div></td>
	                        <td class="col-sm-1 col-md-1" style="text-align: center">
	                        <input type="email" class="form-control" id="exampleInputEmail1" value="3">
	                        </td>
	                        <td class="col-sm-1 col-md-1 text-center"><strong>$4.87</strong></td>
	                        <td class="col-sm-1 col-md-1 text-center"><strong>$14.61</strong></td>
							<td class="actions" data-th="">
								<button title="Atualizar" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-refresh"></i></button>
								<button title="Excluir" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>								
							</td>
	                        <!-- <td class="col-sm-1 col-md-1">
		                        <button type="button" class="btn btn-danger">
		                            <span class="glyphicon glyphicon-remove"></span> Remove
		                        </button>
                        	 </td>-->
	                    </tr>
	                    <tr>
	                        <td class="col-md-6">
	                        <div class="media">
	                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
	                            <div class="media-body">
	                                <h4 class="media-heading"><a href="#">Product name</a></h4>
	                                <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
	                                <span>Status: </span><span class="text-warning"><strong>Leaves warehouse in 2 - 3 weeks</strong></span>
	                            </div>
	                        </div></td>
	                        <td class="col-md-1" style="text-align: center">
	                        <input type="email" class="form-control" id="exampleInputEmail1" value="2">
	                        </td>
	                        <td class="col-md-1 text-center"><strong>$4.99</strong></td>
	                        <td class="col-md-1 text-center"><strong>$9.98</strong></td>
	                        <td class="col-md-1">
	                        <button type="button" class="btn btn-danger">
	                            <span class="glyphicon glyphicon-remove"></span> Remove
	                        </button></td>
	                    </tr>
	                    <tr>
	                        <td>   </td>
	                        <td>   </td>
	                        <td>   </td>
	                        <td><h5>Sub-total</h5></td>
	                        <td class="text-right"><h5><strong>$24.59</strong></h5></td>
	                    </tr>
	                    <tr>
	                        <td>   </td>
	                        <td>   </td>
	                        <td>   </td>
	                        <td><h5>Frete Estimado</h5></td>
	                        <td class="text-right"><h5><strong>$6.94</strong></h5></td>
	                    </tr>
	                    <tr>
	                        <td>   </td>
	                        <td>   </td>
	                        <td>   </td>
	                        <td><h3>Total</h3></td>
	                        <td class="text-right"><h3><strong>$31.53</strong></h3></td>
	                    </tr>
	                    <tr>
	                        <td>   </td>
	                        <td>   </td>
	                        <td>   </td>
	                        <td>
	                        <button type="button" class="btn btn-default">
	                            <span class="glyphicon glyphicon-shopping-cart"></span> Continuar Comprando
	                        </button></td>
	                        <td>
	                        <button type="button" class="btn btn-success">
	                            Comprar <span class="glyphicon glyphicon-play"></span>
	                        </button></td>
	                    </tr>
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
@stop