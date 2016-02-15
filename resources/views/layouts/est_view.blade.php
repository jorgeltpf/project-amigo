
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

            @foreach ($stab as $s)
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        {!! HTML::image('/images/establishments/'.$stab['image']) !!}
                        <!-- <img src="http://placehold.it/320x150" alt="{{$s['name']}}"> -->
                        <div class="caption">
                            <h4 class="pull-right">{{$s['street']}}</h4>
                            <h4><a href="#">{{$s['name']}}</a>
                            </h4>
                            <p>Descrição comida <a target="_blank" href="http://www.bootsnipp.com">site</a>.</p>
                        </div>
                        <div class="ratings">
                            <p class="pull-right">{{$s['phone']}}</p>
                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach    
            </div>

        </div>

    </div>

</div>
@endsection