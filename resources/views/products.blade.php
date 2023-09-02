@extends('layout.main')

@section('title', 'Produtos')
@section('content')
<h1>Produtos</h1>
@if($busca != '')
<p>O usuário busca {{$busca}}</p>
@else
<form class="form form-control" action="/product" method="post">
    <div class="">
    <input type="text" name="name" placeholder="Name">
    </div>
    <div class="">
    <input type="password" name="pass" placeholder="Password">
    </div>
    <div>
        <button class="btn btn-sucess">Enviar</button>
    </div>
</form>
@endif
@endsection
