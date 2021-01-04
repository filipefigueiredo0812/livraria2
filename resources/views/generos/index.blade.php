@extends('layout')
@section('header')
Livraria
@endsection
@section('conteudo')
<h3>Generos</h3>
<ul>

@foreach($generos as $genero)
<li>
<a href="{{route('generos.show', ['idg'=>$genero->id_genero])}}">
    {{$genero->designacao}}
</a></li>
@endforeach
    <br>{{$generos->render()}}
</ul>

@if(auth()->check())
@if(Gate::allows('admin'))
<a href="{{route('generos.create')}}" class="btn btn-info" role="button">Novo Género</a>
@endif
@endif
@endsection