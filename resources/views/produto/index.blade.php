@extends('layouts.app')
@section('title', 'Listagem de Produtos')
@section('content')
	<h1>@yield('title') {{link_to('/produtos/create', 'Cadastrar Produto', ['class'=>'btn btn-outline-secondary'])}}</h1>
	{{Form::open(['url'=>['produtos/buscar']])}}
		<div class="row">
			<div class="col-lg-12">
				<div class="input-group">
					{{Form::text('busca', $busca, ['class'=>'form-control', 'required', 'placeholder'=>'Buscar'])}}

					<span class="input-group-btn">
						{{Form::submit('Buscar', ['class'=>'btn btn-default'])}}
					</span>
				</div>
			</div>
		</div>
	{{Form::close()}}

	<div class="row">
	  <div class="col-md-12">
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

	<div class="row">
		@foreach ($produtos as $produto)
			<div class="col-md-3">
				<h4>{{$produto->titulo}}</h4>

				@if(file_exists("./img/produtos/". md5($produto->id). ".jpg"))
					<a href="{{url('produtos/'.$produto->id)}}">
						<!-- <div class="img-thumbnail">
							{{Html::image(asset("img/produtos/". md5($produto->id). ".jpg"))}}
						</div> -->

						<img src='{{asset("img/produtos/". md5($produto->id). ".jpg")}}' title="{{$produto->titulo}}" class="img-thumbnail">
					</a>
				@else
					{{link_to('/produtos/'. $produto->id, $produto->titulo, ['class'=>'btn btn-outline-secondary'])}}
				@endif
				<div class="mt-2">
				{{Form::open(['route'=>['produtos.destroy', $produto->id], 'method'=>'DELETE'])}}

				{{link_to('/produtos/'. $produto->id. '/edit', 'Editar', ['class'=>'btn btn-outline-primary'])}}

				{{Form::submit('Excluir', ['class'=>'btn btn-outline-danger'])}}
				{{Form::close()}}
				</div>
			</div>
		@endforeach

		{{$produtos->links('pagination::bootstrap-4')}}
	</div>
	<br>
@endsection