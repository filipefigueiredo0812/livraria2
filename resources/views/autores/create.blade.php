@extends('layout')
@section('header')
    <h1>Novo Autor</h1>
    @endsection
    
@section('conteudo')
<form action="{{route('autores.store')}}" method="post">
@csrf
    
    Nome*: <input type="text" name="nome" value="{{old('nome')}}"><br>
    @if ($errors->has('nome'))
    <div class="alert alert-danger" role="alert">
    Nome inválido.<br><br>
    </div>
    @endif
    
    Data Nascimento: <input type="date" name="data_nascimento" value="{{old('data_nascimento')}}"><br>
    @if ($errors->has('data_nascimento'))
    <div class="alert alert-danger" role="alert">
    Valor inserido incorretamente.<br><br>
    </div>
    @endif
    
    Fotografia: <input type="text" name="fotografia" value="{{old('fotografia')}}"><br>
    @if ($errors->has('fotografia'))
    <div class="alert alert-danger" role="alert">
    Fotografia inválida.<br><br>
    </div>
    @endif
    
    <input type="submit" value="enviar">
    

</form>
@endsection