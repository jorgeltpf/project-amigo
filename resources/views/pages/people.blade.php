@extends('app')
@section('title') Pessoa :: @parent @stop
@section('content')
    <div class="row">
        <div class="page-header">
            <h2>Sobre</h2>
        </div>
    </div>
@endsection

@extends('app')
@section('title') Pessoa :: @parent @stop
@section('content')

	<!-- {!! Form::model($article, ['method' => 'PATCH', 'action' => ['ArticlesController@update', $article->id]]) !!} -->
		@include ('pages.form_people', ['submitButtonText' => 'Atualizar Artigo'])
	<!-- {!! Form::close() !!} -->

	@include ('errors.list')

@stop