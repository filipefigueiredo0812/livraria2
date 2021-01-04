@extends('layout')
@section('header')
Autor
@endsection
@section('conteudo')
<ul>
IDA:{{$autores->id_autor}}<br>
Nome:{{$autores->nome}}<br>
    @if(count($autores->livros))
        @foreach($autores->livros as $livro)
            Livros deste autor: {{$livro->titulo}}<br>
        @endforeach
    @else  
        <div class="alert alert-danger" role="alert">
            Neste autor ainda não tem livros!
        </div>
    @endif
Nacionalidade:{{$autores->nacionalidade}}<br>
Data de Nascimento:{{$autores->data_nascimento}}
Fotografia:{{$autores->fotografia}}<br>
Created_at:{{$autores->created_at}}<br>
Updated_at:{{$autores->updated_at}}<br>
Deleted_at:{{$autores->deleted_at}}
</ul>

<br>
<br>

@if(auth()->check())
@if(Gate::allows('admin'))
<a href="{{route('autores.edit', ['ida'=>$autores->id_autor])}}" class="btn btn-info" role="button">Editar Autor</a>

<a href="{{route('autores.delete', ['ida'=>$autores->id_autor])}}" class="btn btn-info" role="button">Eliminar Autor</a>
@endif
@endif

@endsection