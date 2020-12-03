@extends('layout')
@section('header')
    <h1>Eliminar Autor</h1>
    @endsection
    
@section('conteudo')

<h3>Deseja eliminar o livro</h3>
<h3>{{$autor->nome}}</h3>
<form action="{{route('autores.destroy', ['ida'=>$autor->id_autor])}}" method="post">
@csrf
@method('delete')
    <input type="submit" value="enviar">
    

</form>
@endsection