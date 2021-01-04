@extends('layout')

@section('header')
Livraria
@endsection

@section('conteudo')
<h3>Users</h3>
<ul>

@foreach($users as $user)
<li>
    <h6>{{$user->name}}  {{$user->email}}  {{$user->tipo_user}}<h6>
</li>
@endforeach
   <br> 
</ul>


@endsection
