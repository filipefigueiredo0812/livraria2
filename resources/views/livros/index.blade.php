@extends('layout')
@section('header')
Livraria
@endsection

@section('conteudo')
<h3>Livros</h3>
<ul>

@foreach($livros as $livro)
<li>
<a href="{{route('livros.show', ['id'=>$livro->id_livro])}}">
    {{$livro->titulo}}
</a>
</li>
@endforeach
   <br> {{$livros->render()}}
</ul>
<a href="{{route('livros.create')}}" class="btn btn-info" role="button">Novo Livro</a>
@endsection
