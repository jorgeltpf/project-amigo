@extends('app', [''])
@section('title') Home :: @parent @stop
@section('content')
    <div class="row">
        <div class="page-header">
            <h2>Encontre locais próximos</h2>
        </div>
    </div>
    <div id="#cep-div" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <form class="form-horizontal" role="form" method="post" action="index.php">            
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Digite seu CEP</div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12" style="padding-top:10px;">
                        <div class="input-group col-md-8 col-md-offset-2">
                            <input type="text" class="form-control cep" id="cep" name="cep" value="" required>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info" id="btn-cep"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
<!--             <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="button" class="btn btn-primary" id="btn-cep"><i class="glyphicon glyphicon-search"></i> Buscar Restaurantes</button>
                </div>
            </div>   -->
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <! Teste>
            </div>
        </div>
        </form>
    </div>

    <!-- {!! Form::open() !!} -->

    <div id="address" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" style="visibility:hidden; opacity:0; transition:visibility 0s linear 0.5s,opacity 0.5s linear;">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Confirme o seu endereço</div>
            </div>
            <div class="panel-body">
                <form id="address-confirmation" class="form-horizontal" role="form">
                    <div class="form-group" style="margin-bottom:-10px">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <label for="street">Rua</label>
                                    <input type="text" class="form-control col-sm-6" id="street" name="street" value="" readonly="readonly">
                                </div>
                                <div class="col-md-3">
                                    <label for="number">Nº</label>
                                    <input type="text" class="form-control" id="number" name="number" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="address-atr">
                        <label for="neighborhood">Complemento</label>
                        <input type="text" class="form-control" id="complement" name="complement" value="" readonly="readonly">
                    </div>
                    <div class="address-atr">
                        <label for="neighborhood">Bairro</label>
                        <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="" readonly="readonly">
                    </div>
                    <div class="form-group" style="margin-bottom:-10px">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <label for="city">Cidade</label>
                                    <input type="text" class="form-control" id="city" name="city" value="" readonly="readonly">
                                </div>
                                <div class="col-md-3">
                                  <label for="number">UF</label>
                                    <input type="text" class="form-control" id="state" name="state" value="" readonly="readonly">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="form-group">
                    <div class="col-md-12" style="margin-top:10px;">
                        <button id="btn-confirm" type="button" class="btn btn-success center-block"><i class="icon-hand-right"></i>Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!--   <div class="row">
        <form class="form-horizontal">
                <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">This Page is Disabled</div>
                <div class="panel-body">This page is temporarily disabled by the site administrator for some reason.<br> <a href="#">Click here</a> to enable the page.</div>
                </div>
            </div>
                <div class="panel panel-default">
                <label for="street">Rua</label>
                <input type="text" class="form-control col-sm-6" id="street" name="street" value="">

                </div>
            </div>
            <div class="panel-body">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">@</span>
                    <input type="text" class="form-control input-lg" placeholder="Username">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="text" class="form-control" placeholder="Currency">
                </div>
                <br>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">{}</span>
                    <input type="text" class="form-control" placeholder="Code">
                </div>
            </div>
            <div class="form-group">
                <label for="neighborhood" class="col-sm-2 control-label">Bairro</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="">
                </div>
            </div>
        </form>
    </div> -->
    <!-- {!! Form::close() !!} -->

@endsection

@section('scripts')
    @parent
    <script>
        $('#myCarousel').carousel({
            interval: 4000
        });
        // $("#myModal").modal('show');
        $('.cep').mask('99999-999');
        $("#btn-cep").click(function() {
            $('#address').css('visibility', 'visible');
            $('#address').css('opacity', '1');
            $('#address').css('transition-delay', '0s');
            if ($('#cep').val()) {
                $.ajax({
                    type: "GET",
                    url: "http://viacep.com.br/ws/"+$('#cep').val()+"/json/",
                    // data: $('form.contact').serialize(),
                    success: function(data) {
                        if (data) {
                            if (data.logradouro) {
                                $('#street').val(data.logradouro);
                            } else {
                                $('#street').val('').removeAttr('readonly');
                            }
                            if (data.bairro) {
                                $('#neighborhood').val(data.bairro);
                            } else {
                                $('#neighborhood').val('').removeAttr('readonly');
                            }
                            if (data.localidade) {
                                $('#city').val(data.localidade);
                            } else {
                                $('#city').val('').removeAttr('readonly');   
                            }
                            if (data.complemento) {
                                $('#complement').val(data.complemento);
                            } else {
                                $('#complement').val('').removeAttr('readonly');   
                            }
                            if (data.uf) {
                                $('#state').val(data.uf);
                            } else {
                                $('#state').val('').removeAttr('readonly');   
                            }
                        }
                    },
                    error: function() {
                        alert("Ocorreu um erro!");
                    }
                });
            } else {
                $('#address :input').removeAttr('readonly');
            }
            // $.ajax({
            //     type: "POST",
            //     url: "process.php", //process to mail
            //     data: $('form.contact').serialize(),
            //     success: function(msg){
            //         $("#thanks").html(msg) //hide button and show thank you
            //         $("#form-content").modal('hide'); //hide popup  
            //     },
            //     error: function(){
            //         alert("failure");
            //     }
            // });
        });



@endsection
@stop
