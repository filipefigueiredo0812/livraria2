@extends('layout')
@section('header')
    <h1>Eliminar Genero</h1>
    @endsection
    
@section('conteudo')

<h3>Deseja eliminar o genero</h3>
<h3>{{$genero->designacao}}</h3>
<form action="{{route('generos.destroy', ['idg'=>$genero->id_genero])}}" method="post">
@csrf
@method('delete')
    <input type="submit" value="enviar">
    

</form>
@endsection