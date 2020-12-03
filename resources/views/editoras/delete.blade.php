@extends('layout')
@section('header')
    <h1>Eliminar Editora</h1>
    @endsection
    
@section('conteudo')

<h3>Deseja eliminar o livro</h3>
<h3>{{$editora->nome}}</h3>
<form action="{{route('editoras.destroy', ['ide'=>$editora->id_editora])}}" method="post">
@csrf
@method('delete')
    <input type="submit" value="enviar">
    

</form>
@endsection