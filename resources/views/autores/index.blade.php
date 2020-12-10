@extends('layout')
@section('header')
Livraria
@endsection
@section('conteudo')
<h3>Autores</h3>
<ul>

@foreach($autores as $autor)
<li>
<a href="{{route('autores.show', ['ida'=>$autor->id_autor])}}">
    {{$autor->nome}}
</a></li>
@endforeach
   <br> {{$autores->render()}}
</ul>
@if(auth()->check())
<a href="{{route('autores.create')}}" class="btn btn-info" role="button">Novo Autor</a>
@endif
@endsection