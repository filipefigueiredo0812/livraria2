@extends('layout')
@section('header')
    <h1>Nova Editora</h1>
    @endsection
    
@section('conteudo')
<form action="{{route('editoras.update', ['ide'=>$editora->id_editora])}}" method="post">
@csrf
    @method('patch')
    Nome*: <input type="text" name="nome" value="{{$editora->nome}}"><br>
    @if ($errors->has('nome'))
    <div class="alert alert-danger" role="alert">
    Nome inválido.<br><br>
    </div>
    @endif
    
    Morada: <input type="text" name="morada" value="{{$editora->morada}}"><br>
    @if ($errors->has('morada'))
    <div class="alert alert-danger" role="alert">
    Morada inválida.<br><br>
    </div>
    @endif
    
    Observações: <textarea type="text" name="observacoes">{{$editora->observacoes}}</textarea><br>
    @if ($errors->has('observacoes'))
    <div class="alert alert-danger" role="alert">
    Observação inválida.<br><br>
    </div>
    @endif
    
    
    <input type="submit" value="enviar">
    

</form>
@endsection