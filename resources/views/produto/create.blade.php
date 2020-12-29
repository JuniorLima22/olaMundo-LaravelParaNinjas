@extends('layouts.app')
@section('title', 'Adicionar um Produto')
@section('content')
	<h1>Criar um novo produto</h1>

	<div class="row">
	  <div class="col-md-12">
	    @if(count($errors) > 0 )
	      <div class="alert alert-danger alert-dismissible fade show" role="alert">
	        <ul>
	          @foreach($errors->all() as $error)
	            <li> {{$error}} </li>
	          @endforeach
	        </ul>
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	    @endif
	  </div>
	</div>

	{{Form::open(['action' => 'ProdutosController@store'])}}
	{{Form::label('referencia', 'Referência')}}
	{{Form::text('referencia', '', ['class'=>'form-control', 'required', 'placeholder'=>'Referência'])}}

	{{Form::label('titulo', 'Título')}}
	{{Form::text('titulo', '', ['class'=>'form-control', 'required', 'placeholder'=>'Título'])}}

	{{Form::label('descricao', 'Descrição')}}
	{{Form::textarea('descricao', '', ['row'=>3, 'class'=>'form-control', 'required',   'placeholder'=>'Descrição'])}}

	{{Form::label('preco', 'Preço')}}
	{{Form::text('preco', '', ['class'=>'form-control', 'required', 'placeholder'=>'Preço'])}}
	<br>

	{{Form::submit('Cadastrar Produto', ['class'=>'btn btn-primary'])}}
	{{link_to('/produtos', 'Voltar', ['class'=>'btn btn-outline-secondary'])}}
	{{Form::close()}}

@endsection