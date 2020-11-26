@extends('layout')
@section('header')
    <h1>Nova Editora</h1>
    @endsection
    
@section('conteudo')
<form action="{{route('editoras.store')}}" method="post">
@csrf
    
    Nome*: <input type="text" name="nome" value="{{old('designacao')}}"><br>
    @if ($errors->has('nome'))
    <div class="alert alert-danger" role="alert">
    Nome inválido.<br><br>
    </div>
    @endif
    
    Morada: <input type="text" name="morada" value="{{old('morada')}}"><br>
    @if ($errors->has('morada'))
    <div class="alert alert-danger" role="alert">
    Morada inválida.<br><br>
    </div>
    @endif
    
    Observações: <textarea type="text" name="observacoes">{{old('observacoes')}}</textarea><br>
    @if ($errors->has('observacoes'))
    <div class="alert alert-danger" role="alert">
    Observação inválida.<br><br>
    </div>
    @endif
    
    
    <input type="submit" value="enviar">
    

</form>
@endsection