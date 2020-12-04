@extends('layout')
@section('header')
Livraria
@endsection

@section('conteudo')
<h3>Livros</h3>
<ul>

@foreach($livros as $livro)
<li>
    @if(!is_null($livro->uuid))
<a href="{{route('livros.show', ['id'=>$livro->uuid])}}">
    @else
<a href="{{route('livros.show', ['id'=>$livro->id_livro])}}">
    @endif
    {{$livro->titulo}}
</a>
</li>
@endforeach
   <br> {{$livros->render()}}
</ul>
<a href="{{route('livros.create')}}" class="btn btn-info" role="button">Novo Livro</a>
@endsection
