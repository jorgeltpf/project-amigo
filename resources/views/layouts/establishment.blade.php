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

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            @include('partials.check_filter')
            <div class="col-md-9">    

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Restaurantes Próximos
                            <small>Endereço</small>
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
                            <h3>{{$s['name']}}</h3>
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

                <!-- <div class="row text-center">
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
                </div> -->
                <!-- /.row -->

                <!-- <hr> -->

                <!-- Footer -->
                <!-- <footer>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Copyright &copy; Amigo Entregador 2016</p>
                        </div>
                    </div>
                </footer>-->
            </div>
        </div>
    </div>
@endsection