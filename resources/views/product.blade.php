@extends('layout.main')

@section('title', 'Produto')
@section('content')
<h1>Produto</h1>
@if($id != null)
<p>Name: {{$id}}</p>
@else
@endif
@endsection
