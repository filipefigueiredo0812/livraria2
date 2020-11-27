@extends('layout')
@section('header')
    <h1>Editar Autor</h1>
@endsection
    
@section('conteudo')
<form action="{{route('autores.update', ['ida'=>$autores->id_autor])}}" method="post">
@csrf
    @method('patch')
    Nome*: <input type="text" name="nome" value="{{$autores->nome}}"><br>
    @if ($errors->has('nome'))
    <div class="alert alert-danger" role="alert">
    Nome inválido.<br><br>
    </div>
    @endif
    
    Data Nascimento: <input type="date" name="data_nascimento" value="{{$autores->data_nascimento}}"><br>
    @if ($errors->has('data_nascimento'))
    <div class="alert alert-danger" role="alert">
    Valor inserido incorretamente.<br><br>
    </div>
    @endif
    
    Fotografia: <input type="text" name="fotografia" value="{{$autores->fotografia}}"><br>
    @if ($errors->has('fotografia'))
    <div class="alert alert-danger" role="alert">
    Fotografia inválida.<br><br>
    </div>
    @endif
    
    <input type="submit" value="enviar">
    

</form>
@endsection