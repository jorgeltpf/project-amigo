	<div class="form-group">
		{!! Form::label('name', 'Nome:') !!}
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('phone', 'Telefone:') !!}
		{!! Form::text('phone', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('cell_phone', 'Celular:') !!}
		{!! Form::text('cell_phone', null, ['class' => 'form-control']) !!}
	</div>	

	<div class="form-group">
		{!! Form::label('birth_date', 'Nascimento:') !!}
		{!! Form::input('date','birth_date', $article->published_at->format('Y-m-d'), ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('people_type_list', 'Tipo:') !!}
		{!! Form::select('people_type_list[]', $people_type_list, null, ['id' => 'people_type_list', 'class' => 'form-control', 'multiple']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
	</div>

	@section('footer')
		<script type="text/javascript">
			$('#people_type_list').select2({
				placeholder: "Escolha um tipo:"
			});
		</script>
	@endsection