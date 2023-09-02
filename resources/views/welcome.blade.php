@extends('layout.main')

@section('title', 'HDC events')

@section('content')
<h1>Algum titulo</h1>

<ol>
</ol>
@php
$nome = "Welen";
echo $nome;
@endphp
<!-- Comentário HTML -->
{{-- Comentário blade --}}


<a class="btn btn-dark" href="/products">Enviar</a>
@endsection
