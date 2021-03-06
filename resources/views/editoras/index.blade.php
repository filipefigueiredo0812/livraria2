@extends('layout')
@section('header')
Livraria
@endsection
@section('conteudo')
<h3>Editoras</h3>
<ul>

@foreach($editoras as $editora)
<li>
<a href="{{route('editoras.show', ['ide'=>$editora->id_editora])}}">
    {{$editora->nome}}
</a></li>
@endforeach
    <br>{{$editoras->render()}}
</ul>

@if(auth()->check())
@if(Gate::allows('admin'))
<a href="{{route('editoras.create')}}" class="btn btn-info" role="button">Nova Editora</a>
@endif
@endif
@endsection