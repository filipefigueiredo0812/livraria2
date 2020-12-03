@extends('layout')
@section('header')
    <h1>Eliminar Livro</h1>
    @endsection
    
@section('conteudo')

<h3>Deseja eliminar o livro</h3>
<h3>{{$livro->titulo}}</h3>
<form action="{{route('livros.destroy', ['id'=>$livro->id_livro])}}" method="post">
@csrf
@method('delete')
    <input type="submit" value="enviar">
    

</form>
@endsection