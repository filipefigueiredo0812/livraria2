@extends('layout')
@section('header')
    <h1>Editar Livro</h1>
    @endsection
    
@section('conteudo')
<form action="{{route('livros.update', ['id'=>$livro->id_livro])}}" method="post">
@csrf
    @method('patch')
    Título*: <input type="text" name="titulo" value="{{$livro->titulo}}"><br>
    @if ($errors->has('titulo'))
    <div class="alert alert-danger" role="alert">
    Título inválido.<br><br>
    </div>
    @endif
    
    Idioma: <input type="text" name="idioma" value="{{$livro->idioma}}"><br>
    @if ($errors->has('idioma'))
    <div class="alert alert-danger" role="alert">
    Idioma inválido.<br><br>
    </div>
    @endif
    
    Total páginas: <input type="text" name="total_paginas" value="{{$livro->total_paginas}}"><br>
    @if ($errors->has('total_paginas'))
    <div class="alert alert-danger" role="alert">
    Número de páginas inválido.<br><br>
    </div>
    @endif
    
    Data Edição: <input type="date" name="data_edicao" value="{{$livro->data_edicao}}"><br>
    @if ($errors->has('data_edicao'))
    <div class="alert alert-danger" role="alert">
    Valor inserido incorretamente.<br><br>
    </div>
    @endif
    
    ISBN*: <input type="text" name="isbn" value="{{$livro->isbn}}"><br>
    @if ($errors->has('isbn'))
    <div class="alert alert-danger" role="alert">
    Deverá indicar um ISBN correto (13 caracteres)<br><br>
    </div>
    @endif
    
    Observações: <textarea type="text" name="observacoes">{{$livro->observacoes}}</textarea><br>
    @if ($errors->has('observacoes'))
    <div class="alert alert-danger" role="alert">
    Observação inválida.<br><br>
    </div>
    @endif
    
    Imagem Capa: <input type="text" name="imagem_capa" value="{{$livro->imagem_capa}}"><br>
    @if ($errors->has('imagem_capa'))
    <div class="alert alert-danger" role="alert">
    Imagem inválida.<br><br>
    </div>
    @endif
    
    Género: <input type="text" name="id_genero" value="{{$livro->id_genero}}"><br>
    @if ($errors->has('id_genero'))
    <div class="alert alert-danger" role="alert">
    Género inválido.<br><br>
    </div>
    @endif
    
    Autor: <input type="text" name="id_autor" value="{{$livro->id_autor}}"><br>
    @if ($errors->has('id_autor'))
    <div class="alert alert-danger" role="alert">
    Autor inválido.<br><br>
    </div>
    @endif
    
    Sinopse: <textarea type="text" name="sinopse">{{$livro->sinopse}}</textarea><br>
    @if ($errors->has('sinopse'))
    <div class="alert alert-danger" role="alert">
    Sinopse Inválida.<br><br>
    </div>
    @endif
    <input type="submit" value="enviar">
    

</form>
@endsection