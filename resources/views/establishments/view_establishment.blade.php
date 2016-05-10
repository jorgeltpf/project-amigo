<!-- Visualização dos produtos do Estabelecimento previamente selecionado -->
@extends('app')
@section('styles')
    <link href="{{ elixir('css/establishments.css') }}" rel="stylesheet">
@endsection

@section('title') {{{ $title }}} :: @parent @stop

@section('content')
 <div class="row">
    <div class="page-header">
        <h2>{{$title}}</h2>
    </div>
</div>
<div class="container">
    <div class="row">

        @include('partials.side_menu')

        <div class="col-md-9">
            <div class="row">
	            @foreach ($products as $product)
	                {!!
	                    Form::open([
	                        'action' => 'OrdersController@postCreate',
	                        'class' => 'form',
	                        'enctype' => "multipart/form-data"
	                    ])
	                !!}
	                <div class="col-sm-4 col-lg-4 col-md-4">
	                    <div class="thumbnail">
	                        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
	                        {!! HTML::image('/images/establishments/'.$stab['image']) !!}
	                        <div class="caption">
	                            <input type="hidden" name="product_id" value="{{ $product->id }}">
	                            <input type="hidden" name="price" value="{{ $product->price }}">
	                            <input type="hidden" name="establishment_id" value="{{ $stab->id }}">
	                            <h4 class="pull-right">{{$product['name']}}</h4>
	                            <h4><a href="#">R${{$product['price']}}</a></h4>
	                            <p>{{$product['description']}} <a target="_blank" href="http://www.bootsnipp.com">site</a>.</p>
	                        </div>
	                        <div class="ratings">
	                            <p class="pull-right">R${{$product['price']}}</p>
	                            <p>
	                                <span class="glyphicon glyphicon-star"></span>
	                                <span class="glyphicon glyphicon-star"></span>
	                                <span class="glyphicon glyphicon-star"></span>
	                                <span class="glyphicon glyphicon-star"></span>
	                                <span class="glyphicon glyphicon-star"></span>
	                            </p>
	                        </div>
	                        <div class="text-right control-group">
	                            <a href="/item_orders/" class="btn btn-default"><span class="glyphicon glyphicon-shopping-cart"></span> Carrinho</a>
	                            {!! Form::button("Comprar <span class='glyphicon glyphicon-play'></span>", array('class' => 'btn btn-success', 'type'=>'submit')) !!}
	                        </div>
	                    </div>
	                </div>
	                {!! Form::close() !!}
	            @endforeach
            </div>
        </div>

    </div>

    <hr>

    <!-- Pagination -->
    <div class="row text-center">
        {!! $products->render() !!}
    </div>

</div>
@endsection

@section('scripts')
    @parent
<script type="text/javascript">
$(document).ready(function() {
console.log('$(this)');
    $('.buy_product').on('click', function() {
        console.log($(this));
        // $('#orders').submit();
    });
});
</script>
@stop