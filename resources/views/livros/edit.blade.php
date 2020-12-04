@extends('layout')
@section('header')
    <h1>Editar Livro</h1>
    @endsection
    
@section('conteudo')
<form action="{{route('livros.update', ['id'=>$livro->id_livro])}}" method="post">
@csrf
    @method('patch')
    <div class="form-group row">
    Título*: <input type="text" name="titulo" value="{{$livro->titulo}}"><br>
    @if ($errors->has('titulo'))
    <div class="alert alert-danger" role="alert">
    Título inválido.<br><br>
    </div>
    @endif
    </div>
    
    <div class="form-group row">
    Idioma: <input type="text" name="idioma" value="{{$livro->idioma}}"><br>
    @if ($errors->has('idioma'))
    <div class="alert alert-danger" role="alert">
    Idioma inválido.<br><br>
    </div>
    @endif
    </div>
    
    <div class="form-group row">
    Total páginas: <input type="text" name="total_paginas" value="{{$livro->total_paginas}}"><br>
    @if ($errors->has('total_paginas'))
    <div class="alert alert-danger" role="alert">
    Número de páginas inválido.<br><br>
    </div>
    @endif
    </div>
    
    <div class="form-group row">
    Data Edição: <input type="date" name="data_edicao" value="{{$livro->data_edicao}}"><br>
    @if ($errors->has('data_edicao'))
    <div class="alert alert-danger" role="alert">
    Valor inserido incorretamente.<br><br>
    </div>
    @endif
    </div>
    
    <div class="form-group row">
    ISBN*: <input type="text" name="isbn" value="{{$livro->isbn}}"><br>
    @if ($errors->has('isbn'))
    <div class="alert alert-danger" role="alert">
    Deverá indicar um ISBN correto (13 caracteres)<br><br>
    </div>
    @endif
    </div>
    
    <div class="form-group row">
    Observações: <textarea type="text" name="observacoes">{{$livro->observacoes}}</textarea><br>
    @if ($errors->has('observacoes'))
    <div class="alert alert-danger" role="alert">
    Observação inválida.<br><br>
    </div>
    @endif
    </div>
    
    <div class="form-group row">
    Imagem Capa: <input type="text" name="imagem_capa" value="{{$livro->imagem_capa}}"><br>
    @if ($errors->has('imagem_capa'))
    <div class="alert alert-danger" role="alert">
    Imagem inválida.<br><br>
    </div>
    @endif
    </div>
        
    <div class="form-group row">    
    Género: <select name="id_genero"><br>
    @foreach ($generos as $genero)
        <option value="{{$genero->id_genero}}" @if($genero->id_genero==$livro->id_genero)selected @endif
            >{{$genero->designacao}}</option>
    @endforeach
    @if ($errors->has('id_genero'))
    <div class="alert alert-danger" role="alert">
    Género inválido.<br><br>
    </div>
    @endif
    </select>
    <br>
    </div>
        
    <div class="form-group row">
    Autor(es): <select name="id_autor[]" multiple="multiple" size=2><br>
    @foreach ($autores as $autor)
    <option value="{{$autor->id_autor}}" @if(in_array($autor->id_autor, $autoresLivro))selected @endif>{{$autor->nome}}</option>
    @endforeach
    </select>
    @if ($errors->has('id_autor'))
    <div class="alert alert-danger" role="alert">
    Autor inválido.<br><br>
    </div>
    
    @endif
    <br>
    </div>    
        
    <div class="form-group row">
    Editora(as): <select name="id_editora[]" multiple="multiple" size=2><br>
    @foreach ($editoras as $editora)
    <option value="{{$editora->id_editora}}" @if(in_array($editora->id_editora, $editorasLivro))selected @endif>{{$editora->nome}}</option>
    @endforeach
    </select>
    @if ($errors->has('id_editora'))
    <div class="alert alert-danger" role="alert">
    Editora inválida.<br><br>
    </div>
    
    @endif
    <br>
    </div>
        
    <div class="form-group row">
    Sinopse: <textarea type="text" name="sinopse">{{$livro->sinopse}}</textarea><br>
    @if ($errors->has('sinopse'))
    <div class="alert alert-danger" role="alert">
    Sinopse Inválida.<br><br>
    </div>
    @endif
    </div>
    <input type="submit" value="enviar">
    

</form>
@endsection