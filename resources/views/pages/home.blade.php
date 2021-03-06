@extends('app', ['title' => 'home'])
@section('title') Home :: @parent @stop
@section('content')
    <div class="row">
        <div class="page-header">
            <h2>Encontre locais próximos</h2>
        </div>
    </div>
    <div id="cep-div" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <form class="form-horizontal" role="form" method="post" action="index.php">            
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Digite seu CEP</div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12" style="padding-top:10px;">
                        <div class="input-group col-md-8 col-md-offset-2">
                            <input type="text" class="form-control cep" id="cep" name="cep" value="" required title="">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info" id="btn-cep"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <! Laravel>
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
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            if (typeof jQuery == 'undefined') {
                alert('no jQuery.fn.jquery');
            }
            $('#myCarousel').carousel({
                interval: 4000
            });

            $('.cep').mask('99999-999');
            $('#btn-cep').on('click', function() {
                $cep = $('#cep');
                if ($cep.val() !== "") {
                    // Desabilita o qTip quando o cep está preenchido
                    $cep.qtip('disable');
                    $('#btn-confirm').qtip('disable');
                    // Efeito para apresentar o formulário com endereço
                    $('#address').css('visibility', 'visible');
                    $('#address').css('opacity', '1');
                    $('#address').css('transition-delay', '0s');
                    // Busca o endereço no webservice com base no cep digitado
                    if ($cep.val()) {
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
                                    $('#btn-confirm').data('field', true);
                                }
                            },
                            error: function() {
                                alert("Ocorreu um erro!");
                            }
                        });
                    } else {
                        $('#address :input').removeAttr('readonly');
                    }
                } else {
                    // Informa ao usuário a respeito da obrigatoriedade de preencher o campo
                    $cep.qtip({
                        content: {
                            text: 'Por favor preencha o seu cep',
                            show: {
                                event: 'mouseover'
                            },
                            hide: {
                                event: 'unfocus click'
                            },
                        }
                    });
                    $('#address :input').val('');
                    $('#btn-confirm').data('field', false);
                }
            });

            $('#btn-confirm').on('click', function() {
                // Habilita o botão de confirmar para o click do mouse apenas quando o cep está preenchido
                if ($(this).data('field') === true) {
                    $(this).qtip('disable');
                    window.location.href = '/establishments/';
                } else {
                    $(this).qtip({
                        content: {
                            text: 'Por favor preencha o seu cep',
                            show: {
                                event: 'mouseover'
                            },
                            hide: {
                                event: 'unfocus click'
                            },
                        }
                    });
                }
            });
        });
    </script>

@endsection
@stop
