@extends('app')
@section('title') Estabelecimentos :: @parent @stop

@section('styles')
    <link href="{{ elixir('css/establishments.css') }}" rel="stylesheet">
@endsection

@section('content')

     <div class="row">
        <div class="page-header">
            <h2>{{$title}}</h2>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            @include('partials.check_filter')
            <div class="col-md-9">    

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Restaurantes Próximos
                            <!-- <small>Endereço</small> -->
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Estabelecimentos -->
                @foreach ($stab as $s)
                    <div class="row">
                        <div class="col-md-7 est-image">
                            <a href="#">
                                <!-- <img class="img-responsive" src="http://placehold.it/700x300" alt=""> -->
                                {!! HTML::image('/images/establishments/'.$s['image']) !!}
                            </a>
                        </div>
                        <div class="col-md-5">
                            <h3><strong>{{$s['name']}}</strong></h3>
                            <h4>{{$s['phone']}}</h4>
                            <p>{{$s['street']}}, {{$s['street_number']}}</p>
                            <p>{{$s['neighborhood']}}</p>
                            <p>{{$s['complement']}}</p>
                            <a class="btn btn-primary pull-left" href="/establishments/{{$s['id']}}/view_establishment/">Acessar <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                    </div>

                    <hr>
                @endforeach

                <!-- Pagination -->
                <div class="row text-center">
                    {!! $establishments->render() !!}
                </div>
            </div>
        </div>
    </div>

@endsection