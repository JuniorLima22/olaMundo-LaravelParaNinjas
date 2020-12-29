@extends('layouts.app')
@section('title', 'Alterar o Produto: '. $produto->titulo)
@section('content')
	<h1>Alterar o produto: {{$produto->titulo}}</h1>

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

	    @if(Session::has('mensagem'))
	      <div class="alert alert-success alert-dismissible fade show" role="alert">
	        {{Session::get('mensagem')}}
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	    @endif
	  </div>
	</div>

	{{Form::open(['route'=>['produtos.update', $produto->id], 'enctype'=>'multipart/form-data', 'method'=>'PUT'])}}
	{{Form::label('referencia', 'Referência', ['class'=>'prettyLabels'])}}
	{{Form::text('referencia', $produto->referencia, ['class'=>'form-control', 'required', 'placeholder'=>'Referência'])}}

	{{Form::label('titulo', 'Título')}}
	{{Form::text('titulo', $produto->titulo, ['class'=>'form-control', 'required', 'placeholder'=>'Título'])}}

	{{Form::label('descricao', 'Descrição')}}
	{{Form::textarea('descricao', $produto->descricao, ['row'=>3, 'class'=>'form-control', 'required',   'placeholder'=>'Descrição'])}}

	{{Form::label('preco', 'Preço')}}
	{{Form::text('preco', $produto->preco, ['class'=>'form-control', 'required', 'placeholder'=>'Preço'])}}

	{{Form::label('fotoproduto', 'Foto')}}
	{{Form::file('fotoproduto', ['class'=>'form-control', 'id'=>'fotoproduto'])}}

	<br>

	{{Form::submit('Alterar Produto', ['class'=>'btn btn-primary'])}}
	{{link_to('/produtos', 'Voltar', ['class'=>'btn btn-outline-secondary'])}}
	{{Form::close()}}

@endsection