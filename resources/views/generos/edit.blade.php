@extends('layout')
@section('header')
    <h1>Novo Género</h1>
    @endsection
    
@section('conteudo')
<form action="{{route('generos.update', ['idg'=>$genero->id_genero])}}" method="post">
@csrf
    @method('patch')
    Designação*: <input type="text" name="designacao" value="{{$genero->designacao}}"><br>
    @if ($errors->has('designacao'))
    <div class="alert alert-danger" role="alert">
    Designação inválida.<br><br>
    </div>
    @endif
    
    Observações: <textarea type="text" name="observacoes">{{$genero->observacoes}}</textarea><br>
    @if ($errors->has('observacoes'))
    <div class="alert alert-danger" role="alert">
    Observação inválida.<br><br>
    </div>
    @endif
    
    
    <input type="submit" value="enviar">
    

</form>
@endsection