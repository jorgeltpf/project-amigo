@extends('app')
@section('title') Home :: @parent @stop
@section('content')
    <div class="row">
        <div class="page-header">
            <h2>Página Inicial</h2>
        </div>
    </div>
    <div class="row">
        <form class="form-horizontal" role="form" method="post" action="index.php">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Digite seu CEP</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control cep" id="cep" name="cep" value="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <!-- <input id="submit" name="submit" type="submit" value="Buscar Restaurantes" class="btn btn-primary"> -->
                    <!-- <span class="glyphicon glyphicon-search" /> -->
                    <button type="button" class="btn btn-primary" id="btn-cep"><i class="glyphicon glyphicon-search"></i> Buscar Restaurantes</button>
                </div>
            </div>  
            <div class="col-sm-12">
                <input type="text" class="form-control" id="street" name="street" value="">
                <input type="text" class="form-control" id="neighborhood" name="street" value="">
                <input type="text" class="form-control" id="city" name="city" value="">
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <! Teste>
                </div>
            </div>
        </form>
    </div>

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
            $.ajax({
                type: "GET",
                url: "http://viacep.com.br/ws/"+$('#cep').val()+"/json/",
                // data: $('form.contact').serialize(),
                success: function(data){
                    $('#street').val(data.logradouro);
                    $('#neighborhood').val(data.bairro);
                    $('#city').val(data.localidade);
                },
                error: function(){
                    alert("failure");
                }
            });
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
    </script>
@endsection
@stop
