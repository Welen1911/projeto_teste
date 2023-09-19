@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="col0md-10 offset dashboard-title-container">
    <h1>Meus eventos</h1>

</div>
<div class="col-md-10 offset dashboard-events-container">
    @if(count($events) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <th scope="row">
                    {{ $loop->index+1 }}
                </th>
                <td>
                    <a href="/events/{{ $event->id }}">{{ $event->title }}</a>
                </td>
                <td>
                    {{ count($event->users)}}
                </td>
                <td>
                    <a href="/edit/{{ $event->id }}" class="btn btn-info edit-btn"> <ion-icon name="create-outline"></ion-icon> Editar</a>
                    <form action="/delete/{{ $event->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn"> <ion-icon name="trash-outline"></ion-icon> Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Você não tem eventos, <a href="/events/create">Criar evento</a>!</p>
    @endif
</div>
<hr>
<div class="col0md-10 offset dashboard-title-container">
    <h1>Eventos que você confirmou presença:</h1>

</div>
<div class="col-md-10 offset dashboard-events-container">

    @if(count($eventsAsParticipants) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventsAsParticipants as $event)
            <tr>
                <th scope="row">
                    {{ $loop->index+1 }}
                </th>
                <td>
                    <a href="/events/{{ $event->id }}">{{ $event->title }}</a>
                </td>
                <td>
                    {{ count($event->users) }}
                </td>
                <td>
                <a href="">Sair do evento</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Você ainda não confirmou presença em nenhum evento!, <a href="/">Veja os eventos</a>!</p>
    @endif
</div>
@endsection
