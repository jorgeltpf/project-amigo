<!-- Form com informações padrão de cadastro de pessoas -->

<div class="form-group">
	{!! Form::label('cpf', 'CPF:', ['class' => 'control-label col-xs-2', 'for' => 'cpf']) !!}
    <div class="col-xs-10">
    	{!! Form::input('text', 'cpf', !empty($user->person->cpf) ? $user->person->cpf : null, ['class' => 'form-control cpf', 'id' => 'cpf', 'placeholder' => 'Digite seu CPF']) !!}
    </div>
</div>
<div class="form-group">
	{!! Form::label('phone', 'Telefone:', ['class' => 'control-label col-xs-2', 'for' => 'phone']) !!}
    <div class="col-xs-10">
    	{!! Form::input('text', 'phone', !empty($user->person->phone) ? $user->person->phone : null, ['class' => 'form-control phone_with_ddd', 'id' => 'phone', 'placeholder' => 'Digite seu Telefone']) !!}
    </div>
</div>
<div class="form-group">
	{!! Form::label('cell_phone', 'Celular:', ['class' => 'control-label col-xs-2', 'for' => 'cell_phone']) !!}
    <div class="col-xs-10">
    	{!! Form::input('text', 'cell_phone', !empty($user->person->cell_phone) ? $user->person->cell_phone : null, ['class' => 'form-control phone_with_ddd', 'id' => 'cell_phone', 'placeholder' => 'Digite seu Celular']) !!}
    </div>
</div>
<div class="form-group">
	{!! Form::label('cep', 'CEP:', ['class' => 'control-label col-xs-2', 'for' => 'cep']) !!}
    <div class="col-xs-10">
    	{!! Form::input('text', 'cep', !empty($user->person->cep) ? $user->person->cep : null, ['class' => 'form-control cep', 'id' => 'cep', 'placeholder' => 'Digite seu CEP']) !!}
    </div>
</div>
<div class="form-group">
	{!! Form::label('street', 'Rua:', ['class' => 'control-label col-xs-2', 'for' => 'street']) !!}
    <div class="col-xs-6">
    	{!! Form::input('text', 'street', !empty($user->person->street) ? $user->person->street : null, ['class' => 'form-control', 'id' => 'street', 'placeholder' => 'Digite sua Rua']) !!}
    </div>
    <div class="col-xs-2">
    	{!! Form::input('text', 'street_number', !empty($user->person->street_number) ? $user->person->street_number : null, ['class' => 'form-control st_number', 'id' => 'street_number', 'placeholder' => 'Número']) !!}
    </div>
</div>		
<div class="form-group">
	{!! Form::label('neighborhood', 'Bairro:', ['class' => 'control-label col-xs-2', 'for' => 'neighborhood']) !!}
    <div class="col-xs-10">
    	{!! Form::input('text', 'neighborhood', !empty($user->person->neighborhood) ? $user->person->neighborhood : null, ['class' => 'form-control', 'id' => 'neighborhood', 'placeholder' => 'Bairro']) !!}
    </div>
</div>
<div class="form-group">
	{!! Form::label('complement', 'Complemento:', ['class' => 'control-label col-xs-2', 'for' => 'complement']) !!}
    <div class="col-xs-10">
    	{!! Form::input('text', 'complement', !empty($user->person->complement) ? $user->person->complement : null, ['class' => 'form-control', 'id' => 'complement', 'placeholder' => 'Digite o complemento']) !!}
    </div>
</div>
<div class="form-group">
	{!! Form::label('city', 'Cidade:', ['class' => 'control-label col-xs-2', 'for' => 'city']) !!}
    <div class="col-xs-10">
    	{!! Form::input('text', 'city', !empty($user->person->city) ? $user->person->city : null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'Digite a sua cidade']) !!}
    </div>
</div>

@section('scripts')
<script type="text/javascript">
    $('#cep').on('focusout blur change', function() {
        if ($('#cep').val()) {
            $.ajax({
                type: "GET",
                url: "http://viacep.com.br/ws/"+$('#cep').val()+"/json/",
                // data: $('form.contact').serialize(),
                success: function(data) {
                    console.log(data);
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
    });
</script>
@stop