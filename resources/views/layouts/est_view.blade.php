
@section('styles')
<!-- {!! HTML::style('css/shop.css') !!}  -->
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
                <div class="col-md-7 est-image">
                    <a href="#">
                        {!! HTML::image('/images/establishments/'.$stab['image']) !!}
                    </a>
                </div>
                <div class="col-md-5">
                    <h3>{{$stab['name']}}</h3>
                    <h4>{{$stab['phone']}}</h4>
                    <p>{{$stab['street']}}, {{$stab['street_number']}}</p>
                    <p>{{$stab['neighborhood']}}</p>
                    <p>{{$stab['complement']}}</p>
                </div>
            </div>

            <hr>

            <div class="row">

            @foreach ($products as $product)
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        {!! HTML::image('/images/establishments/'.$stab['image']) !!}
                        <div class="caption">
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
                        <div class="clearfix">
                            <a href="/admin/item_orders/1/index" role="button" class="btn btn-success btn-large pull-right">Comprar</a>
                            <!-- <button type="button" class="btn btn-primary pull-right">Comprar</button> -->
                        </div>
                    </div>
                </div>
            @endforeach    
            </div>

        </div>

    </div>

    <hr>

    <!-- Pagination -->
    <div class="row text-center">
        <div class="col-lg-12">
            <ul class="pagination">
                <li>
                    <a href="#">&laquo;</a>
                </li>
                <li class="active">
                    <a href="#">1</a>
                </li>
                <li>
                    <a href="#">2</a>
                </li>
                <li>
                    <a href="#">3</a>
                </li>
                <li>
                    <a href="#">4</a>
                </li>
                <li>
                    <a href="#">5</a>
                </li>
                <li>
                    <a href="#">&raquo;</a>
                </li>
            </ul>
        </div>
    </div>

</div>
@endsection