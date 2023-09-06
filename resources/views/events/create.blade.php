@extends('layout.main')

@section('title', 'Criar evento')

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie o seu evento</h1>
    <form action="/events" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento">
        </div>
        <div class="form-group mb-3">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento">
        </div>
        <div class="form-group mb-3">
            <label for="private">O evento é privado?</label>
            <select class="form-control" name="private" id="private">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="description">Descrição do evento:</label>
            <textarea class="form-control" name="description" id="description" placeholder="Descrição"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Criar evento" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection
