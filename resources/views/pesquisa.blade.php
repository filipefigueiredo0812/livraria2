@extends('layout')
@section('header')
Livraria
@endsection
@section('conteudo')
<form method="post" action="{{route('pesquisa.form')}}">
    @csrf
<label for="pesquisa">Pesquisa</label>
<input type="text" name="pesquisa">
<button type="submit">Enviar</button>
<br><br>
@endsection