@extends('layout')
@section('header')
    <h1>Novo Livro</h1>
    @endsection
    
@section('conteudo')
<form action="{{route('livros.store')}}" method="post" enctype="multipart/form-data">
@csrf
    
    Título*: <input type="text" name="titulo" value="{{old('titulo')}}"><br>
    @if ($errors->has('titulo'))
    <div class="alert alert-danger" role="alert">
    Título inválido.<br><br>
    </div>
    @endif
    
    Idioma: <input type="text" name="idioma" value="{{old('idioma')}}"><br>
    @if ($errors->has('idioma'))
    <div class="alert alert-danger" role="alert">
    Idioma inválido.<br><br>
    </div>
    @endif
    
    Total páginas: <input type="text" name="total_paginas" value="{{old('total_paginas')}}"><br>
    @if ($errors->has('total_paginas'))
    <div class="alert alert-danger" role="alert">
    Número de páginas inválido.<br><br>
    </div>
    @endif
    
    Data Edição: <input type="date" name="data_edicao" value="{{old('data_edicao')}}"><br>
    @if ($errors->has('data_edicao'))
    <div class="alert alert-danger" role="alert">
    Valor inserido incorretamente.<br><br>
    </div>
    @endif
    
    ISBN*: <input type="text" name="isbn" value="{{old('isbn')}}"><br>
    @if ($errors->has('isbn'))
    <div class="alert alert-danger" role="alert">
    Deverá indicar um ISBN correto (13 caracteres)<br><br>
    </div>
    @endif
    
    Observações: <textarea type="text" name="observacoes">{{old('observacoes')}}</textarea><br>
    @if ($errors->has('observacoes'))
    <div class="alert alert-danger" role="alert">
    Observação inválida.<br><br>
    </div>
    @endif
    
    Imagem Capa: <input type="file" name="imagem_capa" value="{{old('imagem_capa')}}"><br>
    @if ($errors->has('imagem_capa'))
    <div class="alert alert-danger" role="alert">
    Imagem inválida.<br><br>
    </div>
    @endif
    
    Género: <select name="id_genero"><br>
    @foreach ($generos as $genero)
        <option value="{{$genero->id_genero}}">{{$genero->designacao}}</option>
    @endforeach
    </select>
    @if ($errors->has('id_genero'))
    <div class="alert alert-danger" role="alert">
    Género inválido.<br><br>
    </div>
    @endif
    
    <br>
    
    
    Autor(es): <select name="id_autor[]" multiple="multiple"><br>
    @foreach ($autores as $autor)
    <option value="{{$autor->id_autor}}">{{$autor->nome}}</option>
    @endforeach
    </select>
    @if ($errors->has('id_autor'))
    <div class="alert alert-danger" role="alert">
    Autor inválido.<br><br>
    </div>
    
    @endif
    <br>
    
    Editora(as): <select name="id_editora[]" multiple="multiple"><br>
    @foreach ($editoras as $editora)
    <option value="{{$editora->id_editora}}">{{$editora->nome}}</option>
    @endforeach
    </select>
    @if ($errors->has('id_editora'))
    <div class="alert alert-danger" role="alert">
    Editora inválida.<br><br>
    </div>
    
    @endif
    <br>
    
    Sinopse: <textarea type="text" name="sinopse">{{old('sinopse')}}</textarea><br>
    @if ($errors->has('sinopse'))
    <div class="alert alert-danger" role="alert">
    Sinopse Inválida.<br><br>
    </div>
    @endif
    <input type="submit" value="enviar">
    

</form>
@endsection